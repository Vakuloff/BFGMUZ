<?
class Admin
{
	public function getAllUsersAdmin($dbcon){
		$sql = "SELECT Users.id as user_id, Users.first_name, Users.last_name
				FROM Users";

		$pst = $dbcon->prepare($sql); 
  		$pst->execute();
		
		$userAdmin = $pst->fetchAll(PDO::FETCH_OBJ);
		return $userAdmin;
	}

	public function deleteUser($dbcon, $user_id){
		$sql = "DELETE FROM Users 
				WHERE id = :user_id";

		$pst = $dbcon->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $userAdmin = $pst->execute();

        return $userAdmin;
	}

	public function getAllMusicByUserAdmin($dbcon, $user_id)
	{
		$sql = "SELECT Users.id, Users.first_name, Users.last_name, 
				Music.id as music_id, Music.title
				FROM Users
				INNER JOIN Music ON Users.id = Music.user_id
				WHERE Users.id = :user_id";

		$pst = $dbcon->prepare($sql); 
		$pst->bindParam(':user_id', $user_id);
  		$pst->execute();
		
		$userAdmin = $pst->fetchAll(PDO::FETCH_OBJ);
		return $userAdmin;
	}

	public function deleteMusic($dbcon, $music_id){
		$sql = "DELETE FROM Music 
				WHERE id = :music_id";

		$pst = $dbcon->prepare($sql);
        $pst->bindParam(':music_id', $music_id);
        $userAdmin = $pst->execute();

        return $userAdmin;
	}

	public function getAllPostsByUserAdmin($dbcon, $user_id)
	{
		$sql = "SELECT Users.id as user_id, Users.first_name, Users.last_name, 
				Posts.id as post_id, Posts.content, Posts.music_name, Posts.img_link, 
				Posts.receiver_id, Posts.author_id
				FROM Users
				INNER JOIN Posts ON Users.id = Posts.author_id
				WHERE Users.id = :user_id";

		$pst = $dbcon->prepare($sql); 
		$pst->bindParam(':user_id', $user_id);
  		$pst->execute();
		
		$userAdmin = $pst->fetchAll(PDO::FETCH_OBJ);
		return $userAdmin;
	}

	public function deletePost($dbcon, $post_id){
		$sql = "DELETE FROM Posts 
				WHERE id = :post_id";

		$pst = $dbcon->prepare($sql);
        $pst->bindParam(':post_id', $post_id);
        $userAdmin = $pst->execute();

        return $userAdmin;
	}
}
?>


