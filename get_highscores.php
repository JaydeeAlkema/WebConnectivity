<?php
include "connect.php";

session_start();
// echo "Session ID: " . session_id() . "<br>";

$limit = $_POST["limit"];

$sql = "SELECT pid, score from scores ORDER BY score DESC LIMIT $limit";

if (!($result = $mysqli->query($sql))) {
    showerror($mysqli->errno, $mysqli->error);
}

while ($row = $result->fetch_assoc()) {
    echo $row["pid"] . "," . $row["score"] . ",";
}

$mysqli->close();
