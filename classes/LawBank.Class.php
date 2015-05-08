<?php

/**
 * Description of LawBank
 *
 * @package law-bank
 * @author ninithday <jeffy@ninthday.info>
 * @since 2015-04-26
 * @version 1.0
 */
class LawBank
{

    private $dbh;

    function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * 
     * @param string $string_html
     * @access public
     */
    public function parseListcontent($string_html)
    {
        $onepage_list = array();
        $page_info = array();
        $judge_content = array();
        $dom = new DOMDocument;
        $dom->loadHTML('<?xml encoding="UTF-8">' . $string_html);
        $page_info["viewstate"] = $dom->getElementById("__VIEWSTATE")->getAttribute("value");
        $page_info["viewstategenerator"] = $dom->getElementById("__VIEWSTATEGENERATOR")->getAttribute("value");
        $page_info["eventvalidation"] = $dom->getElementById("__EVENTVALIDATION")->getAttribute("value");
        
        $table_doms = $dom->getElementsByTagName('table');
        foreach ($table_doms as $table_dom) {
            if ($table_dom->getAttribute("class") == "page") {
                foreach($table_dom->getElementsByTagName("td") as $page_td){
                    if($page_td->getAttribute("width") == "42%"){
                        $cut_page_info = explode(" ", $page_td->nodeValue);
                        $page_info["now_page"] = (int)$cut_page_info[4];
                        $page_info["total_page"] = (int)$cut_page_info[6];
                    }
                }
                continue;
            }
            foreach ($table_dom->getElementsByTagName("tr") as $tr_dom) {
                $td_doms = $tr_dom->getElementsByTagName("td");
                if(!$td_doms->item(0)){
                    continue;
                }
                foreach ($tr_dom->getElementsByTagName("a") as $a_dom) {
                    $judge_content["url"] = $a_dom->getAttribute("href");
                    $judge_content["cookie"] = str_replace("')", "", str_replace("cookieId('", "", $a_dom->getAttribute("onclick")));
                }
                $judge_content["judge_code"] = $td_doms->item(1)->nodeValue;
                $judge_content["judgement"] = $td_doms->item(2)->nodeValue;
                $judge_content["judge_date"] = $td_doms->item(3)->nodeValue;
                $judge_content["main_point"] = $td_doms->item(4)->nodeValue;
                array_push($onepage_list, $judge_content);
            }
        }

        // Release memory
        $dom = NULL;
        $this->saveOneList($onepage_list);
        return $page_info;
    }

    public function initContentTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `listContent` (
            `list_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `judgement_no` varchar(100) DEFAULT NULL COMMENT \'裁判字號\',
            `url` text NOT NULL COMMENT \'連結\',
            `cookie_id` varchar(100) NOT NULL COMMENT \'編號\',
            `judgement` varchar(10) DEFAULT NULL COMMENT \'裁判\',
            `judge_date` varchar(10) DEFAULT NULL COMMENT \'裁判日期\',
            `main_point` varchar(100) DEFAULT NULL COMMENT \'案由\',
            `content` text NOT NULL,
            PRIMARY KEY (`list_id`)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
        try {
            $this->dbh->query($sql);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function saveOneList(array $lists = array())
    {
        $exe_flag = true;
        $sql_insert = 'INSERT INTO `listContent`(`judgement_no`, `url`, `cookie_id`, `judgement`, `judge_date`, `main_point`) ' .
                'VALUES (:judgement_no, :url, :cookie_id, :judgement, :judge_date, :main_point)';
        try {
            $sth = $this->dbh->prepare($sql_insert);
            foreach ($lists as $list) {
                $sth->bindParam(':judgement_no', $list['judge_code'], PDO::PARAM_STR);
                $sth->bindParam(':url', $list['url'], PDO::PARAM_STR);
                $sth->bindParam(':cookie_id', $list['cookie'], PDO::PARAM_STR);
                $sth->bindParam(':judgement', $list['judgement'], PDO::PARAM_STR);
                $sth->bindParam(':judge_date', $list['judge_date'], PDO::PARAM_STR);
                $sth->bindParam(':main_point', $list['url'], PDO::PARAM_STR);
                $exe_flag = $exe_flag && $sth->execute();
//                echo $list['url'] . PHP_EOL;
//                var_dump($list);
            }
        } catch (PDOException $exc) {
//            echo $exc->getTraceAsString();
            echo $exc->getMessage() . PHP_EOL;
        }
        return $exe_flag;
    }

    public function updateContent($list_id, $judge_content)
    {
        $sql_update = 'UPDATE `listContent` SET `content`=:content WHERE `list_id`=:list_id';
        try {
            $sth = $this->dbh->prepare($sql_update);
        $sth->bindParam(':content', $judge_content, PDO::PARAM_STR);
        $sth->bindParam(':list_id', $list_id, PDO::PARAM_INT);
        $rtn = $sth->execute();
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }

        return $rtn;
    }

    public function getEmptyContentList(){
        $sql_getone = 'SELECT *FROM `listContent` WHERE `content` = "" 
            ORDER BY RAND( ) LIMIT 0, 1';
        $rs = $this->dbh->query($sql_getone, PDO::FETCH_ASSOC);
        return $rs->fetch();
    }
    
    function __destruct()
    {
        $this->dbh = null;
    }

}
