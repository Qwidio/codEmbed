<?php
require_once "../php/db.php";
if (!isset($_GET['ids']) || $_GET['ids'] === "") {
    $corsmsg = "empty view item";
}
$noData = false;
$targetIds = $_GET['ids'];
$cDate = date('d/m/Y');
$targetIds = htmlspecialchars($targetIds, ENT_QUOTES, 'UTF-8');
$stmt_check = $connects->prepare("SELECT * FROM shares WHERE ids = ? AND expiration > ?;");
$stmt_check->bind_param("ss", $targetIds, $cDate);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
if ($result_check->num_rows == 1) {
    $value      = $result_check->fetch_assoc();
    $ids        = $value['ids'];
    $title      = $value['title'];
    $editable   = $value['editable'];
    $parsekeys  = $value['parsekeys'];
    $code       = $value['code'];
    $cleancode  = str_replace("<br-c>{</br-c>","{",$code);
    $cleancode  = str_replace("<br-c>}</br-c>","}",$cleancode);
    $cleancode  = str_replace("<br-b>(</br-b>","(",$cleancode);
    $cleancode  = str_replace("<br-b>)</br-b>",")",$cleancode);
    $cleancode  = str_replace("<br-p>[</br-p>","[",$cleancode);
    $cleancode  = str_replace("<br-p>]</br-p>","]",$cleancode);
} else {
    $noData = true;
}
if ($noData == false) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="i.css">
</head>
<body class="posr pad-s w100p h100p minw50px minh150px flex fld gap10 bg-def-1 border-1 bora-s">
    <input class="pad-s-v w100p bg-transparent txt-n txtc c-white bora-s border-none" value="<?php echo $title;?>" type="text" name="title" id="title" placeholder="give title for the shared code" disabled/>
    <pre class="posr pad-s w100p minh100px bg-transparent txt-s c-white border-1" disabled><?php echo $code;?></pre>
    <textarea name="snippets" id="snippets" class="posr pre-line" disabled hidden><?php echo $cleancode;?></textarea>
</body>
</html>
<?php
}
?>