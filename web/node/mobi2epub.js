const convert = require('ebook-convert')
const express = require("express");
const bodyparser = require("body-parser");
const fs = require("fs");
const path = require("path");
const random = require('string-random');
const nodemailer = require('nodemailer');
const download = require('download');
const filePassword = '文件服务器密码'


var app = express();
app.use(bodyparser.urlencoded({ extended: false }));
app.use('/temp',express.static('./temp'))

app.post("/sendMobiByEmail", function (req, res) {
    var data = req.body;
    console.log('开始发送邮件.');
    res.set("Content-Type", "text/plain; charset=utf-8");
    if (data['href'] && data['password']==filePassword) {
        Path = 'temp/' + random(32) + '.mobi';
        target = 'temp/' + random(32) + '.epub';
        (async () => {
            console.log('开始下载');
            // await download(data['href']).pipe(fs.createWriteStream(Path));
            fs.writeFileSync(Path, await download(data['href']));
            console.log('下载完成');
            convert2Epub(Path, target, function (status) {
                console.log('转换完成');
                if (status) {
                    // sendEmail(data['target'], data['name'].replace('.mobi', '.epub'), target, function (status) {
                    //     if (status) {
                    //         res.end('{"status":1}');
                    //     }
                    //     else {
                    //         res.end('{"status":0}');
                    //     }
                    //     fs.unlink(target);
                    // })
                    res.end('{"status":1,"path":"/'+target+'"}');
                    (function (target, Path){
                        setTimeout(function(){
                            fs.unlinkSync(target);
                            fs.unlinkSync(Path);
                        },30*60000)
                    })(target, Path);
                }
                else {
                    res.end('{"status":0}');
                }
            })
        }
        )();
    }
});

app.listen(8667, function () {
    console.log("Start");
});

function convert2Epub(path, target, callback) {
    var options = {
        input: path,
        output: target,
        pageBreaksBefore: '//h:h1',
        chapter: '//h:h1',
        insertBlankLine: true,
        insertBlankLineSize: '1',
        lineHeight: '12',
        marginTop: '50',
        marginRight: '50',
        marginBottom: '50',
        marginLeft: '50'
    }
    convert(options, function (err) {
        if (err) { console.log(err); callback(0); }
        else
            callback(1);

    })
}
