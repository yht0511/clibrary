<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>邮箱设置 - clibrary中文图书馆</title>
    <link rel="shortcut icon" href="/img/icon.png">
    <style>
        body {
            padding-top: 80px;
        }

        .contentBox {
            position: relative;
            left: 15%;
            padding-bottom: 100px;
            width: 70%;
            margin-bottom: 10px;
            background-color: #fff;
            font-size: 20px;
        }

        .title {
            background-color: rgb(130, 247, 169);
            text-align: center;
            padding: 10px 0;
        }

        #input {
            position: absolute;
            width: 60%;
            height: 30px;
            line-height: 30px;
            font-size: 20px;
            left: 20%;
            margin-top:10px;
        }

        #commit {
            position: absolute;
            padding: 5px 15px;
            font-size: 20px;
            bottom: 10px;
            right: 10px;
            background-color: #2a86ff;
            color: #fff;
            cursor: pointer;
        }

        .step{
            margin: 5px 10px;
        }

        @media only screen and (max-width: 550px) {
            .contentBox {
                position: relative;
                left: 5%;
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <link rel="stylesheet" href="/css/every.css">
    <div class="contentBox">
        <div class="title">邮件设置向导</div>
        <div class="step">你好,这里是邮件设置向导.</div>
        <div class="step">我们使用<b>automation@teclab.org.cn</b>发送邮件到你的Kindle,这样你就可以无需亲自下载而直接阅读.</div>
        <div class="step">1. 请在亚马逊官网上自定义你的Kindle电子邮件地址:<a href='https://www.amazon.cn/hz/mycd/myx#/home/settings/payment' target="_blank">设备管理</a>(单击个人文档设置=>〖发送至Kindle〗电子邮箱).</div>
        <div class="step">2. 信任我们的电子邮件地址<b>automation@teclab.org.cn</b>(个人文档设置=>已认可的发件人电子邮箱列表).</div>
        <div class="step">3. 在下方输入框中键入您在第一步中设置的Kindle电子邮件地址.</div>
        <input type="text" name="" id="input">
        <div id='commit' onclick="document.cookie = 'email=' + document.getElementById('input').value + ';expires=' + 'Fri, 31 Dec 9999 23:59:59 GMT';window.history.back();">提交</div>
    </div>
</body>

</html>
