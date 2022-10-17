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

    if ($userlevel != 1){   // 세션에 관리자 로그인이 적용되어 있지 있으면 페이지 입장불가
        echo("
            <script>
                alert('관리자가 아닙니다! 게시글 삭제는 관리자만 가능합니다!');
                history.go(-1)
            </script>
        ");
    }

    if (isset($_POST["item"])) {  // 삭제할 게시글을 체크했는지 검사
        $num_item = count($_POST["item"]);
    } else {
        echo("
            <script>
                alert('삭제할 게시글을 선택해주세요!');
                history.go(-1)
            </script>
        ");
        exit;
    }

    for($i = 0; $i < count($_POST["item"]); $i++){
        $num = $_POST["item"][$i];

        $sql = "select * from search where num = $num";
        $result = $dbConnect->query($sql);
        $row = mysqli_fetch_array($result);
        $pictureDelete = $row["picture"];
        
        // 기존 이미지 삭제
        $file_path = "./data/".$pictureDelete;
		unlink($file_path);

        $sql = "delete from search where num = $num";
        $result = $dbConnect->query($sql);
    }

    echo "
	     <script>
             alert('선택된 게시글이 제거되었습니다.');
	         location.href = 'search_list.php';
	     </script>
	   ";
?>

