<?
session_start();
require_once '../../model/Database.php'; 
require_once '../../model/Admin.php'; 

if(isset($_POST['Delete'])){
	$dbcon = Database::getDb();
	$post_id = $_POST['post_id'];

	$a = new Admin();
	$admin_delete_post = $a->deletePost($dbcon, $post_id);
	if($admin_delete_post){
        header("Location: adminPanel.php");
    }
}
?>