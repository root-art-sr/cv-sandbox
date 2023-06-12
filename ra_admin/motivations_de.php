<?php
// Dev
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Load functions before header has been sent
#include ("modules/variables.php");
require_once 'mysql/connection.php';
// Update page
if (isset($_POST[ 'editor1' ])) {
    $editcontent = $_POST['editor1'];
    $editpage_id = $_POST['editpage_id'];
    mysqli_query($connection, "UPDATE motivation_content SET content_deutsch = '$editcontent' WHERE ID = '$editpage_id'");
}
else {
$editpage_id = '';
}
// Get created pages
$query = "SELECT ID, token, content_deutsch, content_english FROM motivation_content ORDER BY lastchanged DESC";
$result = mysqli_query($connection, $query);
foreach ($result as $r) {
    $page_id[] = $r['ID'];
    $page_deutsch[] = $r['token'];
    $page_english[] = $r['token'];
}
$rows = mysqli_num_rows($result);
// Select page to edit
if (isset($_GET['editpage'])) {
    $editpage_id = $_GET['editpage'];
    $query = "SELECT ID, token, content_deutsch, deutsch FROM motivation_content WHERE ID = '$editpage_id'";
    $result = mysqli_query($connection, $query);
    foreach ($result as $r)
        $content = $r['content_deutsch'];
        $editpage_deutsch = $r['token'];
        $editpage_english = $r['token'];
        $editpage_id = $r['ID'];
} else {
    $content = '';
    $editpage_deutsch = '';
    $editpage_english = '';
}
// Start HTML
echo "<!DOCTYPE html>
<html>
    <head>
        <title>root-art_cms: motivations</title>
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

            <img src='/ra_data/images/Flag_of_the_United_Kingdom.svg' alt='Language: English' class='flags' /> <a href='./'>Administration</a> | <a href='navigation.php'>Navigation</a> | <a href='pages.php'>Pages</a> &#x25BA; <a href='motivations.php'>Motivations</a> | <a href='files.php'>Files</a> | <a href='css.php'>CSS</a> | <a href='info.php'>Info</a>
            <hr>
            <img src='/ra_data/images/Flag_of_Germany.svg' alt='Language: Deutsch' class='flags' /> <a href='./'>Administration</A> | <a href='navigation_de.php'>Navigation</a> | <a href='pages_de.php'>Pages</a> &#x25BA; <a href='motivations_de.php'>Motivations</a> | <a href='files.php'>Files</a> | <a href='css.php'>CSS</a> | <a href='info.php'>Info</a>
            <hr>
            <img src='/ra_data/images/Flag_of_Germany.svg' alt='Language: Deutsch' class='flags' /> Absteigend nach Datum letzter Edit<br />
        ";
        // Show all that exist
        for ($i = 0; $i < $rows; $i++) {
        echo "&raquo;<a href='motivations_de.php?editpage=$page_id[$i]'>$page_deutsch[$i]</a>&laquo;<br />";
        }
        echo "<hr>";

        if (!empty($editpage_id)) {

        echo "
            <form method='POST' action='motivations_de.php?editpage=$editpage_id'>
                <p>
                    Editor: $editpage_deutsch<br />
                    Individueller Link: https://sandbox.root-art.com/motivation/deutsch/$editpage_deutsch<br />
                    <textarea id='editor1' name='editor1'>$content</textarea>
                    <script type='text/javascript'>
                        CKEDITOR.replace( 'editor1',
                        {
                        language : 'de',
                        toolbar : 'Full',
                        uiColor : '#CCCCCC',
                        width : '800',
                        filebrowserBrowseUrl : '/ra_admin/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '/ra_admin/ckfinder/ckfinder.html?Type=Images',
                        filebrowserFlashBrowseUrl : '/ra_admin/ckfinder/ckfinder.html?Type=Flash',
                        filebrowserUploadUrl : '/ra_admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '/ra_admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '/ra_admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                        });
                    </script>
                </p>
                <p>
                <INPUT type='hidden' value='$editpage_id' name='editpage_id'>
                <input type='submit' value='Speichern' />
                </p>
            </form>
        ";
        } else {

            // Check if the form has been submitted
            if (isset($_POST['md5me'])) {
                // MD5 encode the submitted content
                $md5ed = md5($_POST['md5me']);
                // Insert into database
                if (!empty($md5ed)) {
                    mysqli_query($connection, "INSERT INTO motivation_content SET token = '" . $md5ed . "', content_deutsch = 'Kopiere deinen Content', content_english = 'Paste your content', deutsch = 'motivation', english = 'motivation';");
                }
            }

            ?>
            <p>Erstelle MD5 Hash f&uuml;r neues Motivationsanschreiben:</p>
            <p><?= !empty($md5ed) ? $md5ed : '' ?></p>
            <form action="#" method="post">
                <label for="md5me">MD5 Ausgangstext:</label>
                <input name="md5me" id="md5me" type="text" />
                <input type="submit" value="Erstelle MD5 Hash" />
            </form>
    
        <?php
        }
        echo "
        <hr>
        root-art_cms &copy; " . date('Y') . "
        </div>
    </body>
</html>
";