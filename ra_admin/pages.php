<?php
// Dev
error_reporting (E_ALL);
// Load functions before header has been sent
#include ("modules/variables.php");
require_once 'mysql/connection.php';
// Update page
if (isset($_POST[ 'editor1' ])) {
    $editcontent = $_POST['editor1'];
    $editpage_id = $_POST['editpage_id'];
    mysqli_query($connection, "UPDATE content SET english = '$editcontent' WHERE structure_id = '$editpage_id'");
}
else {
$editpage_id = '';
}
// Get created pages
$query = "SELECT ID, page_deutsch, target_deutsch, canonical_deutsch, page_english, target_english, canonical_english FROM structure";
$result = mysqli_query($connection, $query);
foreach ($result as $r) {
    $page_id[] = $r['ID'];
    $page_deutsch[] = $r['page_deutsch'];
    $page_english[] = $r['page_english'];
    $target_deutsch[] = $r['target_deutsch'];
    $target_english[] = $r['target_english'];
    $canonical_deutsch[] = $r['canonical_deutsch'];
    $canonical_english[] = $r['canonical_english'];
}
$rows = mysqli_num_rows($result);
// Select page to edit
if (isset($_GET['editpage'])) {
    $editpage_id = $_GET['editpage'];
    $query = "SELECT structure_id, page_english, english FROM content WHERE structure_id = '$editpage_id'";
    $result = mysqli_query($connection, $query);
    foreach ($result as $r)
        $content = $r['english'];
        $editpage_english = $r['page_english'];
        $editpage_id = $r['structure_id'];
} else {
    $content = '';
    $editpage_english = '';
}
// Start HTML
echo "
    <!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
    <html>
    <head>
    <title>root-art_cms: pages</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/ra_cms.css\">
    <script type='text/javascript' src='ckeditor/ckeditor.js'></script>
    </head>
    <body>
";
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
    <img src='/ra_data/images/Flag_of_the_United_Kingdom.svg' alt='Language: English' class='flags' />&nbsp;
";
// Show all that exist
for ($i = 0; $i < $rows; $i++) {
echo "&raquo;<A href='pages.php?editpage=$page_id[$i]'>$page_english[$i]</A>&laquo;&nbsp;&nbsp;";
}
echo "<hr>";

if (!empty($editpage_id)) {

echo "
    <form method='POST' action='pages.php?editpage=$editpage_id'>
        <p>
            Editor: $editpage_english<br />
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
?>
    <p>Select a page to edit.</p>
    <p>New pages to be created at <a href="/ra_admin/navigation.php">Navigation</a>.</p>
<?php
}
echo "
    <hr>
    root-art_cms &copy; " . date('Y') . "
</div>
</body>
</html>
";
?>