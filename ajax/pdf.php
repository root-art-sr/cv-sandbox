<?php

$errors = [];
$data = [];

if (empty($_POST['pdfname'])) {
    $errors['pdfurl'] = 'Name is required.';
}

if (empty($_POST['pdfurl'])) {
    $errors['pdfurl'] = 'URL is required.';
}

if (empty($_POST['pdfcontent'])) {
    $errors['pdfcontent'] = 'Content is required.';
}

if (empty($_POST['htmltopdf'])) {
    $errors['htmltopdf'] = 'PDF is required.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $pdfname = $_POST['pdfname'];
    $pdfurl = $_POST['pdfurl'];
    $htmltopdf = $_POST['htmltopdf'];
    $pdfcontent = $_POST['pdfcontent'];
    include '../includes/createpdf.php';
}