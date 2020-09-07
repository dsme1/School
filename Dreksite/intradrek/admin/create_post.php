<?php  include('../config.php'); ?>

<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>

<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>

<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all topics -->
<?php $topics = getAllTopics();	?>
	<title>Admin | Create Post</title>
</head>
<body>
    
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>

	<div class="container content">
		<!-- left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- form - to create and edit  -->
		<div class="action create-post-div">
			<h1 class="page-title">Creëer/Edit Artikel</h1>
			<form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/create_post.php'; ?>" >
                
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>

				<!-- when editing a post, id is required to identify that post -->
				<?php if ($isEditingPost === true): ?>
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
				<?php endif ?>

				<input type="text" name="title" value="<?php echo $title; ?>" placeholder="Titel">
				<label style="float: left; margin: 5px auto 5px;">Image</label>
				<input type="file" name="featured_image" >
				<textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
				<select name="topic_id">
					<option value="" selected disabled>Kies Onderwerp</option>
					<?php foreach ($topics as $topic): ?>
						<option value="<?php echo $topic['id']; ?>">
							<?php echo $topic['name']; ?>
						</option>
					<?php endforeach ?>
				</select>
				
				<!-- Only admin users can view publish input field -->
				<?php if ($_SESSION['user']['role'] == "Admin"): ?>
                
					<!-- displays checkbox publish post or not -->
					<?php if ($published == true): ?>
						<label for="publish">
							Publiceren
							<input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
						</label>
					<?php else: ?>
						<label for="publish">
							Publiceren
							<input type="checkbox" value="1" name="publish">&nbsp;
						</label>
					<?php endif ?>
				<?php endif ?>
				
				<!-- when editing a post display update button instead of create button -->
				<?php if ($isEditingPost === true): ?> 
					<button type="submit" class="btn" name="update_post">Aanpassen</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_post">Bewaar artikel</button>
				<?php endif ?>

			</form>
		</div>
		<!-- end of form - to create and edit -->
	</div>
</body>
</html>

<script>
	CKEDITOR.replace('body');
</script>