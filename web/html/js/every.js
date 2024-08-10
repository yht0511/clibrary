//提示信息
function Alert(message, Type) {
    const typeArray = { 1: 'successAlert', 0: 'errorAlert' };
    var box = $('<div class="alertBox ' + typeArray[Type] + '">' + message + '</div>');
    $('body').append(box);
    $('.alertBox').on('click', function () {
        $('.alertBox').remove();
    });
    (function (box) {
        setTimeout(function () {
            box.remove();
        }, 5000);
    })(box);
}

//首页通知
function Notice(message, color,time) {
    if (!time | Date.now()/1000<time){
        if (!color) color = 'green';
        hiddenNoticeBoxContent.innerText = message.replace(/ /g, '&nbsp;');
        if (hiddenNoticeBoxContent.scrollWidth > hiddenNoticeBoxContent.clientWidth) {
            for (let i = 1; i <= $('.noticeBoxContent')[0].clientWidth / 8; i++) {
                message = ' ' + message;
                message += ' ';
            }
        }
        message = message.replace(/ /g, '&nbsp;');
        var box = $('<div class="noticeBox normalNoticeBox" style="background-color:' + color + ';"><div class="noticeBoxContent normalNoticeBoxContent">' + message + '</div><div class="noticeBoxHide">关闭</div></div>');
        $('.normalNoticeBox').remove();
        $('body').append(box);
        $('.noticeBoxHide').on('click', function () {
            $('.normalNoticeBox').remove();
        });
    }
}

function NoticeScroll() {
    box = $('.normalNoticeBoxContent')[0]
    if (box != undefined) {
        left = box.scrollLeft + 1;
        total = box.scrollWidth - box.clientWidth;

        if (total - 20 < left)
            left = 0;

        if (hiddenNoticeBoxContent.scrollWidth > hiddenNoticeBoxContent.clientWidth)
            box.scrollTo(left, 0);
        else
            box.scrollTo(0, 0);
    }
}

var initBox = $('<div class="noticeBox" style="visibility: hidden;"><div class="noticeBoxContent hiddenNoticeBoxContent"></div><div class="noticeBoxHide"></div></div>');
$('body').append(initBox);
var hiddenNoticeBoxContent = $('.hiddenNoticeBoxContent')[0];
setInterval(NoticeScroll, 10)