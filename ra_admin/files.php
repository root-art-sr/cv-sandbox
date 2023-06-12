<?php
// Load functions before header has been sent
#include ("modules/variables.php");
require_once 'mysql/connection.php';
// Start HTML
echo "<!DOCTYPE html>
<html>
    <head>
        <title>root-art_cms: files</title>
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
            Filemanager<br>
        ";
        # End CKEditor
        # CKFinder
        require_once 'ckfinder/ckfinder.php';
        $finder = new CKFinder() ;
        $finder->BasePath = '/ra_admin/ckfinder/' ;
        $finder->SelectFunction = 'ShowFileInfo' ;
        $finder->Width = 800 ;
        $finder->Create() ;
        # End CKFinder
        echo "
        <hr>
        root-art_cms &copy; " . date('Y') . "
        </div>
    </body>
</html>
";
?>