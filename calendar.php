<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
</head>
<body>
    <?php
// 先設日曆基本所需變數

$month= 5;
$year=date("Y");
echo $year."年";
echo "<br>";
echo $month."月";
echo "<br>";
// 先設當月第一天的時間戳變數
$firstDay=strtotime(date("Y-$month-1"));
// 設第一周的第一天
// date(從時間戳取的參數"w"是星期幾,第一天的時間戳)
$firstWeekStarDay=date("w",$firstDay);
echo "當周的第一天是星期".$firstWeekStarDay;
// 當月總共有幾天，"t"是取時間戳的總天數
$days=date("t",$firstDay);
// 當月的最後一天變數時間戳
$lastDay=strtotime(date("Y-$month-$days"));
echo "<br>";
// 從最後一天的時間戳，取當天日期
echo"最後一天是".date("Y-m-d",$lastDay);







    ?>
</body>
</html>