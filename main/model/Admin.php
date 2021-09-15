<?
class Admin
{
	public function getAllMusicByUserAdmin($dbcon)
	{
		$sql = "SELECT Users.id, Users.first_name, Users.last_name, 
				Music.id as music_id, Music.title
				FROM Users
				INNER JOIN Music ON Users.id = Music.user_id"

		$pst = $dbcon->prepare($sql); 
  		$pst->execute();
		
		$userAdmin = $pst->fetchAll(PDO::FETCH_OBJ);
		return $userAdmin;
	}
}
?>