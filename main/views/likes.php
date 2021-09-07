<?php 
// connect to database
$conn = mysqli_connect('nickvaku.mysql.tools', 'nickvaku_bfgmuz', '42+hsZG~p9', 'nickvaku_bfgmuz');

// lets assume a user is logged in with id $user_id
$user_id=39;

if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error($conn));
  exit();
}

// if user clicks like button
if (isset($_POST['action'])) {
  $music_id = $_POST['music_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO UsersxMusic (music_id, user_id, action, date) 
         	   VALUES ($music_id, $user_id, 'like', NOW()) 
         	   ON DUPLICATE KEY UPDATE action='like'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM UsersxMusic WHERE user_id=$user_id AND music_id=$music_id";
	      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating($music_id);
  exit(0);
}

// Get total number of likes for a particular post
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM UsersxMusic 
  		  WHERE music_id = $id AND action='like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}
// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM UsersxMusic WHERE music_id = $id AND action='like'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $rating = [
  	'likes' => $likes[0]
  ];
  return json_encode($rating);
}
// Check if user already likes post or not
function userLiked($music_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM UsersxMusic WHERE user_id=$user_id 
  		  AND music_id=$music_id AND action='like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}
$sql = "SELECT * FROM Music";
$result = mysqli_query($conn, $sql);
// fetch all music from database
// return them as an associative array called $music_arr
$music_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);