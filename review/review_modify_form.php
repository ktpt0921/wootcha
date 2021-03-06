<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="./css/review.css?after">
        <script src="./js/review_insert.js"></script>
    </head>
    <body>
        <!-- 헤더 -->
        <header>
            <?php include_once "../common/page_form/header.php"?>
        </header>
            <?php   include_once "../common/database/db_connector.php";
                    if(!isset($_SESSION['user_mail'])){
                        echo "<script>alert('잘못된 접근입니다. 로그인 후 이용하세요.');
                        history.go(-1);</script>";
                        exit;
                    }
                    $review_num = $_POST['review_num'];
                    $mv_num = $_POST['mv_num'];
                    $review_rating = $_POST['review_rating'];
                    $review_short = $_POST['review_short'];
                    $review_long = $_POST['review_long'];
                    $review_like = $_POST['review_like'];
                    $review_hit = $_POST['review_hit'];
                    $review_regtime = $_POST['review_regtime'];
                    $mv_title = $_POST['mv_title'];
                    $mv_img_path = $_POST['mv_img_path'];
            ?>

        <!-- 섹션 -->
        <section>
            <header class="section_header">
                <span class="title_sub">마이페이지  &nbsp&nbsp > &nbsp&nbsp 리뷰 수정하기 </span><br><br>
                <span class="title_main"> <?=$mv_title?> </span>
            </header>
            <div class="container_review" name="container_review">
                <div class="content_review">
                    <!-- 상단 프로필 및 평점 -->
                    <!-- <div class="content_header_review"> -->
                        <!-- profile img : 세션에서 값 옴-->
                        <!-- profile img : 세션에서 값 옴-->
                        <!-- < ?php -->
                            <!-- if (strlen($user_img) > 22) {
                                echo "<div class='small_img_box'><img src='$user_img' alt=''></div>";
                            }else{ 
                                echo "<div class='small_img_box'><img src='../user/img/$user_img' alt='프로필 이미지 수정'></div>";
                            }
                        ?> -->
                        <!-- 닉네임 : 세션에서 값 옴 -->
                        <!-- <div>< ?=$user_nickname?></div> -->
                        
                    <!-- </div> -->
                    
                    <!-- 영화 제목 : post로 받아온 영화 제목-->
                    <!-- <h3 class="title"></h3> -->
                    <form action="./review_d_m_i.php" method="post" id="review_modify_form">
                        <input type="hidden" name="mode" value="modify">
                        <input type="hidden" name="review_num" value="<?=$review_num?>">
                        <h2>평점 매기기</h2>
                        <div class="startRadio_box">
                            <div class="startRadio">
                            <!-- 평점 -->
                            <?php
                                $find_rating=0.5;
                                while ($find_rating <= 5) {
                                    // 반복문으로 rating bar 생성 및 checked 설정
                                    if ($find_rating == $review_rating) {
                                        $rating_checked = "checked";
                                    }else{
                                        $rating_checked = "";
                                    }
                                    echo "
                                        <label class='startRadio__box'>
                                            <input type='radio' name='review_rating' value='$find_rating' $rating_checked>
                                            <span class='startRadio__img'><span class='blind'></span></span>
                                        </label>";
                                    $find_rating += 0.5;
                                }
                            ?>
                            </div>
                        </div>
                        <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                        <h2>한 줄 평</h2>
                        <span style="color:#aaa;" id="counter">(<?=mb_strlen($review_short, "utf-8")?> / 최대 40자)</span>
                            <input type="text" class="review_short" name="review_short" value="<?=$review_short?>">
                            <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                        <div id="long_view_box">
                            <h2>장 문 평</h2>
                            <textarea name="review_long" id="review_long" cols="30" rows="10" class="review_long" placeholder="장문평을 추가해 주세요"><?=$review_long?></textarea>
                        </div>
                        <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                        <input type="submit" value="수정하기">
                    </form>
                    <form action="./review_d_m_i.php" method="post" id="review_delete">
                        <input type="submit" value="삭제하기">
                        <input type="hidden" name="mode" value="delete">
                        <input type="hidden" name="review_num" value="<?=$review_num?>">
                    </form>
                </div>
            </div><!-- containder -->
                
        </section><!-- section -->
                
        
        <!-- 푸터 -->
        <footer>
            <?php include_once "../common/page_form/footer.php"?>
        </footer>
    </body>
    </html>