//鼠标点击进入
var booknames = $('.bookItem');
for (var i in booknames) {
    try {
        booknames[i].onclick = function () {
            window.location = '/book' + $(this).children()[11].innerText;
        }
    }
    catch (e) { }
}
//搜索框
if (window.location.href.split('q=')[1])
    $('#searchInput')[0].value=decodeURI(window.location.href.split('q=')[1]);
$('#searchCommit')[0].onclick=function(){
    if($('#searchInput')[0].value!='')
        window.location = '/search?q=' + $('#searchInput')[0].value;
}
$('#searchInput')[0].onkeydown = function (e) {
    if (e.key=='Enter' && $('#searchInput')[0].value != '')
        window.location = '/search?q=' + $('#searchInput')[0].value;
}


















