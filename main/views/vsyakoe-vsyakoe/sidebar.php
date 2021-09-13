<div class="col-lg-3 sidebar logIn">
	<!-- Проверка логина -->
	<? 
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			echo 	'<div class="user">
						<div class="userWrapper userIn">
							<div class="userProfile">
								<a href="profile.php?user_id=' . $_SESSION['id'] . '" class="userActive_item">
									<div class="userActive_photo">
										<img src="../images/dist/main/avatars/' .$_SESSION["img"] . '" alt="UserName 1">
									</div>
								</a>
								<div class="userName">
									<p class="userName_title">' . $_SESSION["first_name"] . " " . $_SESSION["last_name"] . '</p>
									<p class="userName_rate"><span>#200821</span> в рейтинге пользователей</p>

								</div>
								<div class="allPosts_sideMenu">
									<button><svg width="4" height="18" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2"/><circle cx="2" cy="9" r="2"/><circle cx="2" cy="16" r="2"/></svg></button>
								</div>
							</div>
 							<form method="POST" enctype=multipart/form-data>
 								<input type="file" class="button download" name="uploadmusic">
 								<button type="submit" name="addMusic" class="button download"> Загрузить трек </button>
 							<a href="logout.php">Выйти</a>
						</div>
					</div>';
                 	} else 
                 	{
                     	echo 	'<div class="user">
									<div class="userWrapper userAuth">
										<div class="authTitle">
											Вход / <a href="registration.php">Регистрация</a>
										</div>
										<form method="POST" action="'. htmlspecialchars($_SERVER["PHP_SELF"]) .'" enctype="multipart/form-data">
											<input type="text" name="username" placeholder="Логин">
											<input type="password" name="password" placeholder="Пароль">
											<button class="button" name="login"><span>Войти</span></button>
										</form>
									</div>
								</div>';
                    }
	?>	
					<div class="playlists">
						<div class="user">
							<div class="userWrapper">
								<h3>Плейлисты</h3>

								<div class="playlistsNav">

									<div class="playlistsNav_item">
										Все
									</div>
								</div>

								<div class="playlistsMusic">
									<div class="playlistsMusic_list popular">
										<?
											if (empty($all_music)){
												echo '<p class="infoMessage">Плейлист пока пустой ..</p>';
											}else{
												foreach($all_music as $all_music){
												echo 
												'<div class="topTracks_item">' . 
													'<audio class="player" controls>'.
													'<source src="' . $all_music->link . '" type="audio/mp3" />'.
													'</audio>'.
													'<div class="topTracks_info"'.
													'<h6>' . $all_music->title . '</h6>'.
													'</div>'.
												'</div>';
												}
											}
											
										?>
										
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>