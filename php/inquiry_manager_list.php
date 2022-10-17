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
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>고객문의글 리스트</title>
<style>
	*{padding: 0; list-style: none;}
	ul{height: 200px;}
	li{padding: 0 2px; text-align: center;}
	.col1{display: inline-block; width: 50px;}
	.col2{display: inline-block; width: 400px;}
	.col3{display: inline-block; width: 70px;}
	.col4{display: inline-block; width: 150px;}
	.col5{display: inline-block; width: 150px;}
	
	.page_ul{text-align: center;}
	.page_ul li{display: inline-block;}
	.page_ul li a{text-decoration: none;}
</style>
</head>
<body> 
	<ul>
		<li>
			<span class="col1">번호</span>
			<span class="col2">제목</span>
			<span class="col3">글쓴이</span>
			<span class="col4">연락처</span>
			<span class="col5">등록일</span>
		</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$sql = "select * from inquiry order by num desc";	// inquiry 테이블 num 필드 기준으로 내림차순 정렬
	$result = $dbConnect->query($sql);	// 데이터베이스 호출
	$total_record = mysqli_num_rows($result); // 호출된 테이블 전체 레코드 수

	$scale = 5;	// 게시글 5개 초과되면 다음 페이지 번호로 넘기기

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)    // 나눠서 나머지 값이 0이랑 같은지 검사
		$total_page = floor($total_record/$scale);      // floor 소수점 제거 후 올림
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
	  $id          = $row["id"];
	  $name        = $row["name"];
	  $phone       = $row["phone"];
	  $subject     = $row["subject"];
	  $content     = $row["content"];
      $regist_day  = $row["regist_day"];
?>
		<li>
			<span class="col1"><?=$number?></span>
			<span class="col2"><a href="inquiry_manager_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><?=$phone?></span>
			<span class="col5"><?=$regist_day?></span>
		</li>	
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
		echo "<li><a href='inquiry_manager_list.php?page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li><a href='inquiry_manager_list.php?page=$i'> $i </a></li>";
		}
   	}
   	if ($total_page >= 2 && $page != $total_page) // 총 페이지가 2개 이상이고 마지막 페이지에 위치하지 않은지 검사
   	{
		$new_page = $page+1;	
		echo "<li> <a href='inquiry_manager_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
	</ul>
</body>
</html>
