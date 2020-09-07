<?php  include('config.php'); ?>

<?php  include('includes/registration_login.php'); ?>

<?php  include('includes/public_functions.php'); ?>

<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>

<?php  include('includes/head_section.php'); ?>

<title>Intradrek | Inloggen</title>

</head>
<body>
    

    
<div class="container">
    
    <!-- Homebutton -->
    <?php require_once(ROOT_PATH . '/includes/homebutton.php') ?>
    <!-- //Homebutton -->
    
    <!-- Login banner -->
    <?php include_once(ROOT_PATH . '/includes/banner.php') ?>
    <!-- //Login banner -->
    
     <?php if (isset($_SESSION['user']['username'])) { ?> 
		<!-- Page content -->
		<div class="content">
            
			<h2 class="content_title">OPERATIE UPDATES</h2>
            
                    <!-- foreach for displaying blogposts to the frontpage -->
                    <?php foreach ($posts as $post){ ?>
                        <div class="post">
                            <img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
                            
                            <!-- if statement for posting  WIP 
                            <?php if (isset($post['topic']['name'])): ?>
                                <a href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>" class="btn category">
                                    <?php echo $post['topic']['name'] ?>
                                </a>
                            <?php endif ?> -->
                            
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
                    <?php } ?>
            
    <?php } ?>
            
			<!-- more content still to come here ... -->
            
		</div>
    
</div>
<!-- // container -->

<!-- Footer -->
<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->