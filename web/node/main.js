// 文件服务器

const express = require("express");
const bodyparser = require("body-parser");
const fs = require("fs");
const path = require("path");
const random = require('string-random');
const nodemailer = require("nodemailer");

const filePassword = '文件服务器密码'
const url_root="https://librarycdn.teclab.org.cn/";
const file_root = "/Data/Books-Spider/";
const mapping = {
    "library.teclab.org.cn": "https://librarycdn.teclab.org.cn/",
    "book.yht.life": "https://bookcdn.yht.life/",
    "192.168.1.4:3080": "http://192.168.1.4:3081/"
}

var app = express();
//允许来自librarycdn.teclab.org.cn和bookcdn.yht.life的请求
app.all('*', function (req, res, next) {
    res.header('Access-Control-Allow-Origin', 'https://librarycdn.teclab.org.cn');
    res.header('Access-Control-Allow-Origin', 'https://bookcdn.yht.life');
    res.header('Access-Control-Allow-Origin', 'http://192.168.1.4:3081');
    res.header('Access-Control-Allow-Headers', 'Content-Type');
    res.header('Access-Control-Allow-Methods', 'POST,GET');
    res.header('Access-Control-Allow-Credentials', 'true');
    next();
});

app.use(bodyparser.urlencoded({ extended: false }));

var FileData=[];

app.post("/applyFile", function (req, res) {
    var files = req.body;
    var result = [];
    for (var i in files) {
        var file = JSON.parse(files[i]);
        var filePath = file["path"].replace("./Books", file_root);
        if (fs.existsSync(filePath)) {
            file["deadline"]=new Date().getTime()+1000*file["holdTime"];
            file["id"]=random(10);
            file["path"]=filePath;
            roo=url_root;
            if(file["host"]){
                for (var key in mapping) {
                    if (file["host"].includes(key)) {
                        roo = mapping[key];
                        break;
                    }
            }}
            file["url"]=roo+"getFile?id="+file["id"];
            FileData.push(file);
            result.push(file["url"]);
        }else{
            result.push("/img/cover-not-exists.png");
        }
    }
    res.send(result);
});

app.get("/getFile", function (req, res) {
    var id = req.query.id;
    for (var i in FileData) {
        var file = FileData[i];
        if (file["id"] == id) {
            if (file["deadline"] > new Date().getTime()) {
                if(file["name"]) console.log("成功获取文件",file["name"],file["ip"]);
                var filePath = file["path"].replace("./Books", file_root);
                //设置下载文件的名称
                res.download(filePath,file["name"]);
                return;
            }else{
                res.send("File expired");
                return;
            }
        }
    }
    res.send("File not found");
});

app.post("/sendFileByEmail", function (req, res) {
    //超过50M的文件不发送
    var filePath = req.body.path.replace("./Books", file_root);
    var stats = fs.statSync(filePath);
    var fileSize = stats.size;
    if (fileSize > 50 * 1024 * 1024) {
        res.send("{\"status\":0}")
        return;
    }
    sendMail(
        req.body.target,
        req.body.name,
        filePath,
        res
    );
});


// app.post("/sendEmail", function (req, res) {
//     console.log(3,res);
// });

app.listen(3081, function () {
    console.log("Start");
});


function sendMail(user, filename, path, res) {
 
    //配置信息
    const transporter = nodemailer.createTransport({
        host: "mail.teclab.org.cn",     //SMTP
        port: 587,    // 端口
        secure: false,            // 使用 SSL
        secureConnection: false, // 使用 SSL
        auth: {
            user: "用户名，你的邮箱地址",     //用户名，你的邮箱地址
            pass: "授权码" //授权码  
        }
    });
 
    const mailOptions = {
        from: "用户名，你的邮箱地址",      // 发件地址
        to: user,             // 收件地址
        subject: filename,  // 标题
        text:"这是由Clibrary图书馆发送的书籍.\n\n书名:"+filename+"\n目标邮件地址:"+user+"\n"+"时间:"+new Date().toLocaleString()+"\n\n[本消息由自动化程序发送]\n天创实验室(TECLAB)",  //内容
           
        //发送附件
        attachments: [{
            filename: filename, //文件名称
            path: path              //本地路径
        }]
    };
 
    transporter.sendMail(mailOptions, function(error, info){
        if(error){
            console.log(error);
            res.send("{\"status\":0}")
            console.log('发送邮件失败: ' + filename + " 至 " + user);
        }
        else{
            res.send("{\"status\":1}")
            console.log('成功发送邮件: ' + filename + " 至 " + user);
        }
    });
 
}
