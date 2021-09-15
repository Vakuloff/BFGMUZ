<?
	$page_title = "BfgMuz";
	include 'header.php';

	$dbcon = Database::getDb();
	$m = new Music();
	$rating = $m->getTopSongs($dbcon);
	$counter = 1;
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
				<div class="topTracks trackRating">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="topTracks_item topTrack">
									<audio class="player" controls>
										<source src="<? echo $rating[0]->link ?>" type="audio/mp3" />
									</audio>
									<div class="topTracks_info">
										<h6><? echo $rating[0]->author ?></h6>
										<p><? echo $rating[0]->title ?></p>
									</div>
									<div class="topTracks_wrapper">
										<div class="topTracks_likes disabled_btn">
											<p class="topPos">Топ 1</p>
												<? echo $rating[0]->likes_count ?> <span class="like"></span>
										</div>
										<div class="topTracks_user">
											<div class="userInfo">Загружен
												<span><? echo $rating[0]->first_name . ' ' . $rating[0]->last_name ?></span>
											</div>
											<a href="profile.php?user_id=<? echo $rating[0]->user_id ?>" class="userActive_item">
												<div class="userActive_photo">
													<img src="../images/dist/main/avatars/<?php echo $rating[0]->img ?>" alt="UserName 1">
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="topRating_wrapper">
									<div class="topRating_heading">
										<p class="trackRating_title">ТОП 10</p>
									</div>
									<?foreach ($rating as $rating): ?>
									<div class="topTracks_item topTrack">
										<audio class="player" controls>
											<source src="<? echo $rating->link ?>" type="audio/mp3" />
										</audio>
										<div class="topTracks_info">
											<h6><? echo $rating->author ?></h6>
												<p><? echo $rating->title ?></p>
										</div>
										<div class="topTracks_wrapper">
											<div class="topTracks_likes disabled_btn">
												<p class="topPos">#<? echo $counter; $counter++; ?></p>
												<? echo $rating->likes_count ?>
												<span class="like"></span>
											</div>
											<div class="topTracks_user">
												<div class="userInfo">Загружен
													<a href="profile.php?user_id=<? echo $rating->user_id ?>">
														<span><? echo $rating->first_name . ' ' . $rating->last_name ?></span>
													</a>
												</div>
											</div>
										</div>
									</div>
									<? endforeach; ?>
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
