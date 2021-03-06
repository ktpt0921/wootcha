<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> Wootcha </title>

    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/css/main.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/css/main_test.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/js/slide/main.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/js/session_check.js"></script>

    <!-- 모달 리뷰 화면 -->
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/mypage/css/mypage_review_modal.css?after">
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/mypage/js/mypage_review_modal.js"></script>
    <!-- 아이콘 폰트  https://fontawesome.com/  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css">
    <?=include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";?>

</head>

<body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
        </header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/main/main_slide.php"; ?>
        <section>
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/main/main.php"; ?>
        </section>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
        </footer>
</body>

</html>

