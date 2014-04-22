var system = require('system');
var fs = require('fs');
var page = require('webpage').create();

page.settings.userName = 'atom614guitar';
page.settings.password = '';

page.onConsoleMessage = function(msg) {
  system.stderr.writeLine('console:' + msg);
}

// var start = 19;
// var end = 19;
// var url_header = "https://ac.designhammer.net/api.php?path_info=people/";
// var url_footer = "&auth_api_token=217-qUrX6d8cJVc69tPndSrqtgcDI2meGkXW5eIZiF2S";

var url = system.args[1];
var file = system.args[2];

console.log(url);
// console.log(file);

  // console.log('processing file ' + i);   
  page.open(url, function(status) {
     if ( status === "success" ) {
        console.log('finished');
        fs.write(file, page.content, 'w');
     } else {
        console.log("Page failed to load."); 
     }
    phantom.exit(0);
  });

