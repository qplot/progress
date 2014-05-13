var utils = require("utils");
var fs = require('fs');
var casper = require('casper').create();

var domain = 'https://groups.drupal.org';
var links = [];
var index = 0;
var limit = 2000;
var results = [];
var pageStart = 11;
var pageEnd = 12;
var pageIndex = pageStart;
//var pageLimit = 2;

// Get first result
function getOne(item, pos) {
    if (item) {
        return item[pos];
    } else return "";
}

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
        item.push(results[i].link);
        item.push(results[i].company);
        item.push(results[i].email);
        item.push(results[i].url);
//        item.push(results[i].position);
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
        // Title
        title = this.fetchText('#page-title');
        // Company
        company = getOne(title.match(/\| (.*?)$/), 1);

//        // Position
//        position = getOne(title.match(/\| (.*?)$/), 0);

//        // Employment
//        employment = this.fetchText('.field-field-type .field-item');
//        // employment = employment.match('/C/');
//        utils.dump(employment);
//        // Telecommute
//        telecommute = this.fetchText('.field-field-telecommute .field-item');
//        utils.dump(telecommute);

        // Body
        body = this.fetchText('.node-content');

        // Email
        email = getOne(body.match(/\b[_\S\d-]+@[_\S\d-]+\.[\S]{2,3}\b/g), 0);

        // Phone
        // phone = body.match(//g);
        // utils.dump(phone);

        // Location
        place = getOne(body.match(/\b[A-Z][a-zA-Z]+,[ ]?[A-Z]{2}\b/g), 0);

        // URls
        url = getOne(body.match(/https?:\/\/\S+/g), 0);

        // Store result
        results.push({
            'link': link,
            'company': company,
            'email': email,
            'location': place,
            'url': url,
//            'position': position
        });
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
        saveCSV();
        // // Stops here.
        this.exit();
    }
}

// Recursively process pages
function processPages() {
    if ((pageIndex >= pageStart) && (pageIndex < pageEnd)) {
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