<?php
require_once 'settings.php';
require_once 'mysql.php';

function getIp()
{
    // if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
    //     $cip = $_SERVER["HTTP_CLIENT_IP"];
    // } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    //     $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    // } else if (!empty($_SERVER["REMOTE_ADDR"])) {
    //     $cip = $_SERVER["REMOTE_ADDR"];
    // } else {
    //     $cip = '';
    // }
    // preg_match("/[\d\.]{7,15}/", $cip, $cips);
    // $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    // unset($cips);
    
    if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $cip = $_SERVER["HTTP_CF_CONNECTING_IP"];
    } else {
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    
    return $cip;
}

function getIpStatus()
{
    global $ip, $refreshGap;
    $sql = "select * from IPData where ip=\"$ip\";";
    $data = execMysql($sql);
    if ($data === null) {
        createNewIp($ip);
        // echo "[ERROR]";
        return getIpStatus();
    }
    if($data['refreshDate']+ $refreshGap<time()){
        refreshIpNum($ip,$data['totalNum']);
        return getIpStatus();
        // echo "[ERROR1]";
    }
    return $data;
}

function createNewIp($ip)
{
    global $daliyDownloadNum;
    $time= time();
    $sql = "INSERT INTO IPData (ip, leftNum, totalNum, refreshDate, status) values (\"$ip\",$daliyDownloadNum,$daliyDownloadNum,$time,1);";
    $data = execMysql($sql);
    return $data;
}

function refreshIpNum($ip,$num){
    $time = time();
    $sql = "UPDATE IPData SET leftNum=$num,refreshDate=$time where ip=\"$ip\";";
    $data = execMysql($sql);
    return $data;
}


//获取用户ip
$ip = getIp();
$ip = check_param($ip);

