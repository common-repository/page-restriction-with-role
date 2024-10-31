<?php

class Base_admin {

    public $slugs;

    function __construct() {
        require PRWR_DIR.'/slugs.php';
        $this->slugs = $slugs;
    }
}