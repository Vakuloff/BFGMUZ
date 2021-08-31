<? 
	$page_title = "Search";
	include 'header.php';

	if(isset($_SESSION['id']))
{
	$music = new Music();
	$user_id = $_SESSION['id'];


	//Music upload
	if (isset($_POST['addMusic'])) {
	  $uploadfile = "media/music/".$_FILES['uploadmusic']['name'];
	  move_uploaded_file($_FILES['uploadmusic']['tmp_name'], $uploadfile);
	
	  $title = $_FILES['uploadmusic']['name'];
	  $user_id = $_SESSION['id'];
	  $link = $uploadfile;
	
	  $music->addMusic($dbcon, $title, $user_id, $link);
	}

	// music list
	$all_music = $music->getAllMusicByUser($dbcon, $user_id);

	if (!empty($_GET['musicName'])){
	$music = new Music();
	$search_result = $_GET['musicName'];
	//echo $search_result;
	$music_search = $music->searchMusic($dbcon, $search_result);
} else {
	echo "Empty";
}
}
?>
<div class="container">
	<div class="row g-0">
		<div class="col-lg-2">
			<?php include 'menu.php' ?>
		</div>
		<div class="col-lg-7 main">
			<main>	
				<div class="searchWrapper">
					<form method="GET" action="searchMusic.php">
						<input type="text" placeholder="Поиск" name="musicName">
						<button type="submit" class="searchButton"></button>
					</form>
				</div>
				<div class="topTracks allTracks">
					<?
foreach($music_search as $music_search){
	echo 	'<div class="topTracks_item">' .
				'<audio class="player" controls>' .
					'<source src="../' . $music_search['link'] . '" type="audio mp3" />' .
				'</audio>' .
				'<div class="topTracks_info">' .
					'<h6>' . $music_search['title'] . '</h6>' .
				'</div>' .
				'<div class="topTracks_wrapper">' .
					'<div class="topTracks_likes">' .
						'<span class="like"></span>' .
					'</div>' .
					'<div class="topTracks_user">' .
						'<div class="userInfo">' .
						 	'Загружен' .
						 	'<span>' . $music_search['user_id'] . '</span>' .
						'</div>' .
						'<a target="_blank" href="/access-is-denied.html" class="userActive_item">' .
							'<div class="userActive_photo">' .
						 		'<img src="../images/dist/main/avatars/avatar1.png" alt="UserName 1">' . 
							'</div>' .
						'</a>' .
					'</div>' .
					'</div>' .
			'</div>';
	}
?>
				</div>
			</main>
		</div>
	</div>
</div>

<? 
include 'footer.php'
?>	
