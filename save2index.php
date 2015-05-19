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

$sql = "SELECT `list_id`, `judgement_no`, `judgement`, `judge_date`, `main_point` FROM `listContent`";
$sth = $dbh->prepare($sql);
$sth->execute();

$year_menu = array();
$year_list = array();

//$i = 1;
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $judgement_no = explode(',', $row["judgement_no"]);
    if (!array_key_exists($judgement_no[0], $year_list)) {
        $year_list[$judgement_no[0]] = array();
    }
    array_push($year_list[$judgement_no[0]], $row);

    echo $judgement_no[0] . '...';
//    if ($i > 50) {
//        break;
//    }
//    $i++;
}

krsort($year_list);
$all_year = array_keys($year_list);
$side_menu = '';
$panel_list = '';
foreach ($all_year as $single_year) {
    $side_menu .= '<li><a href="#">' . $single_year . '</a></li>';
    
    $panel_list .= '<div id="year-' . $single_year . '">';
    $panel_list .= '<div class="panel panel-primary"><div class="panel-heading">';
    $panel_list .= '<h3 class="panel-title">Year: ' . $single_year . '   [' . number_format(count($year_list[$single_year])) .' rows]</h3></div>';
    $panel_list .= '<table class="table table-striped">';
    $panel_list .= '<thead><tr><th width="10%">序號</th><th width="25%">裁判字號</th><th width="15%">裁判</th>';
    $panel_list .= '<th width="20%">裁判日期</th><th width="30%">裁判案由</th></tr></thead>';
    $panel_list .= '<tbody>';
    foreach ($year_list[$single_year] as $row) {
        $panel_list .= '<tr><td>' . $row["list_id"] . '</td>';
        $panel_list .= '<td><a href="data/' . $row["list_id"]  . '.html" target="_blank">' . $row["judgement_no"] . '</a></td>';
        $panel_list .= '<td>' . $row["judgement"] . '</td>';
        $panel_list .= '<td>' . $row["judge_date"] . '</td>';
        $panel_list .= '<td>' . $row["main_point"] . '</td></tr>';
    }
    $panel_list .= '</tbody></table></div></div>';
}


$html = <<<INDEX1
      <!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="jeffy@ninthday.info" name="author">
    <title>Low-bank Document List | JRF</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span>  <span class="icon-bar"></span>  <span class="icon-bar"></span>  <span class="icon-bar"></span> 
                </button> <a href="#" class="navbar-brand">Law-Bank</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="mailto:jeffy@ninthdayinfo">Email Me</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">  
INDEX1;

$html .= $side_menu;

$html .= <<<INDEX2
        </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Judgment</h1>
INDEX2;

$html .= $panel_list;

$html .= <<<INDEX3
        </div>
        </div>
    </div>
    <script src="jquery-2.1.4.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("div[id^=year-]").hide();
            $("ul.nav-sidebar li").click(function() {
                var judg_year = $(this).text();
                $("#year-" + judg_year).slideToggle("slow");
            });
        });
    </script>
</body>

</html>
INDEX3;

$out_file = fopen('lb_index.html', 'w');
fwrite($out_file, $html);
fclose($out_file);

var_dump($year_list);
var_dump(array_keys($year_list));

$dbh = null;