<!-- Banner for backend -->
<?php if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
		<span class="welcome_msg">Yo <?php echo $_SESSION['user']['username'] ?></span>
		
		<span class="logout"><a href="logout.php">Uitloggen</a></span>
        
        <?php if (in_array($_SESSION['user']['role'], ["Admin", "Author"])) { ?>
        <span class="logout"><a href="admin/dashboard.php">Admin Area</a></span>
        <?php } ?>
        
	</div>
<?php }else{ ?>

    <!-- Login form -->
	<div class="form-div">
        
		<form method="POST" action="index.php" class="form">
			<h2>Ben jij wel een echte G?</h2>
            
            <!-- Errors -->
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
            <!-- Errors -->
            
			<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Alias">
			<input type="password" name="password" placeholder="Codewoord">  
            <div class="txt-div">Voor de aspirerende G: DM ff OG_xXlaurentzzXx@drekwerk.nl</div>
			<div class="btn-div"><button type="submit" class="btn" name="login_btn">Ja man</button></div>
            
		</form>
        
	</div>
    <!-- //Login form -->

<?php } ?>
<!-- //Banner for backend -->