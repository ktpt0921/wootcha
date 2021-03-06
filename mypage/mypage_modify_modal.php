<!-- ****************** -->
<!-- css -->
<!-- ****************** -->
<style type="text/css"> 
    /* 빈공간을 어둡게 채우는 창 */
    .modal_container_mypage { position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);  z-index: 1; 
        opacity: 1;  visibility: hidden; transform: scale(1.0); transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s; } 

    /* 흰 화면의 dialog 부분 */
    .modal_container_mypage .modal_content_mypage {  position: absolute;   top: 50%;  left: 50%;  transform: translate(-50%, -50%); background-color: #F5F5F7; 
         padding: 1rem 1.5rem;   width: 400px;  height: 450px;   border-radius: 0.5rem; text-align:center; overflow:hidden;} 

    /* 끄기 버튼 */
    .modal_container_mypage .modal_close_btn_modify { float: right; width: 1.5rem; line-height: 1.5rem; text-align: center; cursor: pointer; 
        border-radius: 0.25rem; background-color: lightgray; }
    .modal_container_mypage .modal_close_btn_modify:hover { background-color: darkgray; }     

    /* 상단 닉네임 및 평점 부분 */
    .modal_container_mypage .modal_content_mypage_header{height: 50px; width:95%; position:relative;}

    /* 프로필 이미지 */
    .modal_container_mypage .small_img_box{ width: 45px; height: 45px; border-radius: 50%; overflow: hidden; display:inline-block;}
    .modal_container_mypage .small_img_box img{width: 100%; height: 100%; object-fit: cover;}
    
    /* 회원가입 폼 */
    .modal_content_mypage form{width:100%;text-align:center; margin-top:10px; margin-bottom:10px;}
    .modal_content_mypage form table{width:100%;}
    .modal_content_mypage form table tr:nth-child(odd){height:60px}
    .modal_content_mypage form table tr:nth-child(odd) td{width:100%; line-height:60px; text-align:center;}
    .modal_content_mypage form table tr:nth-child(even){display:none; width:100%;height:20px;text-align:center;}
    .modal_content_mypage form table tr:nth-child(even) td{width:100%; line-height:20px; text-align:center;}
    .modal_content_mypage form table p{width:100%;height:15px; line-height:20px; text-align:center;}
    .modal_content_mypage form table td input[type=text],[type=password],[type=tel],[type=date]{width:300px;height:50px; font-size:15px;text-align:left;}
    .modal_content_mypage form table td input{height:50px;}
    /* 생년월일 */
    .modal_content_mypage form table tr:nth-child(5) td{position:relative;}
    .modal_content_mypage form table tr:nth-child(5) label{position:absolute; top: 50%;  left: 50%;  transform: translate(-50%, -50%); color:gray;}
    .modal_content_mypage form table tr:nth-child(5) input:focus ~ label,
    .modal_content_mypage form table tr:nth-child(5) input:valid ~ label {display:none;}
    .modal_content_mypage form table tr:nth-child(5) input[type=date]{text-align:left;}
    /* gender */
    /* .modal_content_mypage #modify_form table tr:nth-child(7) label{text-align:center; line-height:50px; font-size:20px}
    .modal_content_mypage #modify_form table tr:nth-child(7) input{text-align:center; line-height:50px; font-size:20px} */
    /* user_img */
    .modal_content_mypage #modify_form table tr:nth-child(7) img{width: 45px; height: 45px; margin-left:5px; margin-right:5px}
    
    /* 수정하기 버튼 */
    .modal_content_mypage #modify_form input[type=button]{width:90%; height: 40px; background-color:rgb(44, 44, 44); border-style:none;
        border-radius: 0.5rem;font-size:20px;font-weight: bold; color:#F5F5F7;}
        .logo_image_box{width:110px; height:45px;overflow: hidden; display:inline-block;}
        .logo_image_box img{width: 100%; height: 100%; object-fit: cover;}
    input[type=button]{width: 90%;
    height: 40px;
    background-color: rgb(44, 44, 44);
    border-style: none;
    border-radius: 0.5rem;
    font-size: 20px;
    font-weight: bold;
    color: #F5F5F7;}
</style>

<!-- ****************** -->
<!-- php -->
<!-- ****************** -->
<div class="modal_container_mypage" name="modal_container_mypage"> 
    <div class="modal_content_mypage"> 
        <!-- 닫기 버튼 -->
        <span class="modal_close_btn_modify">&times;</span>
        <!-- 상단 로고 -->
        <div class="modal_content_mypage_header">
            <!-- 로고 -->
            <div class="logo_image_box">
                <img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/img/logo.png" alt="로고">
            </div> 
        </div>
    
        <!-- ***************** -->
        <!-- 수정하는 데이터 -->
        <!-- ***************** -->
        <hr width="99%" color="#e2e2e2" noshade/>
        <form action="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/user/user_modify.php" id="modify_form" name="modify_form" method="post">
            <table>
            <!-- 비밀번호 -->
            <tr><td>
                    <input type="password" id="modify_password" name="modify_password" placeholder="비밀번호" onblur="checkPass_modify()">
            </td></tr>
            <tr id="hidden_bar_password_modify"><td><p id="modify_password_ck"></p></td></tr>
            
            <!-- 비밀번호  확인-->
            <tr><td>
                    <input type="password" id="modify_password_re" name="modify_password_re" placeholder="비밀번호 확인" onblur="checkPass_modify_re()">
            </td></tr>
            <tr id="hidden_bar_password_modify_re"><td><p id="modify_password_re_ck"></p></td></tr>
            
            <!-- 전화번호 -->
            <tr><td>
                    <input type="tel" id="modify_phone" name="modify_phone" placeholder="휴대전화 : <?=$user_phone?>" onblur="checkPhone()">
            </td></tr>
            <tr id="hidden_bar_phone"><td><p id="modify_phone_ck"></p></td></tr>

            <!-- 아바타 -->
            <?php
                if ($user_img == "user_robot_avatar0.png") {
                    $img_0 = "checked"; $img_1 = ""; $img_2 = ""; $img_3 = ""; 
                }elseif($user_img == "user_robot_avatar1.png"){
                    $img_0 = ""; $img_1 = "checked"; $img_2 = ""; $img_3 = ""; 
                }elseif($user_img == "user_robot_avatar2.png"){
                    $img_0 = ""; $img_1 = ""; $img_2 = "checked"; $img_3 = ""; 
                }elseif($user_img == "user_robot_avatar3.png"){
                    $img_0 = ""; $img_1 = ""; $img_2 = ""; $img_3 = "checked"; 
                }else{
                    
                }
            ?>
            <tr><td>
                    <input type="radio" id="user_avatar_1" name="user_avatar" value="user_robot_avatar0.png" <?= $img_0?>>
                    <label for="user_avatar_1"><img src="../user/img/user_robot_avatar0.png" alt=""></label>
                    <input type="radio" id="user_avatar_2" name="user_avatar" value="user_robot_avatar1.png" <?= $img_1?>>
                    <label for="user_avatar_2"><img src="../user/img/user_robot_avatar1.png" alt=""></label>
                    <input type="radio" id="user_avatar_3" name="user_avatar" value="user_robot_avatar2.png" <?= $img_2?>>
                    <label for="user_avatar_3"><img src="../user/img/user_robot_avatar2.png" alt=""></label>
                    <input type="radio" id="user_avatar_4" name="user_avatar" value="user_robot_avatar3.png" <?= $img_3?>>
                    <label for="user_avatar_4"><img src="../user/img/user_robot_avatar3.png" alt=""></label>
            </td></tr>
        </table>
        <input type="button" value="수정" onclick="allCheckModify()">
        </form>
        <!-- <button> api 가입하기 </button> -->
        <input type="button" onclick="withdrawal()" value="회원 탈퇴">
        <!-- <a href="#" onclick="withdrawal()">회원탈퇴</a> -->
    </div>
</div>

<!-- ****************** -->
<!-- javascript -->
<!-- ****************** -->
    <script type="text/javascript"> 
        // Modal을 가져옵니다.
        var modal_container_mypage = document.getElementsByClassName("modal_container_mypage");
        // Modal을 띄우는 클래스 이름을 가져옵니다.
        var trigger_mypage_modify = document.getElementsByClassName("trigger_mypage_modify");
        // Modal을 닫는 close 클래스를 가져옵니다.
        var modal_close_btn_modify = document.getElementsByClassName("modal_close_btn_modify");
        var funcs = [];

        // Modal을 띄우고 닫는 클릭 이벤트를 정의한 함수
        function Modal(num) {
          return function() {
            // 해당 클래스의 내용을 클릭하면 Modal을 띄움
            trigger_mypage_modify[num].onclick =  function() {
                modal_container_mypage[num].style.visibility = "visible";
                console.log(num);
            };
        
            // <span> 태그(X 버튼)를 클릭하면 Modal이 닫습니다.
            modal_close_btn_modify[num].onclick = function() {
                modal_container_mypage[num].style.visibility = "hidden";
            };
          };
        }

        // 원하는 Modal 수만큼 Modal 함수를 호출해서 funcs 함수에 정의합니다.
        for(var i = 0; i < trigger_mypage_modify.length; i++) {
          funcs[i] = Modal(i);
        }

        // 원하는 Modal 수만큼 funcs 함수를 호출합니다.초기화 하는 역할
        for(var j = 0; j < trigger_mypage_modify.length; j++) {
          funcs[j]();
        }


   
    // 비밀번호
    modify_password = document.getElementById('modify_password');
    modify_password_ck = document.getElementById('modify_password_ck');
    hidden_bar_password_modify = document.getElementById('hidden_bar_password_modify');
    // 비밀번호 확인
    modify_password_re = document.getElementById('modify_password_re');
    modify_password_re_ck = document.getElementById('modify_password_re_ck');
    hidden_bar_password_modify_re = document.getElementById('hidden_bar_password_modify_re');
    // 전화번호
    modify_phone = document.getElementById('modify_phone');
    modify_phone_ck = document.getElementById('modify_phone_ck');
    hidden_bar_phone = document.getElementById('hidden_bar_phone');


    function checkPass_modify() {
        var pass = modify_password.value;
        var passReg = /^.*(?=^.{4,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@$%^&*]).*$/;
        if (!passReg.test(pass)) {
            var text = "4~12자리의 영문,숫자,특수문자(!, @, $, %, ^,&,*)로 구성해야합니다.";
            notifyText_back_modify(modify_password_ck, text, hidden_bar_password_modify);
            return false;
        } else {
            notifyText_ok_modify(hidden_bar_password_modify);
            return true;
        }
    }

    function checkPass_modify_re() {
        var pass = modify_password.value;
        var pass2 = modify_password_re.value;

            if (pass !== pass2) {
                var text = "비밀번호가 일치하지 않습니다.";
                notifyText_back_modify(modify_password_re_ck, text, hidden_bar_password_modify_re);
                return false;
            } else {
                notifyText_ok_modify(hidden_bar_password_modify_re);
                return true;
            }
    }

    function checkPhone() {
        var name = modify_phone.value;
        var nameReg = /^\d{3}-\d{3,4}-\d{4}$/;
        if (!nameReg.test(name)) {
            var text = "휴대전화가 올바르지 않습니다.";
            notifyText_back_modify(modify_phone_ck, text, hidden_bar_phone);
            return false;
        } else {
            notifyText_ok_modify(hidden_bar_phone);
            return true;
        }
    }

    // 정규식 맞지 않을 때 사용하는 함수
    function notifyText_back_modify(id, text, hidden_bar) {
        hidden_bar.style.display = 'inline-block';
        id.innerHTML = text;
        id.style.color = 'red';
    }

    // 정규식 맞을 때 사용!
    function notifyText_ok_modify(hidden_bar) {
        hidden_bar.style.display = 'none';
    }

    // 폼 보낼 때 모두 체크
    function allCheckModify() {
        if (!checkPass_modify()) return;
        if (!checkPass_modify_re()) return;
        if (!checkPhone()) return;
        document.modify_form.submit();
    }
    function withdrawal(){
        var userInput = prompt("정말 탈퇴하시겠습니까? \n탈퇴를 원하시면 비밀번호를 입력하세요.");
        if (userInput != "") {
            // 패턴 맞으면 중복확인 ajax 사용함
            var httpRequest = new XMLHttpRequest();
            var data = "";
            httpRequest.onreadystatechange = function () {
                if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200) {
                    alert(httpRequest.responseText);
                    location.href = "../index.php";
                }
            };

            data = "ps=" + userInput;
            httpRequest.open("POST", "../user/user_withdrawal.php", true);
            httpRequest.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
            );
            httpRequest.send(data);
        }


        




        
    }
</script>

