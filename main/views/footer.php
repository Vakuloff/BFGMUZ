<footer>
	<div class="thanks modalForm">
		<span class="close"></span>
		<div class="thanksMessage">
			<p>Благодарим за ваше обращение!</p>
		</div>
	</div>
	<div class="bugReport userAuth modalForm">
		<span class="close"></span>
		<form method="POST">
			<div class="authTitle">Сообщить о проблеме</div>
			<input type="hidden" name="project_name" value="BG MUZ">
        	<input type="hidden" name="admin_email" value="wayinweb.pro@gmail.com">
        	<input type="hidden" name="form_subject" value="Сообщение о проблеме">

			<input type="text" name="name" placeholder="Пожалуйста, представтесь">
			<textarea name="bugMessage" placeholder="Опишите проблему с которой столкнулись"></textarea>
 			<button type="submit" name="addMusic" class="button"><span>Отправить</span></button>
		</form>
	</div>
	<script src="https://cdn.tiny.cloud/1/q84swdpjye92w7arqbw30b7irscjspljpnx2podv4rtuvvoi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
   		tinymce.init({
      	selector: '.dropText'
    	});
  	</script>
	<script src="../js/likes.js"></script>
	<script src="../js/app.min.js"></script>
</footer>
</body>
</html>