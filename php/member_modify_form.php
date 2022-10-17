<?php
    include 'dbpassword.php';	// 데이터베이스 접속
?>
<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $username = "";
?>
<?php
	if(!isset($_SESSION["userid"])){	// 세션에 로그인이 적용되어 있지 있으면 정보수정 페이지 입장불가
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
	<title>회원정보수정 폼</title>
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
	</style>
        

</head>
<?php    
    $sql    = "select * from members where id='$userid'";
	// $userid 값이랑 members 테이블의 id 필드값이랑 같은 값을 찾아 해당 레코드 모두 호출
    $result = $dbConnect->query($sql);	// 데이터베이스 실행
    $row    = mysqli_fetch_array($result);

    $pass = $row["pass"];
    $name = $row["name"];
    $email = $row["email"];
?>
<body>
	<form  name="member_form" method="post" action="member_modify.php">
		<fieldset class="register">
			<legend>회원정보수정</legend>
			<ul>
				<li>
                    <p>아이디 : <?=$userid?></p>
					<input type="hidden" id="new_id" name="id" size="20" value="<?=$userid?>">
				</li>
				<li>
					<label class="reg" for="new_pw1">비밀번호 <em>*</em></label>
					<input type="password" id="new_pw1" name="pass1" size="20" required value="<?=$pass?>">
				</li>
				<li>
					<label class="reg" for="new_pw2">비밀번호 확인 <em>*</em></label>
					<input type="password" id="new_pw2" name="pass2" size="20" required value="<?=$pass?>">
				</li>
				<li>
					<label class="reg" for="user_name">이름 <em>*</em></label>
					<input type="text" id="user_name" name="name" size="20" required value="<?=$name?>">
				</li>
				<li>
					<label class="reg" for="user_mail">메일 주소 <em>*</em></label>
					<input type="email" id="user_mail" name="email" size="20" required value="<?=$email?>">
				</li>
			</ul>
        </fieldset>
			<input type="submit" value="수정하기">
	</form>
    <form name="member_form2" method="post" action="member_delete.php">
        <input type="hidden" name="id" value="<?=$userid?>">
        <img src="images/button_delete.jpg" alt="계정탈퇴" onclick="check_delete()">
    </form>
</body>
<script>
   function check_delete()
   {
       if(confirm('탈퇴 하시겠습니까?')==1){
       	document.member_form2.submit();
       }
   }
</script>

</html>