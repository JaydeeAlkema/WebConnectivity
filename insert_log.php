<?php
include 'connect.php';

session_start();

$pid = $_SESSION["pid"];
$logtype = $_POST["logtype"];

$query = "INSERT INTO logs (id, pid, date, logtype) VALUES (NULL, $pid, CURRENT_TIMESTAMP(), '$logtype')";

if ($mysqli->query($query) === TRUE) {
    echo "New log created successfully";
} else {
    showerror($mysqli->errno, $mysqli->error);
}

$mysqli->close();
