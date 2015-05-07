<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

$timeout = 60;
$url = "http://fyjud.lawbank.com.tw/index.aspx";
$ckfile = tempnam("/tmp", "CURLCOOKIE");
$cookie = dirname(__FILE__) . "\lawbank-cookie.txt";
//define('COOKIE_FILE', 'cookiedk.txt');
$useragent = "Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0";
$f = fopen('lawbank-log.txt', 'w');

$ch = curl_init($url);
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
curl_setopt($ch2, CURLOPT_REFERER, $url);
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
//echo $html_list;
preg_match_all('/<iframe[^>]+>/i', $html_list, $iframes);
//print_r($iframes);

foreach ($iframes[0] as $iframe) {
    preg_match_all('/< *iframe[^>]*src *= *["\']?([^"\']*)/i', $iframe, $ifram_src);
    if (substr($ifram_src[1][0], 0, 12) == "listcontent4") {
        $result_list_url = "http://fyjud.lawbank.com.tw/" . $ifram_src[1][0];
        echo $result_list_url;
    }
//    echo ($iframe . PHP_EOL);
//    $string = explode("src=\'", $iframe);
//    print_r($string[1]);
//    preg_match_all('/(src|id)=("[^"]*")/i', $iframe, $ifram_attr[]);
//    foreach ($ifram_ids as $ifram_id) {
//        print_r($ifram_id);
//    }
}
//$result_list_url = "http://fyjud.lawbank.com.tw/listcontent4.aspx?courtFullName=TPHM&v_court=&v_sys=&jud_year=&jud_case=&jud_no=&jud_title=&jud_jmain=&keyword=&sdate=&edate=&file=&page=&id=&searchkw=&jcatagory=0&switchFrom=&issimple=-1&jminmoney=&jmaxmoney=&jminyear=&jmaxyear=&txtjudge=%e6%9b%be%e5%be%b7%e6%b0%b4&txtlawyer=&lc1a=&lc1b=&lc1c=";
$ch3 = curl_init();
curl_setopt($ch3, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch3, Cvar / wwwURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch3, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch3, CURLOPT_CONNECTTIMEOUT, $timeout);

curl_setopt($ch3, CURLOPT_URL, $result_list_url);
curl_setopt($ch3, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch3, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch3, CURLOPT_HEADER, FALSE);
curl_setopt($ch3, CURLOPT_REFERER, $list_url);
curl_setopt($ch3, CURLOPT_VERBOSE, 1);
curl_setopt($ch3, CURLOPT_STDERR, $f);

$list_content = curl_exec($ch3);
curl_close($ch3);
//echo $list_content;
//$list_content = file_get_contents("listcontent5.txt");
//echo $list_content;
//引入 Class
require_once './classes/LawBank.Class.php';

//引入 Database 連線參數設定檔
require_once './inc/myPDOConnConfig.inc.php';

$dsn = $pdoConfig['DB_DRIVER'] . ':host=' . $pdoConfig['DB_HOST'] .
        ';dbname=' . $pdoConfig['DB_NAME'] .
        ';port=' . $pdoConfig['DB_PORT'] .
        ';connect_timeout=30';

try {
    $listcontent5_url = "http://fyjud.lawbank.com.tw/listcontent5.aspx";
    $dbh = new PDO($dsn, $pdoConfig['DB_USER'], $pdoConfig['DB_PASSWD'], $pdoConfig['DB_OPTIONS']);
    $obj_lb = new LawBank($dbh);
    $obj_lb->initContentTable();
    $page_info = $obj_lb->parseListcontent($list_content);
    while ($page_info["now_page"] <= $page_info["total_page"]) {
        echo "now list page: " . $page_info["now_page"] . PHP_EOL;
        $ch4 = curl_init();
        curl_setopt($ch4, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch4, Cvar / wwwURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch4, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch4, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch4, CURLOPT_CONNECTTIMEOUT, $timeout);

        curl_setopt($ch4, CURLOPT_URL, $listcontent5_url);
        curl_setopt($ch4, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch4, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($ch4, CURLOPT_HEADER, false);
        curl_setopt($ch4, CURLOPT_REFERER, $listcontent5_url);
        curl_setopt($ch4, CURLOPT_VERBOSE, 1);
        curl_setopt($ch4, CURLOPT_STDERR, $f);

        $postfields = array();
        $postfields["__EVENTTARGET"] = "lnkbtnOhmy2";
        $postfields["__EVENTARGUMENT"] = "";
        $postfields["__VIEWSTATE"] = $page_info["viewstate"];
        $postfields["__VIEWSTATEGENERATOR"] = $page_info["viewstategenerator"];
        $postfields["__EVENTVALIDATION"] = $page_info["eventvalidation"];
        curl_setopt($ch4, CURLOPT_POST, true);
        curl_setopt($ch4, CURLOPT_POSTFIELDS, $postfields);
//        var_dump($postfields);
        
        unset($postfields);
        unset($page_info);

        $list_content = curl_exec($ch4);
        $page_info = $obj_lb->parseListcontent($list_content);
        curl_close($ch4);
        sleep(rand(1, 30));
    }
//    var_dump($page_info);
} catch (PDOException $pexc) {
    echo $pexc->getTraceAsString();
} catch (Exception $exc) {
    echo $exc->getMessage();
}



//$dom = new DOMDocument;
//$dom->loadHTML($list_content);
//$table_doms = $dom->getElementsByTagName('table');
//$judge_content = array();
//foreach ($table_doms as $table_dom) {
//    if ($table_dom->getAttribute("class") == "page") {
//        continue;
//    }
//    foreach ($table_dom->getElementsByTagName("tr") as $tr_dom) {
//        $td_doms = $tr_dom->getElementsByTagName("td");
//        foreach ($tr_dom->getElementsByTagName("a") as $a_dom) {
//            $judge_content["url"] = $a_dom->getAttribute("href");
//            $judge_content["cookie"] = str_replace("')", "", str_replace("cookieId('", "", $a_dom->getAttribute("onclick")));
//        }
//        $judge_content["judge_code"] = $td_doms->item(1)->nodeValue;
//        $judge_content["judgement"] = $td_doms->item(2)->nodeValue;
//        $judge_content["judge_date"] = $td_doms->item(3)->nodeValue;
//        $judge_content["main_point"] = $td_doms->item(4)->nodeValue;
//        print_r($judge_content);
//    }
//}
//preg_match('~<iframe onload="dyniframesize(\'contentFrame\')" src="(.*?)" width="100%" height="880" scrolling="no" frameborder="0" id="contentFrame" name="contentFrame">~', $html_list, $iframe);
//var_dump($iframe);
//preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
//preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);
//echo $viewstate = $viewstate[1];
//echo $eventValidation = $eventValidation[1];