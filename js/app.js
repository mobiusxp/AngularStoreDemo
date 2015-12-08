
(function(){
    
var val = window.location.search.replace("?", "");
    
var id = parseInt(val.substring(3,5));
    
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

    console.log("HELLO"+id);     
    window.location.href = "detail.html?id="+id;
    };
                                
});
    
app.controller('ProductDetailsController',function($scope,$http) {
   $scope.product={};
    $http.get('http://kelvin.ist.rit.edu/~ip9636/Angular/index.php?id='+id).success(function(data){
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
    
function parse(val) {
    var result = "Not found",
        tmp = [];
    location.search
    //.replace ( "?", "" ) 
    // this is better, there might be a question mark inside
    .substr(1)
        .split("&")
        .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
    });
    return result;
}
    

})();