<footer>
	<div class="thanks modalForm">
		<span class="close"></span>
		<div class="thanksMessage">
			<p>Благодарим за ваше обращение!</p>
		</div>
	</div>
	<section class="bugInfo">
        <p>Если у Вас возникли трудности при использовании сайта, либо есть пожелания/предложения, пожалуйста, <a href="#" class="sendReport">Заполните форму</a>,  И мы постараемся вам помочь либо учтём ваше сообщение. С уважением, команда BGMUZE</p>
    </section>
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
</footer>
<script src="../js/likes.js"></script>
<script src="../js/app.min.js"></script>
</body>
</html>