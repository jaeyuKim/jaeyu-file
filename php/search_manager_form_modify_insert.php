<?php
    include 'dbpassword.php';	// 데이터베이스 접속

session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $username = "";

	if($userlevel != 1){	// 세션에 관리자 로그인이 적용되어 있지 있으면 페이지 입장불가
		echo("
			<script>
                alert('관리자 로그인 후 이용해주세요!')
                location.href = 'index.php';
			</script>
		");
	}

    $num = $_GET["num"];
    $page = $_GET["page"];

    $product = $_POST['product'];
    $explanation = $_POST['explanation'];

    $product = htmlspecialchars($product, ENT_QUOTES);  // 특수문자를 화면에 출력하기 위해 입력
    $explanation = htmlspecialchars($explanation, ENT_QUOTES);

    $regist_day = time();  // 현재 시간을 일련번호로 저장
    $picture = $_POST['picture'];

    // 이미지 파일 코드

    // 이미지를 수정할 때 새로 첨부했는지 유무 확인
    if($_FILES['picture']['tmp_name'] != null) {
        
        // 기존 이미지 정보 불러오기
        $sql = "select * from search where num = $num";
        $result = $dbConnect->query($sql);
        $row = mysqli_fetch_array($result);
        $pictureDelete = $row["picture"];
        
        // 기존 이미지 삭제
        $file_path = "./data/".$pictureDelete;
		unlink($file_path);

        // 임시저장된 이미지 파일 (input 타입 file의 name명이 pucture에서 선택된 이미지 정보 가져옴)
        $myTempFile = $_FILES['picture']['tmp_name'];

        // 파일 타입 및 확장자 구하기
        $fileTypeExtension = explode("/", $_FILES['picture']['type']);

        // 파일 종류 이름 (필요 없음)
        $fileType = $fileTypeExtension[0];
        // 파일 확장자
        $extension = $fileTypeExtension[1];

        // 이미지 확장자 검사
        $isExtGood = false;

        switch($extension){
            case 'jpeg':
            case 'jpg';
            case 'bmp':
            case 'gif':
            case 'png':
            $isExtGood = true;
            break;
            default :
                echo "이미지 파일만 첨부할 수 있습니다 (jpg, bmp, gif, png 확장자만 가능)";
                exit;
        }

            if($isExtGood){
                // 임시 파일 옮길 저장 및 파일명
                $picture = "{$product}{$regist_day}.{$extension}";
                $picture2 = "./data/{$product}{$regist_day}.{$extension}";
                // 임시 저장된 파일을 우리가 저장할 장소 및 파일명으로 옮김
                $imageUpload = move_uploaded_file($myTempFile, $picture2);
            }
        
        $sql = "update search set product='$product', explanation='$explanation', picture='$picture', regist_day='$regist_day' where num=$num";
        $result = $dbConnect->query($sql);
        
        echo "
              <script>
                  alert('게시글이 정상적으로 수정되었습니다.');
                  location.href = 'search_list.php?page=$page';
              </script>
          ";
        exit;
        
    }   // 이미지 파일 코드 종료

    $sql = "update search set product='$product', explanation='$explanation', regist_day='$regist_day' where num=$num";
    $result = $dbConnect->query($sql);

    echo "
	      <script>
              alert('게시글이 정상적으로 수정되었습니다.');
	          location.href = 'search_list.php?page=$page';
	      </script>
	  ";
?>


