<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>clibrary中文图书馆</title> -->
  <?php
  $q = $_GET["q"];
  echo "<title>$q-clibrary中文图书馆</title>";
  ?>
  <link rel="shortcut icon" href="/img/icon.png">
</head>

<body>
  <script type="text/javascript" src="/js/jquery-2.2.4.min.js"></script>
  <link rel="stylesheet" href="css/every.css">
  <link rel="stylesheet" href="css/search.css">
  <div id='searchBox'>
    <input type="text" name="" id="searchInput">
    <div id='searchCommit'>搜索</div>
  </div>

  <?php
  require_once 'head.php';
  require_once '../vendor/autoload.php';
  require_once 'file.php';
  require_once 'IpControl.php';
  require_once 'settings.php';


  use MeiliSearch\Client;
  //连接meilisearch
  $client = new Client('http://localhost:7700');
  //输出的数据
  $return = [];
  //只显示部分信息
  $client->index('books')->updateDisplayedAttributes([
    'name',
    'authors',
    'publisher',
    'category',
    'year',
    'language',
    'format',
    'size',
    'interestScore',
    'qualityScore',
    'bookHref',
    'coverPath'
  ]);
  $client->index('books')->updateSearchableAttributes([
    'name',
    'authors'
  ]);
  $res = $client->index('books')->search($_GET["q"]);
  //如果啥都没有,就输出'无结果'
  if (count($res) == 0) {
    echo "<div class='noResults'>无结果</div>";
  }

  $imgArray = array();
  foreach ($res as $x => $x_value) {
    $itemReturn = '<div class="bookItem"><div class="booknum">' . $x . '</div>';
    foreach ($x_value as $y => $y_value) {
      if ($y_value == 'undefined') {
        $y_value = '未知';
      }
      if ($y == 'bookHref') $y_value = explode('book', $y_value)[1]; //分离链接
      if ($y != 'coverPath')
        $itemReturn .= '<div class="book' . $y . '">' . $y_value . '</div>';
      else
        array_push($imgArray, "{\"path\": \"$y_value\", \"ip\":\"$ip\", \"holdTime\":$imgHoldTime}");
    }
    array_push($return, $itemReturn);
  }
  $imgLinks = applyFiles($imgArray); //向服务器申请cover路径
  $arrlength = count($res);
  for ($i = 0; $i < $arrlength; $i++) {
    echo $return[$i];
    echo '<img class="bookImg" src="' . $imgLinks[$i] . '"></img>';
    if($imgLinks[$i]== '/img/cover-not-exists.png'){
      echo '<div class="bookImg">书</div>';
    }
    echo '</div>';
  }
  ?>
  <script type="text/javascript" src="/js/every.js"></script>
  <script type="text/javascript" src="/js/search.js"></script>
</body>

</html>