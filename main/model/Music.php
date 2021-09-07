<?php 
class Music
{
	public function addMusic($dbcon, $title, $user_id, $link)
	{
		$sql = "INSERT INTO Music (title, user_id, link)
				VALUES (:title, :user_id, :link)";
		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':title', $title);
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

	public function unlikeMusic($user_id, $music_id)
	{
		$sql="DELETE FROM UsersxMusic WHERE user_id=$user_id AND music_id=$music_id";

		$pst = $dbcon->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $pst->bindParam(':music_id', $music_id);
       
        $music = $pst->execute();
        return $music;
	}

	public function getLikes($music_id)
	{
		$sql="SELECT COUNT(*) FROM UsersxMusic
		WHERE music_id = $music_id AND action='like'";

		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':music_id', $music_id);
		$pst->execute();
		
		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}

	public function ifLiked($user_id, $music_id)
	{
		$sql = "SELECT * FROM UsersxMusic WHERE user_id=$user_id 
  		  AND music_id=$music_id AND rating_action='like'";

  		$pst = $dbcon->prepare($sql);
  		$pst->bindParam(':user_id', $user_id);
		$pst->bindParam(':music_id', $music_id);
		$pst->execute();
		
		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}
}
?>