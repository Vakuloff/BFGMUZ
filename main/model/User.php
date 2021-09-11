<?
class User
{
	public function getUserById($dbcon, $id)
	{
		$sql = "SELECT * FROM Users
				INNER JOIN Music ON Music.user_id = Users.id
				WHERE Users.id = :id";
		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':id', $id);
        $pst->execute();

        $user = $pst->fetch(PDO::FETCH_OBJ);
        return $user;
	}
}
?>