<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>calendar</title>
  <style>
    body {
      background-color: lightgoldenrodyellow;
    }

    row {
      clear: both;
    }

    .container {
      position: absolute;
      width: 1340px;
      height: 80vh;
    }

    .block-table {
      float: left;
      position: relative;
      display: inline-block;
      width: 380px;
      display: flex;
      flex-wrap: wrap;

    }

    .block-table1 {

      /* background-color: black; */
      color: lightgoldenrodyellow;
      float: left;

      display: inline-block;
      position: relative;
      width: 323px;
      display: flex;
      flex-wrap: wrap;

    }

    /* .block-table1>a{
      color: red;
      text-align: center;
    } */

    .block-table3 {
      background-color: black;
      float: left;
      color: gray;
      display: inline-block;
      position: relative;
      width: 400px;
      display: flex;
      flex-wrap: wrap;

    }

    .item {
      background-color: white;
      margin-left: -1px;
      margin-top: -1px;
      display: inline-block;
      width: 50px;
      height: 50px;
      border: 1px solid black;
      position: relative;
    }

    .item-header {
      margin-left: -1px;
      margin-top: -1px;
      display: inline-block;
      width: 50px;
      height: 50px;
      border: 1px solid yellow;
      text-align: center;
      background-color: black;
      color: white;
      font-weight: 800;

    }

    .holiday {
      background: pink;
    }

    .box {
      text-align: center;
      width: 1000px;

    }


    .prev-box {
      display: inline-block;
      width: 32.5%;
      margin: 5px;
      text-align: margin-left;
    }

    .next-box {
      display: inline-block;
      width: 32.5%;
      margin: 5px;
      text-align: margin-right;
    }
  </style>



</head>

<body>
  <?php
  // 先設月份變數為_GET陣列，這樣之後做給值的網址就可以直接變成日期格式
  // $month=(isset($_GET['month']))?$_GET['month']:date("m");
  // ??是isset判斷式的簡寫，所以此程式代表:
  // 此_GET陣列是否存在，如果存在那變數$month就會被賦予_GET陣列的值
  // 如果不存在就會取此時此刻的月份來當作$month變數的值
  $month = $_GET['month'] ?? date("m");
  // $year=(isset($_GET['year']))?$_GET['year']:date("Y");
  // $month = 4;
  // 先設年份變數為_GET陣列，這樣之後做給值的網址就可以直接變成日期格式
  // ??是isset判斷式的簡寫，所以此程式代表:
  // 此_GET陣列是否存在，如果存在那變數$year就會被賦予_GET陣列的值
  // 如果不存在就會取此時此刻的年份來當作$month變數的值
  // 所以在沒按按鈕的狀況下，就會呈現打開網頁的此時此刻的年份與月份
  $year = $_GET['year'] ?? date("Y");
  // echo $year . "年";
  // echo "<br>";
  // echo $month . "月";
  // echo "<br>";
  // 先設當月第一天的時間戳變數
  $firstDay = strtotime(date("Y-$month-1"));
  // 設第一周的第一天
// date(從時間戳取的參數"w"是星期幾,第一天的時間戳)
  $firstWeekStarDay = date("w", $firstDay);
  // echo "當周的第一天是星期" . $firstWeekStarDay;
  // 當月總共有幾天，"t"是取時間戳的總天數
  $days = date("t", $firstDay);
  // 當月的最後一天變數時間戳
  $lastDay = strtotime(date("Y-$month-$days"));
  // echo "<br>";
  // 從最後一天的時間戳，取當天日期
  // echo "最後一天是" . date("Y-m-d", $lastDay);


  // 先設日期陣列，把迴圈所得的結果存入陣列，並應出來
  $days = [];
  // 要製作一個6*7的css box 需要42個值
  for ($i = 0; $i < 42; $i++) {
    // 用迴圈的$i 與首周第一天的差值來訂定當月的日期
    $diff = $i - $firstWeekStarDay;
    // 把上述差值來當作每月第一天的加值，所以如果有負的則會出現上個月的日期
    // 同理，如果大於當月日期數，也會出現下個月的日期
    $days[] = date("Y-m-d", strtotime("$diff days", $firstDay));
  }
  // 如果在做月份的減值時，月份低於1就會回到上一年的12月
// 不然就是月份-1 年份不變
  if ($month - 1 < 1) {
    $prev = 12;
    $prev_year = $year - 1;
  } else {
    $prev = $month - 1;
    $prev_year = $year;
  }
  // 如果在做月份的加值時，月份低於1就會到下一年的12月
// 不然就是月份+1 年份不變
  if ($month + 1 > 12) {
    $next = 1;
    $next_year = $year + 1;

  } else {
    $next = $month + 1;
    $next_year = $year;
  }
  ?>
  <!-- 用a link的方式給值給_GET陣列，並再由if判斷式做運算 -->


  <div class="box">
    <div class="prev-box">
      <a href="index.php?year=<?= $prev_year; ?>&month=<?= $prev; ?>">上一個月</a>
    </div>
    <?= $year; ?>年 <?= $month; ?>月
    <div class="next-box">
      <a href="index.php?year=<?= $next_year; ?>&month=<?= $next; ?>">下一個月</a>
    </div>
  </div>
  <div class="container">
    <div class="block-table1">123
    </div>
    <div class="block-table">
      <div class="item-header">日</div>
      <div class="item-header">一</div>
      <div class="item-header">二</div>
      <div class="item-header">三</div>
      <div class="item-header">四</div>
      <div class="item-header">五</div>
      <div class="item-header">六</div>
      <?php
      // 把在迴圈得出來的陣列值用foreach 的方式製作出div box 並在box內印出日期
      foreach ($days as $day) {
        // 設定一個變數，把陣列所取出來的日期炸開並且取陣列中第二個位置
        // ex:陣列[2024-5-1]用explode("-",$day)炸開之後，會變成陣列[2024 5 1]
        // explode("-",$day)[2]，代表炸開後取第三個索引那就是1
        // 那format就是陣列中的日期部分
        $format = explode("-", $day)[2];
        // 再來是找每個日期是星期幾，就直接取陣列$day的時間戳
        $w = date("w", strtotime($day));
        // 用if判斷式來區分平日跟假日
        if ($w == 0 || $w == 6) {
          echo "<div class='item holiday'>$format</div>";
        } else {
          echo "<div class='item'>";
          echo "<div class='date'>$format</div>";
          echo "</div>";
        }



      }
      ?>
    </div>
    <!-- <div class="block-table3"><a href="index.php?year=<?= $next_year; ?>&month=<?= $next; ?>">下一個月</a></div> -->
  </div>



</body>

</html>