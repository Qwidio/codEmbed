<?php
require_once "php/db.php";
session_start();
if (!isset($_GET['ids']) || $_GET['ids'] === "") {
    $corsmsg = "empty view item";
}
$noData = false;
$targetIds = $_GET['ids'];
$targetIds = htmlspecialchars($targetIds, ENT_QUOTES, 'UTF-8');
$stmt_check = $connects->prepare("SELECT * FROM shares WHERE ids = ?;");
$stmt_check->bind_param("s", $targetIds);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
if ($result_check->num_rows == 1) {
    $value      = $result_check->fetch_assoc();
    $ids        = $value['ids'];
    $title      = $value['title'];
    $editable   = $value['editable'];
    $parsekeys  = $value['parsekeys'];
    $code       = $value['code'];
    $expiration = $value['expiration'];
} else {
    $noData = true;
    $corsmsg = "the code you open were yet to exist";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>codEmbed / shared code</title>
</head>
<body class="gap-s">
    <a href="index.php" class="posr topMg sideMg w50 txt-maintext txtc">codEmbed</a>
    <div class="posr bottomMg sideMg pad-n-s mobileW95 w50 flex fld border-1 bora-s ovh">
        <form class="posr pad-st pad-nb w100p flex fld gap10" method="post" name="form" enctype="multipart/form-data" onSubmit="return false;">
            <input class="pad-s-v w100p bg-transparent txt-s txtc c-white bora-s border-none" value="<?php echo $title;?>" type="text" name="title" id="title" placeholder="give title for the shared code" disabled/>
            <textarea name="snippets" id="snippets" class="posr pad-s-v h50 r1-1 bg-transparent txt-ms c-white pre-line" disabled><?php echo $code;?></textarea>
            <div class="posr w100p flex gap5">
                <button class="posr pad-s-v w50p txt-s txtc semibold bgc-gold c-black border-none opacity7 hover-opac1 trs500ms" type="submit" name="submit" onclick="copy('snippets'); alerter('code copied!');">Copy Code</button>
                <button class="posr pad-s-v w50p txt-s txtc semibold bgc-gold c-black border-none opacity7 hover-opac1 trs500ms" type="submit" name="submit" onclick="share('/view.php?ids=<?php echo $ids;?>');">Share Code</button>
            </div>
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