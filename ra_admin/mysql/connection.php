<?php
/// MySQL connections - replace your user and password accordingly
$connection = new mysqli("localhost", "user", "password", "cv_sandbox") or die ("Connection failed");
if ($connection -> connect_errno) {
    echo "Failed to connect to MySQL: " . $connection -> connect_error;
    exit();
}