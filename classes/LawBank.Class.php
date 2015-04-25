<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LawBank
 *
 * @author jeffy
 */
class LawBank {

    function __construct() {
        include_once '';
    }

    public function parseListcontent($strHTML) {
        $dom = new DOMDocument;
        $dom->loadHTML($strHTML);
        // Release memory
        $dom = NULL;
    }

}
