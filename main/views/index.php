<?
	$page_title = "BfgMuz";
	include 'header.php';
	$dbcon = Database::getDb();
	$m = new Music();
	$rating = $m->getTopSongs($dbcon);

	$u = new User();
	$recent_active_users = $u->getRecentActiveUsers($dbcon);
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
				<!-- Content -->
				<div class="userActive">
					<div class="userActive_title">
						<h3>Последние активные пользователи</h3>
						<!-- <a target="_blank" href="/access-is-denied.html">Посмотреть всех</a> -->
					</div>
					<div class="userActive_list">
						<? foreach($recent_active_users as $recent_active_users): ?>
							<a href="profile.php?user_id=<?echo $recent_active_users->user_id?>" class="userActive_item">
								<div class="userActive_photo">
									<img src="../images/dist/main/avatars/<?php echo $recent_active_users->img ?>" alt="UserName 1">
								</div>
							</a>
						<? endforeach; ?>
					</div>
				</div>
				<div class="topTracks">
					<h3>Топ треки</h3>
					<div class="container">
						<div class="row g-0">
							<div class="col-12">
								<div class="topTracks_carousel">
									<!-- ----------------------------- -->
									<? foreach($rating as $rating): ?>
										<div class="topTracks_item">
											<audio class="player" controls>
									  			<source src="<? echo $rating->link ?>" type="audio/mp3" />
											</audio>
											<div class="topTracks_info">
												<h6><? echo $rating->author ?></h6>
												<p><? echo $rating->title ?></p>
											</div>
											<div class="topTracks_wrapper">
												<div class="topTracks_likes disabled_btn">
													<? echo $rating->likes_count ?> 
													<span class="like"></span>
												</div>
												<div class="topTracks_user">
													<div class="userInfo">
														Загружен
														<span><? echo $rating->first_name . ' ' . $rating->last_name ?></span>
													</div>
													<a href="profile.php?user_id=<? echo $rating->user_id ?>" class="userActive_item">
														<div class="userActive_photo">
															<img src="../images/dist/main/avatars/<?php echo $rating->img ?>" alt="UserName 1">
														</div>
													</a>
												</div>
											</div>
										</div>
									<? endforeach; ?>
									<!-- -------------------------------- -->
								</div>
							</div>
						</div>
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
