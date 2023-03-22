<?php
/*
 * Remove this error reporting in productive systems
 *  
 */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/*
 * Connect to the database
 * Edit that file below to your individual connection
 * 
 */
require_once 'ra_admin/mysql/connection.php';

/*
 * Include main variables
 * 
 */
include 'includes/variables.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Sascha Riess: <?= $target_title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" />
<meta name="expires" content="now" />
<meta name="googlebot" content="noindex" />
<meta name="description" content="Sascha Riess: <?= $target_title ?>" />
<meta name="keywords" content="Sascha Riess: <?= $target_title ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="shortcut icon" href="/favicon.png" type="image/png" />
<link href="//fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet" type="text/css" />
<link rel="canonical" href="//<?= $host ?>/<?= $target ?>/<?= $language ?>/<?= $token ?>" />
<link rel="stylesheet/less" type="text/css" href="/less/main.less" />
<script src="/scripts/less.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="language">
        <a href="/<?= $page_english ?>/english/<?= $token ?>" title="Switch to English version"><img src="/ra_data/images/Flag_of_the_United_Kingdom.svg" alt="Language: English" class="flags" /></a><span class="switch"> &#9668; &#9658; </span><a href="/<?= $page_deutsch ?>/deutsch/<?= $token ?>" title="Wechsel zur deutschen Version"><img src="/ra_data/images/Flag_of_Germany.svg" alt="Sprache: Deutsch" class="flags" /></a>
    </div>
    <div class="navbox">
        <ul class='topnav'>
        <?php
        for ($i = 0; $i < $rowslinks; $i++) {
            if ($token != '9a7ed6771e4cc30ac79c7f93b180fda7' && $token != '4f39b4cf3f06a4536108c6e30eadbddf') { // Default for all not individualized navigation sections out of structure
                if ($canonical_deutsch[$i] != 'anleitung' && $canonical_english[$i] != 'manual') { // No manual
                    if ($language == 'deutsch') {
                    ?>
                    <li>
                        <a href="/<?= $canonical_deutsch[$i] ?>/<?= $language ?>/<?= $token ?>" class="<?= $cur[$i] ?>"><?= $link_deutsch[$i] ?></a>
                    </li>
                    <?php
                    } else {
                    ?>
                    <li>
                        <a href="/<?= $canonical_english[$i] ?>/<?= $language ?>/<?= $token ?>" class="<?= $cur[$i] ?>"><?= $link_english[$i] ?></a>
                    </li>
                    <?php
                    }
                }
            } else { // Show individualized navigations out of structure
                if ($language == 'deutsch') {
                ?>
                <li>
                    <a href="/<?= $canonical_deutsch[$i] ?>/<?= $language ?>/<?= $token ?>" class="<?= $cur[$i] ?>"><?= $link_deutsch[$i] ?></a>
                </li>
                <?php
                } else {
                ?>
                <li>
                    <a href="/<?= $canonical_english[$i] ?>/<?= $language ?>/<?= $token ?>" class="<?= $cur[$i] ?>"><?= $link_english[$i] ?></a>
                </li>
                <?php
                }
            }
        }
        ?>
        </ul>
    </div>
    <div class='clear'></div>
    <?php
    if (empty($token) || $token == '0efa745f21eb127178899a6343a29242') {
        if ($language == 'deutsch') {
            echo $content_deutsch;
        } else {
            echo $content_english;
        }
    } else {
        if ($language === 'deutsch' && $target === 'motivation') {
            echo $content_deutsch_tokened;
            $content_deutsch = $content_deutsch_tokened;
        }
        elseif ($language === 'english' && $target === 'motivation') {
            echo $content_english_tokened;
            $content_english = $content_english_tokened;
        } else {
            if ($language === 'deutsch') {
                echo $content_deutsch;
            }
            else {
                echo $content_english;
            }
        }
    }
    ?>
    <div class="hbarfooter">
        <span class="hbarfooterline">
                <form>
                    <input
                    type="hidden"
                    id="pdfname"
                    name="pdfname"
                    value="<?= $target ?>"
                    />
                    <input
                    type="hidden"
                    id="pdfurl"
                    name="pdfurl"
                    value="<?= $host ?>/<?= $target ?>/<?= $language ?>/<?= $token ?>"
                    />
                    <input
                    type="hidden"
                    id="pdfcontent"
                    name="pdfcontent"
                    value='<?= $language == 'deutsch' ? $content_deutsch : $content_english ?>'
                    />
                    <input
                    type="hidden"
                    id="htmltopdf"
                    name="htmltopdf"
                    value="pdf"
                    />
                <button type="submit" class="pdfbutton">PDF</button>
            </form>
        </span>
    </div>
    <?php
    if ($language === 'deutsch') {
        echo "<div id='footer'>&copy; Sascha Rie&szlig; root-art | Host: <a href='//" . $host . "' class='inpagelink'>$host</a> | Seite aktualisiert: UTC+1, Deutschland: " . $lastchanged_de . " | <a href='/ra_admin' class='inpagelink' target='_blank'>Login</a> | <a href='//sandbox.root-art.com' class='inpagelink' target='_blank'>Sandbox</a></div>";
    }
    else {
        echo "<div id='footer'>&copy; Sascha Riess root-art | Host: <a <a href='//" . $host . "' class='inpagelink'>$host</a> | Page updated: UTC+1/Germany: " . $lastchanged_en . " | <a href='/ra_admin' class='inpagelink' target='_blank'>Login</a> | <a href='//sandbox.root-art.com' class='inpagelink' target='_blank'>Sandbox</a></div>";
    }
    ?>    
<script src="/scripts/ajax.js"></script>
</body>
</html>