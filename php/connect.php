<?php
ob_start();
session_start();
require_once('config.php');
if (CONSUMER_KEY === '' || CONSUMER_SECRET === '' || CONSUMER_KEY === 'CONSUMER_KEY_HERE' || CONSUMER_SECRET === 'CONSUMER_SECRET_HERE') {
echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';
exit;
}
/* Build an image link to start the redirect process. */
$content = '<a href="redirect.php">Sign in with Twitter</a>';
/* Include HTML to display on the page. */
include('landing_page.php');