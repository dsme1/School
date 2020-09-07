<?php 
	// variables
	$username = "";
	$email    = "";
	$errors = array(); 

	//register user//
	if (isset($_POST['reg_user'])) 
    {
		//receive all input values from the form
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) {  array_push($errors, "Gebruikersnaam niet ingevuld"); }
		if (empty($email)) { array_push($errors, "E-mail niet ingevuld"); }
		if (empty($password_1)) { array_push($errors, "Wachtwoord niet ingevuld"); }
		if ($password_1 != $password_2) { array_push($errors, "Wachtwoord komt niet overeen");}

		//ensuring unique users
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);
        
        //if the user already exists
		if ($user) { 
			if ($user['username'] === $username) {
			  array_push($errors, "Gebruikersnaam bestaat al");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email bestaat al");
			}
		}
		//register the user if the form has no errors
		if (count($errors) == 0) 
        {
            //encrypts passwords before entering the database
			$password = md5($password_1);
			$query = "INSERT INTO users (username, email, password, created_at, updated_at) 
					  VALUES('$username', '$email', '$password', now(), now())";
			mysqli_query($conn, $query);

			//get id of created user
			$reg_user_id = mysqli_insert_id($conn); 

			//put logged in user into session array
			$_SESSION['user'] = getUserById($reg_user_id);

			//if the user is an admin redirect to the admin area
			if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				$_SESSION['message'] = "Fakka G, welkom bij Drekwerk";
				//redirection to the admin area
				header('location: ' . BASE_URL . 'admin/dashboard.php');
				exit(0);
			} else {
				$_SESSION['message'] = "Fakka G, welkom bij Drekwerk";
				//redirection to the public area
				header('location: index.php');				
				exit(0);
			}
		}
	}

	//logs in the user
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "Jonguh je moet wel wat invullen"); }
		if (empty($password)) { array_push($errors, "Kil vul iets in dan"); }
		if (empty($errors)) {
			$password = md5($password); // encrypt password
			$sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				//get id of created user
				$reg_user_id = mysqli_fetch_assoc($result)['id']; 

				//put logged-in user into session array
				$_SESSION['user'] = getUserById($reg_user_id); 

				//if the user is an admin, redirect to the admin area
				if (in_array($_SESSION['user']['role'], ["Admin", "Author"])) 
                {
					$_SESSION['message'] = "Fakka G, welkom bij Drekwerk";
					//redirect to admin area
					header('location: ' . BASE_URL . '/admin/dashboard.php');
					exit(0);
				} else {
					$_SESSION['message'] = "Fakka G, welkom bij Drekwerk";
					//redirect to public area
					header('location: index.php');				
					exit(0);
				}
			} else {
				array_push($errors, 'Je denkt');
			}
		}
	}

	//escape value from form
	function esc(String $value)
	{	
		//brings the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space from the string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}

	//get user info from user id//
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		//returns user as an array 
		//['id'=>1 'username' => 'Daan', 'email'=>'daan.smets1@gmail.com', 'password'=> 'jedenkt']
		return $user; 
	}
?>