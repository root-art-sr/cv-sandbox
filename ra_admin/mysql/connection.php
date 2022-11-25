<?php
/*
 * MySQL connections:           replace your user and password accordingly
 * The MySQL structure is at:   cv-sandbox/ra_admin/mysql/cv_sandbox.sql
 * 
 */

$connection = new mysqli("localhost", "root", "#izx353", "cv_sandbox") or die ("Connection failed");
if ($connection -> connect_errno) {
    echo "Failed to connect to MySQL: " . $connection -> connect_error;
    exit();
}