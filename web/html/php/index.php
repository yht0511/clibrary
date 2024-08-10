<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>clibrary中文图书馆</title>
    <link rel="shortcut icon" href="/img/icon.png">
</head>

<body>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/every.js"></script>
    <link rel="stylesheet" href="/css/every.css">
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/index.css">
    <?php
    require_once 'head.php';
    ?>
    <img src="/img/clibrary.png" alt="" id='clibraryImg'>
    <p id='clibraryDetail'>Teclab数据库-中文图书馆项目,于2022年9月建立.</p>
    <div id='searchBox'>
        <input type="text" name="" id="searchInput">
        <div id='searchCommit'>搜索</div>
    </div>
    <script>
        var i = document.getElementById('searchInput');
        var c = document.getElementById('searchCommit');
        c.onclick = function() {
            if (i.value != '') {
                window.location = '/search?q=' + i.value;
            }
        }
        i.onkeydown = function(e) {
            if (e.key == 'Enter')
                if (i.value != '') {
                    window.location = '/search?q=' + i.value;
                }
        }
        Notice('发送至Kindle功能已恢复正常~','rgba(200,255,200)',1668254400)
    </script>

</body>

</html>
