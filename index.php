<html>
<head>
	<title>Angular Tutorial</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
<script src="./js/app.js"></script>
</head>
<body ng-app="myapp">
<div class="container" ng-controller="ProductListController as pListCtlr">
	<div id="heading">
		<h1>Product Listing</h1>
	</div>
	<div id="products">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3" ng-repeat="product in pListCtlr.productList">
                <div class="thumbnail"><img ng-src="{{product.image.src}}" alt="">
                    <div class="caption"><h3>{{product.name}} {{product.price|currency}}</h3><p></p>
                        <p><a href="#" class="btn btn-primary" ng-click="getDetails(product.id)" role="button">Details</a>
                        </p>
                    </div></div>
            </div>
        </div>
    </div>
</div>	

    
<script type="text/javascript">
/*$(function(){

	var html='<div class="col-sm-6 col-md-3 col-lg-3"><div class="thumbnail"><img src="" alt=""><div class="caption"><h3>Thumbnail label</h3><p></p><p><a href="#" class="btn btn-primary" role="button">Button</a><a href="#" class="btn btn-default" role="button">Button</a></p></div></div></div>';
	for (var i = 0; i < 8; i++) {
			$('#products .row').append(html);	
		};	

});*/

</script>
</body>
</html>