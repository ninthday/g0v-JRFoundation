<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

//引入 Database 連線參數設定檔
require_once './inc/myPDOConnConfig.inc.php';

$dsn = $pdoConfig['DB_DRIVER'] . ':host=' . $pdoConfig['DB_HOST'] .
        ';dbname=' . $pdoConfig['DB_NAME'] .
        ';port=' . $pdoConfig['DB_PORT'] .
        ';connect_timeout=30';

$dbh = new PDO($dsn, $pdoConfig['DB_USER'], $pdoConfig['DB_PASSWD'], $pdoConfig['DB_OPTIONS']);

$sql = 'SELECT `list_id`, `content` FROM `listContent`';
$sth = $dbh->prepare($sql);
$sth->execute();
//$i = 1;
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $out_file = fopen('data/' . $row["list_id"] . '.html', 'w');
    fwrite($out_file, $row["content"]);
    fclose($out_file);
//    if ($i > 10) {
//        break;
//    }
//    $i++;
}

