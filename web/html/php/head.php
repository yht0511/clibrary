<!-- 用于渲染页面上栏 -->
<?php
require_once 'IpControl.php';
$status = getIpStatus();
// foreach ($_SERVER as $i => $i_value) {
// echo "$i : $i_value\n";
// }
// echo $ip;
echo '<div id="head">';
echo '<div class="goHome" onclick=\'window.location="/";\'>主页</div>';
echo '<div class="libraryName">C-Library</div>';
echo '<div class="ipDownloadNum">'.$status['leftNum'] . '/' . $status['totalNum'].'</div>';
echo '<div class="hiddenItems hide">';
echo '<div class="setEmail hide more" onclick=\'window.location="/emailSetting";\'>邮箱设置</div>';
// echo '<div class="donation hide more"  onclick=\'window.location="/donation";\'>捐款</div>';
echo '<div class="donation hide more"  onclick=\'window.location="/about";\'>关于本站</div>';
echo '<div class="donation hide more"  onclick=\'window.location="https://teclab.org.cn";\'>Teclab</div>';
echo '</div></div>';
?>