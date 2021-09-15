<?
class User
{
	public function getUserById($dbcon, $id)
	{
		$sql = "SELECT * FROM Users
				WHERE Users.id = :id";
		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':id', $id);
        $pst->execute();

        $user = $pst->fetch(PDO::FETCH_OBJ);
        return $user;
	}

	public function getRecentActiveUsers($dbcon)
	{
		$sql = "SELECT UsersxMusic.id, UsersxMusic.user_id, Users.first_name, 
				Users.last_name, Users.img, Max(UsersxMusic.date) AS max_date
				FROM `UsersxMusic` 
				INNER JOIN Users ON UsersxMusic.user_id = Users.id
				GROUP BY UsersxMusic.user_id 
				ORDER BY max_date DESC LIMIT 10";
		$pst = $dbcon->prepare($sql); 
  		$pst->execute();
		
		$user = $pst->fetchAll(PDO::FETCH_OBJ);
		return $user;
	}

	public function getAllUsers($dbcon){
		$sql="SELECT * FROM Users";

		$pst = $dbcon->prepare($sql); 
  		$pst->execute();
		
		$music = $pst->fetchAll(PDO::FETCH_OBJ);
		return $music;
	}
}
?>