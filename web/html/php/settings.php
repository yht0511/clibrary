<?php
//文件服务器地址
$fileServerRoot = 'http://127.0.0.1:3081';
$applyFileUrl = 'http://127.0.0.1:3081/applyFile';
$applyEmailUrl = 'http://127.0.0.1:3081/sendFileByEmail';
$sendEmailUrl = 'http://127.0.0.1:3081/sendEmail';
$sendMobiEmailUrl = 'http://127.0.0.1:8667/sendMobiByEmail';
$mobiFileUrl = 'http://127.0.0.1:8667';
//文件服务器密码
$filePassword = '文件服务器密码';
//图片有效时间(s)
$imgHoldTime = 1 * 60;
//文件有效时间(s)
$fileHoldTime = 30 * 60;
//数据库
$dbhost = "192.168.1.4:3306";
$dbuser = "root";
$dbpass = "Mysql密码";
$dbname = "Z-Library";
//向用户显示的内容
$displayItems = [
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
    'coverPath',
    'detail'
];
//用户默认每日下载数
$daliyDownloadNum = 10;
//刷新间隔
$refreshGap = 3600 * 24;
