<?php
include 'connect.php';

session_start();

$sid = $_SESSION["sid"];
$pid = $_SESSION["pid"];
$score = $_POST["score"];

$query = "INSERT INTO scores (id, sid, pid, score, date) VALUES (NULL, $sid, $pid, $score, CURRENT_TIMESTAMP())";

if ($mysqli->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    showerror($mysqli->errno, $mysqli->error);
}

$mysqli->close();
