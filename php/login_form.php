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
    <title>로그인 폼</title>
    <style>
		table {
			border:0;
		}
		td {
			border:0;
			vertical-align: middle;
		}
        #user_id, #user_pw{width: 200px; height: 20px;}
	</style>
</head>
<body>
	<form name="login_form" method="post" action="login_insert.php">
        <table> 
            <tr>
                <td><label for="user_id">아이디 </label></td>
                <td>*<input type="text" id="user_id" name="id" size="10" placeholder="아이디 입력" required onKeyDown="javascript:if (event.keyCode == 13) check_input();"></td>
                <td><label for="user_pw">비밀번호 </label></td>
                <td>*<input type="password" id="user_pw" name="pass" size="10" placeholder="비밀번호 입력" required onKeyDown="javascript:if (event.keyCode == 13) check_input();"></td>
                <td>*<input type="image" id="butt" src="images/login.jpg" alt="login"></td>
            </tr>
        </table>
	</form>
</body>
<script>
   function check_input()
   {
       if (!document.login_form.id.value) // 로그인_폼 안에 id 네임을 가진 인풋 태그 안에 값이 입력되어 있지 않다면
       {
           document.login_form.id.focus(); // 아이디 란에 커서 위치
           return;	// 방탈출
       }

       if (!document.login_form.pass.value)
       {
           document.login_form.pass.focus();
           return;
       }
       document.login_form.submit();
   }
</script>
</html>