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
<meta charset="utf-8">
<?php
	// 데이터베이스 검색 결과 코드
    $searchKeyword = $_GET['searchKeyword'];
    $searchOption = $_GET['searchOption'];

    if($searchKeyword == '' || $searchOption == null){		// 주소 입력해서 진입하면 입장 불가
        echo ("
			<script>
		  		alert('잘못된 경로입니다.');
          		location.href = 'index.php';테스트11
         	</script>
       ");
        exit;
    }

	if($searchOption == 'pande'){
		$sql = "SELECT * FROM search WHERE product LIKE '%{$searchKeyword}%' AND explanation LIKE '%{$searchKeyword}%' ORDER BY num DESC";
	} else if ($searchOption == 'pore') {
		$sql = "SELECT * FROM search WHERE product LIKE '%{$searchKeyword}%' OR explanation LIKE '%{$searchKeyword}%' ORDER BY num DESC";
	} else {
		$sql = "SELECT * FROM search WHERE $searchOption LIKE '%{$searchKeyword}%' ORDER BY num DESC";
		// LIKE 연산자 : 검색어 일부만 입력해도 검색 가능
		// 모든필드 포함, search 테이블, $searchOption 필드에서 서치키워드 변수값이 포함된 데이터 검색, num 내림차순
	}

    $result = $dbConnect->query($sql);	// 데이터베이스 호출
?>

<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>제품 검색 결과</title>
<style>
	*{padding: 0; list-style: none;}
	ul{height: 600px;}
	li{height: 100px; padding: 0 2px;  text-align: center;}
    span{vertical-align: middle;}
	.col1{display: inline-block; width: 50px;}
	.col2{display: inline-block; width: 400px;}
	.col3{display: inline-block; width: 150px;}
	.col4{display: inline-block; width: 100px;}
	
	.page_ul{text-align: center;}
	.page_ul li{display: inline-block;}
	.page_ul li a{text-decoration: none;}
</style>
</head>
<body> 
	<ul>
		<li>
			<span class="col1">번호</span>
			<span class="col2">제품명</span>
			<span class="col3">등록일</span>
			<span class="col4">이미지</span>
		</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$total_record = mysqli_num_rows($result); // 호출된 테이블 전체 레코드 수

	$scale = 6;	// 게시글 6개 초과되면 다음 페이지 번호로 넘기기

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)    // 나눠서 나머지 값이 0이랑 같은지 검사
		$total_page = floor($total_record/$scale);      // floor 소수점 제거 후 올림 함수
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;	// 각 게시글마다 번호 부여하는 변수 number 생성

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)	// && 는 and 조건, || 는 or 조건
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 호출된 테이블 레코드를 하나씩 가져오기
	  $num         = $row["num"];
	  $product     = $row["product"];
      $regist_day  = date("Y-m-d h:i", $row["regist_day"]);
      $picture     = $row["picture"];
?>
		<li>
			<span class="col1"><?=$number?></span>
			<span class="col2"><a href="search_list_view.php?num=<?=$num?>&page=<?=$page?>"><?=$product?></a></span>
			<span class="col3"><?=$regist_day?></span>
			<span class="col4"><img src="data/<?=$picture?>" width="90" height="90" alt="이미지"></span>
<?php
   	   $number--;
   }
?>
	</ul>
	<!--게시글 하단 페이지 번호-->
	<ul class="page_ul">
<?php
	if ($total_page >= 2 && $page >= 2)	// 총 페이지가 2개 이상이고 GET방식으로 받은 페이지 변수가 2이상인지 검사
	{
		$new_page = $page - 1;
		echo "<li><a href='search_list.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i = 1; $i <= $total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='search_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page >= 2 && $page != $total_page) // 총 페이지가 2개 이상이고 마지막 페이지에 위치하지 않은지 검사
   	{
		$new_page = $page+1;	
		echo "<li> <a href='search_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
	</ul>
</body>
</html>

