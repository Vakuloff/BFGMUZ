<div class="menu">
	<a href="index.php" class="logo">
		<img src="../images/dist/main/logo.svg" alt="BfgMuz - Логотип">
	</a>

	<div class="mobileUser">

	<!-- Пользователь не залогинен -->

	<div class="menuClose">
		<svg xmlns="http://www.w3.org/2000/svg"><path d="M31 13.5a1.5 1.5 0 000-3v3zM.94 10.94a1.5 1.5 0 000 2.12l9.545 9.547a1.5 1.5 0 102.122-2.122L4.12 12l8.486-8.485a1.5 1.5 0 10-2.122-2.122L.94 10.94zM31 10.5H2v3h29v-3z"/></svg>					
	</div>

	<div class="user">
		<div class="userWrapper userAuth">
			<div class="authTitle">
				Вход / 
				<a href="/registration.html">Регистрация</a>
			</div>
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="text" name="username" placeholder="Логин или e-mail">
				<input type="password" name="password" placeholder="Пароль">
				<button type="submit" class="button"><span>Войти</span></button>
			</form>
		</div>
	</div>

					<!-- Пользователь не залогинен -->


					<!-- Пользователь залогинен -->

					<!-- <div class="user">
						<div class="userWrapper userIn">
							<div class="userProfile">

								<a href="#" class="userActive_item">
									<div class="userActive_photo">
										<img src="images/dist/main/avatars/avatar1.png" alt="UserName 1">
									</div>
								</a>

								<div class="userName">
									<p class="userName_title">Ивана Васильченко</p>
									<p class="userName_rate"><span>#200821</span> в рейтинге пользователей</p>

								</div>

								<div class="allPosts_sideMenu">
									<button><svg width="4" height="18" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2"/><circle cx="2" cy="9" r="2"/><circle cx="2" cy="16" r="2"/></svg></button>
								</div>

							</div>


							<button class="button download"><span><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.5 0V11M0 5.5H11" stroke="white" stroke-width="2"/>
