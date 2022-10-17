<?php
	$host = "localhost";
    $user = "yujae";   // 닷홈 ftp 아이디 입력
    $pw = "rlawodb124!";     // 닷홈 ftp 비밀번호 입력
    $dbName = "yujae";         // 닷홈 데이터베이스 아이디 입력
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect->set_charset("utf8");
	$id = $_POST['a'];

	$sql = "select * from member where id='$id'";
	$result = $dbConnect->query($sql);

	$num_record = mysqli_num_rows($result);

	if ($num_record == 1){
		echo $id." 아이디는 중복입니다.";
	}
?>
