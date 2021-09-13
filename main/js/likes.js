$(document).ready(function(){

// if the user clicks on the like button ...
$('.topTracks_likes').on('click', function(){
  var music_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('default')) {
  	action = 'like';
  } else if($clicked_btn.hasClass('liked')){
  	action = 'unlike';
  }
  $.ajax({
  	url: 'likes.php',
  	type: 'post',
  	data: {
  		'action': action,
  		'music_id': music_id,
  	},
  	success: function(data){
  		res = JSON.parse(data);
      if (action == "like") {
        $clicked_btn.removeClass('default');
        $clicked_btn.addClass('liked');
      } else if(action == "unlike") {
        $clicked_btn.removeClass('liked');
        $clicked_btn.addClass('default');
      }
  		// display the number of likes and dislikes
  		$clicked_btn.find('span.likes').text(res.likes);

  		// change button styling of the other button if user is reacting the second time to post
  		//$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
  	},  
  });		

});

});