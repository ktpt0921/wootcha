<body onload="setSelectSear();">
    <div class="body_wrap">
        <div class="follow_list_wrap">
            <div class="follow_list_background">
                <?php
                //페이지 수 체크한다.
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }

                //검색어 있을때
                if ($search != "") {
                    //네이버 검색 함수
                    $result = Movie_info::search_movie_title($search, $country, $genre);
                    $total_record = count($result);

                    // 네이버 별점순 정렬
                    foreach ($result as $key => $value) {
                        $sort[$key] = $value['userRating'];
                    }
                    array_multisort($sort, SORT_DESC, $result);

                    //검색어 없을때
                } else if ($search == "") {
                    $total_record = 0;
                }
                ?>

                <!-- select box -------------------------------------------------------------------------------------->
                <div class="follow_list_select">
                    <h2>
                        <span id="view_all_search"></span>
                        <span id="view_all_review">영화 리스트 (전체)</span>
                        <span id="view_all_title"></span>
                    </h2>

                    <span id="follow_total_span">총 <span id="follow_total_num"><?= $total_record ?></span> 개의 영화가 있습니다.</span>
                </div>

                <!-- start of ul ------------------------------------------------------------------------------------->

                <ul class="follow_unorder_list">
                    <?php
                    $scale = 10;

                    if ($total_record % $scale == 0) {
                        $total_page = floor($total_record / $scale);
                    } else {
                        $total_page = floor($total_record / $scale) + 1;
                    }

                    $page_setting = ($page - 1) * $scale;

                    $page_start = $total_record - $page_setting;

                    for ($i = $page_setting;
                    $i < $page_setting + $scale && $i < $total_record;
                    $i++) {

                    // 영화 정보 가져오기
                    $item = $result[$i]; //인덱스

                    $title = $item['title']; // 영화 제목
                    $subTitle = $item["subtitle"]; // 부제
                    $small_poster_img = $item["image"]; // 포스터
                    $naver_star = $item["userRating"]; // 네이버 평점
                    $naver_star = sprintf('%0.1f', $naver_star);
                    $naverLink = $item["link"];   //네이버 영화 링크
                    $movie_code = Movie_info::explode_code($naverLink);

                    // 리뷰수
                    $sql = "select count(mv_num) as `count` from review where mv_num = {$movie_code};";
                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($res);

                    $review_count = $row['count']; // 리뷰 수

                    $sql = "select mv_num, count(mv_num) as count from fav_movie where mv_num = {$movie_code} group by mv_num";
                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($res);

                    if ($row['count']) {
                        $like_count = $row['count'];              // 좋아요 수
                    } else {
                        $like_count = 0;
                    }
                    ?>

                    <li>
                        <div class="follow_list_column">

                            <!--json으로 영화 데이터 보냄 => 영화 상세페이지 -->
                            <a href="/wootcha/movie_introduce_page/movie_introduce_index.php?item=<?= urlencode(json_encode($item)) ?>">
                                <div class="follow_list_column_img">
                                    <?php
                                    if ($small_poster_img == "") {
                                        ?>
                                        <!--엑박 방지 디폴트 이미지-->
                                        <img src="img/defualt_poster.jpg">
                                        <?php
                                    } else {
                                        ?>
                                        <img src=<?= $small_poster_img ?> alt="">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="follow_list_column_text">
                                    <h1 id="follow_text_movie"><?= $title ?>
                            </a>

                            </h1>
                            <p id="follow_text_district"><?= $subTitle ?></p>

                            <div class="follow_list_column_review">
                                <span id="movie_review_span"> 웃챠 리뷰 <span
                                            id="movie_review_num"><?= $review_count ?></span></span>
                                <span id="movie_review_span"> 좋아요 <span id="movie_review_num"><?= $like_count ?></span></span>
                            </div>
                        </div>

                        <!-- 오른쪽 별점 & 삭제버튼 -->
                        <div class="follow_list_column_sub">

                            <!--하트-->
                            <div class="follow_movie_like">
                                <?php
                                if ($user_num) {

                                    $sql = "select exists(select * from fav_movie where user_num = {$user_num} and mv_num = {$movie_code}) as exist;";
                                    $res = mysqli_query($con, $sql); 
                                    $row = mysqli_fetch_array($res);

                                    if ($row['exist']) {
                                        echo "<a href='unfollow.php?no={$movie_code}'><button type='button' id='button_movie_like_on'>like</button></a>";
                                    } else {
                                        echo "<a href='follow.php?no={$movie_code}'><button type='button' id='button_movie_like_off'>like</button></a>";
                                    }
                                    ?>

                                    <?php
                                } else {
                                    ?>
                                    <a href="javascript:alert('로그인 후 이용 가능합니다.')">
                                        <button type="button" id="button_movie_like_off">like</button>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="follow_movie_star_wrap">
                                <div class="startRadio">
                                    <?php
                                    $find_rating = 0.5;

                                    while ($find_rating <= 5) {
                                        // 반복문으로 rating bar 생성 및 checked 설정
                                        if ($find_rating <= ($naver_star / 2)) {
                                            $rating_checked = "checked";
                                        } else {
                                            $rating_checked = "";
                                        }
                                        echo "
                                                <label class='startRadio__box'>
                                                    <input type='radio' name='review_rating_$i' value='$find_rating' $rating_checked disabled='disabled'>
                                                    <span class='startRadio__img'><span class='blind'></span></span>
                                                </label>";
                                        $find_rating += 0.5;
                                    }
                                    ?>
                                </div>
                                <div class="follow_movie_star_num"><?= $naver_star ?></div>
                            </div>
                        </div>
            </div>
            </li>

            <?php
            $page_start--;
            }

            ?>

            </ul>
            <!-- end of ul ------------------------------------------------------------------>

            <div class="page_num_wrap">
                <div class="page_num">
                    <ul class="page_num_ul">
                        <?php
                        $url = '/wootcha/search/search_index.php?search_keyword='.$search.'&country='.$country.'&genre='.$genre;

                        // 페이지 쪽수 표시 량 (5 페이지씩 표기)
                        $page_scale = 5;

                        // 페이지 그룹번호(페이지 5개가 1그룹)
                        $pageGroup = ceil($page / $page_scale);

                        //그룹번호 안에서의 마지막 페이지 숫자
                        $last_page = $pageGroup * $page_scale;

                        // 그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
                        if ($total_page < $page_scale) {
                            $last_page = $total_page;
                        } else if ($last_page > $total_page) {
                            $last_page = $total_page;
                        }

                        //그룹번호의 첫번째 페이지 숫자
                        $first_page = $last_page - ($page_scale - 1);

                        //그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
                        if ($first_page < 1) {
                            $first_page = 1;

                            //마지막 그룹번호일때 첫번째 페이지값 결정
                        } else if ($last_page == $total_page) {

                            if ($total_page % $page_scale == 0) {
                                $first_page = $total_page - $page_scale + 1;
                            } else {
                                $first_page = $total_page - ($total_page % $page_scale) + 1;
                            }
                        }

                        $next = $last_page + 1; // > 버튼 누를때 나올 페이지
                        $prev = $first_page - 1; // < 버튼 누를때 나올 페이지

                        // 첫번째 페이지일 때 앵커 비활성화
                        if ($first_page == 1) {

                            if ($page != 1) {
                                echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            } else {
                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            }
                            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";

                        } else {
                            echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            echo "<li><a href='$url&page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                        }

                        //페이지 번호 매기기
                        for ($i = $first_page; $i <= $last_page; $i++) {

                            if ($page == $i) {
                                echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                            } else {
                                echo "<li><a href='$url&page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                            }
                        }

                        // 마지막 페이지일 때 앵커 비활성화
                        if ($last_page == $total_page) {
                            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                            if ($page != $total_page) {
                                echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            } else {
                                echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            }
                        } else {
                            echo "<li><a href='$url&page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                            echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- end of page_num_wrap -------------------------------------------------------->
        </div>
    </div>
</body>