<?php
// Load functions before header has been sent
#include ("modules/variables.php");
require_once 'mysql/connection.php';
if (isset($_POST['editorcss'])) {
    function stripslashes_deep($value)
        {
        $value = is_array($value) ?
        array_map('stripslashes_deep', $value) :
        stripslashes($value);
        return $value;
        }
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);

$editcss = $_POST['editorcss'];
$editcss = utf8_encode($editcss);
$file = fopen('../less/main.less', 'w');
fwrite($file,$editcss);
fclose($file);
}
else {
# Do nothing
}
$query = "SELECT deutsch FROM content WHERE page_deutsch = 'Startseite'";
$result = mysqli_query($connection, $query);
$r = mysqli_fetch_assoc($result);
$content = $r['deutsch'];
// Start HTML
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
<title>root-art_cms: pages</title>
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
    Editor LESS<br>
    <form method='POST' action='css.php'>
        <p>
            <textarea id='editorcss' name='editorcss' cols='100' rows='30'>"; include '../less/main.less';  echo "</textarea>
        </p>
        <p>
            <input type='submit' value='Speichern' />
        </p>
    </form>
    <hr>
    root-art_cms &copy; " . date('Y') . "
</div>
</body>
</html>
";
?>