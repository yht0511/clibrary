<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>关于 - clibrary中文图书馆</title>
    <link rel="shortcut icon" href="/img/icon.png">
    <style>
        body {
            padding-top: 80px;
        }

        .contentBox {
            position: relative;
            left: 15%;
            padding-bottom: 80px;
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
            margin-top: 10px;
        }

        #goback {
            position: absolute;
            padding: 5px 15px;
            font-size: 20px;
            bottom: 10px;
            right: 10px;
            background-color: #2a86ff;
            color: #fff;
            cursor: pointer;
        }

        .step {
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
        <div class="title">关于本站</div>
        <div class="step">你好,这里是本站的介绍.</div>
        <div class="step">
            Z-Library为知识自由做出了巨大的贡献,然而其在国内无法正常打开(The Great Firewall).人们建立了镜像站,但仍面临不稳定等问题.</div>
        <div class="step">因此,我从Z-Library获取了部分图书数据(中文书)存于国内,建立了Clibrary.</div>
        <div class="step">本站当前仅支持搜索并下载/发送中文图书,将来或许会增加论文下载/评论等功能.</div>
        <div class="step">Clibrary完全是公益性质,不但不会以任何形式盈利,连捐款按钮都没有.</div>
        <div class="step">[2022.9]</div>
        <hr />
        <div class="step">22年刚上高二,后来因为时间精力等原因,该项目被停止.</div>
        <div class="step">现在高考已经结束,是时候回归了.</div>
        <div class="step">[2024.8]</div>
        <div id='goback' onclick="window.history.back();">返回</div>
    </div>
</body>

</html>
