<?php
    include 'dbpassword.php';	// 데이터베이스 접속
?>
<?php
    $id   = $_POST["id"];
	$id   = trim($id);	// 아이디값 공백 제거
    $pass = $_POST["pass"];
    $pass_confirm = $_POST["pass_confirm"];
    $name = $_POST["name"];
    $email  = $_POST["email"];
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장W


    $sql = "select * from members where id='$id'"; // 아이디 중복 있으면 돌아가기
	// select 필드명 from 테이블명 where 조건
	// * 모든 필드 포함
    $result = $dbConnect->query($sql);	// 데이터베이스 실행

    $num_record = mysqli_num_rows($result);	// 조건에 맞는 레코드 개수

    $pattern_id = '/^[a-zA-Z0-9]+$/';
    $pattern_kor = '/^[가-힣]+$/';

    if ($num_record){
        echo "<script>alert('중복된 아이디입니다.');</script>";
        include $_SERVER['DOCUMENT_ROOT'].'/member_form.php';
    } else if($pass != $pass_confirm){
        echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
        include $_SERVER['DOCUMENT_ROOT'].'/member_form.php';
    } else if(!preg_match($pattern_id, $id)){	// 정규표현식 충족이 되면 true 지만 !들어가서 반대
        echo "<script>alert('아이디는 영문과 숫자만 입력이 가능합니다.');</script>";
        include $_SERVER['DOCUMENT_ROOT'].'/member_form.php';
    } else if(!preg_match($pattern_kor, $name)){
        echo "<script>alert('이름은 한글만 입력이 가능합니다.');</script>";
        include $_SERVER['DOCUMENT_ROOT'].'/member_form.php';
    } 
    else
    {
    $sql = "insert into members(id, pass, name, email, regist_day, level) ";
		// members 테이블에 새로운 레코드 삽입
	$sql .= "values('$id', '$pass', '$name', '$email', '$regist_day', 0)";
		// members 테이블에 새롭게 넣을 값
    $result = $dbConnect->query($sql);	// 데이터베이스 실행

    echo "
	      <script>
              alert('회원가입이 완료되었습니다! 로그인해서 이용하시면 됩니다.');
	          location.href = 'index.php'
	      </script>
	  ";
    }
?>