<?php
// Load functions before header has been sent
#include ("modules/variables.php");
require_once 'mysql/connection.php';
// Start HTML
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
<title>root-art_cms: administration</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/ra_cms.css\">
</head>
<body>";
// Started body
// Main container
# CKEditor
echo "
<div id='earth'>

    <!-- img src='../ra_data/images/ra_cms.png' alt='root-art_cms' width='120' height='100'><br -->
    <img src='../ra_data/images/tasys_logo.png' alt='root-art_cms' width='181' height='100'><br>
    
    <img src='/ra_data/images/Flag_of_the_United_Kingdom.svg' alt='Language: English' class='flags' /> <a href='./'>Administration</a> | <a href='navigation.php'>Navigation</a> | <a href='pages.php'>Pages</a> | <a href='files.php'>Files</a> | <a href='css.php'>CSS</a> | <a href='info.php'>Info</a>
    <hr>
    <img src='/ra_data/images/Flag_of_Germany.svg' alt='Language: Deutsch' class='flags' /> <a href='./'>Administration</A> | <a href='navigation_de.php'>Navigation</a> | <a href='pages_de.php'>Pages</a> | <a href='files.php'>Files</a> | <a href='css.php'>CSS</a> | <a href='info.php'>Info</a>
    <hr>
    <img src='../ra_data/images/ra_cms.png' alt='root-art_cms' width='120' height='100'><br>
    root-art_cms: das einfache Content Management System!<br>
    Von: Sascha Rie&szlig;<br>
    Kontakt: <A href='mailto:sascha@root-art.com'>sascha@root-art.com</A><br>
    Web: <A href='//sandbox.root-art.com/'>sandbox.root-art.com</A>
    <hr>
    root-art_cms SANDBOX V 2.01 &copy; " . date('Y') . " | 11/01/2022
</div>
</body>
</html>
";
?>