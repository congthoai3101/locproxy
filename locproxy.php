<?php
error_reporting(0);
@system('clear');
echo "\033[1;97m~ \033[1;92mFile Chứ Proxy (ĐD : IP:PORT) : \033[1;95m";
$_CHOOSE['ProxyFile'] = trim(fgets(STDIN));
echo "\033[1;97m~ \033[1;92mFile Sẽ Chứa Proxy Live : \033[1;95m";
$_CHOOSE['ProxyLive'] = trim(fgets(STDIN));
echo "\033[1;97m~ \033[1;92mFile Sẽ Chứa Proxy Die : \033[1;95m";
$_CHOOSE['ProxyDie'] = trim(fgets(STDIN));
echo "\033[1;97m- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n";
if (!file_exists($_CHOOSE['ProxyFile'])){
echo "\033[1;97m~ \033[1;92mFile Không Tồn Tại!!\n";
die;
}
if (!file_exists($_CHOOSE['ProxyLive'])){
echo "\033[1;97m~ \033[1;92mFile Không Tồn Tại!!\n";
die;
}
if (!file_exists($_CHOOSE['ProxyDie'])){
echo "\033[1;97m~ \033[1;92mFile Không Tồn Tại!!\n";
die;
}
$data   = fread(fopen($_CHOOSE['ProxyFile'] , "r"), filesize($_CHOOSE['ProxyFile']));   
$jsdc   = explode(PHP_EOL,$data);
while (true){
foreach ($jsdc as $get){
$proxy = explode(':', $get);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://google.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy[0]);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxy[1]);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$exec = curl_exec($ch);
$error = curl_error($ch);
if(strpos($error,"CONNECT") == true)
{
$x++;
echo "\033[1;97m~ \033[1;92m[\033[1;95m".$x."\033[1;92m] LIVE!!!\n";
$setup = fopen($_CHOOSE['ProxyLive'],'a+');
$setupwrite = "$get";
fwrite($setup,$setupwrite);
fclose($setup);
} else 
$x++;
echo "\033[1;97m~ \033[1;92m[\033[1;95m".$x."\033[1;92m] DIE!!!\n";
$setup = fopen($_CHOOSE['ProxyDie'],'a+');
$setupwrite = "$get";
fwrite($setup,$setupwrite);
fclose($setup);
}
}
?>