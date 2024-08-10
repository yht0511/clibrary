// var imgs = $('img');
// for (var i in imgs) {
//     try {
//         if ($(imgs[i]).attr('src') == '/img/cover-not-exists.png') {
//             $(imgs[i]).after($('<div class="bookcoverPath">书</div>'));
//         }
//     }
//     catch (e) { }
// }
if ($('.bookdetail')[0].innerText == 'undefined') {
    $('.bookdetail')[0].innerText = '本书无描述.';
}
//下载按钮
$('.dlButton')[0].onclick = function () {
    if (this.style.backgroundColor !== 'rgb(100, 100, 100)') {
        this.style.backgroundColor = 'rgb(100, 100, 100)';
        var link = '/dl/' + window.location.href.split('book/')[1];
        Alert('文件获取中...', 1);
        $.get({
            url: link, success: function (data) {
                if (data != '/img/cover-not-exists.png') {
                    window.location.href = data;
                    Alert('获取成功!', 1);
                    //刷新ip剩余次数
                    var nums = $('.ipDownloadNum')[0].innerText.split('/');
                    nums[0] -= 1;
                    $('.ipDownloadNum')[0].innerText = nums[0] + '/' + nums[1];
                }
                else {
                    Alert('下载失败!', 0);
                }
                $('.dlButton')[0].style.backgroundColor = '#2a86ff';
            }, error: function () {
                Alert('下载失败!', 0);
                $('.dlButton')[0].style.backgroundColor = '#2a86ff';
            }
        })
    }
}
//邮件按钮
$('.emailButton')[0].onclick = function () {
    if (this.style.backgroundColor !== 'rgb(100, 100, 100)') {
        var email = getCookie('email');
        console.log(email);
        if (!email) {
            window.location = '/emailSetting';
            return;
        }
        this.style.backgroundColor = 'rgb(100, 100, 100)';
        var link = '/send?book=/' + window.location.href.split('book/')[1] + '&email=' + email;
        if ($('.bookformat')[0].innerText.indexOf('MOBI')!=-1)
            Alert('Kindle不再支持mobi,转换后发送...', 1);
        else
            Alert('发送中...', 1);
        $.get({
            url: link, success: function (data) {
                if (data == '1') {
                    Alert('发送成功!', 1);
                    //刷新ip剩余次数
                    var nums = $('.ipDownloadNum')[0].innerText.split('/');
                    nums[0] -= 1;
                    $('.ipDownloadNum')[0].innerText = nums[0] + '/' + nums[1];
                }
                else {
                    Alert('发送失败!', 0);
                }
                $('.emailButton')[0].style.backgroundColor = '#3bb839';
            }, error: function () {
                Alert('发送失败!', 0);
                $('.emailButton')[0].style.backgroundColor = '#3bb839';
            }
        })
    }
}

function getCookie(cookie_name) {
    var allcookies = document.cookie;
    //索引长度，开始索引的位置
    var cookie_pos = allcookies.indexOf(cookie_name);
    // 如果找到了索引，就代表cookie存在,否则不存在
    if (cookie_pos != -1) {
        // 把cookie_pos放在值的开始，只要给值加1即可
        //计算取cookie值得开始索引，加的1为“=”
        cookie_pos = cookie_pos + cookie_name.length + 1;
        //计算取cookie值得结束索引
        var cookie_end = allcookies.indexOf(";", cookie_pos);
        if (cookie_end == -1) {
            cookie_end = allcookies.length;
        }
        //得到想要的cookie的值
        var value = unescape(allcookies.substring(cookie_pos, cookie_end));
    }
    return value;
}
    
