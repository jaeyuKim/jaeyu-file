<meta charset="utf-8">
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
    if(!$userid) {
		echo("
			<script>
                alert('로그인 후 이용해주세요!');
                location.href = 'login_form.php';
			</script>
			");
	}

    $id = $_POST["id"];
	$name = $_POST["name"];
    $phone = $_POST["phone1"]."-".$_POST["phone2"]."-".$_POST["phone3"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $subject = htmlspecialchars($subject, ENT_QUOTES);  // 특수문자를 화면에 출력하기 위해 입력
    $content = htmlspecialchars($content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $sql = "insert into inquiry(id, name, phone, subject, content, regist_day) ";
// 데이터베이스 inquiry 테이블에 새로운 레코드를 추가하겠다
	$sql .= "values('$id', '$name', '$phone', '$subject', '$content', '$regist_day')";
    $dbConnect->query($sql);  // $sql 에 저장된 데이터베이스 명령 실행

    echo "
	      <script>
              alert('문의가 정상적으로 접수되었습니다.');
	          location.href = 'index.php'
	      </script>
	  ";

?>