<?php
    include 'dbpassword.php';	// 데이터베이스 접속
?>
<?php
    $id = $_POST["id"];
    
    $sql = "delete from data where id='$id'";
	//	members 테이블의 id 필드랑 유저id랑 일치하는 레코드만 제거
    $result = $dbConnect->query($sql);	// 데이터베이스 실행

    session_start();
    unset($_SESSION["userid"]);	// unset 변수값 제거하여 로그아웃
    unset($_SESSION["username"]);
    unset($_SESSION["userlevel"]);

    echo "
	      <script>
              alert('탈퇴완료!');
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
