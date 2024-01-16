<?php

define("DB_HOST", "sql201.infinityfree.com");
define("DB_USER", "if0_35777178");
define("DB_PASS", "xgb0vB2eMmE");
define("DB_NAME", "if0_35777178_twitter_schema");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("DB connection failed" . $conn->connect_error);
}
