<?php  include('config.php'); ?>

<?php  include('includes/public_functions.php'); ?>

<?php 
	if (isset($_GET['post-slug'])) 
    {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>

<?php include('includes/head_section.php'); ?>
<title> <?php echo $post['title'] ?> | Drekwerk</title>
</head>
<body>
<div class="container">
    
    <!-- Welcome and logout -->
<?php if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
		<span class="welcome_msg">Yo <?php echo $_SESSION['user']['username'] ?></span>
		
		<span class="logout"><a href="logout.php">Uitloggen</a></span>
        
        <?php if (in_array($_SESSION['user']['role'], ["Admin", "Author"])) { ?>
        <span class="logout"><a href="admin/dashboard.php">Admin Area</a></span>
        <?php } ?>
        
	</div>
    <?php } ?>
    <!-- //Welcome and logout -->
    
    <!-- Homebutton -->
    <?php require_once(ROOT_PATH . '/includes/homebutton.php') ?>
    <!-- //Homebutton -->

    <!-- Content -->
	<div class="content" >
        
		<!-- Wrapper -->
		<div class="post-wrapper">
            
			<!-- Post div -->
			<div class="full-post-div">
			<?php if ($post['published'] == false): ?>
				<h2 class="post-title">Sorry... Dit artikel is nog niet gepubliceerd</h2>
			<?php else: ?>
				<h2 class="post-title"><?php echo $post['title']; ?></h2>
				<div class="post-body-div">
					<?php echo html_entity_decode($post['body']); ?>
                    <div class="text-footer"></div>
				</div>
			<?php endif ?>
                
            </div>
			<!-- // Post div -->
            
			<!-- comments section work in progress -->
            
		</div>
		<!-- //Wrapper -->

		<!-- post sidebar WIP
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a> 
					<?php endforeach ?>
				</div>
			</div>
		</div>
		post sidebar -->
        
	</div>
</div>
<!-- // Content -->

<!-- Footer -->
<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- //Footer -->