<?php include('config.php'); ?>

<?php include('includes/public_functions.php'); ?>

<?php include('includes/head_section.php'); ?>

<?php 
	// Get posts under a particular topic
	if (isset($_GET['topic'])) 
    {
		$topic_id = $_GET['topic'];
		$posts = getPublishedPostsByTopic($topic_id);
	}
?>

<title>Drekwerk | Operaties</title>
</head>
<body>
    
<!-- Container for page -->
<div class="container">
    
    <?php if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
		<span class="welcome_msg">Yo <?php echo $_SESSION['user']['username'] ?></span>
		
		<span class="logout"><a href="logout.php">Uitloggen</a></span>
	</div>
    <?php } ?>
    
<!-- Homebutton -->
<?php require_once(ROOT_PATH . '/includes/homebutton.php') ?>
<!-- //Homebutton -->
    
<!-- content -->
<div class="content">
    
	<h2 class="content_title">
		<?php echo getTopicNameById($topic_id); ?>
	</h2>
    
	<?php foreach ($posts as $post): ?>
		<div class="post" style="margin-left: 0px;">
			<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
			<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
				<div class="post_info">
					<h3><?php echo $post['title'] ?></h3>
					<div class="info">
                        <span class="span_date"><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                        <span class="read_more">Lees verder...</span>
                    </div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
    
</div>
<!-- // content -->
    
</div>
<!-- // container -->

<!-- Footer -->
<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->