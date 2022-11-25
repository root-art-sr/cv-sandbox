<?php
/*
 * Declare variables for default cases
 * Don't remove
 * 
 */
$content = '';
$content_deutsch = '';
$content_english = '';
$page_deutsch = '';
$page_english = '';
$lastchanged = '';
$token = '';

/*
 * Get all pages structure into an array
 * In the database those are at table: structure
 * 
 */
$querylinks = "SELECT ID, page_deutsch, target_deutsch, canonical_deutsch, page_english, target_english, canonical_english FROM structure ORDER BY ID";
$results = mysqli_query($connection, $querylinks);
foreach ($results as $rl) {
    $page_id[] = $rl['ID'];
    $link_deutsch[] = $rl['page_deutsch'];
    $link_english[] = $rl['page_english'];
    $target_deutsch[] = $rl['target_deutsch'];
    $target_english[] = $rl['target_english'];
    $canonical_deutsch[] = $rl['canonical_deutsch'];
    $canonical_english[] = $rl['canonical_english'];
}
$rowslinks = mysqli_num_rows($results);

/*
 * Start language section
 * Detect browser language and serve accordingly
 * Get language from manual select
 * 
 */
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['de', 'en'];
$lang = in_array($lang, $acceptLang) ? $lang : 'en';
$detectedLang = ($lang === 'de') ? 'deutsch' : 'english';

if (isset($_GET['page'])) {
    $target = $_GET['page'];
}

if (isset($_GET['language'])) {
    $getLang = $_GET['language'];
    if ($getLang === 'deutsch') {
        $language = 'deutsch';
    } else {
        $language = 'english';
    }
} else {
    $language = $detectedLang;
    if ($detectedLang === 'deutsch') {
        $target = 'startseite';
    } else {
        $target = 'homepage';
    }
}

/*
 * Just accept URLs in database, else error 404
 * Needs at least one page created in the administration to avoid a 404 at prodictive section
 * 
 */
if ((!in_array("$target", $canonical_deutsch)) && (!in_array("$target", $canonical_english))) {
    header('HTTP/1.0 404 Not Found');
    header("Location: /$target");
}

/*
 * Token handling: MD5 Hash
 * 
 * First get all pages motivation_content into an array
 * In the database those are at table: motivation_content
 * 
 * Default is:
 * 0efa745f21eb127178899a6343a29242
 * You can adjust to whatever you want, but need to edit in this file here accordingly
 * 
 */
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $queryToken = "SELECT content_deutsch, content_english, deutsch, english, lastchanged FROM motivation_content WHERE token = '" . $token . "'";
    $resultToken = mysqli_query($connection, $queryToken);
    foreach ($resultToken as $rToken) {
    $content_deutsch_tokened = $rToken['content_deutsch'];
    $content_english_tokened = $rToken['content_english'];
    $lastchanged_tokened = $rToken['lastchanged'];
    }
} else {
    $token = '0efa745f21eb127178899a6343a29242';
    $content_deutsch_tokened = '';
    $content_english_tokened = '';
}

/*
 * Get all pages content into an array
 * In the database those are at table: content
 * 
 */
$query = "SELECT structure_id, page_deutsch, page_english, deutsch, english, lastchanged FROM content WHERE page_" . $language . " = '" . $target . "'";
$result = mysqli_query($connection, $query);
foreach ($result as $r) {
    $page_deutsch = $r['page_deutsch'];
    $page_english = $r['page_english'];
    $content_deutsch = $r['deutsch'];
    $content_english = $r['english'];
    $structure_id = $r['structure_id'];
    $lastchanged = $r['lastchanged'];
}

/*
 * Get host for canonical URLs as we do rewrite in the .htaccess
 * 
 */
$host = $_SERVER['HTTP_HOST'];

/*
 * Nice readable titles
 * 
 */
$target_title = ucwords($target);

/*
 * Ccurrently selected page for highlighting via CSS
 * 
 */
if (in_array($target, $canonical_deutsch)) {
    $p = -1;
    unset($cur);
    
    foreach ($canonical_deutsch as $cp_deutsch) {
        $p++;

        if ($target === $cp_deutsch) {
            $cur[$p] = "current";
        } else {
            $cur[$p] = "notcurrent";
        }
    }
}

if (in_array($target, $canonical_english)) {
    $p = -1;
    unset($cur);
    
    foreach ($canonical_english as $cp_english) {
        $p++;

        if ($target === $cp_english) {
            $cur[$p] = "current";
        } else {
            $cur[$p] = "notcurrent";
        }
    }
}

/*
 * Actual date in different formats according active language
 * 
 */
if  (!empty($lastchanged_tokened) &&
        $token != '0efa745f21eb127178899a6343a29242' &&
        ($target == 'motivation' || $target == 'motivation')
    )
    {
    $lastchanged_en = date("m/d/Y h:i:s A",strtotime($lastchanged_tokened));
    $lastchanged_de = date("d.m.Y H:i:s",strtotime($lastchanged_tokened));
} else {
    $lastchanged_en = date("m/d/Y h:i:s A",strtotime($lastchanged));
    $lastchanged_de = date("d.m.Y H:i:s",strtotime($lastchanged));}
