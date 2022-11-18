<?php
/// MySQL connections
$connection = new mysqli("localhost", "sari_2", "353izXMandyLissa", "cv_sandbox") or die ("Connection failed");
if ($connection -> connect_errno) {
    echo "Failed to connect to MySQL: " . $connection -> connect_error;
    exit();
}
#sySAT
?>