</svg>
 Загрузить трек</span></button>

						</div>
					</div> -->

					<!-- Пользователь залогинен -->
	</div>

	<div class="menuGroup">
		<span class="menuTitle">Меню</span>
		<ul>
			<li>
				<a href="/" class="active"><span>
					<svg class="menuIcon home" width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
						<circle cx="2.6" cy="2.6" r="2.1" stroke="#3A55EE"/>
						<circle cx="10.4" cy="2.6" r="2.6" fill="#3A55EE"/>
						<circle cx="10.4" cy="10.4" r="2.1" stroke="#3A55EE"/>
						<circle cx="2.6" cy="10.4" r="2.1" stroke="#3A55EE"/>
					</svg></span>
				Главная</a>
			</li>
			<li>
				<a target="_blank" href="/access-is-denied.html"><span>
					<svg class="menuIcon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.7 29.2"
						xml:space="preserve">
						<circle cx="14.5" cy="7.1" r="6.6"/>
						<path d="M18.4,14.9c-1.9,1.2-4.3,1.5-6.6,0.6c-0.5-0.2-0.9-0.4-1.3-0.6C5.6,16,2,20.3,2,25.5v3.1h25v-3.1
							C27,20.3,23.3,16,18.4,14.9z"/>
					</svg></span>
					Моя страница</a>
			</li>
			<li>
				<a target="_blank" href="/access-is-denied.html"><span>
					<svg class="menuIcon" viewBox="0 0 14 12" xmlns="http://www.w3.org/2000/svg">
						<rect width="4" height="12" rx="2"/>
						<rect x="5" y="4" width="4" height="8" rx="2"/>
						<rect x="10" y="8" width="4" height="4" rx="2"/>
					</svg></span>
				Рейтинги</a>
			</li>
			<!-- <li>
				<a target="_blank" href="/access-is-denied.html"><span>
					<svg class="menuIcon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.7 22.2"
						xml:space="preserve">
						<circle cx="9.8" cy="5.5" r="5"/>
						<ellipse cx="20.4" cy="8.1" rx="4.3" ry="4.2"/>
						<path d="M22.9,13.1c-1.2,0.8-2.8,1-4.3,0.4c-0.3-0.1-0.6-0.3-0.8-0.4c-3.2,0.7-5.5,3.5-5.5,6.9v2h16.2v-2
							C28.5,16.5,26.1,13.7,22.9,13.1z"/>
							<path d="M15.8,12.7c-0.9-0.6-1.9-1.1-3-1.4c-1.5,0.9-3.3,1.1-5,0.5c-0.4-0.1-0.7-0.3-1-0.5c-3.7,0.8-6.5,4.2-6.5,8.1
								v2.4h10.9v-2.2C11.1,16.6,13,13.9,15.8,12.7z"/>
					</svg></span>
				Друзья</a>
			</li> -->
		<!-- 	<li>
				<a target="_blank" href="/access-is-denied.html"><span>
					<svg class="menuIcon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								x="0px" y="0px" viewBox="0 0 60 60" xml:space="preserve">
								<path d="M21,15.9c-11.3,0-20.5,8.3-20.5,18.5c0,3.6,1.1,7,3.3,10c-0.4,4.5-1.5,7.8-3.1,9.4c-0.2,0.2-0.3,0.5-0.1,0.8
									c0.1,0.2,0.4,0.4,0.6,0.4c0,0,0.1,0,0.1,0c0.3,0,6.7-1,11.4-3.6c2.6,1.1,5.5,1.6,8.4,1.6c11.3,0,20.5-8.3,20.5-18.5
									S32.3,15.9,21,15.9z M11.4,37.1c-1.5,0-2.7-1.2-2.7-2.7s1.2-2.7,2.7-2.7c1.5,0,2.7,1.2,2.7,2.7S12.9,37.1,11.4,37.1z M21,37.1
									c-1.5,0-2.7-1.2-2.7-2.7s1.2-2.7,2.7-2.7c1.5,0,2.7,1.2,2.7,2.7S22.5,37.1,21,37.1z M30.6,37.1c-1.5,0-2.7-1.2-2.7-2.7
									s1.2-2.7,2.7-2.7s2.7,1.2,2.7,2.7S32.1,37.1,30.6,37.1z"/>
									<g>
										<path d="M56.8,26.6c1.8-2.5,2.7-5.3,2.7-8.3c0-8.5-7.6-15.3-17-15.3C34.5,3,27.9,7.9,26,14.6c9.9,1.7,17.3,9.5,17.3,18.9
											c0,0.1,0,0.1,0,0.2c2.1-0.1,4.2-0.5,6.2-1.3c3.9,2.2,9.2,3,9.4,3c0,0,0.1,0,0.1,0c0.2,0,0.4-0.1,0.5-0.3c0.1-0.2,0.1-0.5-0.1-0.7
											C58.1,33.1,57.2,30.4,56.8,26.6z"/>
										</g>
					</svg></span>
				Сообщения</a>
			</li> -->
		</ul>
	</div>
	<div class="menuGroup">
		<span class="menuTitle">Музыка</span>
		<ul>
			<li>
				<a target="_blank" href="/access-is-denied.html"> <span>
					<svg class="menuIcon" viewBox="0 0 16 10" xmlns="http://www.w3.org/2000/svg">
						<path d="M7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L15.0711 3.34315C15.4616 2.95262 15.4616 2.31946 15.0711 1.92893C14.6805 1.53841 14.0474 1.53841 13.6569 1.92893L8 7.58579L2.34315 1.92893C1.95262 1.53841 1.31946 1.53841 0.928932 1.92893C0.538408 2.31946 0.538408 2.95262 0.928932 3.34315L7.29289 9.70711ZM7 0L7 9H9V0L7 0Z"/>
					</svg></span>
				Загруженные</a></li>
			<li>
				<a target="_blank" href="/access-is-denied.html">
					<span>
						<svg class="menuIcon" viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
							<path d="M14 3.78871C14 1.70492 12.3172 0 10.2604 0C8.8581 0 7.64274 0.781421 7.01169 1.94171H6.96494C6.35726 0.8051 5.1419 0 3.73957 0C1.6828 0 0 1.70492 0 3.78871C0 4.66484 0.30384 5.46995 0.81803 6.13297L6.98831 13L13.1586 6.15665C13.6962 5.49362 14 4.68852 14 3.78871Z"/>
						</svg></span>
				Понравившиеся</a>
			</li>
			<!-- <li>
				<a target="_blank" href="/access-is-denied.html">
					<span>
						<svg class="menuIcon favorite" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0V12L4 8.49741L8 12V0H0Z"/>
						</svg></span>
				Избранные</a>
			</li> -->
		</ul>
	</div>
</div>