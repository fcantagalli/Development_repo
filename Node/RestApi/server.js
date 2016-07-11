// Needed Package
var express = require('express');
var app = express();
var bodyParser = require('body-parser');

//Configure body-parser
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());

var port = process.env.PORT || 8081

var router = express.Router();

//Set up middleware
var middleware = require('app/Interceptors/apiMiddleware.js');
middleware();

// Test if router is working
router.get('', function(request, response) {
   response.json({ message: 'Welcone to our test API'});
});

//append api before each endpoint
app.use('/api', router);

//START THE SERVER
//================================
app.listen(port);
console.log('Magic happens on port '+ port);
