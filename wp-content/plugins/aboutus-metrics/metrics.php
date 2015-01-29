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

Build Route and Register View

*/
?>
<!DOCTYPE html>
<html>
<head>
  <title>Embed API Demo</title>
</head>
<body>

<!-- Step 1: Create the containing elements. -->

<section id="auth-button"></section>
<section id="view-selector"></section>
<section id="timeline"></section>
<section id="region"></section>

<!-- Step 2: Load the library. -->

<script>
(function(w,d,s,g,js,fjs){  
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
  js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
}(window,document,'script'));
</script>

<script>
gapi.analytics.ready(function() {

  var divSelector = document.getElementById('auth-button');

  // Step 3: Authorize the user.

  var CLIENT_ID = '774930384892-nd5f7nllhratugt64hinitok29khfnaj.apps.googleusercontent.com';

  gapi.analytics.auth.authorize({
    container: 'auth-button',
    clientid: CLIENT_ID,
  });


  // Step 4: Create the view selector.

  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector'
  });

  // Step 5: Create the timeline chart.

  var timeline = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'timeline'
    }
  });

  //BUILD A CHART LOOKING AT THE REGIONS USERS HAVE SIGNED UP IN
  //APPLY FILTER ON REGION

    var region = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:region',
      'metrics': 'ga:users',
      'filters': 'ga:country==New Zealand',
      'start-date': '2013-01-01',
      'end-date': '2014-10-10',
    },
    chart: {
      type: 'COLUMN',
      container: 'region'
    }
  });

  // Step 6: Hook up the components to work together.

  gapi.analytics.auth.on('success', function(response) {
    viewSelector.execute();
  });

  viewSelector.on('change', function(ids) {
    var newIds = {
      query: {
        ids: ids
      }
    }
    timeline.set(newIds).execute();
    region.set(newIds).execute();
  });
});
</script>
</body>
</html>

