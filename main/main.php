<!-- 상단 슬라이드 -->
<div class="slideShow">
        <div class="slideShow_slides">
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-1.jpg" alt="slide1"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-2.jpg" alt="slide2"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-3.jpg" alt="slide3"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-4.jpg" alt="slide4"></a>
        </div>
        <div class="slideShow_nav">
            <a href="#" class="prev">이전</a>
            <a href="#" class="next">다음</a>
        </div>
        <div class="slideShow_indicator">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
        </div>
</div>

<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/crawling/movie_cgv_crawling.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/search/movie_naver_api_func.php";

  $sql = "select R.mv_num, count(R.mv_num) as count, M.mv_title, M.mv_release_date, M.mv_img_path, R.review_rating 
  from review R inner join movie M on R.mv_num = M.mv_num group by R.mv_num order by count desc limit 5;";
  $result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 최다 코멘트 총 리스트 -->
<div class="css-MainDiv ebeya3l11">
  <!-- 타이틀과 영화항목 최다리뷰 -->
  <div class="css-MainListContainer ebeya3l2">
    <!-- 타이틀 -->
    <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
      <!-- 타이틀 설정 -->
      <p class="css-StyledMainListTitle ebeya3l6">WOOTCHA 사용자들이 좋아하는 영화</p>
    </div>
    <!-- 영화항목 -->
    <div class="css-StyledMainScrollOuterContainer ebeya3l4">
      <!-- 영화 로비 -->
      <div class="css-ScrollBarContainer e1f5xhlb0">
        <!-- 영화 1층 -->
        <div class="css-ScrollBar e1f5xhlb1">
          <!-- 영화 2층 -->
          <div class="css-ScrollingTaim e1f5xhlb2">
            <!-- 영화 3층 -->
            <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
              <!-- 영화 4층 ul -->
              <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                <!-- 영화 5층 li -->
                <?php
                  $main_list2=1;
                  while($row = mysqli_fetch_array($result)){
                    $review_rating = $row['review_rating'];
                    $mv_release_date = $row['mv_release_date'];
                    $mv_title = $row['mv_title'];
                    $mv_img_path = $row['mv_img_path'];
                    $mv_num = $row['mv_num'];
                ?>
                <li class="css-MainList-li e3fgkal0">
                  <!-- 영화 6층 a -->
                  <a title="<?=$mv_title?>" href="/wootcha/movie_introduce_page/movie_introduce_index.php?mv_num=<?=$mv_num ?>">
                    <!-- 6층 포스터 -->
                    <div class="css-MainContentPosterBlock e3fgkal1">
                      <!-- 포스터 설정 -->
                      <div class="css-MainPosterBlock-MainPosterBlock ewlo9840">
                        <img src="<?=$mv_img_path?>" class="css-StyledMainPosterBlock ewlo9841">
                      </div>
                      <!-- 포스터 랭크 -->
                      <div class="css-RankBadge e3fgkal7"><?=$main_list2?></div>
                    </div>
                    <!-- 6층 설명 -->
                    <div class="css-MainContentBlock e3fgkal2">
                      <!-- 영화설명_제목 -->
                      <div class="css-ContentTitle e3fgkal3"><?=$mv_title?></div>
                      <!-- 영화설명_출시년도 -->
                      <div class="css-StyledContentYear ebeya3l12"><?=$mv_release_date?></div>
                      <!-- 영화설명_평점 -->
                      <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                        <span>평점</span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-IcRatingStarSvg erjycaa0">
                            <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                          </svg>
                        <span><?=$review_rating?></span>
                      </div>
                    </div>
                  </a>
                </li><!-- END 영화 5층 li -->
                <?php
                  $main_list2++;
                  } // END while
                ?>
              </ul>
            </div>
          </div>
        </div> <!-- END 영화 1층 -->
      </div> <!-- END 영화로비 -->
    </div>
  </div> <!-- END 타이틀과 영화항목 최다리뷰 -->
