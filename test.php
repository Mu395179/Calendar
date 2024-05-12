<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>calendar</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&family=Pacifico&display=swap"
    rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet">

</head>

<body>
  <a href="test.php">test</a>
  <!-- <img src="https://img.freepik.com/premium-photo/wet-asphalt-reflection-abstract-dark-setting_957479-15394.jpg?w=996"
    alt=""> -->

  <?php
  // 先設月份變數為_GET陣列，這樣之後做給值的網址就可以直接變成日期格式
  // $month=(isset($_GET['month']))?$_GET['month']:date("m");
  // ??是isset判斷式的簡寫，所以此程式代表:
  // 此_GET陣列是否存在，如果存在那變數$month就會被賦予_GET陣列的值
  // 如果不存在就會取此時此刻的月份來當作$month變數的值git
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
  // $lastDay = strtotime(date("Y-$month-$days"));
  // echo "<br>";
  // 從最後一天的時間戳，取當天日期
  // echo "最後一天是" . date("Y-m-d", $lastDay);
  

  // 先設日期陣列，把迴圈所得的結果存入陣列，並應出來
  $daysArray = [];
  // 要製作一個6*7的css box 需要42個值
  for ($i = 0; $i < 42; $i++) {
    $diff = $i - $firstWeekStarDay;
    $currentDay = strtotime("$diff days", $firstDay);
    $daysArray[] = date("Y-m-d", $currentDay);
  }
  // 如果在做月份的減值時，月份低於1就會回到上一年的12月
// 不然就是月份-1 年份不變
$prev = ($month - 1 < 1) ? 12 : $month - 1;
$prev_year = ($month - 1 < 1) ? $year - 1 : $year;

$next = ($month + 1 > 12) ? 1 : $month + 1;
$next_year = ($month + 1 > 12) ? $year + 1 : $year;

$only_prev_year = $year - 1;
$only_next_year = $year + 1;

$year_digits_array = str_split($year);
$year_tens_digits=$year_digits_array[2] ?? '';
$year_digits=$year_digits_array[3] ?? '';

  ?>
  <!-- 用a link的方式給值給_GET陣列，並再由if判斷式做運算 -->
  <nav>
    <div class="yearbox">
      <span>2</span>
      <span>0</span>
      <span><?php echo $year_tens_digits;?></span>
      <span><?php echo $year_digits;?></span>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="buttonbox">
        <div class="prev-box">
          <a href="test.php?year=<?= $only_prev_year; ?>&month=<?= $month; ?>"></a>
        </div>
        <div class="prev-box">
          <a href="test.php?year=<?= $prev_year; ?>&month=<?= $prev; ?>"></a>
        </div>

        <div class="next-box">
          <a ; href="test.php?year=<?= $next_year; ?>&month=<?= $next; ?>"></a>
        </div>
        <div class="next-box">
          <a href="test.php?year=<?= $only_next_year; ?>&month=<?= $month; ?>"></a>
        </div>
      </div>

      <div class="block-table">
        <div class="item header">SUN</div>
        <div class="item header">MON</div>
        <div class="item header">TUE</div>
        <div class="item header">WED</div>
        <div class="item header">THU</div>
        <div class="item header">FRI</div>
        <div class="item header">SAT</div>
        <?php
        $specary = [
          "Y-5-1" => "勞動節",
          "Y-5-12" => "護士節",
          "Y-5-26" => "道歉節",
        ];
        $isspecary = false;
        // 把在迴圈得出來的陣列值用foreach 的方式製作出div box 並在box內印出日期
        foreach ($daysArray as $day) {
          // 設定一個變數，把陣列所取出來的日期炸開並且取陣列中第二個位置
          // ex:陣列[2024-5-1]用explode("-",$day)炸開之後，會變成陣列[2024 5 1]
          // explode("-",$day)[2]，代表炸開後取第三個索引那就是1
          // 那format就是陣列中的日期部分
        
          $formatmonth = explode("-", $day)[1];
          $formatday = explode("-", $day)[2];
          foreach ($specary as $spedate => $spedayname) {
            $spemonth = explode("-", $spedate)[1];
            $spemday = explode("-", $spedate)[2];
            $m = date("m", strtotime($day));

            if ($formatmonth == $spemonth && $formatday == $spemday) {
              echo "<div class='item'>$formatday";
              echo "<br>";
              echo "$spedayname</div>";
              $isspecary = true;
            }
          }
          if (!$isspecary) {
            if ($month != $m) {
              echo "<div class='item'>$formatday</div>";
            } else {
              echo "<div class='item'>$formatday</div>";
            }

          }
          $isspecary = false;
        }
        ?>
        <?php
        $monthname = [
          "1" => "January",
          "2" => "February",
          "3" => "March",
          "4" => "April",
          "5" => "May",
          "6" => "June",
          "7" => "July",
          "8" => "August",
          "9" => "September",
          "10" => "Octorber",
          "11" => "November",
          "12" => "December",
        ];
        $getMonthtext = [
          "January" => [],
          "February" => [],
          "March" => [],
          "April" => [],
          "May" => [
            "勞動節" => "International Workers Day",
            "護士節" => "International Nurses Day",
            "道歉節" => "National Sorry Day",
          ],
          "June" => [],
          "July" => [],
          "August" => [],
          "September" => [],
          "October" => [],
          "November" => [],
          "December" => []
        ];
        $getMonth = $_GET['month'] ?? date("n");
        $getMonthName = $monthname[$getMonth] ?? date("n");
        $getMonthText = $getMonthtext[$getMonthName] ?? [];


        ; ?>
      </div>
      <div class="textbox">
        <div class="monthname"><?php echo $monthname[$getMonth]; ?></div>
        <div class="monthtextbox">
          <span>
            <div class="monthtext">
              <?php
              foreach ($getMonthText as $key => $value) {
                echo "$key: $value<br>";
              } ?>
            </div>
          </span>
        </div>
      </div>
    </div>
  </div>



</body>

</html>