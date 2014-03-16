var system = require('system');
var fs = require('fs');
var page = require('webpage').create();
page.onConsoleMessage = function(msg) {
  system.stderr.writeLine('console:' + msg);
}
page.open("https://ac.designhammer.net/api.php?path_info=people/19&auth_api_token=217-qUrX6d8cJVc69tPndSrqtgcDI2meGkXW5eIZiF2S", function(status) {
   if ( status === "success" ) {
      console.log(page.title); 
      fs.write('1.xml', page.content, 'w');
   } else {
      console.log("Page failed to load."); 
   }
   phantom.exit(0);
});
