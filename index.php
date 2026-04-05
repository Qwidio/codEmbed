<?php
require_once "php/db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>codEmbed</title>
</head>
<body class="gap-s">
    <h1 class="posr topMg sideMg w50 txt-maintext txtc">codEmbed</h1>
    <div class="posr bottomMg sideMg pad-n-s mobileW95 w50 flex fld border-1 bora-s ovh">
        <h2 class="posr pad-nt w100p txtc">Paste your code here</h2>
        <form class="posr pad-st pad-nb w100p flex fld gap10" action="php/save.php" method="post" name="form" enctype="multipart/form-data">
            <textarea name="snippets" id="snippets" class="posr pad-s-v h50 r1-1 txt-ms bg-transparent c-white pre-line" required></textarea>
            <input class="pad-s-v w100p bg-half-gray txt-s txtc c-white bora-s border-none" type="text" name="title" id="title" placeholder="give title for the shared code" required/>
            <input class="posr pad-s-v w100p txt-s txtc semibold bgc-gold c-black border-none opacity7 hover-opac1 trs500ms" type="submit" name="submit" value="Share Code">
        </form>
    </div>
    <div id="alertcard">
        <p id="alertcontent"></p>
        <div id="borderanimate"></div>
    </div>
    <script src="js/script.js"></script>
    <?php
    if (!empty($corsmsg)) {
        echo "<script> ";
        echo "alerter('"; echo $corsmsg; echo "')";
        echo "</script>";
    }
    if (!empty($_SESSION['corsmsg'])) {
        $corsmsg = $_SESSION['corsmsg'];
        echo "<script> ";
        echo "alerter('" . $corsmsg . "')";
        echo "</script>";
        $_SESSION['corsmsg'] = "";
    }
    ?>
</body>
</html>