<?php  include('../config.php'); ?>

<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>

<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
				<h1>Drekwerk - Admin Area</h1>
			</a>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<div class="user-info">
				<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
				<a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">Uitloggen</a>
			</div>
		<?php endif ?>
	</div>
	<div class="container dashboard">
		<h1>Welkom bij Drekwerk</h1>
		<div class="stats">
			<a href="users.php" class="first">
				<span>Gebruikers</span>
			</a>
			<a href="posts.php">
				<span>Artikels</span>
			</a>
			<a>
				<span>Comments</span>
			</a>
		</div>
		<br><br><br>
		<div class="buttons">
			<a href="users.php">Voeg Gebruikers Toe</a>
			<a href="posts.php">Voeg Artikels Toe</a>
		</div>
	</div>
</body>
</html>