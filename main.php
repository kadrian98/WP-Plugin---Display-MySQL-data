<?php
/*
Plugin Name: Display MySQL data
Description: Plugin to display info about potential customers as interface 
Author: Adrian Kaczmarek
*/

require_once plugin_dir_path(__FILE__) . 'includes/mfp-functions.php';
$mainPlugin = new MainPlugin();
$mainPlugin->run();
?>