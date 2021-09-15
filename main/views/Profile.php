<?

	$page_title = "Profile";
	include 'header.php';

	if(isset($_GET['user_id'])){
		$user_id = $_GET['user_id'];
		$dbcon  = Database::getDb();
		$u = new User();
		$m = new Music();
		$p = new Post();
	
		$user = $u->getUserById($dbcon, $user_id);
		$music = $m->getAllMusicByUser($dbcon, $user_id);
		$post = $p->getAllPostsByUser($dbcon, $user_id);

		if(isset($_POST['submitPost'])){
			$post_receiver_id = $user_id;
			$post_author_id = $_SESSION['id'];
			//--------------Post-content---------------------
			if($_POST['postContent'] === '' || $_POST['postContent'] === null || $_POST['postContent'] === ' '){
				$post_content = null;
			}else{
				$post_content = $_POST['postContent'];
			}
			//--------------Post-content-end--------------------
			//--------------Music---------------------
			$date = new DateTime();
   			$date_hash = hash('ripemd160', $date->getTimestamp());
    		$login_hash = hash('ripemd160', $_SESSION['username']);
    		$uniqueHash = $date_hash . $login_hash;

	  		$uploadfile = "../media/posts/music/". $uniqueHash . $_FILES['formAddTrack_file']['name'];
	  		move_uploaded_file($_FILES['formAddTrack_file']['tmp_name'], $uploadfile);

	  		
	  		$title = $_FILES['formAddTrack_file']['name'];
    		if($title === '' || $title === null || $title === ' '){
    			$post_music_name = null;
    			$post_music_link = null;
    		}else{
      			// $music->addMusic($dbcon, $title, $author, $user_id, $link);
      			$post_music_name = $_FILES['formAddTrack_file']['name'];
      			$post_music_link = $uploadfile;
    		}
			//--------------Music-End-----------------
			//--------------Img-----------------------
    		if( $_FILES['formAddImg_file']['name'] === '' || $_FILES['formAddImg_file']['name'] === null || $_FILES['formAddImg_file']['name'] === ' '){
  				$post_img = null;
  			}else{
  		
  				$folder = "../media/posts/img/";
  				
				$img_name = $_FILES['formAddImg_file']['name'];
  				$path = $folder . $img_name; ;
  				$target_file = $folder.basename($_FILES["formAddImg_file"]["name"]);
				
  				$imgFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  				$allowed = array('jpeg','png','jpg','svg','JPEG','PNG','JPG', 'SVG');
  				$filename = $_FILES['formAddImg_file']['name'];
				
  				$ext=pathinfo($filename, PATHINFO_EXTENSION);
  				if(!in_array($ext,$allowed)){
  				  	echo "Please only select img file of type JPG, JPEG, PNG OR GIF";
  				}
  				else{
  					$post_img = $target_file;
  				  	move_uploaded_file( $_FILES['formAddImg_file']['tmp_name'], $path);
  				}
  			}
			//--------------Img-End-------------------
			// echo 'Post content: ' . $post_content . '; ';
			// echo 'Receiver id: ' . $post_receiver_id . '; ';
			// echo 'Author id: ' . $post_author_id . '; ';
			// echo 'Track name: ' . $post_music_name . '; ';
			// echo 'Music link:  ' . $post_music_link . '; ';
			// echo 'Img:  ' . $post_img . '; ';
			$addPost = $p->addPost($dbcon, $post_content, $post_music_link, $post_music_name, $post_img, $post_receiver_id, $post_author_id);
		}
	}

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
							<span class="fake_btn"></span>
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
													<h6><?echo $music->author?></h6>
													<p><? echo $music->title?></p>
												</div>
												<div class="topTracks_wrapper">
													<div class="topTracks_likes disabled_btn">
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
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a href="uploadedMusic.php?user_id=<?echo $user->user_id ?>" class="button buttonTracks"><span>Все треки</span></a>
					<div class="dropPost userAuth">
						<h3>Сделать публикацию:</h3>
						
						<form method="POST" enctype="multipart/form-data" class="dropTextForm">
							<div class="buttonDropWrapper uploadFilesWrapper">
                                <div class="formAddTrack_wrapper">
                                    <input type="file"  name="formAddImg_file" id="formAddImg_file" class="formAddTrack_file">
                                    <label for="formAddImg_file" class="button formAddTrack available">
                                        <img src="../images/dist/icons/addTrack.svg" alt="add track bgmuz">
                                        <span class="formAddTrack_descr">Выберите фото</span>
                                    </label>
                                </div>
                                <div class="formAddTrack_wrapper">
                                    <input type="file"  name="formAddTrack_file" id="formAddTrack_file" class="formAddTrack_file">
                                    <label for="formAddTrack_file" class="button formAddTrack available">
                                        <img src="../images/dist/icons/addTrack.svg" alt="add track bgmuz">
                                        <span class="formAddTrack_descr">Прикрепите трек</span>
                                    </label>
                                </div>
                            </div>

							<textarea required name="postContent" class="dropTextArea" placeholder="Введите текст вашей публикации"></textarea>
							<div class="buttonDropWrapper">
								<button name="submitPost" class="button postDropButton"><span>Опубликовать</span></button>
							</div>
						</form>
					</div>
					<div class="allPosts">
						<h3>Все публикации</h3>
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
