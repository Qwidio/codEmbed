<?php
require_once "db.php";
session_start();
function getRandomWord($len = 40) {
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}
if (isset($_POST['submit'])) {
    $initReq = htmlspecialchars($initReq, ENT_QUOTES, 'UTF-8');
    $y = date("Y");
    $m = date("m");
    $d = date("d");
    $d = $d + 15;
    if ($d > 27) {
        $m = $m + 1;
        $d = 15;
    }
    if ($m < 10) {
        $m = "0" . $m;
    }
    $expdate = $d . "-" . $m . "-" . $y;
    $rnum = random_int(1000000, 989798979);
    $rword = getRandomWord();
    $ids = $rnum.$rword.$d.$m.$y;
    $title = $_POST['title'];
    $codes = $_POST['snippets'];
    $codes = htmlspecialchars($codes, ENT_QUOTES, 'UTF-8');
    $stmt_post = $connects->prepare("INSERT INTO shares (ids, title, parsekeys, code, expiration) VALUES (?, ?, MD5(?), ?, ?)");
    $stmt_post->bind_param("sssss", $ids, $title, $ids, $codes, $expdate);
    if($stmt_post->execute()){
        $_SESSION['corsmsg'] = 'code saved';
        header ('location: ../view.php?ids=' . $ids);
        exit;
    }else{
        $_SESSION['corsmsg'] = 'an error occured when trying to save the code';
        header ('location: ../index.php');
        exit;
    };
    $stmt_post->close();
} else {
    header ('location: ../index.php');
    exit;
};
?>