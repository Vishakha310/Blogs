<?php
	try{
		$connection=new MongoClient();
		$database=$connection->selectDB('myblogsite');
		$collection=$database->selectCollection('articles');
	}
	catch(MongoConnectionException $e)
	{
		die("failed to connect database".$e->getMessage());
	}
	$cursor=$collection->find();
	?>
	<body>
	<div id="contentarea">
		<div id="innercontentarea">
			<h1>My Blog</h1>
			<?php while($cursor->hasnext()):
			$article=$cursor->getnext();?>
			<h2><?php echo $article['title'];?></h2>
			<p>
			<?php echo substr($article['content'],0,50).'...';?>
			</p>
			<a href="blog.php"?id=<?php echo $article['_id'];?>">read More</a>
			<?php endwhile;?>
			</div>
			</div>
			</body>