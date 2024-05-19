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

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
    body {
      margin: 0;
      overflow: hidden;
      background-color: #222;
    }

    .raindrop {
      position: absolute;
      width: 3px;
      height: 30px;
      background-color: gray;
      opacity: 0.1;
      opacity: 0.6;


    }

    .material-symbols-outlined {
      padding-right: 20px;

      text-shadow:
        /* 0 0 2.5px white,
        0 0 5px white,
        0 0 10px white, */
        0 0 1px rgb(255, 0, 255),
        0 0 1px rgb(255, 0, 255),
        0 0 1px rgb(255, 0, 255),
        0 0 1px rgb(255, 0, 255);
      font-size: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s, filter 0.3s;

      font-variation-settings:
        'FILL' 1,
        'wght' 800,
        'GRAD' 0,
        'opsz' 24;
    }

    .material-symbols-outlined:hover {
      text-shadow:
        /* 0 0 2.5px white,
        0 0 5px white,
        0 0 10px white, */
        0 0 3px rgb(255, 0, 255),
        0 0 5px rgb(255, 0, 255),
        0 0 10px rgb(255, 0, 255),
        0 0 20px rgb(255, 0, 255);
      transform: scale(1.1);
      filter: drop-shadow(0 0 50px rgb(255, 0, 255));
    }
  </style>

</head>

<body>
  <a href="test.php">test</a>
  <script src="rainy.js"></script>
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
  $firstDay = strtotime(date("$year-$month-1"));
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

  $only_prev_year = $year - 1;
  $only_next_year = $year + 1;

  $year_digits_array = str_split($year);
  $year_tens_digits = $year_digits_array[2] ?? '';
  $year_digits = $year_digits_array[3] ?? '';


  ?>
  <!-- 用a link的方式給值給_GET陣列，並再由if判斷式做運算 -->
  <nav>
    <div class="yearbox">
      <span>2</span>
      <span>0</span>
      <span><?php echo $year_tens_digits; ?></span>
      <span><?php echo $year_digits; ?></span>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="year-buttonbox">
        <div class="year-prev-box">

          <a href="index.php?year=<?= $only_prev_year; ?>&month=<?= $month; ?>" title="prev year"></a>
        </div>
        <div class="year-prev-box">
          <a href="index.php?year=<?= $only_prev_year; ?>&month=<?= $month; ?>" title="prev year"></a>
        </div>

        </a>
        <div class="year-next-box">
          <a href="index.php?year=<?= $only_next_year; ?>&month=<?= $month; ?>" title="next year"></a>
        </div>
        <div class="year-next-box">
          <a href="index.php?year=<?= $only_next_year; ?>&month=<?= $month; ?>" title="next year"></a>
        </div>
      </div>
      <div class="month-buttonbox">

        <div class="month-prev-box">
          <a href="index.php?year=<?= $prev_year; ?>&month=<?= $prev; ?>" title="prev month"></a>
        </div>

        <div class="month-prev-box">
          <a href="index.php?year=<?= $prev_year; ?>&month=<?= $prev; ?>" title="prev month"></a>
        </div>
        <a href="index.php" title="today"><span class="material-symbols-outlined">
            today
          </span>
        </a>
        <div class="month-next-box">
          <a ; href="index.php?year=<?= $next_year; ?>&month=<?= $next; ?>" title="next month"></a>
        </div>
        <div class="month-next-box">
          <a ; href="index.php?year=<?= $next_year; ?>&month=<?= $next; ?>" title="next month"></a>
        </div>

      </div>



      <div class="block-table">
        <div class="item header-weeken">SUN</div>
        <div class="item header">MON</div>
        <div class="item header">TUE</div>
        <div class="item header">WED</div>
        <div class="item header">THU</div>
        <div class="item header">FRI</div>
        <div class="item header-weeken">SAT</div>
        <?php
        $specary = [
          "Y-1-15" => "MLKD",
          "Y-2-28" => "228",
          "Y-3-8" => "IWD",
          "Y-3-14" => "Pi Day",
          "Y-4-1" => "AFD",
          "Y-4-2" => "WAAD",
          "Y-5-1" => "IWD",
          "Y-5-12" => "IND",
          "Y-5-18" => "ICOM",
          "Y-5-26" => "NSD",
          "Y-5-ˇ31" => "WNTD",
          "Y-6-1" => "ICD",
          "Y-6-5" => "WED",
          "Y-6-14" => "WBDD",
          "Y-7-7" => "WCD",
          "Y-7-27" => "MMBD",
          "Y-8-1" => "IDIP",
          "Y-8-13" => "ILHD",
          "Y-9-10" => "TSD",
          "Y-9-21" => "IDP",
          "Y-10-4" => "DAD",
          "Y-10-14" => "WSD",
          "Y-10-16" => "DFD",
          "Y-10-17" => "IDEP",
          "Y-10-23" => "MBD",
          "Y-11-20" => "TDoR",
          "Y-11-25" => "WVD",
          "Y-12-10" => "IBHR",
          "Y-12-25" => "Xmas",
        ];
        $isspecary = false;
        // 把在迴圈得出來的陣列值用foreach 的方式製作出div box 並在box內印出日期
        foreach ($days as $day) {
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
              echo "<div class='item special'>$formatday";
              echo "<br>";
              echo "$spedayname</div>";
              $isspecary = true;
            }
          }
          if (!$isspecary) {
            if ($month != $m) {
              echo "<div class='item other'>$formatday</div>";
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
          "January" => [
            "MLKD" => "Martin Luther King, Jr. Day",
          ],
          "February" => [
            "228" => "Peace Memorial Day",
          ],
          "March" => [
            "IWD" => "Pi Day",
            "Pi Day" => "Pi Day",
          ],
          "April" => [
            "AFD" => "April Fool's Day",
            "WAAD" => "World Autism Awareness Day",
          ],
          "May" => [
            "IWD" => "International Workers Day",
            "IND" => "International Nurses Day",
            "ICOM" => "International Council of Museums",
            "NSD" => "National Sorry Day",
            "WNTD" => "World No Tobacco Day",

          ],
          "June" => [
            "ICD" => "International Children's Day",
            "WED" => "World Environment Day",
            "WBDD" => "World Blood Donor Day",
          ],
          "July" => [
            "WCD" => "World Chocolate Day",
            "MMBD" => "My Mom's Birthday",

          ],
          "August" => [
            "IDIP" => "International Day of the Indigenous People",
            "ILHD" => "International Left-Handers Day",
          ],
          "September" => [
            "IDP" => "International Day of Peace",
            "TSD" => "Teacher's Day",
          ],
          "Octorber" => [
            "DAD" => "World Animal Day",
            "WSD" => "World Standards Day",
            "DFD" => "World Food Day",
            "IDEP" => "International Day for the Eradication of Poverty",
            "MBD" => "My Birthday",
          ],
          "November" => [
            "TDoR" => "Transgender Day of Remembrance",
            "WVD" => "World Vegetarian Day",
          ],
          "December" => [
            "IBHR" => "International Bill of Human Rights",
            "Xmas" => "Christmas",
          ]
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