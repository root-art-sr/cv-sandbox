<?php
// Dev
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Load functions before header has been sent
#include ("modules/variables.php");
require_once 'mysql/connection.php';
// Insert new navigation element
if (isset($_POST[ 'navi1' ])) {
$structure = $_POST[ 'navi1' ];
// Write clean HTML visible link
$createstructure = $structure;
$structuretoreplace = array("/ä/","/ö/","/ü/","/Ä/","/Ö/","/Ü/","/ß/");
$structurereplace = array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;");
$createstructure = preg_replace($structuretoreplace,$structurereplace,$createstructure);
// Write clean URL
$createtarget = $structure;
$targettoreplace = array("/ä/","/ö/","/ü/","/Ä/","/Ö/","/Ü/","/ß/","/&nbsp;&amp;&nbsp;/","/'/","/ /","/&nbsp;/");
$targetreplace = array("ae","oe","ue","Ae","Oe","Ue","ss","-","","-","-");
$createtarget = preg_replace($targettoreplace,$targetreplace,$createtarget);
$createtarget = strtolower($createtarget);
mysqli_query($connection, "INSERT INTO structure "
        . "SET "
        . "page_deutsch = '$createstructure', "
        . "target_deutsch = 'index.php?page=$createtarget', "
        . "canonical_deutsch = '$createtarget$createtarget', "
        . "page_english = '$createstructure', "
        . "target_english = 'index.php?page=$createtarget', "
        . "canonical_deutsch = '$createtarget'");
// Write structure_id into content
$res = mysqli_query($connection, "SELECT MAX(ID) AS LAST_ID FROM structure");
$lastid = mysqli_fetch_array($res);
$page_id = $lastid['LAST_ID'];
mysqli_query($connection, "INSERT INTO content "
        . "SET "
        . "structure_id = '$page_id', page_deutsch = '$createtarget', "
        . "deutsch = '<div>$createstructure</div>', "
        . "page_english = '$createtarget', "
        . "english = '<div>$createstructure</div>'");
}
elseif (isset($_POST[ 'navi2' ])) {
$structure = $_POST[ 'navi2' ];
$id = $_POST[ 'id' ];
// Write clean HTML visible link
$createstructure = $structure;
$structuretoreplace = array("/ä/","/ö/","/ü/","/Ä/","/Ö/","/Ü/","/ß/");
$structurereplace = array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;");
$createstructure = preg_replace($structuretoreplace,$structurereplace,$createstructure);
// Write clean URL
$createtarget = $structure;
$targettoreplace = array("/ä/","/ö/","/ü/","/Ä/","/Ö/","/Ü/","/ß/","/&nbsp;&amp;&nbsp;/","/'/","/ /","/&nbsp;/");
$targetreplace = array("ae","oe","ue","Ae","Oe","Ue","ss","-","","-","-");
$createtarget = preg_replace($targettoreplace,$targetreplace,$createtarget);
$createtarget = strtolower($createtarget);
mysqli_query($connection, "UPDATE structure "
        . "SET "
        . "page_deutsch = '$createstructure', "
        . "target_deutsch = 'index.php?page=$createtarget&language=deutsch&token=0efa745f21eb127178899a6343a29242', "
        . "canonical_deutsch = '$createtarget' "
        . "WHERE ID = '$id'");
mysqli_query($connection, "UPDATE content "
        . "SET "
        . "page_deutsch = '$createtarget' "
        . "WHERE structure_id = '$id'");
}
elseif (isset($_POST[ 'navi3' ])) {
    $structure = $_POST[ 'navi3' ];
    $id = $_POST[ 'id' ];
    // Delete
    mysqli_query($connection, "DELETE FROM structure WHERE ID = '$id'");
    mysqli_query($connection, "OPTIMIZE TABLE structure");
    mysqli_query($connection, "DELETE FROM content WHERE structure_id = '$id'");
    mysqli_query($connection, "OPTIMIZE TABLE content");
}
else {
# Do nothing
}
$query = "SELECT ID, page_deutsch, target_deutsch, canonical_deutsch, page_english, target_english, canonical_english FROM structure";
$result = mysqli_query($connection, $query);
foreach ($result as $r) {
    $navi_id[] = $r['ID'];
    $page_deutsch[] = $r['page_deutsch'];
    $page_english[] = $r['page_english'];
    $target_deutsch[] = $r['target_deutsch'];
    $target_english[] = $r['target_english'];
    $canonical_deutsch[] = $r['canonical_deutsch'];
    $canonical_english[] = $r['canonical_english'];
}
$rows = mysqli_num_rows($result);
// Start HTML
echo "<!DOCTYPE html>
<html>
    <head>
        <title>root-art_cms: navigation</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"css/ra_cms.css\">
        <script type='text/javascript' src='ckeditor/ckeditor.js'></script>
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
            <img src='/ra_data/images/Flag_of_Germany.svg' alt='Language: Deutsch' class='flags' /><br />
            ID | Name | Canonical | Dynamic";
            // Show all that exist
            for ($i = 0; $i < $rows; $i++) {
            echo "
            <form action='navigation_de.php' method='POST'><input type='hidden' name='id' value='$navi_id[$i]'>$navi_id[$i] <input type='text' name='navi2' value='$page_deutsch[$i]'> $page_deutsch[$i] | $canonical_deutsch[$i] | $target_deutsch[$i] <input type='submit' value='&Auml;ndern'></form>
            <form action='navigation_de.php' method='POST'><input type='hidden' value='$navi_id[$i]' name='id'><input type='hidden' name='navi3'><INPUT type='submit' value='L&ouml;schen'></form>
            <br>";
            }
            echo "<br>Navigationen: $rows<br>";

            echo "
            <p>Neue Navigation &amp; Page:</p>
            <form action='navigation_de.php' method='POST'>
                <input type='text' id='navi1' name='navi1'>
                <input type='submit' value='Save'>
            </form>
            <span style='color:#ff8c00; font-weight: bold;'>Multilinguale Navigationen zu &uuml;bersetzen!</span>
            <hr>
            root-art_cms &copy " . date('Y') . "
        </div>
    </body>
</html>
";