<?php 

require_once plugin_dir_path(dirname(__FILE__, 2)) . 'includes/DisplayDataFromDB.php';


$displayData = new DisplayDataFromDB();

$displayData->displayData();