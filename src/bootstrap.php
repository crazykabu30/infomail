<?php 

require 'ClassLoader.php';

$load = new ClassLoader();
$load->regsterDir(dirname(__FILE__).'Database');
$load->regster();
