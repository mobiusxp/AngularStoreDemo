
(function(){
var app = angular.module('myapp', ['ngRoute']);

app.controller('ProductListController',function($scope,$http) {
    
    $scope.productList=[];
    $http.get('http://kelvin.ist.rit.edu/~ip9636/Angular/index.php?id=0').success(function(data){
        console.log("in get");
        console.dir(data);
        $scope.productList = data;
        $scope.x =$scope.productList;

    }); 
    
this.gotoDetails = function(id) {
        //redirect to details
    window.location.href = "detail.html?id="+id;
    };
                                
});
    
app.controller('ProductDetailsController',function($scope,$http) {
   $scope.product={};
    $http.get('http://kelvin.ist.rit.edu/~ip9636/Angular/index.php?id=1').success(function(data){
        console.log("in get");
        console.dir(data);
        $scope.product = data;
        
    }); 
                           
});
    
app.controller('ReviewController',function($scope) {
    $scope.userReview="hi";
    $scope.email="";
    $scope.addReview = function() {
        console.log("hello");
    };
                                
});
    

})();