<?php
include "connect.php";

session_start();
// echo "Session ID: " . session_id() . "<br>";

$username = $_POST["username"];
$password = $_POST["password"];

$password = hash("sha256", $password);

$_SESSION["username"] = $username;
$_SESSION["password"] = $password;

$sql = "SELECT password FROM users WHERE user_name = ?";
$statement = $mysqli->prepare($sql);
$statement->bind_param("s", $username);

$statement->execute();
$result = $statement->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["password"] == "$password") {
            // Return all the data of the user on successfull log in.
            $sql = "SELECT id, first_name, last_name, email, registrationdate FROM users WHERE user_name = ?";
            $statement = $mysqli->prepare($sql);
            $statement->bind_param("s", $username);

            $statement->execute();
            $result = $statement->get_result();

            $row = $result->fetch_assoc();

            echo json_encode($row);
        } else {
            echo "Incorrect username/password!";
        }
    }
} else {
    echo "Incorrect username/password!";
}

$sql = "SELECT id FROM users WHERE user_name = ?";
$statement = $mysqli->prepare($sql);
$statement->bind_param("s", $username);

$statement->execute();
$result = $statement->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["id"] != "") {
            // Return all the data of the user on successfull log in.
            $_SESSION["pid"] = $row["id"];
        }
    }
}
$mysqli->close();
