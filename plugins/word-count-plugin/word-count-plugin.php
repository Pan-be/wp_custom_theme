<?php

/*
Plugin Name: Word Count
Description: A simple post word counter.
Version: 1.0
Author: Pan.Be
Author URI: https://pan-be.vercel.app
*/

class WordCountAndTimePlugin {
    function __construct() {
        add_action( 'admin_menu', array($this, 'adminPage'));
            }

    function adminPage() {
        add_options_page( 'Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'Html'));
    }

    function Html() { ?>
<div class="wrap">
    <h1>Word Count Settings</h1>
</div>
<?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();