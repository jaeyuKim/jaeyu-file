
<?php
    $host = "localhost";
    $user = "yujae";   // 닷홈 ftp 아이디 입력
    $pw = "rlawodb124!";     // 닷홈 ftp 비밀번호 입력
    $dbName = "yujae";         // 닷홈 데이터베이스 아이디 입력
    $dbConnect = new mysqli($host, $user, $pw, $dbName);
    $dbConnect->set_charset("utf8");

    if(mysqli_connect_errno()){
        echo "데이터베이스 {$dbName}에 접속 실패";
    }
    ?>
