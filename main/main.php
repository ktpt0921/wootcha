<div class="css-xpk6f5-Main ebsyszu1">
  <div class="css-7eleqt-Self ebeya3l1">
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";

    $sql = "select R.mv_num, count(R.mv_num) as count, M.mv_title, M.mv_release_date, M.mv_img_path, M.mv_rating 
      from review R inner join movie M on R.mv_num = M.mv_num group by R.mv_num order by count desc limit 10;";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    ?>
    <!-- 최다 리뷰 영화 리스트 -->
    <div class="css-MainDiv ebeya3l11 session_check">
        <!-- 타이틀과 영화항목 최다리뷰 -->
        <div class="css-MainListContainer ebeya3l2">
            <!-- 타이틀 -->
            <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
                <!-- 타이틀 설정 -->
                <p class="css-StyledMainListTitle ebeya3l6">WOOTCHA Best Movie</p>
            </div>
            <!-- 영화항목 -->
            <div class="css-StyledMainScrollOuterContainer ebeya3l4">
                <!-- 영화 로비 -->
                <div class="css-ScrollBarContainer e1f5xhlb0">
                    <!-- 영화 1층 -->
                    <div class="css-ScrollBar e1f5xhlb1">
                        <!-- 영화 2층 -->
                        <div class="css-ScrollingTaim best_movie">
                            <!-- 영화 3층 -->
                            <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
                                <!-- 영화 4층 ul -->
                                <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                                    <!-- 영화 5층 li -->
                                    <?php
                                    $main_list2 = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $mv_rating = $row['mv_rating'];
                                        $mv_release_date = $row['mv_release_date'];
                                        $mv_title = $row['mv_title'];
                                        $mv_img_path = $row['mv_img_path'];
                                        $mv_num = $row['mv_num'];
                                        $count = $row['count'];
                                        ?>
                                        <li class="css-MainList-li e3fgkal0">
                                            <!-- 영화 6층 a -->
                                            <a title="<?= $mv_title ?>"
                                              href="/wootcha/movie_introduce_page/movie_introduce_index.php?mv_num=<?= $mv_num ?>">
                                                <!-- 6층 포스터 -->
                                                <div class="css-MainContentPosterBlock e3fgkal1">
                                                    <!-- 포스터 설정 -->
                                                    <div class="css-MainPosterBlock-MainPosterBlock ewlo9840">
                                                        <img src="<?= $mv_img_path ?>"
                                                            class="css-StyledMainPosterBlock ewlo9841">
                                                    </div>
                                                    <!-- 포스터 랭크 -->
                                                    <div class="css-RankBadge e3fgkal7"><?= $main_list2 ?></div>
                                                </div>
                                                <!-- 6층 설명 -->
                                                <div class="css-MainContentBlock e3fgkal2">
                                                    <!-- 영화설명_제목 -->
                                                    <div class="css-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                                    <!-- 영화설명_출시년도 -->
                                                    <div class="css-StyledContentYear ebeya3l12"><?= $mv_release_date ?></div>
                                                    <!-- 영화설명_평점 -->
                                                    <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                                      <span>
                                                        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/image/wootcha_star.png" alt="" class="css-IcRatingStarSvg erjycaa0">
                                                        <?= $mv_rating ?>
                                                        &nbsp;
                                                        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/image/wootcha_review.png" alt="" class="css-IcRatingStarImg erjycaa0">  <?= $count ?>
                                                      </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- END 영화 5층 li -->
                                        <?php
                                        $main_list2++;
                                    } // END while
                                    ?>
                                </ul> <!-- END 영화 4층 ul -->
                            </div>
                        </div> <!-- END 영화 2층 -->
                    </div> <!-- END 영화 1층 -->
                <!-- 영화로비_왼쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-left e1f5xhlb3" direction="left">
                    <div class="css-BackwardButton-left e1f5xhlb6"></div>
                </div>
                <!-- 영화로비_오른쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-right e1f5xhlb3" direction="right">
                    <div class="css-ForwardButton-right e1f5xhlb5">
                        <!-- 영화로비_오른쪽버튼 img -->
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K" alt="forward">
                    </div>
                </div> <!-- END 영화로비 -->
            </div>
        </div> <!-- END 타이틀과 영화항목 최다리뷰 -->
    </div><!-- END 최다 리뷰 영화 리스트 -->

    <?php
    $sql = "select M.mv_title, R.review_rating, R.review_short, R.review_like, R.review_num, M.mv_img_path, U.user_nickname
                from review R 
                inner join movie M on R.mv_num = M.mv_num
                inner join user U on R.user_num = U.user_num
                order by review_like desc limit 10;";
    $result = mysqli_query($con, $sql);
    ?>
    <!-- 베스트 리뷰 리스트 -->
    <div class="css-MainDiv ebeya3l11 session_check">
        <!-- 타이틀과 영화항목 베스트리뷰 -->
        <div class="css-MainListContainer ebeya3l2">
            <!-- 타이틀 -->
            <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
                <!-- 타이틀 설정 -->
                <p class="css-StyledMainListTitle ebeya3l6">Best Review</p>
            </div>
            <!-- 영화항목 -->
            <div class="css-StyledMainScrollOuterContainer ebeya3l4">
                <!-- 영화 로비 -->
                <div class="css-ScrollBarContainer e1f5xhlb0">
                    <!-- 영화 1층 -->
                    <div class="css-ScrollBar e1f5xhlb1">
                        <!-- 영화 2층 -->
                        <div class="css-ScrollingTaim best_review">
                            <!-- 영화 3층 -->
                            <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
                                <!-- 영화 4층 ul -->
                                <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                                    <!-- 영화 5층 li -->
                                    <?php
                                    $main_list = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $review_rating = $row['review_rating'];
                                        $review_like = $row['review_like'];
                                        $review_number = $row['review_num'];
                                        $user_nickname = $row['user_nickname'];
                                        $review_short = $row['review_short'];
                                        $mv_title = $row['mv_title'];
                                        $mv_img_path = $row['mv_img_path'];
                                        // *****************************
                                        // 리뷰 모달에서 사용하는 변수, 여기에 매치하면 됨
                                        // *****************************
                                        $query = "select R.user_num, user_img, user_nickname, review_like, review_regtime, review_short, review_long  
                                                  from review R
                                                  inner join user U
                                                  on R.user_num = U.user_num
                                                  where review_num = $review_number;";
                                        $result_query = mysqli_query($con, $query) or die(mysqli_error($con));
                                        $row = mysqli_fetch_array($result_query);
                                        // 리뷰 pk
                                        $review_pk_num = $review_number;
                                        // 리뷰 작성자 pk
                                        $review_writer_num = $row['user_num'];
                                        // 리뷰 작성자의 이미지
                                        $review_writer_img = $row['user_img'];
                                        // 리뷰 작성자의 닉네임
                                        $review_writer_nickname = $row['user_nickname'];
                                        // 리뷰 작성자가 평가한 평점
                                        $review_writer_rating = $review_rating;
                                        // 리뷰 좋아요 수
                                        $review_like_count = $row['review_like'];
                                        // 리뷰 등록 일자
                                        $review_register_date = $row['review_regtime'];
                                        // 반복문의 넘버
                                        $while_num = $main_list - 1;
                                        // 영화의 제목
                                        $movie_subject = $mv_title;
                                        // 한줄평
                                        $short_review_content = $row['review_short'];
                                        // 장문평
                                        $long_review_content = $row['review_long'];
                                        // 세션 유저의 넘버
                                        if (isset($_SESSION['user_num'])) {
                                            $session_user_num = $_SESSION['user_num'];
                                        } else {
                                            $session_user_num = "";
                                        }

                                        include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/review/review_modal.php";
                                        // review_dialog_trigger 클래스가 버튼 역할을 함
                                        ?>
                                        <li class="css-MainList-li e3fgkal0">
                                            <!-- 영화 6층 a -->
                                            <a title="<?= $mv_title ?>" href="#" class="review_dialog_trigger"
                                              onclick="return false;">
                                                <!-- 6층 포스터 -->
                                                <div class="css-MainContentPosterBlock e3fgkal1">
                                                    <!-- 포스터 설정 -->
                                                    <div class=" css-MainPosterBlock-MainPosterBlock ewlo9840">
                                                        <img src="<?= $mv_img_path ?>"
                                                            class="css-StyledMainPosterBlock ewlo9841">
                                                    </div>
                                                    <!-- 포스터 랭크 -->
                                                    <div class="css-RankBadge e3fgkal7"><?= $main_list ?></div>
                                                </div>
                                                <!-- 6층 설명 -->
                                                <div class="css-MainContentBlock e3fgkal2">
                                                    <!-- 영화설명_제목 -->
                                                    <div class="css-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                                    <!-- 영화설명_출시년도 -->
                                                    <div class="css-StyledContentYear ebeya3l12"><?= $mv_release_date ?></div>
                                                    <!-- 영화설명_평점 -->
                                                    <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                                      <span>
                                                          <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/image/wootcha_star.png" alt="" class="css-IcRatingStarSvg erjycaa0">
                                                          <?= $review_rating ?>
                                                          &nbsp;
                                                          <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/image/notlike.png" alt="" class="css-IcRatingStarSvg erjycaa0">  <?= $review_like ?>
                                                        </span>
                                                    </div>
                                                    <!-- 서브리스트 div 영화리뷰 -->
                                                    <div class="css-1teivyt-ContentShort"><span><?= $user_nickname ?></span> | <?= $review_short ?></div>
                                                </div>
                                            </a>
                                        </li><!-- END 영화 5층 li -->
                                        <?php
                                        $main_list++;
                                    } // END while
                                    ?>
                                </ul> <!-- END 영화 4층 ul -->
                            </div> <!-- END 영화 3층 -->
                        </div> <!-- END 영화 2층 -->
                    </div> <!-- END 영화 1층 -->
                    <!-- 영화로비_왼쪽버튼 -->
                    <div class="arrow_button css-ArrowButtonBlock-left e1f5xhlb3"
                        direction="left">
                        <div class="css-BackwardButton-left e1f5xhlb6"></div>
                    </div>
                    <!-- 영화로비_오른쪽버튼 -->
                    <div class="arrow_button css-ArrowButtonBlock-right e1f5xhlb3"
                        direction="right">
                        <div class="css-ForwardButton-right e1f5xhlb5">
                            <!-- 영화로비_오른쪽버튼 img -->
                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K"
                                alt="forward">
                        </div>
                    </div>
                </div> <!-- END 영화로비 -->
            </div>
        </div> <!-- END 타이틀과 영화항목 베스트리뷰 -->
    </div><!-- END 베스트 리뷰 리스트 -->

    <?php
    $sql = "select R.review_rating, R.review_short, R.review_num, M.mv_title, M.mv_img_path, M.mv_release_date,U.user_nickname from review R 
              inner join movie M on R.mv_num = M.mv_num
              inner join user U on R.user_num = U.user_num
              order by R.review_regtime desc limit 30;";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    ?>
    <!-- 리뷰 전체 리스트 -->
    <div class="css-MainDiv ebeya3l11 session_check">
        <!-- 타이틀과 영화항목 최근리뷰 -->
        <div class="css-MainListContainer ebeya3l2">
            <!-- 타이틀 -->
            <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
                <!-- 타이틀 설정 -->
                <p class="css-StyledMainListTitle ebeya3l6">Recent Reivew</p>
            </div>
            <!-- 영화항목 -->
            <div class="css-StyledMainScrollOuterContainer ebeya3l4">
                <!-- 영화 로비 -->
                <div class="css-ScrollBarContainer e1f5xhlb0">
                    <!-- 영화 1층 -->
                    <div class="css-ScrollBar e1f5xhlb1">
                        <!-- 영화 2층 -->
                        <div class="css-ScrollingTaim recent_review">
                            <!-- 영화 3층 -->
                            <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
                                <!-- 영화 4층 ul -->
                                <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                                    <!-- 영화 5층 li -->
                                    <?php
                                    $main_list3 = 1;
                                    $result_count = mysqli_num_rows($result);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $review_rating = $row['review_rating'];
                                        $review_number = $row['review_num'];
                                        $review_short = $row['review_short'];
                                        $user_nickname = $row['user_nickname'];
                                        $mv_title = $row['mv_title'];
                                        $mv_img_path = $row['mv_img_path'];

                                        // *****************************
                                        // 리뷰 모달에서 사용하는 변수, 여기에 매치하면 됨
                                        // *****************************
                                        $query = "select R.user_num, user_img, user_nickname, review_like, review_regtime, review_short, review_long  
                                                  from review R
                                                  inner join user U
                                                  on R.user_num = U.user_num
                                                  where review_num = $review_number;";
                                        $result_query = mysqli_query($con, $query) or die(mysqli_error($con));
                                        $row = mysqli_fetch_array($result_query);
                                        // 리뷰 pk
                                        $review_pk_num = $review_number;
                                        // 리뷰 작성자 pk
                                        $review_writer_num = $row['user_num'];
                                        // 리뷰 작성자의 이미지
                                        $review_writer_img = $row['user_img'];
                                        // 리뷰 작성자의 닉네임
                                        $review_writer_nickname = $row['user_nickname'];
                                        // 리뷰 작성자가 평가한 평점
                                        $review_writer_rating = $review_rating;
                                        // 리뷰 좋아요 수
                                        $review_like_count = $row['review_like'];
                                        // 리뷰 등록 일자
                                        $review_register_date = $row['review_regtime'];
                                        // 반복문의 넘버 : 1부터 시작하는데 js에서 필요한 건 0부터 시작
                                        $while_num = $main_list3 + $main_list - 2;
                                        // 영화의 제목
                                        $movie_subject = $mv_title;
                                        // 한줄평
                                        $short_review_content = $row['review_short'];
                                        // 장문평
                                        $long_review_content = $row['review_long'];
                                        // 세션 유저의 넘버
                                        if (isset($_SESSION['user_num'])) {
                                            $session_user_num = $_SESSION['user_num'];
                                        }else{
                                            $session_user_num = "";
                                        }

                                        include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/review/review_modal.php";
                                        // review_dialog_trigger 클래스가 버튼 역할을 함
                                        ?>
                                        <!--DB 결과 수    -->
                                        <input type="hidden" name="result_count"
                                              id="result_count"
                                              value="<?= $result_count ?>">
                                        <li class="css-MainList-li e3fgkal0">
                                            <!-- 영화 6층 a -->
                                            <a title="<?= $mv_title ?>" href="#"
                                              class="review_dialog_trigger"
                                              onclick="return false;">
                                                <!-- 6층 포스터 -->
                                                <div class="css-MainContentPosterBlock e3fgkal1">
                                                    <!-- 포스터 설정 -->
                                                    <div class=" css-MainPosterBlock-MainPosterBlock ewlo9840">
                                                        <img src="<?= $mv_img_path ?>"
                                                            class="css-StyledMainPosterBlock ewlo9841">
                                                    </div>
                                                    <!-- 포스터 랭크 -->
                                                    <div class="css-RankBadge e3fgkal7"><?= $main_list3 ?></div>
                                                </div>
                                                <!-- 6층 설명 -->
                                                <div class="css-MainContentBlock e3fgkal2">
                                                    <!-- 영화설명_제목 -->
                                                    <div class="css-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                                    <!-- 영화설명_출시년도 -->
                                                    <div class="css-StyledContentYear ebeya3l12"><?= $mv_release_date ?></div>
                                                    <!-- 영화설명_평점 -->
                                                      <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                                        <span>
                                                          <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/image/wootcha_star.png" alt="" class="css-IcRatingStarSvg erjycaa0">
                                                          <?= $review_rating ?>
                                                        </span>
                                                      </div>
                                                    <!-- 서브리스트 div 영화리뷰 -->
                                                    <div class="css-1teivyt-ContentShort"><span><?= $user_nickname ?></span> | <?= $review_short ?></div>
                                                  </div>
                                            </a>
                                        </li><!-- END 영화 5층 li -->
                                        <?php
                                        $main_list3++;
                                    } // END while
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- END 영화 1층 -->
                    <!-- 영화로비_양쪽 틈 -->
                    <div direction="left" class="css-CheatBlock-left"></div>
                    <div direction="right" class="css-CheatBlock-right"></div>
                <!-- 영화로비_왼쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-left e1f5xhlb3" direction="left">
                    <div class="css-BackwardButton-left e1f5xhlb6"></div>
                </div>
                <!-- 영화로비_오른쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-right e1f5xhlb3" direction="right">
                    <div class="css-ForwardButton-right e1f5xhlb5">
                        <!-- 영화로비_오른쪽버튼 img -->
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K" alt="forward">
                    </div>
                </div> <!-- END 영화로비 -->
            </div>
        </div> <!-- END 타이틀과 영화항목 최근리뷰 -->
    </div><!-- END 리뷰 전체 리스트 -->
</div>