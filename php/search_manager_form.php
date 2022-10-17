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
	if($userlevel != 1){	// 세션에 관리자 로그인이 적용되어 있지 있으면 페이지 입장불가
		echo("
			<script>
                alert('관리자 로그인 후 이용해주세요!')
                location.href = 'index.php';
			</script>
		");
	}
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>제품 등록 폼</title>
<style>
	*{padding: 0; list-style: none;}
	textarea{resize: none;}
</style>
</head>
<body> 
	<form method="post" action="search_manager_form_insert.php" enctype="multipart/form-data">
			<ul>
				<li>
					<label for="product">제품 이름</label>
					<input type="text" id="product" name="product" maxlength="20" size="20" required>
				</li>
				<li>
					<label for="explanation">제품 설명</label>
					<textarea id="explanation" name="explanation" rows="10" cols="30" required></textarea>
				</li>
				<li>
					<label for="picture">사진 등록</label>
					<input type="file" id="picture" name="picture" required>
				</li>
			</ul>
			<input type="submit" value="제품 등록">
		</form>
</body>
</html>
