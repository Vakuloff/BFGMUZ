<?php require_once '../model/Database.php'; 

$dbcon = Database::getDb();

// Define the variables we will use and intialize them to empty strings
$username = $email = $first_name = $last_name = $password = $confirm_password = $img = "";
$username_err = $email_err = $first_name_err = $last_name_err = $password_err = $confirm_password_err = ""; 
$errors = array();

if($_SERVER["REQUEST_METHOD"] == "POST"){

  // username validation
  if(empty(trim($_POST["username"]))){
    $username_err = "Введите логин";
    array_push($errors, "Введите логин");
  }
  else{
    $sql = "SELECT id FROM Users WHERE username = :username";

    if($stmt = $dbcon->prepare($sql)){
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
      $param_username = trim($_POST["username"]);

      if($stmt->execute()){
        if($stmt->rowCount() == 1){
          $username_err = "Этот логин уже используется";
          array_push($errors, "Этот логин уже используется");
        }
        else{
          $username = trim($_POST["username"]);
        }
      }
      else{
        echo "Something went wrong! Please try again later. user error";
      }
    }
    unset($stmt);
    }
    // first name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Введите имя";
        array_push($errors, "Введите имя");
    }
    else{
        $sql = "SELECT id from Users WHERE first_name = :first_name";

        if($stmt = $dbcon->prepare($sql)){
            $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
            $param_first_name = trim($_POST["first_name"]);

            if($stmt->execute()){
                $first_name = trim($_POST["first_name"]);
            }
            else{
                echo "Something went wrong! Please try again later. user error";
            }
        }
        unset($stmt);
    }

    // last name
    if(empty(trim($_POST["last_name"]))){
        $first_name_err = "Введите фамилию";
        array_push($errors, "Введите фамилию");
    }
    else{
        $sql = "SELECT id from Users WHERE last_name = :last_name";

        if($stmt = $dbcon->prepare($sql)){
            $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
            $param_last_name = trim($_POST["last_name"]);

            if($stmt->execute()){
                $last_name = trim($_POST["last_name"]);
            }
            else{
                echo "Something went wrong! Please try again later. user error";
            }
        }
        unset($stmt);
    }

  // email validation
  if(empty(trim($_POST["email"]))){
    $email_err = "Введите имейл";
    array_push($errors, "Введите имейл");
  }
  else{
    $sql = "SELECT id FROM Users WHERE email = :email";

    if($stmt = $dbcon->prepare($sql)){
      $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
      $param_email = trim($_POST["email"]);

      if($stmt->execute()){
        if($stmt->rowCount() == 1){
        $email_err = "Этот имейл уже используется";
        array_push($errors, "Этот имейл уже используется");
      }
      else{
        $email = trim($_POST["email"]);
      }
    }
    else{
      echo "Something went wrong! Please try again later. user error";
    }
  }
  	unset($stmt);
	}
	  // upload an image
  if( $_FILES['img']['name'] === '' || $_FILES['img']['name'] === null || $_FILES['img']['name'] === ' '){
  		$img='default.svg';
  	}else{
  		
  		$folder = "../images/dist/main/avatars/";
  		$img = $_FILES['img']['name'];
		
  		$path = $folder . $img ;
  		$target_file = $folder.basename($_FILES["img"]["name"]);
		
  		$imgFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  		$allowed = array('jpeg','png','jpg','svg','JPEG','PNG','JPG', 'SVG');
  		$filename = $_FILES['img']['name'];
		
  		$ext=pathinfo($filename, PATHINFO_EXTENSION);
  		if(!in_array($ext,$allowed)){
  		  	echo "Please only select img file of type JPG, JPEG, PNG OR GIF";
  		}
  		else{
  		  	move_uploaded_file( $_FILES['img']['tmp_name'], $path);
  		}
  	}



  //password validation
  if(empty(trim($_POST["password"]))){
    $password_err = "Введите пароль";
    array_push($errors, "Введите пароль");
    // make sure password length is at least 6 characters
  } elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "Пароль должен состоять минимум из 6 символов";
    array_push($errors, "Пароль должен состоять минимум из 6 символов");
  }  
  else{
    $password = trim($_POST["password"]);
  }

  // validate match password
  if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Подтвердите пароль";
    array_push($errors, "Подтвердите пароль");
  }
  else{
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password))
    {
      $confirm_password_err = "Пароль не совпадает";
      array_push($errors, "Пароль не совпадает");
    }
  }
  
  // register user if there are no errors in the form
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err))
    {
    $sql = "INSERT INTO Users (username, password, email, first_name, last_name, img) VALUES (:username, :password, :email, :first_name, :last_name, :img)";
    if($stmt = $dbcon->prepare($sql)){
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
        $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
        $stmt->bindParam(":img", $param_img, PDO::PARAM_STR);

        $param_username = $username;
        $param_email = $email;
        $param_first_name = $first_name;
        $param_last_name = $last_name;
        $param_img = $img;
        // This method is to create password hash to encrypt the password when saved in the database
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if($stmt->execute()){
        session_start();

        // this will make session available in other pages
        $_SESSION["loggedin"] = true;
        // we need to get the id and username since we will need to show the username value in some of the pages.
        $_SESSION["id"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["img"] = $img;
      ?>
        <!-- if all requirements are met for registeration, redirect to welcome page -->
        <!-- <script type="text/javascript">
        window.location.href = "index.php";
        </script> -->
      <?php  
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
    }
    // close statement
    unset($stmt);
  }
  // close connection
  unset($dbcon);
}
// this function to display erros in the register panel.
function display_error() {
  global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo $error .'<br>';
            }
        echo '</div>';
    }
}   
$page_title = "BfgMuz - музыкальное сообщество";
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<!-- <base href="/"> -->

	<title><?echo $page_title ?></title>
	<meta name="description" content="BfgMuz - музыкальное сообщество">
	<meta property="og:description" content="BfgMuz - музыкальное сообщество">
	<meta property="og:type" content="website">
    <meta property="og:title" content="BfgMuz - музыкальное сообщество">
    <meta property="og:image" content="images/dist/main/logo.jpg">
    <meta property="og:url" content="https://bfgmuz.com/">
    <meta property="og:site_name" content="BfgMuz">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link rel="icon" href="images/favicon/source-fav.png">

	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">

	<meta property="og:image" content="/images/dist/main/logo.jpg">
	
	<meta name="theme-color" content="#3A55EE">

	<link rel="stylesheet" href="../css/main.min.css">

