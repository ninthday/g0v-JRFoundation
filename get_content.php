<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

//引入 Class
require_once './classes/LawBank.Class.php';

//引入 Database 連線參數設定檔
require_once './inc/myPDOConnConfig.inc.php';

$dsn = $pdoConfig['DB_DRIVER'] . ':host=' . $pdoConfig['DB_HOST'] .
        ';dbname=' . $pdoConfig['DB_NAME'] .
        ';port=' . $pdoConfig['DB_PORT'] .
        ';connect_timeout=30';

$dbh = new PDO($dsn, $pdoConfig['DB_USER'], $pdoConfig['DB_PASSWD'], $pdoConfig['DB_OPTIONS']);

$timeout = 60;
$base_url = "http://fyjud.lawbank.com.tw/";
$ckfile = tempnam("/tmp", "CURLCOOKIE");
$cookie = dirname(__FILE__) . "\lawbank-cookie.txt";
//define('COOKIE_FILE', 'cookiedk.txt');
$useragent = "Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0";
$f = fopen('lawbank-log.txt', 'w');

$ch = curl_init($base_url . 'index.aspx');
curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
//curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$html = curl_exec($ch);
curl_close($ch);
//echo $html;
sleep(rand(1, 4));

$list_url = "http://fyjud.lawbank.com.tw/list2.aspx";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch2, Cvar / wwwURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch2, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, $timeout);

curl_setopt($ch2, CURLOPT_URL, $list_url);
curl_setopt($ch2, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch2, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch2, CURLOPT_HEADER, FALSE);
curl_setopt($ch2, CURLOPT_REFERER, $base_url . 'index.aspx');
curl_setopt($ch2, CURLOPT_VERBOSE, 1);
curl_setopt($ch2, CURLOPT_STDERR, $f);

$postfields = array();
$postfields["txtmail"] = "%E8%AB%8B%E8%BC%B8%E5%85%A5%E9%9B%BB%E5%AD%90%E4%BF%A1%E7%AE%B1";
$postfields["courtFullName"] = "TPHM";
$postfields["sel_judword"] = "%E5%B8%B8%E7%94%A8%E5%AD%97%E5%88%A5";
$postfields["jcatagory"] = "0";
$postfields["issimple"] = "-1";
$postfields["txtjudge"] = "曾德水";
$postfields["x"] = "46";
$postfields["y"] = "17";
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $postfields);
$html_list = curl_exec($ch2);
curl_close($ch2);


$obj_lb = new LawBank($dbh);

$refer_url = "http://fyjud.lawbank.com.tw/listcontent5.aspx";
while ($row = $obj_lb->getEmptyContentList()) {
    $ch4 = curl_init();
    curl_setopt($ch4, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch4, Cvar / wwwURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch4, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch4, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch4, CURLOPT_CONNECTTIMEOUT, $timeout);

    curl_setopt($ch4, CURLOPT_URL, $base_url . $row["url"]);
    curl_setopt($ch4, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch4, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch4, CURLOPT_COOKIE, "y=p=" . $row["cookie_id"]);
    curl_setopt($ch4, CURLOPT_HEADER, false);
    curl_setopt($ch4, CURLOPT_REFERER, $refer_url);
    curl_setopt($ch4, CURLOPT_VERBOSE, 1);
    curl_setopt($ch4, CURLOPT_STDERR, $f);
    $judge_content = curl_exec($ch4);
    curl_close($ch4);
    
    if (!$obj_lb->updateContent($row["list_id"], $judge_content)) {
        break;
    }
    echo "list_id: " . $row["list_id"];
    $sleep = rand(1, 30);
    echo "----------------------------> sleep " . $sleep . " sec." . PHP_EOL;
    sleep($sleep);
}

