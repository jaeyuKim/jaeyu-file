<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
?>
<?php
	if(isset($_SESSION["userid"])){	// 세션에 로그인이 적용되어 있으면 로그인 페이지 입장불가
		echo("
			<script>
			alert('잘못된 경로입니다!')
			history.go(-1)
			</script>
		");
	}
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
	<meta charset="utf-8">
	<title>회원가입 폼</title>
    <script src="jquery.js"></script>
	<style>
		form fieldset {
			margin: 10px 0;
		}

		form legend {
			font-size: 18px;
			color: #0066FF;
			font-weight: 600;
		}

		form label.reg {
			font-size: 14px;
			width: 120px;
			float: left;
		}

		form label em {
			font-size: 15px;
			color: red;
			font-weight: 800;
		}

		form ul li {
			list-style: none;
			margin: 10px 0;
		}

		form .easys {
			text-align: left;
			font-size: 12px;
			color: blue;
		}

		form fieldset.sendform {
			text-align: center;
		}
	</style>
</head>
<body>
	<form name="member_form" method="post" action="member_insert.php">
		<fieldset class="register">
			<legend>가입하기</legend>
			<ul>
				<li>
					<label class="reg" for="user_name">아이디 <em>*</em></label>
					<input type="text" id="new_id" name="id" size="20" minlength="3" maxlength="15" required> <small style="color:red;"> 3~15자리 이내의 영문과 숫자</small>
                    <input type="button" value="중복 확인" onclick="idcheck()">
                    <p id="result"></p>
				</li>
				<li>
					<label class="reg" for="new_pw1">비밀번호 <em>*</em></label>
					<input type="password" id="new_pw1" name="pass" size="20" required>
				</li>
				<li>
					<label class="reg" for="new_pw2">비밀번호 확인 <em>*</em></label>
					<input type="password" id="new_pw2" name="pass_confirm" size="20" required>
				</li>
				<li>
					<label class="reg" for="user_name">이름 <em>*</em></label>
					<input type="text" id="user_name" name="name" size="20" required>
				</li>
				<li>
					<label class="reg" for="user_mail">메일 주소 <em>*</em></label>
					<input type="email" id="user_mail" name="email" size="20" required>
				</li>
			</ul>
		</fieldset>
		<fieldset class="sendform">
			<input type="submit" value="가입하기">
			<input type="reset" value="다시쓰기">
		</fieldset>
	</form>
</body>
<script>
    function idcheck() {
        $.ajax({
            url: "ajax.php",	// 폼태그 액션
            type: "get",	// 메소드
            data: {	// ajax.php 파일로 넘길 값
                a: $('#new_id').val(),
            }
        }).done(function(data){
            document.querySelector("#result").innerHTML = data;
        });
    }
</script>

</html>