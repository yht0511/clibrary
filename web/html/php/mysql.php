<?php
require_once 'settings.php';

function execMysql($sql)
{
    global $dbhost, $dbuser, $dbpass, $dbname;
    @$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!$link) {
        "[" . mysqli_connect_errno() . "]" . mysqli_connect_error() . '<hr>';
        return false;
    }
    $results = mysqli_query($link, $sql);
    if (!$results) {       //$results 取反  出现错误时进入if循环
        "[" . mysqli_errno($link) . "]" . mysqli_error($link) . '<hr>';         //输出错误的序号和详细错误信息
        return false;
    }
    if($results === true){
        return true;
    }
    return $results->fetch_assoc();
}



function getBookData($href)
{
    $href = check_param($href);
    $sql = "select * from BookData where bookHref like \"%$href\";";
    return execMysql($sql);
}

function check_param($value = null)
{
        $value = addslashes($value);
        $value = str_replace("_", "\_", $value);
        $value = str_replace("%", "\%", $value);
        return $value;
} 
