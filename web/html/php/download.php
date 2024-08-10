<?php
require_once 'file.php';
require_once 'settings.php';
require_once 'mysql.php';
require_once 'IpControl.php';

$href = $_GET['arg1'];
$leftNum = getIpStatus()['leftNum'];
if ($leftNum > 0) {
    $data = getBookData($href);
    $path = $data['bookPath'];
    $name = $data['name'];
    $format = strtolower($data['format']);
    $filename = $name . '.' . $format;
    $host=$_SERVER['HTTP_HOST'];
    $link = applyFiles(array("{\"path\": \"$path\",\"name\":\"$filename\", \"ip\":\"$ip\", \"holdTime\":$fileHoldTime,\"host\":\"$host\"}"))[0];
    echo $link;
    if ($link != '/img/cover-not-exists.png') {
        refreshIpNum($ip, $leftNum - 1);
    }
} else {
    echo '/img/cover-not-exists.png';
}
