<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <!-- <base href="/"> -->

  <title><? echo $page_title?></title>
  <meta name="description" content="BfgMuz - музыкальное сообщество">
  <meta property="og:description" content="BfgMuz - музыкальное сообщество">
  <meta property="og:type" content="website">
    <meta property="og:title" content="BfgMuz - музыкальное сообщество">
    <meta property="og:image" content="../images/dist/main/logo.jpg">
    <meta property="og:url" content="https://bfgmuz.com/">
    <meta property="og:site_name" content="BfgMuz">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link rel="icon" href="../images/favicon/source-fav.png">

  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../images/favicon/favicon-96x96.png">

  <meta property="og:image" content="../images/dist/main/logo.jpg">
  
  <meta name="theme-color" content="#3A55EE">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../css/main.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<?php 
require_once '../model/Database.php'; 
require_once '../model/Music.php'; 
require_once '../model/User.php'; 
require_once '../model/Post.php'; 

$dbcon = Database::getDb();
//---------------------------LOGIN-----------------------------------------------------------
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  ?>
  <script type="text/javascript">
  window.location.href = "index.php";
  </script>  
<?php
    exit;
}

$username = $password = "";
$username_err = $password_err = "";
$errors = array();

if (isset($_POST['login'])) {

  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter username.";
    array_push($errors,"Please enter username.");
  }
  else{
    $username = trim($_POST["username"]);
  }

  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
    array_push($errors,"Please enter your password.");
  }
  else{
    $password = trim($_POST["password"]);
  }

  if(empty($username_err) && empty($password_err)){
    $sql = "SELECT id, username, password, email, first_name, last_name, img FROM Users WHERE username = :username";

    if($stmt = $dbcon->prepare($sql)){
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

      $param_username = trim($_POST["username"]);

      if($stmt->execute()){
        if($stmt->rowCount() == 1){
          if($row = $stmt->fetch()){
            $id= $row["id"];
            $username = $row["username"];
            $hashed_password = $row["password"];
            $email = $row["email"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $img = $row["img"];
            

            if(password_verify($password, $hashed_password)){
            // password is correct, then start new session

              session_start();
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["email"] = $email;
              $_SESSION["first_name"] = $first_name;
              $_SESSION["last_name"] = $last_name;
              $_SESSION["img"] = $img;
              

              ?>  
<!--               <script type="text/javascript">
              window.location.href = 'index.php';
              </script> -->
              <?php
            }
            else{
              $password_err="The password you entered is not valid.";
              array_push($errors,"The password you entered is not valid.");
            }
          }
        }
        else{
          $username_err = "No account found with that username.";
          array_push($errors,"No account found with that username.");
        }
      }
      else {
        echo "Something went wrong. Please try again later.";
      }
    }
    unset($stmt);
  }
  unset($dbcon);
}
// this function to display erros in the register panel.
function display_error() {
  global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
  }
}
session_start();
//---------------------------LOGIN-END----------------------------------------------------------
include('likes.php');
//---------------------------MUSIC-Upload----------------------------------------------------------
if(isset($_SESSION['id']))
{
	$music = new Music();
	$user_id = $_SESSION['id'];


	if (isset($_POST['addMusic'])) {
    $date = new DateTime();
    $date_hash = hash('ripemd160', $date->getTimestamp());
    $login_hash = hash('ripemd160', $_SESSION['username']);
    $uniqueHash = $date_hash . $login_hash;

	  $uploadfile = "../media/music/". $uniqueHash . $_FILES['uploadmusic']['name'];
	  move_uploaded_file($_FILES['uploadmusic']['tmp_name'], $uploadfile);
	
	  $title = $_POST['nameTrack'];
    $author = $_POST['authorTrack'];

	  $user_id = $_SESSION['id'];
	  $link = $uploadfile;
    if($title === '' || $title === null || $title === ' '){
      ?>
        <script>
          alert('Попробуйте еще раз, пожалуйста');
        </script>
      <?
    }else{
      $music->addMusic($dbcon, $title, $author, $user_id, $link);
      ?>
        <script>
          alert('Трек был успешно загружен');
        </script>
      <?
    }
	}

	// music list
	$all_music = $music->getAllMusicByUser($dbcon, $user_id);
  $favorites_music = $music->getLikedMusic($dbcon, $user_id);

}
//---------------------------MUSIC-LIST-END---------------------------------------------------------
 ?>
<body>
	<header>
		<div class="mobileMenu">
			<a href="index.php" class="logo">
				<img src="../images/dist/main/logo.svg" alt="BfgMuz - Логотип">
			</a>
			<div class="menuWrapper">
				<button class="hamburger hamburger--spring" type="button">
		  			<span class="hamburger-box">
		    			<span class="hamburger-inner"></span>
		  			</span>
				</button>
				<p>Меню</p>
			</div>

			<button class="playlistsButton"><svg width="25" height="26" xmlns="http://www.w3.org/2000/svg"><path d="M6.812 3.328v16.484c-.988-.468-2.444-.416-3.848.26-1.976.988-3.016 2.964-2.288 4.316.728 1.352 2.86 1.664 4.836.624 1.56-.832 2.548-2.184 2.496-3.432V8.788L23.244 6.5v10.92c-.988-.468-2.444-.416-3.848.26-1.976.988-3.016 2.964-2.288 4.316.676 1.352 2.86 1.664 4.836.624 1.56-.78 2.496-2.132 2.496-3.328V.676L6.812 3.328z"/></svg></button>
		</div>
	</header>
	