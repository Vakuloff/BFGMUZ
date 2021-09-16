<?
session_start();
require_once '../../model/Database.php'; 
require_once '../../model/Admin.php'; 

if(isset($_POST['Delete'])){
	$dbcon = Database::getDb();
	$user_id = $_POST['user_id'];

	$a = new Admin();
	$admin_delete_user = $a->deleteUser($dbcon, $user_id);
	unlink(ini_get('session.save_path') . 'sess_' . $user_id);
	if($admin_delete_user){
        header("Location: adminPanel.php");
    }
}
?>