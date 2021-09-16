<?
session_start();
require_once '../../model/Database.php'; 
require_once '../../model/Admin.php'; 

if(isset($_POST['Delete'])){
	$dbcon = Database::getDb();
	$music_id = $_POST['music_id'];

	$a = new Admin();
	$admin_delete_music = $a->deleteMusic($dbcon, $music_id);
	if($admin_delete_music){
        header("Location: adminPanel.php");
    }
}
?>