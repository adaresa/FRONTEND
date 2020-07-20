<?php
session_start();

ini_set('display_errors', 'on');
//connect to db
$db = new PDO('mysql:host=127.0.0.1:8889;dbname=biteit', 'root', 'root');
//REGISTER
$errors = array();  
if (isset($_POST['reg_user'])) {
    //receive input values
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];


    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Kasutajanimi on kohustuslik"); }
    if (empty($email)) { array_push($errors, "Email on kohustuslik"); }
    if (empty($password)) { array_push($errors, "Parool on kohustuslik"); }
    if ($password != $re_password) {
      array_push($errors, "Paroolid ei ühti");
    }

    if(count($errors) == 0){
   $user = $db->prepare("
       INSERT INTO users (email, username, password)
       VALUES (:email, :username, :password)
   ");

   $user->execute([
       'email' => $email,
       'username' => $username,
       'password' => $password,
   ]);
    } else {
		$error_message = "Viga registreerimisega. Proovi uuesti!";	
	}
}

//LOGIN
    if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (empty($username)) {
  	array_push($errors, "Kasutajanimi on kohustuslik");
  }
  if (empty($password)) {
  	array_push($errors, "Parool on kohustuslik");
  }
  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysql_query($query);
    if (mysql_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Õnnestus";
      header('location: index.php');
    }else {
        array_push($errors, "Vale kasutajanimi või parool");
    }
}       
}

?>