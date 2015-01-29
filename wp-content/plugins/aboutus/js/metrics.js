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


