<?php

class Prwr_base_frontend {

    public $slugs;

    function __construct() {
        require PRWR_DIR.'/slugs.php';
        $this->slugs = $slugs;
    }
}