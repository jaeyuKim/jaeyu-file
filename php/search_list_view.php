<?php
    include 'dbpassword.php';	// 데이터베이스 접속
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>제품 리스트 상세 보기</title>
<style>
	*{padding: 0; list-style: none;}
</style>
</head>
<body> 
<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$sql = "select * from search where num = $num";
	$result = $dbConnect->query($sql);

	$row = mysqli_fetch_array($result);
	$product     = $row["product"];
	$explanation = $row["explanation"];
	$regist_day  = date("Y-m-d h:i", $row["regist_day"]);
	$picture     = $row["picture"];

	$product = str_replace(" ", "&nbsp;", $product);
	$product = str_replace("\n", "<br>", $product);
    $explanation = str_replace(" ", "&nbsp;", $explanation);
	$explanation = str_replace("\n", "<br>", $explanation);
?>		
	<ul>
		<li><strong>제품 이름 :</strong> <?=$product?></li>
		<li><strong>제품 설명 :</strong> <?=$explanation?></li>
		<li><strong>작성일 :</strong> <?=$regist_day?></li>
		<li><strong>이미지</strong> <img src="data/<?=$picture?>" alt="이미지"></li>
	</ul>
</body>
</html>
