<?

	$page_title = "Profile";
	include 'header.php';

	if(isset($_GET['user_id'])){
		$user_id = $_GET['user_id'];
		$dbcon  = Database::getDb();
		$u = new User();
		$m = new Music();
	
		$user = $u->getUserById($dbcon, $user_id);
		$music = $m->getAllMusicByUser($dbcon, $user_id);
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

				<div class="userPage_banner">
					<?
						if($_SESSION['id'] == $_GET['user_id']){
							echo '<a href="profileEdit.php?user_id=' . $_SESSION['id'] . '" class="editData button"><span>Редактировать</span></a>';
						}
					?>
					
				</div>
				<div class="userPage_bottomLine">
					<div class="userPage_infoWrapper">
						<div class="userActive_item">
							<div class="userActive_photo">
								<img src="../images/dist/main/avatars/<?echo $user->img?>" alt="UserName 1">
							</div>
						</div>
						<div class="userActive_info">
							<? echo $user->first_name . ' ' . $user->last_name?>
							<button class="message button"><span>Написать</span></button>
						</div>
					</div>
					<div class="userProfile_info">
						
					</div>
				</div>
				<div class="topTracks">
					<h3>Загруженные треки</h3>
						<div class="container">
							<div class="row g-0">
								<div class="col-12">
									<div class="topTracks_carousel">
										<?php foreach ($music as $music): ?>
											<div class="topTracks_item">
												<audio class="player" controls>
									  				<source src="<? echo $music->link?>" type="audio/mp3" />
												</audio>
												<div class="topTracks_info">
													<h6><?echo $music->title?></h6>
												</div>
												<div class="topTracks_wrapper">
													<div class="topTracks_likes">
														<?echo $m->getLikes($dbcon, $music->id)[0]->Likes[0] ?> <span class="like"></span>
													</div>
													<div class="topTracks_user">
														<div class="userInfo">
															Загружен
															<span><? echo $user->first_name . ' ' . $user->last_name?></span>
														</div>
														<a target="_blank" href="profile?user_id=<? echo $music->user_id ?>" class="userActive_item">
															<div class="userActive_photo">
																<img src="../images/dist/main/avatars/<?php echo $user->img ?>" alt="UserName 1">
															</div>
														</a>
													</div>
												</div>
											</div>
										<?php endforeach ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a href="#" class="button buttonTracks"><span>Все треки</span></a>
					<div class="dropPost">
						<h3>Сделать публикацию:</h3>
						<form class="dropTextForm">
							<textarea name="droptext" class="dropText"></textarea>
							<div class="buttonDropWrapper">
								<button class="button"><span>Опубликовать</span></button>
							</div>
						</form>
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
