<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
// isset(변수명) 변수값이 있으면 true 없으면 false
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>회원가입 로그인 연습</title>
</head>

<body>
    
<?php
    if(!$userid) {
?>                
        <p><a href="member_form.php">회원 가입</a> | <a href="login_form.php">로그인</a></p>
<?php
    } else {
?>
        <p> <?=$username?>(<?=$userid?>)님 안녕하세요.</p>
        <p><a href="member_modify_form.php">정보수정</a></p>
        <p><a href="logout.php">로그아웃</a></p>
<?php
    }
    if($userlevel){
?>
    <p><a href="inquiry_manager_list.php">고객문의글 보기</a></p>
	<p><a href="search_manager_form.php">제품 등록</a></p>
<?php
    } else {
?>
    <p><a href="inquiry_form.php">고객문의</a></p>
<?php
    }
?>
    
<p><a href="search_list.php">제품 전체 보기</a></p>
    
<form method="get" action="search_insert.php">
	<input type="text" name="searchKeyword" placeholder="제품 검색" required>
	<select name="searchOption" required>
		<option value="product">제품명</option>
		<option value="explanation">설명</option>
		<option value="pande">제품명과 설명</option>
		<option value="pore">제품명 또는 설명</option>
	</select>
	<input type="submit" value="검색">
</form>

</body>
</html>
