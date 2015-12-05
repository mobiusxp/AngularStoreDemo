<html>
<head>
	<title>Product Detail</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/style.css">-->	
    <link rel="stylesheet" type="text/css" href="css/detailstyle.css">	
</head>
<body>
<div class="container">
    <div class="prodsum">
        <div id="heading">
            <h1>Product Name</h1>
        </div>
        <div id="productPicture"><img src="http://i.imgur.com/XjS6egA.jpg" alt="an image here" /></div>
        
        <div class="btn-group categories" data-toggle="buttons">
          <label class="btn btn-primary active">
            <input type="radio" name="options" id="option1" autocomplete="off" checked> Details
          </label>
          <label class="btn btn-primary">
            <input type="radio" name="options" id="option2" autocomplete="off"> Reviews
          </label>
        </div>

        <div class="infoContainer">
            <div class="prodDetails">
                <h3>Product Details</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div class="prodReviews">
                <h3>Submit a review!</h3>
                    <form>
                        <fieldset class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="username" />
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="username" placeholder="Email" />

                        </fieldset>

                        <fieldset class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="password" />
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="userReview">Review</label>
                            <textarea class="form-control" id="userReview" rows="3"></textarea>
                        </fieldset>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
    
    </div>
</div>	
    
    
    
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){

	var html='<div class="col-sm-6 col-md-3 col-lg-3"><div class="thumbnail"><img src="" alt=""><div class="caption"><h3>Thumbnail label</h3><p></p><p><a href="#" class="btn btn-primary" role="button">Button</a><a href="#" class="btn btn-default" role="button">Button</a></p></div></div></div>';
	for (var i = 0; i < 8; i++) {
			$('#products .row').append(html);	
		};	

});

</script>
</body>
</html>