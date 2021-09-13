<?
	$page_title = "BfgMuz";
	include 'header.php';

	$dbcon = Database::getDb();
	$m = new Music();
	$rating = $m->getTopSongs($dbcon);
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
				<!-- Content -->
				<div class="topTracks allTracks">
					<?php foreach ($rating as $rating): ?>
						<span>Song with id: <?echo $rating->music_id?> has </span>
						<span><?echo $rating->likes_count?> likes</span>
						<br>
					<? endforeach; ?>
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
