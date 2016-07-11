/**
 * Created by felipe on 7/9/16.
 */

var testMiddleware = function() {
    //Middleware to use for all calls. eq Authentication
    router.use(function(req, res, next) {
        // Do logging
        var header = req.header();
        console.log(header);
        next();
    });
};

var loadMiddlewares = function() {
    testMiddleware();
};

module.exports = {
  loadMiddlewares : function() {
    return loadMiddlewares();
  }
};