</head>

<body>

<div class="mobileMenu">
	<a href="/" class="logo">
		<img src="/images/dist/main/logo.svg" alt="BfgMuz - Логотип">
	</a>

	<div class="menuWrapper">
		<button class="hamburger hamburger--spring" type="button">
		  <span class="hamburger-box">
		    <span class="hamburger-inner"></span>
		  </span>
		</button>
		<p>Меню</p>
	</div>

	<button class="playlistsButton"><svg width="25" height="26" xmlns="http://www.w3.org/2000/svg"><path d="M6.812 3.328v16.484c-.988-.468-2.444-.416-3.848.26-1.976.988-3.016 2.964-2.288 4.316.728 1.352 2.86 1.664 4.836.624 1.56-.832 2.548-2.184 2.496-3.432V8.788L23.244 6.5v10.92c-.988-.468-2.444-.416-3.848.26-1.976.988-3.016 2.964-2.288 4.316.676 1.352 2.86 1.664 4.836.624 1.56-.78 2.496-2.132 2.496-3.328V.676L6.812 3.328z"/></svg></button>
</div>
<div class="container">
	<div class="row g-0">
		<div class="col-lg-2">
			
			<div class="menu">
				<a href="index.php" class="logo">
				<img src="/images/dist/main/logo.svg" alt="BfgMuz - Логотип">
			</a>

			<div class="mobileUser">

				<!-- Пользователь не залогинен -->

				<div class="menuClose">
				<svg xmlns="http://www.w3.org/2000/svg"><path d="M31 13.5a1.5 1.5 0 000-3v3zM.94 10.94a1.5 1.5 0 000 2.12l9.545 9.547a1.5 1.5 0 102.122-2.122L4.12 12l8.486-8.485a1.5 1.5 0 10-2.122-2.122L.94 10.94zM31 10.5H2v3h29v-3z"/></svg>					
				</div>

				<div class="user">
						<div class="userWrapper userAuth">
							<div class="authTitle">
	Вход / <a href="/registration.html">Регистрация</a>
