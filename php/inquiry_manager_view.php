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
<title>고객문의글 보기</title>
<style>
	*{padding: 0; list-style: none;}
</style>
</head>
<body> 
<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$sql = "select * from inquiry where num = $num";
	$result = $dbConnect->query($sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$name      = $row["name"];
	$phone      = $row["phone"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$regist_day = $row["regist_day"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);
?>
	<ul>
		<li><strong>아이디(성함) :</strong> <?=$id?>(<?=$name?>)</li>
		<li><strong>연락처 :</strong> <?=$phone?></li>
		<li><strong>작성일 :</strong> <?=$regist_day?></li>
		<li><strong>내용 :</strong> <?=$content?></li>
		<li><button onclick="location.href='inquiry_manager_list.php?page=<?=$page?>'">목록</button></li>
	</ul>
</body>
</html>
