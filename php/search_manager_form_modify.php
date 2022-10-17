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
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>제품 등록 폼 수정</title>
<style>
	*{padding: 0; list-style: none;}
</style>
</head>
<body>
<?php
	if($userlevel != 1){	// 세션에 관리자 로그인이 적용되어 있지 있으면 페이지 입장불가
		echo("
			<script>
                alert('관리자 로그인 후 이용해주세요!')
                location.href = 'index.php';
			</script>
		");
	}
?>
<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];
	
	$sql = "select * from search where num = $num";
	$result = $dbConnect->query($sql);
	$row = mysqli_fetch_array($result);
    $product     = $row["product"];
	$explanation = $row["explanation"];
	$picture     = $row["picture"];
?>
    <form name="search_manager_form_modify" method="post" action="search_manager_form_modify_insert.php?num=<?=$num?>&page=<?=$page?>"  enctype="multipart/form-data">
        <ul>
            <li>
                <label for="product">제품 이름</label>
                <input type="tel" id="product" name="product" maxlength="20" size="20" value="<?=$product?>" required>
            </li>
            <li>
                <label for="explanation">제품 설명</label>
                <textarea id="explanation" name="explanation" rows="10" cols="30" required><?=$explanation?></textarea>
            </li>
            <li>
                <label class="cys1" for="picture">이미지 파일 : </label>
                <span class="cys2"><?=$picture?></span><br>
                <span class="cys3" onClick="click1();" style="background: aqua; border: 1px solid #000; cursor: pointer;">이미지 변경하기</span>
                
            </li>
        </ul>
        <input type="submit" value="수정하기">
    </form>
</body>
    <script>
        function click1(){
            document.querySelector(".cys1").innerHTML = "사진 등록";
            document.querySelector(".cys2").innerHTML = "<input type='file' id='picture' name='picture' required>";
            document.querySelector(".cys3").style.display = "none";
        }
    </script>
</html>


