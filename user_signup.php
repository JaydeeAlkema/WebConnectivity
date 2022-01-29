<?php
include "connect.php";

session_start();
echo "Session ID: " . session_id() . "<br>";

$username = $_POST["username"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];
$email = $_POST["email"];

$password = hash("sha256", $password);

$_SESSION["username"] = $username;
$_SESSION["password"] = $password;
$_SESSION["firstname"] = $firstname;
$_SESSION["lastname"] = $lastname;
$_SESSION["email"] = $email;

$sql = "SELECT user_name FROM users WHERE user_name = ?";
$statement = $mysqli->prepare($sql);
$statement->bind_param("s", $username);

$statement->execute();
$result = $statement->get_result();

if ($result->num_rows > 0) {
    // Tell the user that the name is already taken.
    echo "Username is already taken!";
} else {
    echo "Creating new User...";
    // Insert new user into the database.

    $sql = "INSERT INTO users (id, user_name, first_name, last_name, email, password, registrationdate) VALUES (NULL, '$username', '$firstname', '$lastname', '$email', '$password', CURRENT_TIMESTAMP())";
    if ($mysqli->query($sql) === true) {
        echo "New user create successfully!";
    } else {
        showerror($mysqli->errno, $mysqli->error);
    }
}

$mysqli->close();