</div><!-- END 최다 코멘트 총 리스트 -->

<?php
  $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_like desc limit 5";
  $result = mysqli_query($con, $sql);
?>
<!-- 베스트 총 리스트 -->
<div class="css-MainDiv ebeya3l11">
  <!-- 타이틀과 영화항목 베스트리뷰 -->
  <div class="css-MainListContainer ebeya3l2">
    <!-- 타이틀 -->
    <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
      <!-- 타이틀 설정 -->
      <p class="css-StyledMainListTitle ebeya3l6">좋아요 리뷰</p>
    </div>
    <!-- 영화항목 -->
    <div class="css-StyledMainScrollOuterContainer ebeya3l4">
      <!-- 영화 로비 -->
      <div class="css-ScrollBarContainer e1f5xhlb0">
        <!-- 영화 1층 -->
        <div class="css-ScrollBar e1f5xhlb1">
          <!-- 영화 2층 -->
          <div class="css-ScrollingTaim e1f5xhlb2">
            <!-- 영화 3층 -->
            <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
              <!-- 영화 4층 ul -->
              <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                <!-- 영화 5층 li -->
                <?php
                  $main_list=1;
                  while($row = mysqli_fetch_array($result)){
                   $mv_num = $row['mv_num'];
                   $review_rating = $row['review_rating'];
                   $mv_release_date = $row['mv_release_date'];
                   $mv_title = $row['mv_title'];
                   $mv_img_path = $row['mv_img_path'];
                ?>
                <li class="css-MainList-li e3fgkal0">
                  <!-- 영화 6층 a -->
                  <a title="<?=$mv_title?>" href="#">
                    <!-- 6층 포스터 -->
                    <div class="css-MainContentPosterBlock e3fgkal1">
                      <!-- 포스터 설정 -->
                      <div class=" css-MainPosterBlock-MainPosterBlock ewlo9840">
                        <img src="<?=$mv_img_path?>" class="css-StyledMainPosterBlock ewlo9841">
                      </div>
                      <!-- 포스터 랭크 -->
                      <div class="css-RankBadge e3fgkal7"><?=$main_list?></div>
                    </div>
                    <!-- 6층 설명 -->
                    <div class="css-MainContentBlock e3fgkal2">
                      <!-- 영화설명_제목 -->
                      <div class="css-ContentTitle e3fgkal3"><?=$mv_title?></div>
                      <!-- 영화설명_출시년도 -->
                      <div class="css-StyledContentYear ebeya3l12"><?=$mv_release_date?></div>
                      <!-- 영화설명_평점 -->
                      <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                        <span>평점</span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-IcRatingStarSvg erjycaa0">
                            <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                          </svg>
                        <span><?=$review_rating?></span>
                      </div>
                    </div>
                  </a>
                </li><!-- END 영화 5층 li -->
                <?php
                  $main_list++;
                  } // END while
                ?>
              </ul>
            </div>
          </div>
        </div> <!-- END 영화 1층 -->
      </div> <!-- END 영화로비 -->
    </div>
  </div> <!-- END 타이틀과 영화항목 베스트리뷰 -->
</div><!-- END 베스트 총 리스트 -->

<?php
  $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_regtime desc";
  $result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 최근 총 리스트 -->
