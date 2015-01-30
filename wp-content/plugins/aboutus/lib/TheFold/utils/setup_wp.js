var sys = require('sys')
var exec = require('child_process').exec;
var fs = require('fs');
var readline = require('readline');

var rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

function puts(error, stdout, stderr) { sys.puts(stdout) }

rl.question("Site:",function(site){

	setup_site(site);
        rl.close();
});

function setup_site(site) {

    exec('mkdir -p /tmp/'+site+'/trunk/ && mkdir -p /tmp/'+site+'/releases/', function() {

        exec('svn import /tmp/'+site+'/ https://svn.thefold.co.nz/'+site+' -m "initial import via setup script"', function() {

            console.log('created svn repo');

            exec('svn co https://svn.thefold.co.nz/'+site+'/trunk/ .', site_checked_out);
            });
    });
}

function site_checked_out(){
                                                                //TODO look this up
    fs.writeFile('externals.txt', 'core http://core.svn.wordpress.org/tags/3.4.2/', function(err) {
        if(err)
            sys.puts(err);
        else
        exec('svn propset svn:externals . --file externals.txt', function(){

            console.log('checking out core');

            exec('svn up',function(){
                fs.writeFile('core/.htaccess','RewriteEngine On\n'+
                    'RewriteCond %{REQUEST_FILENAME} !-f\n'+
                    'RewriteRule \.(jpg|jpeg|png|gif|ico|swf|bmp)$ - [nocase,redirect=404,last]\n\n'+
                    'RewriteBase /\n'+
                    'RewriteRule ^index\.php$ - [L]\n'+
                    'RewriteCond %{REQUEST_FILENAME} !-f\n'+
                    'RewriteCond %{REQUEST_FILENAME} !-d\n'+
                    'RewriteRule . /index.php [L]');

                exec('cp core/wp-config-sample.php wp-config.php');
            
                console.log('copying wp-content from core');
                
                exec('cp -R core/wp-content wp-content',function(){

                    exec('svn add wp-content .htaccess',function(){

                        console.log('checking in');
                        exec('svn ci -m "externals ready"');

                    });

                });


            }); 

        });
    }); 
    
    fs.writeFile('.htaccess','<Files .htaccess,.svn>\n' +
            'order allow,deny\n' +
            'deny from all\n' +
            '</Files>\n'+
            'Options -Indexes\n'+
            'RewriteEngine On\n'+
            'RewriteCond %{REQUEST_URI} !^/core/\n'+
            'RewriteCond %{REQUEST_FILENAME} !-f\n'+
            'RewriteCond %{REQUEST_FILENAME} !-d\n'+
            'RewriteRule ^(.*)$ /core/$1\n'+
            'RewriteRule ^(/)?$ core/index.php [L]');
}
