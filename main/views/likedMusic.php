<?
	$page_title = "BfgMuz";
	include 'header.php';

	$dbcon = Database::getDb();
	$m = new Music();
	$user_id = $_SESSION['id'];
	$likedMusic = $m->getLikedMusic($dbcon, $user_id);
?>
<div class="container">
	<div class="row g-0">
		<div class="col-lg-2">
			<?php include 'menu.php' ?>
		</div>
		<div class="col-lg-7">
			<main class="main">	
				<div class="searchWrapper">
					<form method="GET" action="searchMusic.php">
						<input type="text" placeholder="Поиск" name="musicName">
						<button type="submit" class="searchButton"></button>
					</form>
				</div>
				<div class="topTracks allTracks">
					<?php foreach ($likedMusic as $likedMusic): ?>
						<div class="topTracks_item">
							<audio class="player" controls>
									<source src="<? echo $likedMusic->link?>" type="audio/mp3" />
							</audio>
							<div class="topTracks_info">
								<h6><?echo $likedMusic->title?></h6>
							</div>
							<div class="topTracks_wrapper">
								<!-- Likes suda -->
								<div class="topTracks_likes">
									<span class="like"></span>
								</div>
								<p> </p>
								<div class="topTracks_user">
									<div class="userInfo">
										Загружен
										<span><? echo $likedMusic->first_name . ' ' . $likedMusic->last_name?></span>
									</div>
									<a target="_blank" href="profile?user_id=<? echo $likedMusic->user_id ?>" class="userActive_item">
										<div class="userActive_photo">
											<img src="../images/dist/main/avatars/<?php echo $likedMusic->img ?>" alt="UserName 1">
										</div>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>	
			</main>
		</div>
		<?
			include 'sidebar.php';
		?>
	</div>
</div>
<? 
include 'footer.php'
?>	
