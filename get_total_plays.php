<?php
include "connect.php";

session_start();
// echo "Session ID: " . session_id() . "<br>";
$currentDate = date("Y-m-d H:i:s");
$oneMonthBack = date("Y-m-d H:i:s", strtotime('-1 month'));
$counter = 0;

$sql = "SELECT date from logs WHERE logtype = 1"; // logtype = 1 is logintype

if (!($result = $mysqli->query($sql))) {
    showerror($mysqli->errno, $mysqli->error);
}

while ($row = $result->fetch_assoc()) {
    if ($row["date"] >= $oneMonthBack) {
        $counter++;
    }
}

echo $counter;

$mysqli->close();