</div>
							<form method="POST">
								<input type="email" placeholder="Логин или e-mail">
								<input type="password" placeholder="Пароль">
								<button class="button"><span>Войти</span></button>
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
					<li><a href="/" class="active"><span><svg class="menuIcon home" width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
						<circle cx="2.6" cy="2.6" r="2.1" stroke="#3A55EE"/>
						<circle cx="10.4" cy="2.6" r="2.6" fill="#3A55EE"/>
						<circle cx="10.4" cy="10.4" r="2.1" stroke="#3A55EE"/>
						<circle cx="2.6" cy="10.4" r="2.1" stroke="#3A55EE"/>
					</svg></span>
				Главная</a></li>
				<li><a target="_blank" href="/access-is-denied.html">
					<span><svg class="menuIcon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.7 29.2"
						xml:space="preserve">
						<circle cx="14.5" cy="7.1" r="6.6"/>
						<path d="M18.4,14.9c-1.9,1.2-4.3,1.5-6.6,0.6c-0.5-0.2-0.9-0.4-1.3-0.6C5.6,16,2,20.3,2,25.5v3.1h25v-3.1
							C27,20.3,23.3,16,18.4,14.9z"/>
						</svg></span>
					Моя страница</a></li>
					<li><a target="_blank" href="/access-is-denied.html"><span><svg class="menuIcon" viewBox="0 0 14 12" xmlns="http://www.w3.org/2000/svg">
						<rect width="4" height="12" rx="2"/>
						<rect x="5" y="4" width="4" height="8" rx="2"/>
						<rect x="10" y="8" width="4" height="4" rx="2"/>
					</svg></span>
				Рейтинги</a></li>
				<li><a target="_blank" href="/access-is-denied.html">
					<span><svg class="menuIcon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28.7 22.2"
						xml:space="preserve">
						<circle cx="9.8" cy="5.5" r="5"/>
						<ellipse cx="20.4" cy="8.1" rx="4.3" ry="4.2"/>
						<path d="M22.9,13.1c-1.2,0.8-2.8,1-4.3,0.4c-0.3-0.1-0.6-0.3-0.8-0.4c-3.2,0.7-5.5,3.5-5.5,6.9v2h16.2v-2
							C28.5,16.5,26.1,13.7,22.9,13.1z"/>
							<path d="M15.8,12.7c-0.9-0.6-1.9-1.1-3-1.4c-1.5,0.9-3.3,1.1-5,0.5c-0.4-0.1-0.7-0.3-1-0.5c-3.7,0.8-6.5,4.2-6.5,8.1
								v2.4h10.9v-2.2C11.1,16.6,13,13.9,15.8,12.7z"/>
							</svg></span>
						Друзья</a></li>
						<li><a target="_blank" href="/access-is-denied.html">
							<span><svg class="menuIcon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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
								Сообщения</a></li>
							</ul>
						</div>
						<div class="menuGroup">
							<span class="menuTitle">Музыка</span>
							<ul>
								<li><a target="_blank" href="/access-is-denied.html"> <span><svg class="menuIcon" viewBox="0 0 16 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L15.0711 3.34315C15.4616 2.95262 15.4616 2.31946 15.0711 1.92893C14.6805 1.53841 14.0474 1.53841 13.6569 1.92893L8 7.58579L2.34315 1.92893C1.95262 1.53841 1.31946 1.53841 0.928932 1.92893C0.538408 2.31946 0.538408 2.95262 0.928932 3.34315L7.29289 9.70711ZM7 0L7 9H9V0L7 0Z"/>
								</svg></span>
							Загруженные</a></li>
							<li><a target="_blank" href="/access-is-denied.html">
								<span><svg class="menuIcon" viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 3.78871C14 1.70492 12.3172 0 10.2604 0C8.8581 0 7.64274 0.781421 7.01169 1.94171H6.96494C6.35726 0.8051 5.1419 0 3.73957 0C1.6828 0 0 1.70492 0 3.78871C0 4.66484 0.30384 5.46995 0.81803 6.13297L6.98831 13L13.1586 6.15665C13.6962 5.49362 14 4.68852 14 3.78871Z"/>
								</svg></span>
							Понравившиеся</a></li>
							<li><a target="_blank" href="/access-is-denied.html">
								<span><svg class="menuIcon favorite" viewBox="0 0 8 12" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0V12L4 8.49741L8 12V0H0Z"/>
								</svg></span>
							Избранные</a></li>
						</ul>
					</div>

			</div>

				</div>

				<div class="col-lg-7 main registrationPage">
					<main>
						
						<div class="user">
							<div class="userWrapper userAuth">

								<div class="authTitle">
									Регистрация
								</div>

								<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<?php echo display_error(); ?>
									<input type="text" name="username" placeholder="Логин">
									<input type="email" name="email" placeholder="E-mail">
									<input type="fname" name="first_name" placeholder="Имя">
									<input type="lname" name="last_name" placeholder="Фамилия">
									<input type="password" name="password" placeholder="Пароль">
									<input type="password" name="confirm_password" placeholder="Повторите пароль">
									<input type="hidden" name="MAX_FILE_SIZE" value="300000000000" />
									<label for="img">Аватар:</label>
									<input type="file" name="img" accept="img/*">

										<label class="checkWrapper">
											
											<input type="checkbox"><span></span> <p>Вы подтверждаете что являетесь совершеннолетней особой </p>
										</label>

										<label class="checkWrapper">
											<input type="checkbox"><span></span> <p>Вы соглашаетесь с <a target="_blank" href="access-is-denied.html">Правилами сайта</a> и <a target="_blank" href="access-is-denied.html">Лицензионным соглашнием</a></p>
										</label>

									<button type="submit" name="register_btn" class="button"><span>Зарегистрироваться</span></button>
								</form>
							</div>
						</div>

					</main>
				</div>

				<div class="col-lg-3 sidebar logIn align-self-center">

					<div class="playlists">
						<div class="user">
							<div class="userWrapper">
								<h3>Плейлисты</h3>

								<div class="playlistsNav">

									<div class="playlistsNav_item">
										Популярные
									</div>

									<div class="playlistsNav_item">
										Понравившиеся
									</div>

									<div class="playlistsNav_item">
										Избранные
									</div>

									<div class="playlistsNav_item">
										Мои
									</div>

								</div>

								<div class="playlistsMusic">
									<div class="playlistsMusic_list popular">

										<div class="topTracks_item">

											<audio class="player" controls>
											  <source src="media/music/test-track_1.mp3" type="audio/mp3" />
											  <!-- <source src="/path/to/audio.ogg" type="audio/ogg" /> -->
											</audio>

											<div class="topTracks_info">
												<h6>Andy Powell - </h6>
												<p>The Best You've Had (ft. Emily Taylor)</p>
											</div>

										</div>

										<div class="topTracks_item">

											<audio class="player" controls>
											  <source src="media/music/test-track_2.mp3" type="audio/mp3" />
											  <!-- <source src="/path/to/audio.ogg" type="audio/ogg" /> -->
											</audio>

											<div class="topTracks_info">
												<h6>Emika - </h6>
												<p>Drop The Other</p>
											</div>

										</div>

										<div class="topTracks_item">

											<audio class="player" controls>
											  <source src="media/music/test-track_3.mp3" type="audio/mp3" />
											  <!-- <source src="/path/to/audio.ogg" type="audio/ogg" /> -->
											</audio>

											<div class="topTracks_info">
												<h6>Imagine Dragons</h6>
												<p>Believer</p>
											</div>

										</div>

										<div class="topTracks_item">

											<audio class="player" controls>
											  <source src="media/music/test-track_4.mp3" type="audio/mp3" />
											  <!-- <source src="/path/to/audio.ogg" type="audio/ogg" /> -->
											</audio>

											<div class="topTracks_info">
												<h6>Kendrick Lamar - </h6>
												<p>Don't Wanna Know (ft. Maroon 5)</p>
											</div>

										</div>

										<div class="topTracks_item">

											<audio class="player" controls>
											  <source src="media/music/test-track_5.mp3" type="audio/mp3" />
											  <!-- <source src="/path/to/audio.ogg" type="audio/ogg" /> -->
											</audio>

											<div class="topTracks_info">
												<h6>Yelawolf – </h6>
												<p>Row Your Boat</p>
											</div>

										</div>

									</div>

									<div class="playlistsMusic_list liked">

										<p class="infoMessage">Плейлист доступен только авторизированным пользователям ..</p>

									</div>

									<div class="playlistsMusic_list favorites">

										<p class="infoMessage">Плейлист доступен только авторизированным пользователям ..</p>

									</div>

									<div class="playlistsMusic_list my">

										<p class="infoMessage">Плейлист доступен только авторизированным пользователям ..</p>

									</div>
									
								</div>
											

							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
			<script src="js/app.min.js"></script>

</body>
</html>