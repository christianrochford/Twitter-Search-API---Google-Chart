<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
header('Location: clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];
/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
/* Get account info */
$account = $connection->get('account/verify_credentials');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* Get account info */
$account = $connection->get('account/verify_credentials');

if(isset($_POST)){
  foreach($_POST as $key => $value){
    $hashtag = $value;
    $content = $connection->get('search/tweets', array('q' => $hashtag, 'count' => '100', 'result_type' => 'mixed'));
    $statuses = $content->statuses;
    $count = count($statuses);
    if (isset($count) && isset($hashtag)) {
      echo '<div class="tweetCount">' . $count . '</div>';
      echo '<div class="tag">' . $hashtag . '</div>';
    }
  }
}

/* Include HTML to display on the page */
include('chart.php');

