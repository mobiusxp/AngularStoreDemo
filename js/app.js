
(function(){
var app = angular.module('myapp', ['ngRoute']);

app.controller('ProductListController',['$http',function($http) {
    this.productList = productList;
    //var productList = this;
     productList.products=[];
    $http.get('/products.json').success(function(data){
        productList.products = data;
    }); 
    
this.getDetails = function(id) {
        //redirect to details
    };
                                
}]);

    var productList = [{name:"Nike",
                   image:"nike.jpg",
                    price:3.4,
                   description:"Just do it"},
                   {name:"Adidas",
                   image:"nike.jpg",
                    price:3.4,
                   description:"Just do it"},
                   {name:"Reebok",
                   image:"nike.jpg",
                    price:3.4,
                   description:"Just do it"},
                   {name:"Puma",
                   image:"nike.jpg",
                    price:3.4,
                   description:"Just do it"}];
})();