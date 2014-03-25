<?php
session_start();
?>

<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-css-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../stylesheets/screen.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">
<title>Twitter Chart</title>
</head>

<body>

<h1>Compare Twitter #Counts</h1>
<div id="twitterfeed">
    <p id="label">#</p>
    <form id="hashtagTable" method="post" action="prechart.php">
      <input class="input-button" type="text" placeholder="enter hashtag here" name="input0" id="input0">
    </form>
    <ul id="twCountTable">
      <li class="label"># Count</li>
    </ul>
    <div id="button-wrap">
      <a href="#" id="add" class="button">Add More</a>
      <a id="clear" class="button" href="#">Clear</a>
      <a id="save" class="button" href="#">Create Chart</a>
    </div>
  </div>

  <!-- Facebook Likes Chart-->
  <div id="dashboard">
    <div id="stringFilter"></div>
    <div id="twCountChart"></div>
  </div>
  
  <a href="clearsessions.php" id="logout">Logout</a>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://www.google.com/jsapi"></script>
  <script src="../js/app.js"></script>

</body>
</html>
