<?php
require_once 'settings.php';

/**
 * 发送文件申请
 * @param array $postData 请求数据
 * @return string
 */
function applyFiles($postData){
    global $applyFileUrl;
    $res=posturl($applyFileUrl,$postData);
    return $res;
}

/**
 * 发送邮件
 * @param array $postData 请求数据
 * @return string
 */
function applyEmail($postData){
    global $applyEmailUrl;
    $res=posturl($applyEmailUrl,$postData);
    return $res;
}

/**
 * 转换为epub再发送邮件
 * @param array $postData 请求数据
 * @return string
 */
function sendMobiEmail($postData)
{
    global $sendMobiEmailUrl;
    $res = posturl($sendMobiEmailUrl, $postData);
    return $res;
}

/**
 * 指定收件人,名称及文件连接发送邮件
 * @param array $postData 请求数据
 * @return string
 */
function sendEmail($postData)
{
    global $sendEmailUrl;
    $res = posturl($sendEmailUrl, $postData);
    return $res;
}

/**
 * 发送post请求
 * @param string $url 请求地址
 * @param array $post_data post键值对数据
 * @return string
 */
function posturl($url, $post_data) {
    $postdata = http_build_query($post_data);
    $options = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type:application/x-www-form-urlencoded',
        'content' => $postdata,
        'timeout' => 15 * 60 // 超时时间（单位:s）
    )
  );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result, true);
}

?>