<html>
<head>
	<title>Product Detail</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/style.css">-->	
    <link rel="stylesheet" type="text/css" href="css/detailstyle.css">	
</head>
<body ng-app="myapp">
<div class="container">
    <div class="prodsum" ng-controller="ProductDetailsController as product">
        <div id="heading">
            <h1>Product Name</h1>
        </div>
        <div id="productPicture"><img ng-src="{{product.image_src}}" alt="an image here" /></div>
        <ul class="nav nav-tabs">
            <li ng-class="{active:tab===1}"><a href ng-click="tab=1">Details</a></li>
            <li ng-class="{active:tab===2}"><a href ng-click="tab=2">Review</a></li>
        </ul>
        
       <!-- <div class="btn-group categories" data-toggle="buttons">
          <label class="btn btn-primary active">
            <input type="radio" name="options" id="option1" autocomplete="off" checked> Details
          </label>
          <label class="btn btn-primary">
            <input type="radio" name="options" id="option2" autocomplete="off"> Reviews
          </label>
        </div> -->

        <div class="infoContainer">
            <div class="prodDetails" ng-show="tab===1">
                <h3>Description</h3>
                <p>{{product.description}}</p>
            </div>
             <div class="prodDetails" ng-show="tab===2">
                 <h3>Review</h3>
                <p>{{product.review}}</p>
            </div>
            </div>

            <div class="prodReviews">
                <h3>Submit a review!</h3>
                    <form ng-controller="ReviewController as rCtlr" ng-submit="rCtlr.addReview(product)">
                        <b>Review</b>
                       {{rCtlr.review.text}}</p><br/>
                <b>Email</b><cite>{{rCtlr.review.email}}</cite>
                        <fieldset class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="username" />
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="email">Email</label>
                            <input type="email" ng-model="rCtlr.review.email" class="form-control" id="username" placeholder="Email" />

                        </fieldset>
                        <fieldset class="form-group">
                            <label for="userReview">Review</label>
                            <textarea class="form-control" ng-model="rCtlr.review.text" id="userReview" rows="3"></textarea>
                        </fieldset>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
    </div>
</div>	
    
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
<script src="./js/app.js"></script>
</body>
</html>