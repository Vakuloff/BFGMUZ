<?
	$page_title = "BgMuze - музыкальное сообщество";
	include 'header.php';
	$dbcon = Database::getDb();
	$m = new Music();
	$u = new User();
	$p = new Post();

	$rating = $m->getTopSongs($dbcon);
	$recent_active_users = $u->getRecentActiveUsers($dbcon);
	$post = $p->getAllPosts($dbcon);
?>
<div class="container">
	<div class="row g-0">
		<div class="col-lg-2">
			<?php include 'menu.php' ?>
		</div>
		<div class="col-lg-7">
			<main class="main">
				<? if(isset($_GET['message'])): ?>
					<p class='successMessage'><? echo $_GET['message'] ?></p>
				<? endif; ?>
				<div class="titleBanner">
					<h2>Присоединяйтесь к порталу BgMUZE</h2>
					<p>Создавайте, делитесь, ищите, и слушайте музыку,  голосуйте за понравившиеся треки, формируйте свои плейлисты</p>
					<a href="/BFGMUZ/main/views/searchMusic.php?musicName=" class="button"><span>Все треки</span></a>
				</div>	
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
				<div class="allPosts">
					<h3>Закрепленная публикация</h3>
					<div class="container">
						<div class="row g-0">
							<div class="col-12">
								<div class="allPosts_item liked">
									<div class="topTracks_wrapper">
										<div class="topTracks_user">
											<a href="profile.php?user_id=1" class="userActive_item">
												<div class="userActive_photo">
													<img src="../images/dist/main/avatars/wtf.jpg" alt="UserName 1">
												</div>
											</a>
											<div class="userInfo">
												<span>Nick Vakulov</span>
													2021-09-15 21:00:00
											</div>
										</div>
									</div>
									<div class="allPosts_content">
										<p>Уважаемые пользователи! Надеемся с Вашей помощью наш проект станет еще лучше. Ваши пожелания, жалобы и предложения Вы можете отправить через контекстное меню, которое находится справа от Вашего аватара, либо написав на нашу почту <a href="mailto:wayinweb.pro@gmail.com">wayinweb.pro@gmail.com</a>
											<br><b>Имейте ввиду, что на данный момент система лайков работает только на странице поиска. </b>
											<br>Благодарим за уделённое время. </p>
										<div class="topTracks_item">
											<audio class="player" controls>
												<source src="../media/music/The Phoenix.mp3" type="audio/mp3" />
											</audio>
											<div class="topTracks_info">
												<h6>Fall Out Boy</h6>
												<p>The Phoenix</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						<h3>Последние публикации сообщества</h3>
						<div class="container">
							<div class="row g-0">
								<!-- ------------------------------------------------ -->
								<?php foreach ($post as $post): ?>
								<div class="col-12">
									<div class="allPosts_item liked">
										<div class="topTracks_wrapper">
											<div class="topTracks_user">
												<a href="profile.php?user_id=<? echo $post->author_id ?>" class="userActive_item">
													<div class="userActive_photo">
														<img src="../images/dist/main/avatars/<?php echo $post->img ?>" alt="UserName 1">
													</div>
												</a>
												<div class="userInfo">
													<span><? echo $post->first_name . ' ' . $post->last_name?></span>
														<? echo $post->date ?>
												</div>
											</div>
										</div>
										<div class="allPosts_content">
											<!-- Picture -->
											<? if(is_null($post->img_link)): ?>
												<div class="clearfix"></div>
											<? else: ?>
												<img src="<? echo $post->img_link ?>" alt="Post 1">
											<? endif; ?>
											<!-- Text -->
											<? if(is_null($post->content)): ?>
												<div class="clearfix"></div>
											<? else: ?>
												<p><? echo $post->content ?></p>
											<? endif; ?>
											<div class="clearfix"></div>
											<!-- Music -->
											<? if(is_null($post->music_name)): ?>
												<div class="clearfix"></div>
											<? else: ?>
												<div class="topTracks_item">
													<audio class="player" controls>
														<source src="<? echo $post->music_link ?>" type="audio/mp3" />
													</audio>
													<div class="topTracks_info">
														<p><? echo $post->music_name ?></p>
													</div>
												</div>
											<? endif; ?>
											
										</div>
									</div>
								</div>
								<? endforeach; ?>
								<!-- ------------------------------------------------ -->
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
