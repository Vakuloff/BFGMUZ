<?
include 'header.php';

if(isset($_GET['user_id'])){
	$dbcon = Database::getDb();
	$user_id = $_SESSION['id'];

	if($user_id == $_GET['user_id']){
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
  	} 	elseif(strlen(trim($_POST["password"])) < 6){
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
    $sql = "UPDATE Users
    		SET username = :username, 
    		password = :password, 
    		email = :email, 
    		first_name = :first_name, 
    		last_name = :last_name, 
    		img = :img
    		WHERE id = :id";
    if($stmt = $dbcon->prepare($sql)){
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
        $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
        $stmt->bindParam(":img", $param_img, PDO::PARAM_STR);
        $stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);

        $param_username = $username;
        $param_email = $email;
        $param_first_name = $first_name;
        $param_last_name = $last_name;
        $param_img = $img;
        // This method is to create password hash to encrypt the password when saved in the database
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if($stmt->execute()){
        // this will make session available in other pages
        $_SESSION["loggedin"] = true;
        // we need to get the id and username since we will need to show the username value in some of the pages.
        $_SESSION["id"] = $user_id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["img"] = $img;
      ?>
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
  	}	
	else{
		header('Location: index.php');
		exit();
	}
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
                echo $error .'<br>';
            }
        echo '</div>';
    }
}   
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
						<div class="authTitle">
							Изменить персональные данные
						</div>

						<form method="POST" enctype="multipart/form-data" class="dataEditForm">
							<?php echo display_error_editProfile(); ?>
							<input type="text" name="first_name" placeholder="Имя" value="<? echo $_SESSION['first_name']?>">
							<input type="text" name="last_name"  placeholder="Фамилия" value="<? echo $_SESSION['last_name']?>">
							<input type="text" name="username"  placeholder="Логин" value="<? echo $_SESSION['username']?>">
							<input type="email" name="email"  placeholder="E-mail" value="<? echo $_SESSION['email']?>">
							<input type="password" name="password"  placeholder="Пароль">
							<input type="password" name="confirm_password"  placeholder="Повторите пароль">
							<label for="img">Аватар:</label>
							<input type="file" name="img" accept="img/*">
							<div class="buttonWrapperEdit">
								<!-- <button class="button cancel"><span>Отменить</span></button> -->
								<button type="submit" class="button disabled saveChanges"><span>Изменить</span></button>
							</div>

						</form>
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