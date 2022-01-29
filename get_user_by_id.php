<?php
include "connect.php";

session_start();
// echo "Session ID: " . session_id() . "<br>";

$ID = $_POST["id"];

$sql = "SELECT user_name FROM users WHERE id = $ID";

if (!($result = $mysqli->query($sql))) {
    showerror($mysqli->errno, $mysqli->error);
}

while ($row = $result->fetch_assoc()) {
    echo $row["user_name"];
}

$mysqli->close();
