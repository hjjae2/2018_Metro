<?php
#phpinfo();
$host = "52.78.234.197";
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
    <link rel="stylesheet" href="page2.css?ver=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body style="background-color: black;">
    <div class="wrapper">
        <a href="#open" class="detail">여기여기</a>
        <button class="btn home" type="button" onclick="location.href='page1.html'"> </button>
        <button class="btn refresh" type="button" onclick="location.href='page2.php'"> </button>
        <img class="img" src="img/bckgd2.png">
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
        <div class="white_content" id="open">
            <div style="text-align:center">
                <img class="train" src="img/tt.png">
                <button type="button" onclick="location.href='#close'">닫기</button>
                <?php
                    switch($resultarray[0]){
                        case 1: echo "<img class=\"box_1st\" src=\"img/grade1.png\">";
                            break;
                        case 2: echo "<img class=\"box_1st\" src=\"img/grade2.png\">";
                            break;
                        case 3: echo "<img class=\"box_1st\" src=\"img/grade3.png\">";
                            break;
                    }
                    switch($resultarray[1]){
                        case 1: echo "<img class=\"box_2nd\" src=\"img/grade1.png\">";
                            break;
                        case 2: echo "<img class=\"box_2nd\" src=\"img/grade2.png\">";
                            break;
                        case 3: echo "<img class=\"box_2nd\" src=\"img/grade3.png\">";
                            break;
                    }
                    switch($resultarray[2]){
                        case 1: echo "<img class=\"box_3rd\" src=\"img/grade1.png\">";
                            break;
                        case 2: echo "<img class=\"box_3rd\" src=\"img/grade2.png\">";
                            break;
                        case 3: echo "<img class=\"box_3rd\" src=\"img/grade3.png\">";
                            break;
                    }
                    switch($resultarray[3]){
                        case 1: echo "<img class=\"box_4th\" src=\"img/grade1.png\">";
                            break;
                        case 2: echo "<img class=\"box_4th\" src=\"img/grade2.png\">";
                            break;
                        case 3: echo "<img class=\"box_4th\" src=\"img/grade3.png\">";
                            break;
                    }
                    switch($resultarray[4]){
                        case 1: echo "<img class=\"box_5th\" src=\"img/grade1.png\">";
                            break;
                        case 2: echo "<img class=\"box_5th\" src=\"img/grade2.png\">";
                            break;
                        case 3: echo "<img class=\"box_5th\" src=\"img/grade3.png\">";
                            break;
                    }
                    switch($resultarray[5]){
                        case 1: echo "<img class=\"box_6th\" src=\"img/grade1.png\">";
                            break;
                        case 2: echo "<img class=\"box_6th\" src=\"img/grade2.png\">";
                            break;
                        case 3: echo "<img class=\"box_6th\" src=\"img/grade3.png\">";
                            break;
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>