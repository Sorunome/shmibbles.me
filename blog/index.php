<?php
if(array_key_exists('p', $_GET)) {
	if(!is_numeric($_GET['p'])) {
		header('Location: http://shmibbles.me/blog');
	}
	$page = $_GET['p'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>shmibbles.me</title>
		<link rel="icon" type="image/png" href="http://shmibbles.me/harma.png">

		<link href="../fira/fira.css" rel="stylesheet" type="text/css">
		<link href="../tengtelc/tengtelc.css" rel="stylesheet" type="text/css">
		<link href="../main.css" rel="stylesheet" type="text/css">

		<!-- randomise background colour -->
		<style type="text/css">
			body {
				background-color: hsl( <?php echo rand(0,359);?> , 44%, 43%);
			}
		</style>
	</head>

	<body>
		
		<header>
			<div class="title">
				<div class="container">
					<h1>Absent musings etc.</h1>
					
					<p>
						<font face="Tengwar Telcontar">
						|
						</font>
					</p>
				</div>
			</div>
		</header>

		<div class="block">
			<div class="container">
				
<?php
/* index all entries.obviously, this will all explode if i put an
 * unexpected file in the directory */
$handle = opendir("html");
$entries = array();

while( false !== ($val = readdir($handle)) ) {
	if( preg_match("/[0-9]+/", $val, $matches) ) {
		$entries[$matches[0]] = $val;
	}
}

closedir($handle);

ksort($entries, $sort_flags=SORT_NUMERIC);

if( array_key_exists($page, $entries) ) {
	/* try to display a specific entry */
	preg_match("/-.*/", $entries[$page], $matches);
	$title=$matches[0];
	$title=substr($title, 1);
?>
	<h2><?php echo $title ?></h2>
				<div id="blog-body">
<?php
	include('html/' . $entries[$page]);
?>
				</div>
<?php
} else {
	/* display the index */
?>
				<h2>Blog index</h2>

				<div id="blog-body">
<?php
	foreach($entries as $key => $value) {
		echo '<p><a href="http://shmibbles.me/blog/?p=' . $key . '">';
		echo $value;
		echo '</a></p>';
	}
?>
				</div>
<?php
}
?>
				<div id="nav">

<?php
	/* first */
	echo '<a id="first" href=';
	echo 'http://shmibbles.me/blog/?p=' . key(array_slice($entries, -1, 1, TRUE));
	echo '>&lt;&lt; first</a>';
?>

<?php
	/* prev */
	if( $page and array_key_exists($page - 1, $entries) ) {
		echo '<a id="prev" href=';
		echo '"http://shmibbles.me/blog/?p=' . ($page - 1) . '">';
		echo '&lt; prev</a>';
	} else {
		echo '<div id="prev">&lt; prev</div>';
	}
?>

<?php
	/* index */
	if( $page and array_key_exists($page, $entries) ) {
		echo '<a id="index" href="http://shmibbles.me/blog">';
		echo 'index';
		echo '</a>';
	} else {
		echo '<div id="index">index</div>';
	}
?>

<?php
	/* next */
	if( $page and array_key_exists($page + 1, $entries) ) {
		echo '<a id="prev" href=';
		echo '"http://shmibbles.me/blog/?p=' . ($page + 1) . '">';
		echo 'next &gt;</a>';
	} else {
		echo '<div id="next">next &gt;</div>';
	}
?>

<?php
	/* last */
	echo '<a id="last" href=';
	echo 'http://shmibbles.me/blog/?p=' . key(array_slice($entries, -1, 1, TRUE));
	echo '>last &gt;&gt;</a>';
?>
				</div>
			</div>
		</div>
	</body>
</html>
