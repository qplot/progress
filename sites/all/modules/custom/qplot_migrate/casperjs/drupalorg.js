var utils = require("utils");
var casper = require('casper').create();

var domain = 'https://groups.drupal.org';
var links;
var index = 0;
var limit = 4;

// Get all links
function getLinks() {
    links = document.querySelectorAll('.views-row .node-title a');
    return Array.prototype.map.call(links, function(e) {
        return e.getAttribute('href');
    });
}

// Process each link
function processSingle(link) {
    this.start(link, function() {
        // this.echo(this.getTitle());
        // Title
        title = this.fetchText('#page-title');
        // Company
        company = (title.match(/\| (.*?)$/))[1];
        utils.dump(company);
        // Employment
        employment = this.fetchText('.field-field-type .field-item');
        // employment = employment.match('/C/');
        utils.dump(employment);
        // Telecommute
        telecommute = this.fetchText('.field-field-telecommute .field-item');
        utils.dump(telecommute);

        // Body
        body = this.fetchText('.node-content');

        // Email
        email = body.match(/\b[_\S\d-]+@[_\S\d-]+\.[\S]{2,3}\b/g);
        utils.dump(email);
        // Phone
        phone = body.match(//g);
        utils.dump(phone);
        // Location
        place = body.match(/\b[A-Z][a-zA-Z]+,[ ]?[A-Z]{2}\b/g);
        utils.dump(place);
        // URls
        url = body.match(/https?:\/\/\S+/g);
        utils.dump(url);
        // User id
        // User name
    })
}

// Recursively process links
function processLinks() {
    if ((index < links.length) && (index < limit)) {
        utils.dump(links[index]);
        processSingle.call(this, domain + links[index]);
        index++;
        this.run(processLinks);
    } else {
        // Stops here.
        this.exit();
    }
}

casper.start(domain + '/drupal-jobs', function() {
    this.echo(this.getTitle());
    links = this.evaluate(getLinks);
    // utils.dump(links);
});

casper.run(processLinks);

