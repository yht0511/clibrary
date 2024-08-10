<?php
require_once 'file.php';
require_once 'settings.php';
require_once 'mysql.php';
require_once 'IpControl.php';

$href = $_GET['book'];
$target = $_GET['email'];
$leftNum = getIpStatus()['leftNum'];
if ($leftNum > 0) {
    $data = getBookData($href);
    $path = $data['bookPath'];
    $name = $data['name'];
    $format = strtolower($data['format']);
    // if(strpos($format, 'mobi')!==false) {
    //     //先获取下载链接
    //     $link = applyFiles(array("{\"path\": \"$path\",\"name\":\"$name\", \"ip\":\"$ip\", \"holdTime\":$fileHoldTime}"))[0];
    //     //提交给转换器
    //     $epubData=sendMobiEmail(["href" => $link, "name" => $name . '.' . $format, "target" => $target,"password" => $filePassword]);
    //     if($epubData['status']==1){
    //         $status = sendEmail(["href" => $mobiFileUrl.$epubData['path'], "name" => $name . '.epub', "target" => $target])['status'];
    //     }
    //     else{
    //         $status=$epubData['status'];
    //     }
    // } else {
        $status = applyEmail(["path" => $path, "name" => $name . '.' . $format, "target" => $target])['status'];
    // }
    echo $status;
    if ($status == 1) {
        refreshIpNum($ip, $leftNum - 1);
    }
} else {
    echo 0;
}
