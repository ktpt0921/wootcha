<?php
// /Users/hong-yongcheon/Sites DB연결 
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
///Users/hong-yongcheon/Sites 테이블을 만듦
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/create_table.php";

create_table($con,'qna_board');//자유게시판테이블생성
create_table($con,'qna_reply');//자유게시판덧글테이블생성

//상수선언 스케일이라고 쓰면 10이다
define('SCALE', 10);
$memo_content="";

//isset으로 겟 모드로 들어왔는지 확인하고 겟방식으로 들어온 모드가 search인지 확인
if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
  //제목, 내용, 아이디

  //입력받은 find search값의 데이터에 불필요한 것이 없도록 test input으로 검사
  $find = test_input($_POST["find"]);
  $search = test_input($_POST["search"]);
  //우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
  //이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
  $q_search = mysqli_real_escape_string($con, $search);
  $sql="SELECT * from `qna_board` where $find like '%$q_search%' order by qna_num desc;";
}else{
  // $sql="SELECT * from `qna_board` order by qna_num desc";
  $sql = "SElECT * from `qna_board` a join `user` b on a.user_num=b.user_num order by qna_num desc";
}

$result=mysqli_query($con,$sql);
// 행의 개수를 구해서 total_recorde에 저장한다
$total_record=mysqli_num_rows($result);
//total_page를 scale로 나눴을 때 0인가? 그려면 1 아니면 반올림한다
$total_page=($total_record % SCALE == 0 )?($total_record/SCALE):(ceil($total_record/SCALE));

//2.페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

// 페이지 수에서 1을 빼고 스케일을 곱한 값을 저장하고 
//행의 개수인 토탈 리코드에서 스타트를 빼고 그 값을 넘버에 저장한다 
$start=($page -1) * SCALE;
$number = $total_record - $start;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/question/css/greet.css">
    <script type="text/javascript" src="./js/member_form.js"></script>
    <script src="../js/vendor/jquery-1.10.2.min.js"></script>
    <!-- script는 웹페이지에 스크립트를 추가한다 -->
    <script src="../js/vendor/jquery-ui-1.10.3.custom.min.js?ver=3"></script>
    <script src="../js/main.js"></script>
    <title></title>
  </head>
  <body>
  <header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
  </header> 
  <!-- <div id="main_img_bar">
		<img src= "http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/img/main_img.png">
  </div>  -->
  
  <div id="wrap">
      <div id="content">
      <div id="col2">
         <div id="title">
            <h3>답변형 게시판 > 목록보기</h3>
         </div>
         <form name="board_form" action="list.php?mode=search" method="post">
           <div id="list_search">
             <div id="list_search1">총 <?=$total_record?>개의 게시물이 있습니다.</div>
             <div id="list_search2"> <img src="./img/select_search.gif"></div>
             <div id="list_search3">
               <select  name="find">
                 <option value="subject">제목</option>
                 <option value="content">내용</option>
                 <option value="nick">별명</option>
                 <option value="name">이름</option>
                 <option value="id">아이디</option>
               </select>
             </div><!--end of list_search3  -->
             <div id="list_search4"><input type="text" name="search"></div>
             <div id="list_search5"> <input type="image" src="./img/list_search_button.gif"></div>
           </div><!--end of list_search  -->
         </form>
         <div id="clear"></div>
         <div id="list_top_title">
           <ul>
             <li id="list_title1"><img src="./img/list_title1.gif"></li>
             <li id="list_title2"><img src="./img/list_title2.gif"></li>
             <li id="list_title3"><img src="./img/list_title3.gif"></li>
             <li id="list_title4"><img src="./img/list_title4.gif"></li>
             <li id="list_title5"><img src="./img/list_title5.gif"></li>
           </ul>
         </div><!--end of list_top_title  -->

         <div id="list_content">

         <?php
        //i가 스타트와 같음, i가 스타트와 스케일의 합보다 작고 토탈리코드보다 작으면 i값을 늘린다
        //토탈리코드는 행의 갯수 스타트는 $start=($page -1) * SCALE;
          for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
            //mysqli_data_seek 함수는 리절트 셋(result set)에서
            // 원하는 순번의 데이터를 선택하는데 쓰입니다.
            //리저트에서 i의 번째를 선택한다
            mysqli_data_seek($result,$i);
            //리코드 셋을 배열로 만든다
            $row=mysqli_fetch_array($result);
            $num=$row['qna_num'];
            $id=$row['qna_title'];
            $name=$row['user_nickname'];
            // $nick=$row['nick'];
            $hit=$row['qna_hit'];
            //등록일자를 date에 저장하는데 0번째숫자부터 10자리의 숫자를 저장한다
            $date= substr($row['qna_regtime'],0,10);
            $subject=$row['qna_title'];
            //str_replace라는 함수는 문자열에 특정 단어가 포함되어 있는 부분을 원하는 값으로 치환
            // \n이 들어가면 줄바꿈 " "공백이면 한칸 띄운 서브젝트를 반환한다
            $subject=str_replace("\n", "<br>",$subject);
            $subject=str_replace(" ", "&nbsp;",$subject);
            if ($row["file_name_0"])
      	      $file_image = "<img src='./img/file.gif'>";
            else
      	      $file_image = " ";
        ?>
            <div id="list_item">
              <div id="list_item1"><?=$number?></div>
              <div id="list_item2">
                  <a href="./view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$subject?></a>
                  
              </div>
              <div id="list_item3"><?=$file_image?><?=$name?></div>
              <div id="list_item4"><?=$date?></div>
              <div id="list_item5"><?=$hit?></div>
            </div><!--end of list_item -->
            <div id="memo_content"><?=$memo_content?></div>
        <?php
            $number--;
         }//end of for
        ?>

        <div id="page_button">
          <div id="page_num">이전◀ &nbsp;&nbsp;&nbsp;&nbsp;
          <?php
            // 페이지 숫자를 보여줌
            for ($i=1; $i <= $total_page ; $i++) {
              if($page==$i){
                echo "<b>&nbsp;$i&nbsp;</b>";
              }else{
                echo "<a href='./list.php?page=$i'>&nbsp;$i&nbsp;</a>";
              }
            }
          ?>
          &nbsp;&nbsp;&nbsp;&nbsp;▶ 다음
          <br><br><br><br><br><br><br>
        </div><!--end of page num -->
        <div id="button">
          <a href="./list.php?page=<?=$page?>"> <img src="./img/list.png" alt="">&nbsp;</a>
          <?php //세션에 아이디가 있으면 글쓰기 버튼을 보여줌.
            if(!empty($_SESSION['userid'])){
            echo '<a href="write_edit_form.php"><img src="./img/write.png"></a>';
            }
          ?>
        </div><!--end of button -->
      </div><!--end of page button -->
      </div><!--end of list content -->

      </div><!--end of col2  -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer> 
  </body>
</html>
