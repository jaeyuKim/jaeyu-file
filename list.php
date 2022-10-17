<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>게시판</title>
    <style>
        li{list-style: none;}
        a{text-decoration: none; list-style: none;}
    </style>
</head>

<body>
    
    <?php
    $host = "localhost";
    $user = "yujae";   // 닷홈 ftp 아이디 입력
    $pw = "rlawodb124!";     // 닷홈 ftp 비밀번호 입력
    $dbName = "yujae";         // 닷홈 데이터베이스 아이디 입력
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect->set_charset("utf8");
    
     $sql = "select * from txt order by num desc"; // test테이블 모든 레코드를 조회. *표시는 모든 필드 조회
     $result = $dbConnect->query($sql); // 데이터 베이스 실행
     $jy = mysqli_fetch_array($result); // 레코드를 조회해서 해당 변수에 조회
     $count = mysqli_num_rows($result); // 레코드 총 개수
    
    
    echo "<ul>";
        
    for($i = 0; $i < $count; $i++){
    mysqli_data_seek($result, $i); // 전체 레코드 중에서 i변수값에 맞게 해당 레코드를 선택
    $jy = mysqli_fetch_array($result); // 레코드를 조회해서 해당 변수에 조회   
    ?>
    
    <li><a href="view.php?num=<?=$jy['num']?>"><?=$jy['title']?></a><?=$jy['regist_day']?></li>
    
    <?php
    }
    
    echo "</ul>";
    ?>
</body>
</html>
