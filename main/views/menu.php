<div class="menu">
	<a href="index.php" class="logo">
		<img src="../images/dist/main/logo.svg" alt="BfgMuz - Логотип">
	</a>

	<div class="mobileUser">

	<div class="menuClose">
		<svg xmlns="http://www.w3.org/2000/svg"><path d="M31 13.5a1.5 1.5 0 000-3v3zM.94 10.94a1.5 1.5 0 000 2.12l9.545 9.547a1.5 1.5 0 102.122-2.122L4.12 12l8.486-8.485a1.5 1.5 0 10-2.122-2.122L.94 10.94zM31 10.5H2v3h29v-3z"/></svg>					
	</div>
	<!-- Пользователь залогинен -->
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
						<p class="userName_rate"><span>#1</span> в рейтинге пользователей</p>

					</div>
					<div class="allPosts_sideMenu">
						<button><svg width="4" height="18" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2"/><circle cx="2" cy="9" r="2"/><circle cx="2" cy="16" r="2"/></svg></button>
						<div class="sideMenu_inner">
							<ul>
								<li><a href="profileEdit.php?user_id=<? echo $_SESSION['id'] ?>">Изменить</a></li>
								<li><a href="#" class="sendReport">Сообщить о проблеме</a></li>
								<li><a href="logout.php">Выйти</a></li>
							</ul>
						</div>
					</div>
				</div>
				<button class="button download"><span>Загрузить трек</span></button>
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
	<? endif; ?>
	</div>
	<? if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
	<!-- -------------------------------------------------------- -->
		<div class="menuGroup">
			<span class="menuTitle">Меню</span>
			<ul>
				<li>
					<a href="index.php"><span>
						<svg class="menuIcon home" width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
							<circle cx="2.6" cy="2.6" r="2.1" stroke="#3A55EE"/>
							<circle cx="10.4" cy="2.6" r="2.6" fill="#3A55EE"/>
							<circle cx="10.4" cy="10.4" r="2.1" stroke="#3A55EE"/>
							<circle cx="2.6" cy="10.4" r="2.1" stroke="#3A55EE"/>
						</svg></span>
					Главная</a>
				</li>
				<li>
					<a href="profile.php?user_id=<?echo $_SESSION['id'] ?>"><span>

						<svg class="menuIcon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.7 29.2"
						xml:space="preserve">
							<circle cx="14.5" cy="7.1" r="6.6"/>
							<path d="M18.4,14.9c-1.9,1.2-4.3,1.5-6.6,0.6c-0.5-0.2-0.9-0.4-1.3-0.6C5.6,16,2,20.3,2,25.5v3.1h25v-3.1
							C27,20.3,23.3,16,18.4,14.9z"/>
						</svg></span>
						Моя страница</a>
				</li>
				<li>
					<a href="ratings.php"><span>
						<svg class="menuIcon" viewBox="0 0 14 12" xmlns="http://www.w3.org/2000/svg">
							<rect width="4" height="12" rx="2"/>
							<rect x="5" y="4" width="4" height="8" rx="2"/>
							<rect x="10" y="8" width="4" height="4" rx="2"/>
						</svg></span>
					Рейтинги</a>
				</li>
			</ul>
		</div>
	
		<div class="menuGroup">
			<span class="menuTitle">Музыка</span>
			<ul>
				<li>
					<a href="uploadedMusic.php?user_id=<?echo $_SESSION['id'] ?>"> <span>
						<svg class="menuIcon" viewBox="0 0 16 10" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L15.0711 3.34315C15.4616 2.95262 15.4616 2.31946 15.0711 1.92893C14.6805 1.53841 14.0474 1.53841 13.6569 1.92893L8 7.58579L2.34315 1.92893C1.95262 1.53841 1.31946 1.53841 0.928932 1.92893C0.538408 2.31946 0.538408 2.95262 0.928932 3.34315L7.29289 9.70711ZM7 0L7 9H9V0L7 0Z"/>
						</svg></span>
					Загруженные</a></li>
				<li>
					<a href="likedMusic.php">
						<span>
							<svg class="menuIcon" viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
								<path d="M14 3.78871C14 1.70492 12.3172 0 10.2604 0C8.8581 0 7.64274 0.781421 7.01169 1.94171H6.96494C6.35726 0.8051 5.1419 0 3.73957 0C1.6828 0 0 1.70492 0 3.78871C0 4.66484 0.30384 5.46995 0.81803 6.13297L6.98831 13L13.1586 6.15665C13.6962 5.49362 14 4.68852 14 3.78871Z"/>
							</svg></span>
					Понравившиеся</a>
				</li>
			</ul>
		</div>
	<? else: ?>
		<div class="menuGroup">
			<span class="menuTitle">Меню</span>
			<ul>
				<li>
					<a href="index.php"><span>
						<svg class="menuIcon home" width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
							<circle cx="2.6" cy="2.6" r="2.1" stroke="#3A55EE"/>
							<circle cx="10.4" cy="2.6" r="2.6" fill="#3A55EE"/>
							<circle cx="10.4" cy="10.4" r="2.1" stroke="#3A55EE"/>
							<circle cx="2.6" cy="10.4" r="2.1" stroke="#3A55EE"/>
						</svg></span>
					Главная</a>
				</li>
				<li>
					<a href="ratings.php"><span>
						<svg class="menuIcon" viewBox="0 0 14 12" xmlns="http://www.w3.org/2000/svg">
							<rect width="4" height="12" rx="2"/>
							<rect x="5" y="4" width="4" height="8" rx="2"/>
							<rect x="10" y="8" width="4" height="4" rx="2"/>
						</svg></span>
					Рейтинги</a>
				</li>
			</ul>
		</div>
	<? endif; ?>
	<!-- ------------------------------------------------------------------ -->
	<p class="privacy">Ознакомтесь с <a target="_blank" href="privacy.php">Правилами портала</a> и <a target="_blank" href="agreement.php">Лицензионным соглашением</a></p>
	<p class="aboutBg">Узнайте больше о <a target="_blank" href="about.php">BgMUZE</a></p>
</div>