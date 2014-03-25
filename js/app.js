// Local Storage of Table Entries

$(document).ready(function(){

  var hashtag = $('#hashtagTable');
  hashtagList = [];
  tweetCounts = [];
  inputTags = document.getElementsByTagName('input');
  formData = {};

  // Save form inputs and values to local storage
  $('#save').click(function(e){
    e.preventDefault();
    localStorage.setItem('list', hashtag.html());
    for(i=0, len=inputTags.length; i<len; i++){
      formData[inputTags[i].name] = inputTags[i].value;
    }
    localStorage.setItem('formData', JSON.stringify(formData));
    $('#hashtagTable').action = $(this).href
    $('#hashtagTable').submit();
  });
  
  // empty local storage and reload page
  $('#clear').click(function(e){
    e.preventDefault();
    localStorage.clear('list');
    window.location.reload();
  });

  // Prevent form submission on input + return key
  $('.input-button').keypress(function(e){
    if ( e.which == 13 ) e.preventDefault();
  })

  // Add additional text-input to the form
  num = 1;
  $('#add').click(function(e){
    e.preventDefault();
    $('#hashtagTable').append('<input type="text" class="input-button" placeholder="enter hashtag here" name="input' + num + '" id="input' + num + '">');
    num++;
  })
  
  // Get input markup from previous list if exists
  if(localStorage.getItem('list')){
    hashtag.html(localStorage.getItem('list'));
  }

  // Get object of hashtags from previous list if exists
   if(localStorage.getItem('formData')){
    // Parse localstorage form data into JSON object 
    formedData = JSON.parse(localStorage.getItem('formData'));
    // Push each hashtag from formData object into hashtagList array
    for(var prop in formedData){
      hashtagList.push(formedData[prop]);
    }
    // Populate form inputs on reload
    for(i=0, len=inputTags.length; i<len; i++){
      inputTags[i].value = hashtagList[i];
    }
  }

  // Add hashtag counts to tweetCounts array
  var hashtagCounts = document.querySelectorAll('.tweetCount');
  for(var i=0, len=hashtagCounts.length; i<len; i++){
    tweetCounts.push(parseInt(hashtagCounts[i].innerHTML));
  }
  console.log(tweetCounts);
 });


// ///// Twitter Count Chart /////

// Load google charts package
google.load('visualization', '1.0', {packages: ['controls']});

function drawTwCountChart(){
  var data = new google.visualization.DataTable();
  // Create rows and columns
  data.addColumn('string', '#');
  data.addColumn('number', 'Count');
  // Add row to chart for each hashtag
  for(i=0, len=inputTags.length; i<len; i++){
    if(tweetCounts[i] !== undefined && hashtagList[i] !== undefined){
      data.addRow(['#' + hashtagList[i], tweetCounts[i]]);
    }
  }
  // Set chart options
  var options = {
    title: '# Count',
    'height': 500,
    'fontSize': 12,
    'colors': ['#ff3300'],
    'marginLeft': 0,
    'titleTextStyle': {
      color: '#ff3300',
      fontName: 'Helvetica',
      bold: true,
      fontSize: 32
    }
  };
  var twCountChart = new google.visualization.ChartWrapper({
    'chartType': 'ColumnChart',
    'containerId': 'twCountChart',
    'options': options
  });
  var filter = new google.visualization.ControlWrapper({
    'controlType': 'StringFilter',
    'containerId': 'stringFilter',
    'options': {
      'filterColumnLabel': '#'
    }
  });
  // Create chart
  var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard'));
  dashboard.bind(filter, [twCountChart]);
  dashboard.draw(data);
  
}

google.setOnLoadCallback(drawTwCountChart);

