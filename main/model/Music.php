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
}
?>