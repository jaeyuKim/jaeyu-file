<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>무제 문서</title>
</head>

<body>
    
    <?php
    
    /*
    $_POST['w'];
    $_POST['h'];
    
    $sAll = $_POST['w'] * $_POST['h'];
    $sLiter = $sAll/4;
    
    echo '면적:' .$sAll;
    echo '페인트:' .$sLiter;
    ?>
    */
    $classA = $_POST['w'];
    $classB = $_POST['h'];
    
    if($classA > 70 || $classB > 70){
        echo '통과';
    } else {
        echo '탈락
        ';
    }
    
    ?>
</body>
</html>
