<?php
include "connect.php";

session_start();
// echo "Session ID: " . session_id() . "<br>";

$ID = $_POST["id"];

$sql = "SELECT id, user_name, last_name email FROM users id = ";

if (!($result = $mysqli->query($sql)))
    showerror($mysqli->errno, $mysqli->error);

$row = $result->fetch_assoc();

echo json_encode($row);

$mysqli->close();
