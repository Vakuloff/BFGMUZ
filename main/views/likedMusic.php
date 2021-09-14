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
			<main class="main topTracks allTracks">	
				<div class="searchWrapper">
					<form method="GET" action="searchMusic.php">
						<input type="text" placeholder="Поиск" name="musicName">
						<button type="submit" class="searchButton"></button>
					</form>
				</div>
				<!-- Content -->
				<div class="container">
					<div class="row">
						<?php foreach ($likedMusic as $likedMusic): ?>
						<div class="col-lg-6">
							<div class="topTracks_item">
							<audio class="player" controls>
									<source src="<? echo $likedMusic->link?>" type="audio/mp3" />
							</audio>
							<div class="topTracks_info">
								<h6><?echo $likedMusic->author?></h6>
								<p><? echo $likedMusic->title?></p>
							</div>
							<div class="topTracks_wrapper">
								<div class="topTracks_likes disabled_btn">
									<?echo $m->getLikes($dbcon, $likedMusic->id)[0]->Likes[0] ?><span class="like"></span>
								</div>
								<p> </p>
								<div class="topTracks_user">
									<div class="userInfo">
										Загружен
										<span><? echo $likedMusic->first_name . ' ' . $likedMusic->last_name?></span>
									</div>
									<a target="_blank" href="profile.php?user_id=<? echo $likedMusic->user_id ?>" class="userActive_item">
										<div class="userActive_photo">
											<img src="../images/dist/main/avatars/<?php echo $likedMusic->img ?>" alt="UserName 1">
										</div>
									</a>
								</div>
							</div>
						</div>
						</div>
						<?php endforeach; ?>
					</div>
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
