<!DOCTYPE html>
<html>
    
<head>
    
    <?php require_once('config.php') ?>
    
    <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
    
	<title>Drekwerk | Affiliaties</title>
    
</head>
    
<body>
    
    <!-- Homebutton -->
    <?php require_once(ROOT_PATH . '/includes/homebutton.php') ?>
    <!-- //Homebutton -->
    
	<!-- Container -->
	<div class="container">
        
        <!-- Logobutton -->
        <div class="metadamlogo"><a href="index.php"></a></div>
        <!-- //Logobutton -->
        
        <!-- Navbar -->
        <?php require_once(ROOT_PATH . '/includes/navbar.php') ?>
        <!-- //Navbar -->
        
        <!-- Text -->
        <div class="text-container">
            
            <div class="text">
            <h1>CONTACT EN INFORMATIE</h1>
            <br><br><br><br>
            
            <div class="row">
                <div class="column">
                    <img src="static/images/mail.png">
                    <h3>Contact?</h3>

                    <form class="contactform" action="includes/mail.php" method="post">
                    <label for="naam">Je naam *<br></label>
                    <input class="input" type="text" id="naam" name="naam" placeholder="">

                    <label for="email"><br>Je e-mailadres *<br></label>
                    <input class="input" type="text" id="email" name="email" placeholder="">

                    <label for="bericht"><br>Je bericht *<br></label>
                    <textarea id="text" name="text" placeholder=""></textarea><br>

                    <input class="submitbtn" type="submit" value="submit">

                    </form>
                </div>
                <div class="column">
                    <a href="https://www.google.com/maps/place/Osdorpplein+369,+1068+EV+Amsterdam/@52.3591248,4.8016032,17z/data=!3m1!4b1!4m5!3m4!1s0x47c5e3d1d296ac81:0x2e547a1d81eb1fd7!8m2!3d52.3591248!4d4.8037919"><img src="static/images/adres.png"></a>
                    <h3>Bezoekadres</h3>
                    <p>Osdorpplein 369<br>1068EV Amsterdam</p>
                    <p><u>Postadres</u><br>Postbus 020<br>1069JM</p>
                    <p><u>Nevenvestiging</u><br>Bataviaweg 404<br>1117TQ Schiphol</p>
                </div>
                <div class="column">
                    <img src="static/images/contact.png">
                    <h3>Email/Telefoon</h3>
                    <p><b>T: </b>020-53663337</p>
                    <p><b>F: </b>020-5333658</p>
                    <p><b>E: </b>B.Barneveld@drekwerk.nl</p>
                </div>
            </div>
                
            <div class="img-footer">Locatie Drektoren in Google maps.</div>
            <div class="maps"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1218.3113938448487!2d4.802697558315927!3d52.35912643299901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5e3d1d296ac81%3A0x2e547a1d81eb1fd7!2sOsdorpplein%20369%2C%201068%20EV%20Amsterdam!5e0!3m2!1snl!2snl!4v1579695900122!5m2!1snl!2snl" width="750" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
            

        
            </div>
        </div>
        <div class="text-footer"></div>
        <!-- //Text -->
        
    </div> 
    <!-- //Container -->
    
    <!-- Footer -->
    <?php include_once(ROOT_PATH . '/includes/footer.php') ?>
    <!-- //Footer -->
    
</body>
    
    
    
</html>