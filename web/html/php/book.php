<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>clibrary中文图书馆</title> -->
    <link rel="shortcut icon" href="/img/icon.png">
</head>

<body>
    <script type="text/javascript" src="/js/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="/css/every.css">
    <link rel="stylesheet" href="/css/book.css">
    <div id='searchBox'>
        <input type="text" name="" id="searchInput">
        <div id='searchCommit'>搜索</div>
    </div>
    <script>
        var I = document.getElementById('searchInput');
        var c = document.getElementById('searchCommit');
        c.onclick = function() {
            if (I.value != '') {
                window.location = '/search?q=' + I.value;
            }
        }
        I.onkeydown = function(e) {
            if (e.key == 'Enter')
                if (I.value != '') {
                    window.location = '/search?q=' + I.value;
                }
        }
    </script>
    <?php
    require_once 'head.php';
    require_once '../vendor/autoload.php';
    require_once 'file.php';
    require_once 'IpControl.php';
    require_once 'settings.php';
    require_once 'mysql.php';

    $href = $_GET['arg1'] . '/' . $_GET['arg2'];

    $data = getBookData($href);
    echo "<div class='bookItem'>";
    foreach ($displayItems as $i => $i_value) {
        if ($data[$i_value] === null || $data[$i_value] == 'undefined') $data[$i_value] = '未知';
        if ($i_value == 'coverPath') {
            $host=$_SERVER['HTTP_HOST'];
            $data[$i_value] = applyFiles(array("{\"path\": \"$data[$i_value]\", \"ip\":\"$ip\", \"holdTime\":$imgHoldTime,\"host\":\"$host\"}"))[0];
            echo '<img class="book' . $i_value . '" src="' . $data[$i_value] . '"/>';
            if (strpos($data[$i_value], '/img/cover-not-exists.png')!==false) {
                echo '<div class="bookcoverPath">书</div>';
            }
        } else
            echo '<div class="book' . $i_value . '">' . $data[$i_value] . '</div>';
    }
    echo "</div>";
    $name = $data["name"];
    echo "<title>$name-clibrary中文图书馆</title>";
    ?>

    <div class='dlButton'>下载</div>
    <div class='emailButton'>发送到Kindle</div>
    <script src="/js/every.js"></script>
    <script src="/js/book.js"></script>
</body>

</html>
