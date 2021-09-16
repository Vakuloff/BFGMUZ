<?php 
class Post
{
	public function addPost($dbcon, $content, $music_link, $music_name, $img_link, $receiver_id, $author_id)
	{
		$sql = "INSERT INTO Posts (content, music_link, music_name, img_link, receiver_id, 
				author_id, date)
				VALUES(:content, :music_link, :music_name, :img_link, :receiver_id, 
				:author_id, NOW())";

		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':content', $content);
		$pst->bindParam(':music_link', $music_link);
		$pst->bindParam(':music_name', $music_name);
		$pst->bindParam(':img_link', $img_link);
		$pst->bindParam(':receiver_id', $receiver_id);
		$pst->bindParam(':author_id', $author_id);

		$post = $pst->execute();
		return $post;
	}

	public function getAllPostsByUser($dbcon, $receiver_id)
	{
		$sql = "SELECT Posts.id, Posts.content, Posts.music_link, Posts.music_name, 
				Posts.img_link, Posts.receiver_id, Posts.author_id, Posts.date, Users.first_name, 
				Users.last_name, Users.img, Users.id 
				FROM Posts
				INNER JOIN Users ON Posts.author_id = Users.id
				WHERE Posts.receiver_id = $receiver_id
				ORDER BY Posts.date DESC";

		$pst = $dbcon->prepare($sql);
		$pst->bindParam(':receiver_id', $receiver_id);
		$pst->execute();

		$post = $pst->fetchAll(PDO::FETCH_OBJ);
		return $post;

	}

	public function getAllPosts($dbcon)
	{
		$sql = "SELECT Posts.id, Posts.content, Posts.music_link, Posts.music_name, 
				Posts.img_link, Posts.receiver_id, Posts.author_id, Posts.date, Users.first_name, 
				Users.last_name, Users.img, Users.id 
				FROM Posts
				INNER JOIN Users ON Posts.author_id = Users.id
				ORDER BY Posts.date DESC LIMIT 10";

		$pst = $dbcon->prepare($sql);
		$pst->execute();

		$post = $pst->fetchAll(PDO::FETCH_OBJ);
		return $post;

	}
}
?>