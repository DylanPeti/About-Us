
// http://nodejs.org/api.html#_child_processes
var util = require('util');
var http = require('http');
var https = require('https');
var url = require('url');
var fs = require('fs');
var exec = require('child_process').exec;

var tags = {};

var extenals_file = 'externals.txt';

try{
fs.unlinkSync(extenals_file);
}catch(e){}

child = exec("svn propget svn:externals", function (error, stdout, stderr) {

    var externals = stdout.split("\n");

    for( var i=0; i <= externals.length; i++){

        if(!externals[i]) continue;

        var line = externals[i].split(' ');
        var local = line[0];
        var external = line[1];

        try{
            //get tag number
            var tag = external.match(/([0-9\.]+)\/?$/)[1];
        }
        catch( e ) { 
            console.log(e); 
            continue; 
        }

        // set external to root tag path
        external = external.replace(tag,'').replace(/\/+$/,'');
        external += '/';

        if(external.length > 0){

            /*if(external.match('^https')){
                console.log('haven\'t worked out how to handle https externals yet :( '+ external+' not updated');
                write_to_externals(local+' '+external+tag+'/');
                continue;
            }*/
            
            try{
                parse_external(external, tag, local);
            }
            catch( e ) {
                console.log('Unable to work with external '+external);
                console.log(e);
                continue;
            }
        }

    }

});

function parse_external(external, current_tag, local_dir) {

    var service = external.match('^https') ? https : http;

    service.get(external, function(res) {

        res.on('data', function (chunk) {

            var re = />([0-9\.]+)\/</g;

            while (match = re.exec(chunk)) {

                var tag = match[1];

                tags[external] ? tags[external].push(tag) : tags[external] = [tag];
            }

        });

        res.on('end', function(){

            if(!tags[external]){
                console.log( "cant find any tags! for external :"+ external);
                write_to_externals(local_dir+' '+external+current_tag+'/');
                return;
            }

            tags[external].sort(function(a,b) {  
                
                return numeric_tag(a) - numeric_tag(b);
            })

            latest = tags[external].pop();
            number_latest = numeric_tag(latest);
            number_currrent_tag = numeric_tag(current_tag);


            if(number_latest > number_currrent_tag) {

                //maybe prompt here ?
                console.log('need to update '+external+ ' from ' + current_tag + ' to ' + latest);

                //depending on prompt here ?
                write_to_externals(local_dir+' '+external+latest+'/');
                // or write_to_externals(local_dir+' '+external+current_tag);
            }
            else {
                write_to_externals(local_dir+' '+external+current_tag+'/');
            }

        });

    }).on('error', function(e) {
        console.log("Got error: " + e.message);
    });
}

function write_to_externals(external_property) {

    fs.appendFile(extenals_file, external_property+"\n", function (err) {
        if (err) throw err;
        console.log(external_property+' to '+extenals_file);
    });
}

//work out numeric value of the tag, so we can tell which is the latest version 
// for example 2.2.9 & 2.2.9.3 must evaluate to be less than 2.2.13 and 
function numeric_tag(tag)
{
    //padd version number so its always six deep.
    while((tag.split(".").length - 1) < 5)
    {
        tag += '.0';
    }
        
    var parts = tag.split('.').reverse();
    var total = 0;
    var denomination = 1;

    for(var i in parts) {
        
        total += ( parts[i] * denomination );

        denomination *= 100
    }
    
    return total;
}
