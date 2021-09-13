
<?
  $page_title = "BfgMuz All Tracks";
  include 'header.php';
?>
<div class="container">
  <div class="row g-0">
    <div class="col-lg-2">
      <?php include 'menu.php' ?>
    </div>
    <div class="col-lg-7 main">
      <main>  
        <div class="searchWrapper">
          <form method="GET" action="searchMusic.php">
            <input type="text" placeholder="Поиск" name="musicName">
            <button type="submit" class="searchButton"></button>
          </form>
        </div>
        <div class="topTracks allTracks">
          <?php foreach ($music_arr as $music_arr): ?>
            <div class="topTracks_item">
              <audio class="player" controls>
                <source src="<?php echo $music_arr['link'] ?>" type="audio/mp3" />
              </audio>
              <div class="topTracks_info">
                <h6><?php echo $music_arr['title'] ?></h6>
              </div>
              <div class="topTracks_wrapper">
                <div class="topTracks_likes">
                  <i <?php if (userLiked($music_arr['music_id'])): ?>
                    class="fa fa-thumbs-up like-btn"
                  <?php else: ?>
                    class="fa fa-thumbs-o-up like-btn"
                  <?php endif ?>
                  data-id="<?php echo $music_arr['music_id'] ?>"></i>
                  <span class="likes"><?php echo getLikes($music_arr['music_id']); ?></span>
                </div>
                <div class="topTracks_user">
                  <div class="userInfo">
                    Загружен
                    <span><?php echo $music_arr['first_name'] . ' ' . $music_arr['last_name']?></span>
                  </div>
                  <a href="profile.php?user_id=<? echo $music_arr['user_id']?>" class="userActive_item">
                    <div class="userActive_photo">
                        <img src="../images/dist/main/avatars/<?php echo $music_arr['img'] ?>" alt="UserName 1">
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        
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
