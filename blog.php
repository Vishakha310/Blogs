<?php 
require('log.php');
$start=microtime();
$id=$_GET['id'];
try
{
	$connection=new Mongo();
	$database=$connection->selectDB('myblogsite');
	$collection=$database->selectCollection('articles');
}
catch(MongoConnectionException $e)
{
	die("failed to connect to database".$e->getMessage());
}
$article=$collection->findOne(array('_id'=>new MongoId($id)));
$end=microtime();
$data=array('responce_time_ms'=>($end=-$start)*1000);
$logger=new Logger();
$logger->logRequest($data);
?>
<body>
	<div id="contentarea">
		<div id="innercontentarea">
		<h1>My Blogs</h1>
		<h2><?php echo $article['title'];?></h2>
		<h2><?php echo $article['content'];?></h2>
	</div>
	</div>
	</body>
	</html>