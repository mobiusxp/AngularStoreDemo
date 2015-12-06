
(function(){
var app = angular.module('myapp', ['ngRoute']);

app.controller('ProductListController',['$scope','$http',function($scope,$http) {
    // this.productList = productList;
    //var productList = this;
    $scope.productList=[];
    $http.get('http://kelvin.ist.rit.edu/~ip9636/Angular/index.php?id=0').success(function(data){
        console.log("in get");
        console.dir(data);
        $scope.productList = data;
        $scope.x =$scope.productList;
    }); 
    
$scope.gotoDetails = function(id) {
        //redirect to details
    console.log("HELLO"+id);   
    window.location.href = "details.html?id="+id;
    };
                                
}]);
    
app.controller('ProductDetailsController',function($scope,$http) {
   
    $http.get('http://kelvin.ist.rit.edu/~ip9636/Angular/index.php?id=1').success(function(data){
         console.log("in get");
        console.dir(data);
        $scope.product = data;
    }); 
    
  /*this.getProductDetails = function(id) {
       
    };*/
                                
});
    
    /*  var product = {name:"Nike",
                   image:"http://i.imgur.com/XjS6egA.jpg",
                    price:3.4,
                   description:"Just do it"};*/

    // var productList = [{name:"Nike",
    //                image:"nike.jpg",
    //                 price:3.4,
    //                description:"Just do it"},
    //                {name:"Adidas",
    //                image:"nike.jpg",
    //                 price:3.4,
    //                description:"Just do it"},
    //                {name:"Reebok",
    //                image:"nike.jpg",
    //                 price:3.4,
    //                description:"Just do it"},
    //                {name:"Puma",
    //                image:"nike.jpg",
    //                 price:3.4,
    //                description:"Just do it"}];
})();