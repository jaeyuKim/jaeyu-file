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
	if(!isset($_SESSION["userid"])){	// 세션에 로그인이 적용되어 있지 있으면 페이지 입장불가
		echo("
			<script>
                alert('로그인 후 이용해주세요!')
                location.href = 'login_form.php';
			</script>
		");
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>고객문의글 폼</title>
</head>

<body>
    <form method="post" action="inquiry_insert.php">
        <ul>
            <li>
                <p>아이디(성함) : <?=$userid?>(<?=$username?>)</p>
                <input type="hidden" name="id" value="<?=$userid?>"> 
				<input type="hidden" name="name" value="<?=$username?>">
            </li>
            <li>
                <label for="phone1">연락처</label>
                <input type="tel" id="phone1" name="phone1" maxlength="3" size="3" required>-
                <input type="tel" id="phone2" name="phone2" maxlength="4" size="4" required>-
                <input type="tel" id="phone3" name="phone3" size="4" maxlength="4" required>
            </li>
            <li>
                <label for="subject">문의 제목</label>
                <input type="text" id="subject" name="subject" maxlength="40" required>
            </li>
            <li>
                <label for="content">문의 내용</label>
                <textarea id="content" name="content" rows="10" cols="30" required></textarea>
            </li>
        </ul>
        <input type="submit" value="문의하기">
	</form>
</body>
</html>


