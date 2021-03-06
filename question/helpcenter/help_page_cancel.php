<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/common_class_value.php"; ?>
  <title> <?= COMMON::$title; ?> </title>

  <!-- CSS, JS 파일 링크 시, -->
  <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
  <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/board.css">

  <!-- 공통으로 사용하는 link & script -->
  <!-- < ?php include $_SERVER['DOCUMENT_ROOT'] . "/echelin/common/common_link_script.php"; ?> -->


</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/create_table.php"; ?>
  <header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
  </header>
  <section>
    <div class="my_info_content">
      <div class="left_menu">
        <!-- 왼쪽 사이드 메뉴 -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/question/helpcenter/help_center_side_left_menu.php"; ?>
      </div>
      <div class="right_content">

        <!-- 도움말 json 기사를 css_card_menu_row로 자동 작업 -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/question/helpcenter/json_parsing_help_center.php";
        helpCenterArticlePage("help_page_cancel");
        ?>
        <div>
          취소안내 div
        </div>



      </div><!-- end of right_content -->
  </section>
  <footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
  </footer>
</body>

</html>