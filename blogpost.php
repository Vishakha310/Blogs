<?php
	$action=(!empty($_POST['btn_submit'])&&($_POST['btn_submit']==='Sava'))?'save_article':'show_form';
	switch($action){
		case 'show_article':
		try{
		$connection=new MongoClient();
		$database=$connection->myblogsite;
		$collection=$database->selectCollection('articles');
		$article=array(
			'title'=>$_POST['title'],
			'content'=>$_POST['content'],
			'saved_at'=>new MongoDate());
			$collection->insert($article);
		}
		catch(MongoConnectionException $e)
		{
			die("failed to connect to database".$e->getMessage());
		}
		catch(MongoException $e)
		{
			die("failed to insert data".$e->getMessage());
		}
		break;
		case 'show_form';
		default:
	}
	?>
	<body>
	<div id="contentarea">
		<div id="innercontentarea">
			<h1>Blog Post Creator</h1>
			<?php if($action==='show_form'):?>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<h3>Title</h3>
				<p><input type="text" name="title" id="title"/></p>
				<h3>Content</h3>
				<textarea name="Content" rows="20"></textarea>
				<p><input type="submit" name="btn_submit" value="save"/></p>
				</form>
				<?php else:?>
				<p> Article saved._id:<?php echo $article['_id'];?>.
				<a href="blogpost.php">
				Write another one?</a>
				</p>
				<?php endif;?>
				</div>
				</div>
				</body>
				</html>
		