<?
	$page_title = "Обитель божества";
	include 'header.php';

	require_once '../model/Admin.php'; 

	if($_SESSION['id'] == '1' || $_SESSION['id'] == '49'){
		$a = new Admin();
		$admin_user_tracks = $a->getAllMusicByUserAdmin($dbcon);


	} else{
		header('Location: index.php');
		exit;
	}
	
?>
<div class="container">
	<div class="row g-0">
		<div class="col-lg-2">
			<?php include 'menu.php' ?>
		</div>
		<div class="col-lg-7">
			<main class="main banPage">

                        <article>
                            <h1>Все пользователи</h1>

                                <div class="userItemList">
                                    <h2>User Name <button class="button"><span>Delete</span></button></h2>

                                    <span class="pointItem">Треки</span>
                                    <ul>
                                        <li><span class="trackName">Track Name</span> <button class="button"><span>Delete</span></button></li>
                                        <li><span class="trackName">Track Name</span> <button class="button"><span>Delete</span></button></li>
                                    </ul>

                                    <span class="pointItem">Посты</span>
                                    <ul>
                                        <li><span class="trackName">Post Name</span> <button class="button"><span>Delete</span></button></li>
                                        <li><span class="trackName">Post Name</span> <button class="button"><span>Delete</span></button></li>
                                    </ul>

                                </div>

                        </article>

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
