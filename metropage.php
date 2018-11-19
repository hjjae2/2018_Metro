<?php
#phpinfo();
$host = "52.78.234.197";
$user="test";
$pass="1234";

$connect = mysqli_connect($host, $user, $pass);


mysqli_select_db($connect, "METRO_DB");
$query="SELECT * from img_result_tb";
$result=mysqli_query($connect, $query);

//var_dump($result->num_rows); //행 개수 확인
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Subway saturation</title>
    <link rel="stylesheet" href="metropage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="wrapper">
        <img src="img/tt.png" alt="train">
        <?php
        $row=mysqli_fetch_array($result);
        switch($row['resultId']){
            case 1: echo "<div class=\"box box-1st grade1\"></div>"; break;
            case 2: echo "<div class=\"box box-1st grade2\"></div>"; break;
            case 3: echo "<div class=\"box box-1st grade3\"></div>"; break;
            case 4: echo "<div class=\"box box-1st grade3\"></div>"; break;
            case 5: echo "<div class=\"box box-1st grade5\"></div>"; break;
        }
        $row=mysqli_fetch_array($result);
        switch($row['resultId']){
            case 1: echo '<div class="box box-2nd grade1"></div>'; break;
            case 2: echo '<div class="box box-2nd grade2"></div>'; break;
            case 3: echo '<div class="box box-2nd grade3"></div>'; break;
            case 4: echo '<div class="box box-2nd grade4"></div>'; break;
            case 5: echo '<div class="box box-2nd grade5"></div>'; break;
        }
        $row=mysqli_fetch_array($result); 
        switch($row['resultId']){
            case 1: echo '<div class="box box-3rd grade1"></div>'; break;
            case 2: echo '<div class="box box-3rd grade2"></div>'; break;
            case 3: echo '<div class="box box-3rd grade3"></div>'; break;
            case 4: echo '<div class="box box-3rd grade4"></div>'; break;
            case 5: echo '<div class="box box-3rd grade5"></div>'; break;
        }
        $row=mysqli_fetch_array($result); 
        switch($row['resultId']){
            case 1: echo '<div class="box box-4th grade1"></div>'; break;
            case 2: echo '<div class="box box-4th grade2"></div>'; break;
            case 3: echo '<div class="box box-4th grade3"></div>'; break;
            case 4: echo '<div class="box box-4th grade4"></div>'; break;
            case 5: echo '<div class="box box-4th grade5"></div>'; break;
        }
        $row=mysqli_fetch_array($result); 
        switch($row['resultId']){
            case 1: echo '<div class="box box-5th grade1"></div>'; break;
            case 2: echo '<div class="box box-5th grade2"></div>'; break;
            case 3: echo '<div class="box box-5th grade3"></div>'; break;
            case 4: echo '<div class="box box-5th grade4"></div>'; break;
            case 5: echo '<div class="box box-5th grade5"></div>'; break;
        }
        $row=mysqli_fetch_array($result); 
        switch($row['resultId']){
            case 1: echo '<div class="box box-6th grade1"></div>'; break;
            case 2: echo '<div class="box box-6th grade2"></div>'; break;
            case 3: echo '<div class="box box-6th grade3"></div>'; break;
            case 4: echo '<div class="box box-6th grade4"></div>'; break;
            case 5: echo '<div class="box box-6th grade5"></div>'; break;
        }
        ?>    
    </div>
</body>
</html>
