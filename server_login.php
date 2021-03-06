<?php
include "connect.php";

session_start();
// echo "Session ID: " . session_id() . "<br>";

$servername = $_POST["servername"];
$serverpassword = $_POST["serverpassword"];

$serverpassword = hash("sha256", $serverpassword);

$_SESSION["servername"] = $servername;
$_SESSION["serverpassword"] = $serverpassword;

$sql = "SELECT password FROM servers WHERE name = ?";
$statement = $mysqli->prepare($sql);
$statement->bind_param("s", $servername);

$statement->execute();
$result = $statement->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["password"] == "$serverpassword") {
            // Return all the data of the user on successfull log in.
            $sql = "SELECT id, name FROM servers WHERE name = ?";
            $statement = $mysqli->prepare($sql);
            $statement->bind_param("s", $servername);

            $statement->execute();
            $result = $statement->get_result();

            $row = $result->fetch_assoc();

            echo json_encode($row);
        } else {
            echo "Incorrect server/password!";
        }
    }
} else {
    echo "Incorrect server/password!";
}

$sql = "SELECT id FROM servers WHERE name = ?";
$statement = $mysqli->prepare($sql);
$statement->bind_param("s", $servername);

$statement->execute();
$result = $statement->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["id"] != "") {
            // Return all the data of the user on successfull log in.
            $_SESSION["sid"] = $row["id"];
        }
    }
}

$mysqli->close();
