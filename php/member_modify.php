<?php
    include 'dbpassword.php';	// 데이터베이스 접속
?>
<?php
    $id = $_POST["id"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];
    $name = $_POST["name"];
    $email  = $_POST["email"];

    if($pass1 != $pass2){
        echo("
			<script>
			alert('비밀번호가 일치하지 않습니다. 다시 입력해주세요.')
			history.go(-1)
			</script>
		");
    } else {

    session_start();
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["userlevel"]);
        
    $sql = "update members set pass='$pass1', name='$name', email='$email' where id='$id'";
		// update 레코드 변경하겠다, members 테이블, set 변경할 필드 3개, where 조건
    $result = $dbConnect->query($sql);	// 데이터베이스 실행

    echo "
	      <script>
              alert('수정완료! 다시 로그인하여 주세요.');
	          location.href = 'index.php';
	      </script>
	  ";
    }
?>

   
