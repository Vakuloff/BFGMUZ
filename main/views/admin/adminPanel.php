<?
	$page_title = "Обитель божества";
	
	include 'adminHeader.php';


	if($_SESSION['id'] == '1' || $_SESSION['id'] == '49'){
		
		$a = new Admin();
		$dbcon = Database::getDb();
		$admin_user_list = $a->getAllUsersAdmin($dbcon);
		
	} else{
		header('Location: index.php');
		exit;
	}
	
?>
<div class="container">
	<div class="row g-0">
		<div class="col-lg-2">

		</div>
		<div class="col-lg-7">
			<main class="main banPage">
				<article>
					<h1>Все пользователи</h1>
						<? foreach($admin_user_list as $admin_user_list): ?>
						<div class="userItemList">
							<form class="formFlexWrapper" action="deleteUser.php" method='POST'>
								<h2><?echo $admin_user_list->first_name . ' ' . $admin_user_list->last_name ?></h2>
								<input type='hidden' value='<? echo $admin_user_list->user_id ?>' name='user_id' />
								<button type='submit' class="button" name="Delete"><span>Delete</span></button>
							</form>
							<? $admin_user_tracks = $a->getAllMusicByUserAdmin($dbcon, $admin_user_list->user_id); ?>
							<div class="pointWrapper">
								<span class="pointItem">Треки</span>
								<ul class="userContentList userTrackList">
									<? foreach($admin_user_tracks as $admin_user_tracks): ?>
										<li>
											<form class="formFlexWrapper" action="deleteMusic.php" method='POST'>
												<span class="trackName"><?echo $admin_user_tracks->title ?></span>
												<input type='hidden' value='<? echo $admin_user_tracks->music_id ?>' name='music_id' />
												<button type='submit' class="button" name="Delete"><span>Delete</span></button>
											</form>
										</li>
									<? endforeach; ?>
								</ul>
							</div>
							<? $admin_user_posts = $a->getAllPostsByUserAdmin($dbcon, $admin_user_list->user_id); ?>
							<div class="pointWrapper">
								<span class="pointItem">Посты</span>
								<ul class="userContentList userPostList">
									<? foreach($admin_user_posts as $admin_user_posts): ?>
									<!-- ------------------------------------- -->
										<li>
											<form class="formFlexWrapper" action="deletePost.php" method='POST'>
												<span class="trackName">
													<p><? echo $admin_user_posts->content ?></p>
													<a target="_blank" href="../<? echo $admin_user_posts->img_link ?>">img-link</a>
													<p><? echo $admin_user_posts->music_name ?></p>
												</span> 
												<input type='hidden' value='<? echo $admin_user_posts->post_id ?>' name='post_id' />
												<button type='submit' class="button" name="Delete"><span>Delete</span></button>
											</form>
										</li>
									<? endforeach ?>
									<!-- ---------------------------------------- -->
								</ul>
							</div>
						</div>
					<? endforeach; ?>
				</article>
			</main>
		</div>
		<?

		?>
	</div>
</div>
<? 
include 'adminFooter.php'
?>	
