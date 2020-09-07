<?php 
//admin variables
$admin_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";

//general variables
$errors = [];

//topic variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

/* admin actions */
//clicking the create admin button
if (isset($_POST['create_admin'])) 
{
	createAdmin($_POST);
}
//clicking the edit admin button
if (isset($_GET['edit-admin'])) 
{
	$isEditingUser = true;
	$admin_id = $_GET['edit-admin'];
	editAdmin($admin_id);
}
//clicking the update admin button
if (isset($_POST['update_admin'])) 
{
	updateAdmin($_POST);
}
//clicking the Delete admin button
if (isset($_GET['delete-admin'])) 
{
	$admin_id = $_GET['delete-admin'];
	deleteAdmin($admin_id);
}

/*topic actions*/
//clicking the create topic button
if (isset($_POST['create_topic'])) 
{
    createTopic($_POST); 
}

//clicking the Edit topic button
if (isset($_GET['edit-topic'])) 
{
	$isEditingTopic = true;
	$topic_id = $_GET['edit-topic'];
	editTopic($topic_id);
}
//clicking the update topic button
if (isset($_POST['update_topic']))
{
	updateTopic($_POST);
}
//clicking the Delete topic button
if (isset($_GET['delete-topic'])) 
{
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
}

/*admin functions*/
//receives new data from admin form, creates new admin, returns admin users with roles
function createAdmin($request_values)
{
	global $conn, $errors, $role, $username, $email;
	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);

	if(isset($request_values['role'])){
		$role = esc($request_values['role']);
	}
	//form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Gebruikersnaam niet ingevuld"); }
	if (empty($email)) { array_push($errors, "E-mail niet ingevuld"); }
	if (empty($role)) { array_push($errors, "Rol is vereist voor admin gebruikers");}
	if (empty($password)) { array_push($errors, "Wachtwoord niet ingevuld"); }
	if ($password != $passwordConfirmation) { array_push($errors, "Wachtwoord komt niet overeen"); }
    
	//ensures that users are unique
	$user_check_query = "SELECT * FROM users WHERE username='$username' 
							OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);
    
    //if user already exists
	if ($user) 
    {
		if ($user['username'] === $username) {
		  array_push($errors, "Username already exists");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "Email already exists");
		}
	}
    
	//registers user if no errors in the form are found
	if (count($errors) == 0) 
    {
        //encrypts passwords before entering the database
		$password = md5($password);
		$query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$role', '$password', now(), now())";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user created successfully";
		header('location: users.php');
		exit(0);
	}
}

//topic funtions//

//gets all topics from the DB
function getAllTopics() 
{
	global $conn;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}

function createTopic($request_values)
{
	global $conn, $errors, $topic_name;
	$topic_name = esc($request_values['topic_name']);
	//creates slug, if topic is "Something Whatever", return "something-whatever" as slug
	$topic_slug = makeSlug($topic_name);
	//validates the form
	if (empty($topic_name)) 
    { 
		array_push($errors, "Topic name required"); 
	}
	//ensures that all topics are unique 
	$topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
	$result = mysqli_query($conn, $topic_check_query);
    
	//if the topic already exists
    if (mysqli_num_rows($result) > 0) 
    { 
		array_push($errors, "Topic bestaat al");
	}
	//registers topic if no errors are found in the form
	if (count($errors) == 0) 
    {
		$query = "INSERT INTO topics (name, slug) 
				  VALUES('$topic_name', '$topic_slug')";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Topic created successfully";
		header('location: topics.php');
		exit(0);
	}
}

//topic functions//

//takes topic id as a parameter, sets topic fields on the form for editing, fetches topics from the DB
function editTopic($topic_id) 
{
	global $conn, $topic_name, $isEditingTopic, $topic_id;
	$sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);
    
	//sets the form values as $topic_name on the form to be updated
	$topic_name = $topic['name'];
}

function updateTopic($request_values) 
{
	global $conn, $errors, $topic_name, $topic_id;
	$topic_name = esc($request_values['topic_name']);
	$topic_id = esc($request_values['topic_id']);
    
	//creates slug, if topic is "Something Whatever", return "something-whatever" as slug
	$topic_slug = makeSlug($topic_name);
    
	//validates the form
	if (empty($topic_name)) 
    { 
		array_push($errors, "Topic name required"); 
	}
	//registers the topic if no errors are found in the form
	if (count($errors) == 0) 
    {
		$query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Topic updated successfully";
		header('location: topics.php');
		exit(0);
	}
}

//deletes topics
function deleteTopic($topic_id) 
{
	global $conn;
	$sql = "DELETE FROM topics WHERE id=$topic_id";
	if (mysqli_query($conn, $sql)) 
    {
		$_SESSION['message'] = "Topic successfully deleted";
		header("location: topics.php");
		exit(0);
	}
}

//admin id functions//

//takes admin id as a paramenter, sets admin fields on the form for editing, fetches admins from the DB
function editAdmin($admin_id)
{
	global $conn, $username, $role, $isEditingUser, $admin_id, $email;

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$admin = mysqli_fetch_assoc($result);

	//sets the form values $username and $email on the form to be updated
	$username = $admin['username'];
	$email = $admin['email'];
}

//gets admin request from the form and updates it in the DB
function updateAdmin($request_values)
{
	global $conn, $errors, $role, $username, $isEditingUser, $admin_id, $email;
    
	//gets id of the admin to be updated
	$admin_id = $request_values['admin_id'];
    
	//sets the edit state to false
	$isEditingUser = false;


	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);
	if(isset($request_values['role']))
    {
		$role = $request_values['role'];
	}
    
	//registers the user if no errors are found in the form
	if (count($errors) == 0) 
    {
		//encrypts the password before entering the DB
		$password = md5($password);

		$query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$admin_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user updated successfully";
		header('location: users.php');
		exit(0);
	}
}
//deletes admin users 
function deleteAdmin($admin_id) 
{
	global $conn;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($conn, $sql)) 
    {
		$_SESSION['message'] = "User successfully deleted";
		header("location: users.php");
		exit(0);
	}
}

//returns all admin users and roles
function getAdminUsers()
{
	global $conn, $roles;
	$sql = "SELECT * FROM users WHERE role IS NOT NULL";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}

//escapes submitted values in the form preventing SQL injection
function esc(String $value)
{
	//brings global DB connect object into function
	global $conn;
	//removes the empty space surrounding strings
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}
//if it receives a string like 'Sample String' returns 'sample-string'
function makeSlug(String $string)
{
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}
?>