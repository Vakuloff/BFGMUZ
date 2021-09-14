<?php 
class Music
{
	public function addMusic($dbcon, $title, $author, $user_id, $link)
	{
		$sql = "INSERT INTO Music (title, author, user_id, link, date)
				VALUES (:title, :author, :user_id, :link, NOW())";
				
		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':title', $title);
		$pst->bindParam(':author', $author);
		$pst->bindParam(':user_id', $user_id);
		$pst->bindParam(':link', $link);

		$music = $pst->execute();
		return $music;
	}

	public function getAllMusicByUser($dbcon, $user_id)
	{
		$sql = "SELECT * FROM Music
		WHERE user_id = :user_id";

		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':user_id', $user_id);
		$pst->execute();
		
		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}

	public function searchMusic($dbcon, $search)
	{
		$sql="SELECT * FROM Music
		WHERE title LIKE :search ";

		$pst = $dbcon->prepare($sql);
		$pst->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
		$pst->execute();

		$music = $pst->fetchAll();
		return $music;
	}

	public function likeMusic($dbcon, $user_id, $music_id, $action, $date)
	{
		$sql = "INSERT INTO UsersxMusic (music_id, userd_id, action, date)
			VALUES ($music_id, $userd_id, $action, $date)
			ON DUPLICATE KEY UPDATE action='like'";
		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':user_id', $user_id);
		$pst->bindParam(':music_id', $music_id);
		$pst->bindParam(':action', $action);
		$pst->bindParam(':date', $date);	

		$music = $pst->execute();
		return $music;
	}

	public function unlikeMusic($dbcon, $user_id, $music_id)
	{
		$sql="DELETE FROM UsersxMusic WHERE user_id=$user_id AND music_id=$music_id";

		$pst = $dbcon->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $pst->bindParam(':music_id', $music_id);
       
        $music = $pst->execute();
        return $music;
	}

	public function getLikes($dbcon, $music_id)
	{
		$sql="SELECT COUNT(*) AS Likes FROM UsersxMusic
		WHERE music_id = $music_id AND action='like'";

		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':music_id', $music_id);
		$pst->execute();
		
		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}

	public function ifLiked($dbcon, $user_id, $music_id)
	{
		$sql = "SELECT * FROM UsersxMusic WHERE user_id=$user_id 
  		  AND music_id=$music_id AND action='like'";

  		$pst = $dbcon->prepare($sql);
  		$pst->bindParam(':user_id', $user_id);
		$pst->bindParam(':music_id', $music_id);
		$pst->execute();
		
		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}

	public function getLikedMusic($dbcon, $user_id)
	{
		$sql = "SELECT UsersxMusic.id as music_liked_id, 
				Users.id as user_id, Users.first_name, Users.last_name, Users.img, 
				Music.id, Music.title, Music.author, Music.link
				FROM UsersxMusic
				INNER JOIN Users ON UsersxMusic.user_id = Users.id
				INNER JOIN Music ON UsersxMusic.music_id = Music.id
				WHERE Users.id = :user_id";

  		$pst = $dbcon->prepare($sql);
  		$pst->bindParam(':user_id', $user_id);  
  		$pst->execute();
		
		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}

	public function getTopSongs($dbcon)
	{
		$sql="SELECT UsersxMusic.id, UsersxMusic.music_id, Music.title, Music.author, Music.link, UsersxMusic.user_id, Users.first_name, Users.last_name, 
			Users.img, UsersxMusic.action, COUNT(UsersxMusic.id) as 'likes_count' 
			FROM `UsersxMusic`
			INNER JOIN Users ON UsersxMusic.user_id = Users.id
			INNER JOIN Music ON UsersxMusic.music_id = Music.id
			GROUP BY UsersxMusic.music_id
			ORDER BY likes_count DESC LIMIT 10";

		$pst = $dbcon->prepare($sql);
		$pst->execute();

		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}
}
?>
