<?php
include 'connect.php';

session_start();

$sid = $_SESSION["sid"];
$pid = $_POST["pid"];
$score = $_POST["score"];

$query = "INSERT INTO scores (id, sid, pid, score, date) VALUES (NULL, $sid, $pid, $score, CURRENT_TIMESTAMP())";

if ($mysqli->query($query) === TRUE) {
    echo "1";
} else {
    echo "0";
}

$mysqli->close();
