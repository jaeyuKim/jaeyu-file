<meta charset="utf-8">
<?php
	$host = "yujae";
    $user = "yujae";   // 닷홈 ftp 아이디 입력
    $pw = "rlawodb124!";     // 닷홈 ftp 비밀번호 입력
    $dbName = "yujae";         // 닷홈 데이터베이스 아이디 입력
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect->set_charset("utf8");
	
    $title = $_POST['title'];
    $content = $_POST['content'];
    $regist_day = date('Y-m-d (H:i:s)');

    $sql = "insert into txt(tltle, content, regist_day) values('$title', '$content', '$regist_day')"; // text테이블에 새 레코드를 추가
    $result = $dbConnect->query($sql); // 데이터 베이스 실행

	echo "<script> alert('게시글 작성이 완료되었습니다.'); location.href = 'member_form2.php'; </script>";
?>
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>