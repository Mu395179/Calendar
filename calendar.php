<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
<style>
.block-table{
    width: 380px;
    display: flex;
    flex-wrap: wrap;

}
.item{
    margin-left: -1px;
    margin-top: -1px;
    display: inline-block;
    width: 50px;
    height: 50px;
    border: 1px solid black;
    position: relative;
}
.item-header{
    margin-left: -1px;
    margin-top: -1px;
    display: inline-block;
    width: 50px;
    height: 50px;
    border: 1px solid black;
    text-align: center;
    background-color: black;
    color: white;
    font-weight: 800;
    
}



</style>



</head>

<body>
    <?php
    // 先設日曆基本所需變數
    
    $month = 5;
    $year = date("Y");
    echo $year . "年";
    echo "<br>";
    echo $month . "月";
    echo "<br>";
    // 先設當月第一天的時間戳變數
    $firstDay = strtotime(date("Y-$month-1"));
    // 設第一周的第一天
// date(從時間戳取的參數"w"是星期幾,第一天的時間戳)
    $firstWeekStarDay = date("w", $firstDay);
    echo "當周的第一天是星期" . $firstWeekStarDay;
    // 當月總共有幾天，"t"是取時間戳的總天數
    $days = date("t", $firstDay);
    // 當月的最後一天變數時間戳
    $lastDay = strtotime(date("Y-$month-$days"));
    echo "<br>";
    // 從最後一天的時間戳，取當天日期
    echo "最後一天是" . date("Y-m-d", $lastDay);


    // 先設日期陣列，把迴圈所得的結果存入陣列，並應出來
    $days=[];
    // 要製作一個6*7的css box 需要42個值
    for ($i = 0; $i < 42; $i++) {
        // 用迴圈的$i 與首周第一天的差值來訂定當月的日期
        $diff=$i-$firstWeekStarDay;
        // 把上述差值來當作每月第一天的加值，所以如果有負的則會出現上個月的日期
        // 同理，如果大於當月日期數，也會出現下個月的日期
        $days[] = date("Y-m-d", strtotime("$diff days",$firstDay));
    }






    ?>
</body>

</html>