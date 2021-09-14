<? include 'header.php'; 
if(isset($_GET['user_id'])){
	$dbcon = Database::getDb();
	$user_id = $_SESSION['id'];

	//------------------------- username----------------------------
	if(isset($_POST['username'])){
		$username = '';
		$username_err = '';
		
		if(empty(trim($_POST["username"]))){
    		$username_err = "Введите логин";
    		array_push($errors, "Введите логин");
    	}else{
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
	
		if(empty($username_err)){
			$sql = "UPDATE Users
					SET username = :username
					WHERE id = :id";
			if($stmt = $dbcon->prepare($sql)){
				$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
				$stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
				
				$param_username = $username;
				if($stmt->execute()){
					$_SESSION["username"] = $username;
				}
			}
		}
	}
	//------------------------- username-end---------------------------
	//------------------------- firstname------------------------------
	if(isset($_POST['firstName'])){
		$first_name = '';
		$first_name_err = '';

		if(empty(trim($_POST["firstName"]))){
        	$first_name_err = "Введите имя";
        	array_push($errors, "Введите имя");
    	}
    	else{
        	$sql = "SELECT id from Users WHERE first_name = :first_name";

        	if($stmt = $dbcon->prepare($sql)){
        	    $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
        	    $param_first_name = trim($_POST["firstName"]);
	
        	    if($stmt->execute()){
        	        $first_name = trim($_POST["firstName"]);
        	    }
        	    else{
        	        echo "Something went wrong! Please try again later. user error";
        	    }
        	}
        	unset($stmt);
    	}

    	if(empty($first_name_err)){
			$sql = "UPDATE Users
					SET first_name = :first_name
					WHERE id = :id";
			if($stmt = $dbcon->prepare($sql)){
				$stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
				$stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
				
				$param_first_name = $first_name;
				if($stmt->execute()){
					$_SESSION["first_name"] = $first_name;
				}
			}
		}
	}
	//------------------------- firstname-end---------------------------
	//------------------------- lastname------------------------------
	if(isset($_POST['lastName'])){
		$last_name = '';
		$last_name_err = '';

		if(empty(trim($_POST["lastName"]))){
        	$last_name_err = "Введите фамилию";
        	array_push($errors, "Введите фамилию");
    	}
    	else{
        	$sql = "SELECT id from Users WHERE last_name = :last_name";

        	if($stmt = $dbcon->prepare($sql)){
        	    $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
        	    $param_last_name = trim($_POST["lastName"]);
	
        	    if($stmt->execute()){
        	        $last_name = trim($_POST["lastName"]);
        	    }
        	    else{
        	        echo "Something went wrong! Please try again later. user error";
        	    }
        	}
        	unset($stmt);
    	}

    	if(empty($last_name_err)){
			$sql = "UPDATE Users
					SET last_name = :last_name
					WHERE id = :id";
			if($stmt = $dbcon->prepare($sql)){
				$stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
				$stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
				
				$param_first_name = $last_name;
				if($stmt->execute()){
					$_SESSION["last_name"] = $last_name;
				}
			}
		}
	}
	//------------------------- firstname-end---------------------------
	//------------------------- email----------------------------
	if(isset($_POST['email'])){
		$email = '';
		$email_err = '';
		
		if(empty(trim($_POST["email"]))){
    		$email_err = "Введите email";
    		array_push($errors, "Введите email");
    	}else{
    		$sql = "SELECT id FROM Users WHERE email = :email";

    		if($stmt = $dbcon->prepare($sql)){
      			$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
      			$param_email = trim($_POST["email"]);

      			if($stmt->execute()){
        			if($stmt->rowCount() == 1){
          				$email_err = "Этот email уже используется";
          				array_push($errors, "Этот email уже используется");
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
	
		if(empty($email_err)){
			$sql = "UPDATE Users
					SET email = :email
					WHERE id = :id";
			if($stmt = $dbcon->prepare($sql)){
				$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
				$stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
				
				$param_username = $username;
				if($stmt->execute()){
					$_SESSION["email"] = $email;
				}
			}
		}
	}
	//------------------------- email-end---------------------------
	//------------------------- password----------------------------
	if(isset($_POST['password'])){
		$password = '';
		$password_err = '';
		
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
  		if(empty(trim($_POST["confirmPassword"]))){
  	  		$confirm_password_err = "Подтвердите пароль";
  	  		array_push($errors, "Подтвердите пароль");
  		}
  		else{
    		$confirm_password = trim($_POST["confirmPassword"]);
    		if(empty($password_err) && ($password != $confirm_password))
    		{
    	  		$confirm_password_err = "Пароль не совпадает";
    	  		array_push($errors, "Пароль не совпадает");
    		}
  		}
	
		if(empty($password_err) && empty($confirm_password_err)){
			$sql = "UPDATE Users
					SET password = :password
					WHERE id = :id";
			if($stmt = $dbcon->prepare($sql)){
				$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
				$stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
				
				$param_password = password_hash($password, PASSWORD_DEFAULT);
				$stmt->execute();
			}
		}
	}
	//------------------------- password-end---------------------------
	//------------------------- image----------------------------

	if(isset($_POST['submitImg'])){
		if( $_FILES['img']['name'] === '' || $_FILES['img']['name'] === null || $_FILES['img']['name'] === ' '){
  		$img = 'default.svg';
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
  		$sql = "UPDATE Users
					SET img = :img
					WHERE id = :id";
		if($stmt = $dbcon->prepare($sql)){
			$stmt->bindParam(":img", $param_img, PDO::PARAM_STR);
			$stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
			
			$param_img = $img;
			if($stmt->execute()){
				$_SESSION["img"] = $img;
			}
		}
  	}
}

	//------------------------- image-end---------------------------
}else{
	header('Location: index.php');
	exit();
}
// this function to display erros in the register panel.
function display_error_editProfile() {
  global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo '<span class="formError">' . $error . '</span>';
            }
        echo '</div>';
    }
}  
var_dump($_SESSION);

?>
<div class="container">
	<div class="row g-0">
		<div class="col-lg-2">
			<?php include 'menu.php' ?>
		</div>
		<div class="col-lg-7 registrationPage">
			<main class="main">	
				<div class="user">
					<div class="userWrapper userAuth">
						<p class="authTitle"> Изменить персональные данные</p>
						<?php echo display_error_editProfile(); ?>
						<form method="POST" class="dataEditForm">
							<div class="editWrapper">
								<input class="editHidden" type="hidden" value="<? echo $_SESSION['username']?>">
								<input type="text" name="username" placeholder="Логин" value="<? echo $_SESSION['username']?>">
								<button class="button saveChanges"><span>Изменить</span></button>
							</div>
						</form>

						<form method="POST" class="dataEditForm">
							<div class="editWrapper">
								<input class="editHidden" type="hidden" value="<? echo $_SESSION['first_name']?>">
								<input type="text" name="firstName" placeholder="Имя" value="<? echo $_SESSION['first_name']?>">
								<button class="button saveChanges"><span>Изменить</span></button>
							</div>
						</form>

						<form method="POST" class="dataEditForm">
							<div class="editWrapper">
								<input class="editHidden" type="hidden" value="<? echo $_SESSION['last_name']?>">
								<input type="text" name="lastName" placeholder="Фамилия" value="<? echo $_SESSION['last_name']?>">
								<button class="button saveChanges"><span>Изменить</span></button>
							</div>
						</form>

						<form method="POST" class="dataEditForm">
							<div class="editWrapper">
								<input class="editHidden" type="hidden" value="<? echo $_SESSION['email']?>">
								<input type="email" name="email" placeholder="E-mail" value="<? echo $_SESSION['email']?>">
								<button class="button saveChanges"><span>Изменить</span></button>
							</div>
						</form>

						<form method="POST" class="dataEditForm passEdit">
							<div class="editWrapper">
								<input class="firstPass" name="password" type="password" placeholder="Пароль">
								<input class="secondPass" name="confirmPassword" type="password" placeholder="Повторите пароль">
							</div>
							<button class="button saveChanges"><span>Изменить</span></button>
						</form>

						<form method="POST" enctype="multipart/form-data" class="dataEditForm editAvatar">
							<div class="editWrapper">
								<div class="formAddTrack_wrapper">
									<input type="file"  name="img" id="formAddTrack_file" class="formAddTrack_file" accept="img/*">
									<label for="formAddTrack_file" class="button formAddTrack available">
										<img src="../images/dist/icons/addTrack.svg" alt="add track bgmuz">
										<span class="formAddTrack_descr">Выберите аватар</span>
									</label>
								</div>
								<button type="submit" name="submitImg" class="button saveChanges"><span>Изменить</span></button>
							</div>
						</form>
					</div>
				</div>
			</main>
		</div>
		<? include 'sidebar.php'; ?>
	</div>
</div>
<? include 'footer.php' ?>	