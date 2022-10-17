<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>글쓰기</title>
	<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	
    
    <form method="post" action="php/member_insert.php">
        
        <input type="text" name="title" placeholder="게시글 제목">
        <textarea name="content"></textarea>
        <input type="submit" value="글쓰기">
        
    </form>
</body>
</html>
