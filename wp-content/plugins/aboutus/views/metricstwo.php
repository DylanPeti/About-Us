<?php 

/*
Plugin Name: About Us Metrics
Plugin URI: http://www.aboutus.co.nz
Description: Analytics for City Business's 
Version: 1.0.1
Author: Dylan Peti
Author URI: http://www.aboutus.co.nz
License: GPL2
Copyright: Dylan Peti

* Java protocol for google data visualisation 
* Username = thebigupgrade@gmail.com
* Password = theclub01
* View profile ID = 81441535
*
session_start();

php 5.4.24 > is in
curl is installed

Gmail Account  thebigupgrade@gmail.com  theclub01
Client ID      774930384892-nd5f7nllhratugt64hinitok29khfnaj.apps.googleusercontent.com
Client Secret  ZB44pmIUQ9Oz7jb00tcQpJ46
Redirect URIs  http://127.0.0.1/
API Keys/developer keys       AIzaSyCycypv7Hh55AdAAEPZsJ23qqm5nihewb4
Obsolete Key   AIzaSyASy4rtxYzrx29zU_vcpTCQ4DOaV5V4QJc

Create Google application from console
Authorize user access using OAuth 2.0 
Create Google Analytics API


STEPS

1. Create Elements to be loaded
2. Load the Library(order matters)
3. Authorize User
4. Create the View Selector
5. Create the Timeline Chart
6. Hook the Componenets to Work Together

NOTES:

The Embed API makes use of the gapi.analytics.ready(function(callbacks){}) The callbacks are invoked in the order
they were added and after the library finishes loading. 



TODO 

wp_head throws errors

stats
1. wellington users
2. active sessions
3. 

*/

require('header-temp.php');

?>



<!-- Step 1: Create the containing elements. -->

<section id="auth-button"></section>
<section id="view-selector"></section>
<section id="timeline"></section>
<section id="region"></section>


<h1 id="location"></h1>
<i class="fa fa-circle-thin" id="one"></i>
<i class="fa fa-circle-thin" id="users"></i>
<i class="fa fa-circle-thin"></i>


<!-- Step 2: Load the library. -->

<script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>


<div id="embed-api-auth-container"></div>
<div id="view-selector-container"></div>
<div id="main-chart-container"></div>
<div id="breakdown-chart-container"></div>


<script>

gapi.analytics.ready(function() {

  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: '774930384892-nd5f7nllhratugt64hinitok29khfnaj.apps.googleusercontent.com',
  });


  /**
   * Create a new ViewSelector instance to be rendered inside of an
   * element with the id "view-selector-container".
   */
  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector-container'
  });

  // Render the view selector to the page.
  viewSelector.execute();

  /**
   * Create a table chart showing top browsers for users to interact with.
   * Clicking on a row in the table will update a second timeline chart with
   * data from the selected browser.
   */
  var mainChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      'dimensions': 'ga:region',
      'metrics': 'ga:sessions, ga:users, ga:newUsers, ga:percentNewSessions, ga:avgsessionDuration',
      'filters': 'ga:region==Wellington',
      'start-date': '2013-01-01',
      'end-date': '2014-10-10'
    },
    chart: {
      type: 'TABLE',
      container: 'main-chart-container',
      options: {
        width: '100%'
      }
    }
  });

 // var users = new gapi.analytics.googleCharts.DataChart({
 //    query: {
 //      'dimensions': 'ga:region',
 //      'metrics': 'ga:users',
 //      'filters': 'ga:region==Wellington',
 //      'start-date': '2013-01-01',
 //      'end-date': '2014-10-10'
 //    },
 //    chart: {
 //      type: 'TABLE',
 //      container: 'main-chart-container',
 //      options: {
 //        width: '100%'
 //      }
 //    }
 //  });

  /**
   * Create a timeline chart showing sessions over time for the browser the
   * user selected in the main chart.
   */
  var breakdownChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      'dimensions': 'ga:region',
      'metrics': 'ga:sessions',
      'filters': 'ga:region==Wellington',
      'start-date': '2013-01-01',
      'end-date': '2014-10-10'
    },
    chart: {
      type: 'LINE',
      container: 'breakdown-chart-container',
      options: {
        width: '100%'
      }
    }
  });


  /**
   * Store a refernce to the row click listener variable so it can be
   * removed later to prevent leaking memory when the chart instance is
   * replaced.
   */
  var mainChartRowClickListener;


  /**
   * Update both charts whenever the selected view changes.
   */
  viewSelector.on('change', function(ids) {
    var options = {query: {ids: ids}};

    // Clean up any event listeners registered on the main chart before
    // rendering a new one.
    if (mainChartRowClickListener) {
      google.visualization.events.removeListener(mainChartRowClickListener);
    }

    mainChart.set(options).execute();
    users.set(options).execute();

    breakdownChart.set(options);

    // Only render the breakdown chart if a browser filter has been set.
    if (breakdownChart.get().query.filters) breakdownChart.execute();
  });


  /**
   * Each time the main chart is rendered, add an event listener to it so
   * that when the user clicks on a row, the line chart is updated with
   * the data from the browser in the clicked row.
   */
   users.on('success', function(response){
    document.getElementById('users').innerHTML = '<p> TOTAL USERS:' + response.data.rows[0].c[1].v + '</p>';
   });


  mainChart.on('success', function(response) {

    var chart = response.chart;
    var dataTable = response.dataTable;

    


    var result = response.data.rows[0].c[1].v;
    var region = response.data.rows[0].c[0].v;
    var number = document.getElementById('one').innerHTML = '<p id="result"> SESSIONS:' + result + '</p>';
    var title = document.getElementById('location').innerHTML = region;
    
    
    

    // Store a reference to this listener so it can be cleaned up later.
    mainChartRowClickListener = google.visualization.events
        .addListener(chart, 'select', function(event) {

      // When you unselect a row, the "select" event still fires
      // but the selection is empty. Ignore that case.
      if (!chart.getSelection().length) return;

      var row =  chart.getSelection()[0].row;
      var browser =  dataTable.getValue(row, 1);

      var options = {
        query: {
          filters: 'ga:browser==' + browser
        },
        chart: {
          options: {
            title: browser
          }
        }
      };

      breakdownChart.set(options).execute();
    });
  });

});
</script>



<?php get_footer(); ?>




