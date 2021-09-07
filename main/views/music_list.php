
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
        <div class="posts-wrapper">
          <?php foreach ($music_arr as $music_arr): ?>
            <div class="post">
              <?php echo $music_arr['title']; ?>
              <div class="post-info">
          <!-- if user likes post, style button differently -->
                <i <?php if (userLiked($music_arr['id'])): ?>
                    class="fa fa-thumbs-up like-btn"
                  <?php else: ?>
                    class="fa fa-thumbs-o-up like-btn"
                <?php endif ?>
                  data-id="<?php echo $music_arr['id'] ?>"></i>
                <span class="likes"><?php echo getLikes($music_arr['id']); ?></span>
              </div>
            </div>
          <?php endforeach ?>
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
