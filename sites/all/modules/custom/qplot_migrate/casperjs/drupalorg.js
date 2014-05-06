var utils = require("utils");
var fs = require('fs');
var casper = require('casper').create();

var domain = 'https://groups.drupal.org';
var links = [];
var index = 0;
var limit = 10;
var results = [];
var pageIndex = 0;
var pageLimit = 2;

// Get all links
function getLinks() {
    items = document.querySelectorAll('.views-row .node-title a');
    return Array.prototype.map.call(items, function(e) {
        return e.getAttribute('href');
    });
}

// Save results to csv
function saveCSV() {
    outputs = [];
    for (var i = 0; i < results.length; i++) {
        item = [];
        item.push(results[i].company);
        item.push(results[i].email);
        item.push(results[i].url)
        outputs.push('"' + item.join('","') + '"');
    };
    // utils.dump(output);
    fs.write('results.csv', outputs.join("\r\n"), 'w');
}

// Process page
function processPage(link) {
    this.start(link, function() {
        var items = this.evaluate(getLinks);
        for (var i = 0; i < items.length; i++) {
            links.push(items[i]);
        };
    });
}

// Process each link
function processSingle(link) {
    this.start(link, function() {
        // this.echo(this.getTitle());
        // Title
        title = this.fetchText('#page-title');
        // Company
        company = (title.match(/\| (.*?)$/));
        if (company) { 
            company = company[1]; 
        } else company = "";

        results.push({'company': company});
    });
}

// Recursively process links
function processLinks() {
    if ((index < links.length) && (index < limit)) {
        utils.dump(links[index]);
        processSingle.call(this, domain + links[index]);
        index++;
        this.run(processLinks);
    } else {
        utils.dump(results);
        // save results here
        // // Stops here.
        this.exit();
    }
}

// Recursively process pages
function processPages() {
    if (pageIndex < pageLimit) {
        utils.dump('page = ' + pageIndex);
        processPage.call(this, domain + '/drupal-jobs?page=' + pageIndex);
        pageIndex++;
        this.run(processPages);
    } else {
        utils.dump(links);
        processLinks.call(this);
    }
}

casper.start(domain + '/drupal-jobs', function() {
    // this.echo(this.getTitle());
    // links = this.evaluate(getLinks);
});
casper.run(processPages);
// casper.run(processLinks);