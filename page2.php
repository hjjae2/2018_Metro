<?php
#phpinfo();
$host = "localhost";
$user="test";
$pass="1234";

$connect = mysqli_connect($host, $user, $pass);


mysqli_select_db($connect, "METRO_DB");
$query="SELECT * from analysis_result_tb";
$result=mysqli_query($connect, $query);

$resultarray=array();

$row=mysqli_fetch_array($result);

for($i=1;$i<=6;$i++){
    array_push($resultarray,$row[$i]);
}
$result_avg=round(array_sum($resultarray)/count($resultarray));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Subway saturation</title>
    <link rel="stylesheet" href="page2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="wrapper">
        <img class="img" src="img/METRO_2.png" alt="page1">
        <?php
        switch($result_avg){
            case 1: echo "<img class=\"grade\" src=\"img/grade1.png\">";
                break;
            case 2: echo "<img class=\"grade\" src=\"img/grade2.png\">";
                break;
            case 3: echo "<img class=\"grade\" src=\"img/grade3.png\">";
                break;
        }
        ?>
    </div>
</body>
</html>
