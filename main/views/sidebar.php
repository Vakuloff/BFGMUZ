<?
	$dbcon = Database::getDb();
	$m = new Music();
	$rating = $m->getTopSongs($dbcon);
?>
<div class="col-lg-3 sidebar logIn">
	<!-- Проверка логина -->
	<? if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
		<div class="user">
			<div class="userWrapper userIn">
				<div class="userProfile">
					<a href="profile.php?user_id=<? echo $_SESSION['id'] ?>"class="userActive_item">
						<div class="userActive_photo">
							<img src="../images/dist/main/avatars/<? echo $_SESSION["img"] ?>" alt="UserName 1" title="Ваш профиль">
						</div>
					</a>
					<div class="userName">
						<p class="userName_title"><? echo $_SESSION["first_name"] . " " . $_SESSION["last_name"] ?></p>
						<p class="userName_rate"><span>#<? echo $_SESSION['id'] ?></span> в рейтинге пользователей</p>

					</div>
					<div class="allPosts_sideMenu">
						<button><svg width="4" height="18" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2"/><circle cx="2" cy="9" r="2"/><circle cx="2" cy="16" r="2"/></svg></button>
						<div class="sideMenu_inner">
							<ul>
								<li><a href="profileEdit.php?user_id=<? echo $_SESSION['id'] ?>">Изменить</a></li>
								<li><a href="#" class="sendReport">Сообщить о проблеме</a></li>
								<? if($_SESSION['id'] == '1' || $_SESSION['id'] == '49'): ?>
									<li><a href="admin/adminPanel.php">Въебать варварам!</a></li>
								<? endif; ?>
								<li><a href="logout.php">Выйти</a></li>
							</ul>
						</div>
					</div>
				</div>
				<button class="button download"><span>Загрузить трек</span></button>
			</div>
		</div>
		<div class="tracksUpload modalForm userAuth">
			<span class="close"></span>
			<form method="POST" enctype="multipart/form-data">
				<div class="authTitle">Загрузка треков</div>
				
				<input type="text" name="nameTrack" placeholder="Укажите название" required>
				<input type="text" name="authorTrack" placeholder="Укажите автора" required>

				<div class="formAddTrack_wrapper">
					<input type="file"  name="uploadmusic" id="formAddTrack_file" class="formAddTrack_file" required>
						<label for="formAddTrack_file" class="button formAddTrack">
							<img src="../images/dist/icons/addTrack.svg" alt="add track bgmuz">
							<span class="formAddTrack_descr">Выберите трек</span>
						</label>
				</div>
				<p>Выберите один либо несколько треков для загрузки, в формате <b>.mp3 /.ogg / wav</b></p>
 				<button type="submit" name="addMusic" class="button download"><span>Загрузить трек</span></button>
			</form>
		</div>
		<div class="playlists">
			<div class="user">
				<div class="userWrapper">
					<h3>Плейлисты</h3>
					<div class="playlistsNav">
						<div class="playlistsNav_item">Загруженные</div>
						<div class="playlistsNav_item">Понравившиеся</div>
					<div class="playlistsNav_item">Топ 10</div>
					</div>
					<div class="playlistsMusic">
						<div class="playlistsMusic_list popular">
							<? if (empty($all_music)): ?>
								<p class="infoMessage">Плейлист пока пустой ..</p>
							<? else: ?>
								<? foreach($all_music as $all_music): ?>
									<div class="topTracks_item">
										<audio class="player" controls>
											<source src="<? echo $all_music->link ?>" type="audio/mp3" />
										</audio>
										<div class="topTracks_info">
											<h6><? echo $all_music->author ?></h6>
											<p><? echo $all_music->title?></p>
										</div>
									</div>
								<? endforeach; ?>
							<? endif; ?>
						</div>
						<div class="playlistsMusic_list favorites">
							<? if (empty($favorites_music)): ?>
								<p class="infoMessage">Плейлист пока пустой ..</p>
							<? else: ?>
								<? foreach($favorites_music as $favorites_music): ?>
									<div class="topTracks_item">
										<audio class="player" controls>
											<source src="<? echo $favorites_music->link ?>" type="audio/mp3" />
										</audio>
										<div class="topTracks_info">
											<h6><? echo $favorites_music->author ?></h6>
											<p><? echo $favorites_music->title ?></p>
										</div>
									</div>
								<? endforeach; ?>
							<? endif; ?>
						</div>
					<!-- -------------------------------------------------------------------------- -->
						<div class="playlistsMusic_list topTen">
							<? if (empty($rating)): ?>
								<p class="infoMessage">Плейлист пока пустой ..</p>
							<? else: ?>
								<? foreach($rating as $rating): ?>
									<div class="topTracks_item">
										<audio class="player" controls>
											<source src="<? echo $rating->link ?>" type="audio/mp3" />
										</audio>
										<div class="topTracks_info">
											<h6><? echo $rating->author ?></h6>
											<p><? echo $rating->title ?></p>
										</div>
									</div>
								<? endforeach; ?>
							<? endif; ?>
						</div>
					<!-- -------------------------------------------------------------------------- -->
					</div>
				</div>
			</div>
		</div>
	<? else: ?>
		<div class="user">
			<div class="userWrapper userAuth">
				<div class="authTitle">Вход / 
					<a href="registration.php">Регистрация</a>
				</div>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
					<input type="text" name="username" placeholder="Логин">
					<input type="password" name="password" placeholder="Пароль">
					<button class="button" name="login"><span>Войти</span></button>
				</form>
			</div>
		</div>
		<div class="playlists">
			<div class="user">
				<div class="userWrapper">
					<h3>Плейлисты</h3>
					<div class="playlistsNav">
					<div class="playlistsNav_item">Топ 10</div>
					</div>
					<div class="playlistsMusic">
					<!-- -------------------------------------------------------------------------- -->
						<div class="playlistsMusic_list topTen">
							<? if (empty($rating)): ?>
								<p class="infoMessage">Плейлист пока пустой ..</p>
							<? else: ?>
								<? foreach($rating as $rating): ?>
									<div class="topTracks_item">
										<audio class="player" controls>
											<source src="<? echo $rating->link ?>" type="audio/mp3" />
										</audio>
										<div class="topTracks_info">
											<h6><? echo $rating->author ?></h6>
											<p><? echo $rating->title ?></p>
										</div>
									</div>
								<? endforeach; ?>
							<? endif; ?>
						</div>
					<!-- -------------------------------------------------------------------------- -->
					</div>
				</div>
			</div>
		</div>
	<? endif; ?>
</div>