
(function(){
    
    /* create angular module */    
    var app = angular.module('myapp', []);

    /* create module.controllers 
    1.ProductListController
    2.ProductDetailsController
    3.ReviewController
    Each controller handles a different view
    */
    app.controller('ProductListController',function($http) {     
        /* initialize */    
        var pListCtlr=this;
        pListCtlr.productList=[];
        /* request the server to get all products.(id=0 returns all products)*/
        $http.get('http://kelvin.ist.rit.edu/~ip9636/Angular/index.php?id=0').success(function(data){
            pListCtlr.productList=data;   
        });                              
    });//end of ProductListController
        
    app.controller('ProductDetailsController',function($http) {

        /* initialize */
        var productDetails=this; 
        productDetails.product={};
        //parse query string to get the current ID
        var val = window.location.search.replace("?", "");    
        productDetails.id=parseInt(val.substring(3,5));

        //request the server for product data
        $http.get('http://kelvin.ist.rit.edu/~ip9636/Angular/index.php?id='+productDetails.id).success(function(data){
            /** get the data fetched from the server to populate product **/
            productDetails.product=data;        
        }); 
                               
    });//end of ProductDetailsController
        
    app.controller('ReviewController',function() {
        
        /**initialize**/
        var rCtlr=this;
        rCtlr.userReview="";
        rCtlr.email="";

        rCtlr.addReview = function() {
            /** do something on review submissions. Lets just console log out something for now!! **/
            console.log("HELLO reviews");
        };
                                    
    });//end of ReviewController

})();