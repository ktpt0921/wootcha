<!DOCTYPE html>
<html>

<head>

    <title>영화 상세 페이지</title>
    <link rel="stylesheet"
          href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/movie_introduce_page/css/movie_introduce_content.css?after">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css">

    <!-- 모달  -->
    <link rel="stylesheet" type="text/css" href="../mypage/css/mypage_review_modal.css?after">
    <script src="../mypage/js/mypage_review_modal.js"></script>
    <script src="http://code.jquery.com/jquery-1.7.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
</head>


<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/create_table.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/movie_info.php"; ?>


    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
    </header>

    <section>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/movie_introduce_page/movie_introduce_main.php"; ?>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>