<div class="css-MainDiv ebeya3l11">
  <!-- 타이틀과 영화항목 최근리뷰 -->
  <div class="css-MainListContainer ebeya3l2">
    <!-- 타이틀 -->
    <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
      <!-- 타이틀 설정 -->
      <p class="css-StyledMainListTitle ebeya3l6">최근 리뷰</p>
    </div>
    <!-- 영화항목 -->
    <div class="css-StyledMainScrollOuterContainer ebeya3l4">
      <!-- 영화 로비 -->
      <div class="css-ScrollBarContainer e1f5xhlb0">
        <!-- 영화 1층 -->
        <div class="css-ScrollBar e1f5xhlb1">
          <!-- 영화 2층 -->
          <div class="css-ScrollingTaim e1f5xhlb2">
            <!-- 영화 3층 -->
            <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
              <!-- 영화 4층 ul -->
              <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                <!-- 영화 5층 li -->
                <?php
                  $main_list3 = 1;
                  while($row = mysqli_fetch_array($result)){
                    $mv_num = $row['mv_num'];
                    $review_rating = $row['review_rating'];
                    $mv_release_date = $row['mv_release_date'];
                    $mv_title = $row['mv_title'];
                    $mv_img_path = $row['mv_img_path'];
                ?>
                <li class="css-MainList-li e3fgkal0">
                  <!-- 영화 6층 a -->
                  <a title="<?=$mv_title?>" href="#">
                    <!-- 6층 포스터 -->
                    <div class="css-MainContentPosterBlock e3fgkal1">
                      <!-- 포스터 설정 -->
                      <div class=" css-MainPosterBlock-MainPosterBlock ewlo9840">
                        <img src="<?=$mv_img_path?>" class="css-StyledMainPosterBlock ewlo9841">
                      </div>
                      <!-- 포스터 랭크 -->
                      <div class="css-RankBadge e3fgkal7"><?=$main_list3?></div>
                    </div>
                    <!-- 6층 설명 -->
                    <div class="css-MainContentBlock e3fgkal2">
                      <!-- 영화설명_제목 -->
                      <div class="css-ContentTitle e3fgkal3"><?=$mv_title?></div>
                      <!-- 영화설명_출시년도 -->
                      <div class="css-StyledContentYear ebeya3l12"><?=$mv_release_date?></div>
                      <!-- 영화설명_평점 -->
                      <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                        <span>평점</span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-IcRatingStarSvg erjycaa0">
                            <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                          </svg>
                        <span><?=$review_rating?></span>
                      </div>
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
        </div> 
      </div> <!-- END 영화로비 -->
    </div>
  </div> <!-- END 타이틀과 영화항목 최근리뷰 -->
</div><!-- END 최근 총 리스트 -->

<?php
  $sql = "select R.review_rating, R.review_short, M.mv_title, M.mv_img_path, U.user_nickname from review R 
            inner join movie M on R.mv_num = M.mv_num
            inner join user U on R.user_num = U.user_num
            order by R.review_regtime desc;";
  $result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 한줄리뷰 총 리스트 -->
<div class="css-gxko42-StyledHomeListContainer ebeya3l2">
  <!-- 타이틀과 영화항목 장르리스트 -->
  <div class="css-1ewd6nb-StyledHomeListTitleRow-StyledHomeListTitleRow ebeya3l3">
    <!-- 타이틀 -->
    <p class="css-1e8eq80-StyledHomeListTitle ebeya3l6">한줄평 리뷰</p>
  </div>
  <!-- 장르별리스트 div 로비 css여기까지만 작업했음 지금 만드는 틀 전부 만들고 작업 ㄱㄱ -->
  <div class="css-1pik52h-StyledHorizontalScrollOuterContainer ebeya3l4">
    <!-- 장르별리스트 div 1층 -->
    <div class="css-1yw8v4t-ScrollBarContainer e1f5xhlb0">
      <!-- 장르별리스트 div 2층 -->
      <div class="css-chidac-ScrollBar e1f5xhlb1">
        <!-- 장르별리스트 div 3층 -->
        <div class="css-150y45-ScrollingInner e1f5xhlb2">
          <!-- 장르별리스트 ul -->
          <ul class="ebeya3l0 css-oudgax-VisualUl-StyledHorizontalUl-StyledHorizontalUlWithContentPosterList-RowList eykn4p10">
            <?php
              $main_list4 = 1;
              while($row = mysqli_fetch_array($result)){
                $mv_title = $row['mv_title'];
                $review_rating = $row['review_rating'];
                $review_short = $row['review_short'];
                $mv_img_path = $row['mv_img_path'];
                $user_nickname = $row['user_nickname'];
            ?>
            <!-- 장르별리스트 li -->
            <li class="css-106b4k6-Self e3fgkal0">
              <!-- 장르별리스트 a -->
              <a title="<?=$mv_title?>" href="#">
                <!-- 장르별리스트 div 영화포스터 -->
                <div class="css-wg9zzb-ContentPosterBlock e3fgkal1">
                  <!-- 장르별리스트 img -->
                  <div class=" e1pon7hn0 css-1hdc5d8-Self-LazyLoadingImg ewlo9840">
                    <!-- 장르별리스트 img 설정 -->
                    <img src="<?=$mv_img_path?>" class=" e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841" alt="">
                    <!-- 장르별리스트 img 스템프 -->
                    <div class="ottBadge css-cq1n1p-OttBadge e3fgkal8" src="" alt="왓챠!">dd</div>
                  </div>
                </div>
                <!-- 장르별리스트 div 영화설명 -->
                <div class="css-dmreg0-ContentInfo e3fgkal2">
                  <!-- 장르별리스트 div 영화제목 -->
                  <div class="css-1teivyt-ContentTitle e3fgkal3"><?=$mv_title?></div>
                  <!-- 장르별리스트 div 영화평점 -->
                  <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                    <span>평점</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-IcRatingStarSvg erjycaa0">
                        <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                      </svg>
                    <span><?=$review_rating?></span>
                  </div>
                  <!-- 장르별리스트 div 리뷰작성자 -->
                  <div class="css-1teivyt-ContentShortMemberNick">작성자 : <?=$user_nickname?></div>
                  <!-- 장르별리스트 div 영화리뷰 -->
                  <div class="css-1teivyt-ContentShort"><?=$review_short?></div>
                </div>
              </a>
            </li>
            <?php
              $main_list4++;
              } // END while
            ?>
          </ul>
        </div>
      </div>
      <!-- 장르별리스트 div 로비 양쪽 틈 -->
      <div direction="left" class="css-1piyrvy-CheatBlock e1f5xhlb4"></div>
      <div direction="right" class="css-1avws16-CheatBlock e1f5xhlb4"></div>
      <!-- 장르별리스트 div 로비 왼쪽버튼 -->
      <div class="arrow_button css-1d4tu36-ArrowButtonBlock e1f5xhlb3" direction="left">
        <div class="css-1o4i6uc-BackwardButton e1f5xhlb6"></div>
      </div>
      <!-- 장르별리스트 div 로비 오른쪽버튼 -->
      <div class="arrow_button css-cj0kkg-ArrowButtonBlock e1f5xhlb3" direction="right">
        <div class="css-kb0601-ForwardButton e1f5xhlb5">
          <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K" alt="forward">
        </div>
      </div>
    </div><!-- END 장르별리스트 div 1층 -->
  </div><!-- END 장르별리스트 div 로비 -->
</div><!-- END 한줄리뷰 총 리스트 -->

<?php
  $sql = "select R.review_rating, R.review_short, M.mv_title, M.mv_img_path, U.user_nickname from review R 
            inner join movie M on R.mv_num = M.mv_num
            inner join user U on R.user_num = U.user_num
            order by R.review_regtime desc;";
  $result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 한줄리뷰 총 리스트 -->
<div class="css-gxko42-StyledHomeListContainer ebeya3l2">
  <!-- 타이틀과 영화항목 장르리스트 -->
  <div class="css-1ewd6nb-StyledHomeListTitleRow-StyledHomeListTitleRow ebeya3l3">
    <!-- 타이틀 -->
    <p class="css-1e8eq80-StyledHomeListTitle ebeya3l6">한줄평 리뷰</p>
  </div>
  <!-- 장르별리스트 div 로비 css여기까지만 작업했음 지금 만드는 틀 전부 만들고 작업 ㄱㄱ -->
  <div class="css-1pik52h-StyledHorizontalScrollOuterContainer ebeya3l4">
    <!-- 장르별리스트 div 1층 -->
    <div class="css-1yw8v4t-ScrollBarContainer e1f5xhlb0">
      <!-- 장르별리스트 div 2층 -->
      <div class="css-chidac-ScrollBar e1f5xhlb1">
        <!-- 장르별리스트 div 3층 -->
        <div class="css-150y45-ScrollingInner e1f5xhlb2">
          <!-- 장르별리스트 ul -->
          <ul class="ebeya3l0 css-oudgax-VisualUl-StyledHorizontalUl-StyledHorizontalUlWithContentPosterList-RowList eykn4p10">
            <?php
              $main_list4 = 1;
              while($row = mysqli_fetch_array($result)){
                $mv_title = $row['mv_title'];
                $review_rating = $row['review_rating'];
                $review_short = $row['review_short'];
                $mv_img_path = $row['mv_img_path'];
                $user_nickname = $row['user_nickname'];
            ?>
            <!-- 장르별리스트 li -->
            <li class="css-106b4k6-Self e3fgkal0">
              <!-- 장르별리스트 a -->
              <a title="<?=$mv_title?>" href="#">
                <!-- 장르별리스트 div 영화포스터 -->
                <div class="css-wg9zzb-ContentPosterBlock e3fgkal1">
                  <!-- 장르별리스트 img -->
                  <div class=" e1pon7hn0 css-1hdc5d8-Self-LazyLoadingImg ewlo9840">
                    <!-- 장르별리스트 img 설정 -->
                    <img src="<?=$mv_img_path?>" class=" e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841" alt="">
                    <!-- 장르별리스트 img 스템프 -->
                    <div class="ottBadge css-cq1n1p-OttBadge e3fgkal8" src="" alt="왓챠!">dd</div>
                  </div>
                </div>
                <!-- 장르별리스트 div 영화설명 -->
                <div class="css-dmreg0-ContentInfo e3fgkal2">
                  <!-- 장르별리스트 div 영화제목 -->
                  <div class="css-1teivyt-ContentTitle e3fgkal3"><?=$mv_title?></div>
                  <!-- 장르별리스트 div 영화평점 -->
                  <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                    <span>평점</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-IcRatingStarSvg erjycaa0">
                        <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                      </svg>
                    <span><?=$review_rating?></span>
                  </div>
                  <!-- 장르별리스트 div 리뷰작성자 -->
                  <div class="css-1teivyt-ContentShortMemberNick">작성자 : <?=$user_nickname?></div>
                  <!-- 장르별리스트 div 영화리뷰 -->
                  <div class="css-1teivyt-ContentShort"><?=$review_short?></div>
                </div>
              </a>
            </li>
            <?php
              $main_list4++;
              } // END while
            ?>
          </ul>
        </div>
      </div>
      <!-- 장르별리스트 div 로비 양쪽 틈 -->
      <div direction="left" class="css-1piyrvy-CheatBlock e1f5xhlb4"></div>
      <div direction="right" class="css-1avws16-CheatBlock e1f5xhlb4"></div>
      <!-- 장르별리스트 div 로비 왼쪽버튼 -->
      <div class="arrow_button css-1d4tu36-ArrowButtonBlock e1f5xhlb3" direction="left">
        <div class="css-1o4i6uc-BackwardButton e1f5xhlb6"></div>
      </div>
      <!-- 장르별리스트 div 로비 오른쪽버튼 -->
      <div class="arrow_button css-cj0kkg-ArrowButtonBlock e1f5xhlb3" direction="right">
        <div class="css-kb0601-ForwardButton e1f5xhlb5">
          <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K" alt="forward">
        </div>
      </div>
    </div><!-- END 장르별리스트 div 1층 -->
  </div><!-- END 장르별리스트 div 로비 -->
</div><!-- END 한줄리뷰 총 리스트 -->
