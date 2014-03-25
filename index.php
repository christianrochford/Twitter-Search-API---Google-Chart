<?php
/**
* @file
* User has successfully authenticated with Twitter. Access tokens saved to session and DB.
*/
ob_start();
session_start();
/* Load required lib files. */
require_once('php/twitteroauth.php');
require_once('php/config.php');
/* If access tokens are not available redirect to connect page. */
if(empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
header('Location: php/clearsessions.php');
}
include('php/entry_page.php');

