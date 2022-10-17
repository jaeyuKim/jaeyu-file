<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>무제 문서</title>
</head>

<body>
     <?php
    $host = "localhost";
    $user = "yujae";   // 닷홈 ftp 아이디 입력
    $pw = "rlawodb124!";     // 닷홈 ftp 비밀번호 입력
    $dbName = "yujae";         // 닷홈 데이터베이스 아이디 입력
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect->set_charset("utf8");
    
    $num = $_GET['num'];
    
    $sql = "select * from txt where num=$num"; // test테이블 모든 레코드를 조회. *표시는 모든 필드 조회
    //num필드 중에서 num값이랑 같은 것만 조회
    $result = $dbConnect->query($sql); // 데이터 베이스 실행
    $jy = mysqli_fetch_array($result); // 레코드를 조회해서 해당 변수에 조회
    
    echo $jy['title'].$jy['content'].$jy['regist_day'];
    ?>

    
</body>
</html>
