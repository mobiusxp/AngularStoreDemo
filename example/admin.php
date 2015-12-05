<?php
    $pageName = "Admin Panel - login";
    $stylesheets;
    $stylesheets[] = "signin.css";
    include ('./header.php');

?>


<form class="form-signin" action="admin.php" method="post">
    <h2>Administrator Access</h2>
    <?php
        if(isset($loginStatus)){
            echo "<h4>" . $loginStatus . "</h4>";
        }
    ?>
    <h3 class="form-signin-heading">Please sign in</h3>
    <label for="loginName" class="sr-only">Username</label>
    <input type="text" id="loginName" name="loginName" class="form-control" placeholder="User Name" required="" autofocus="">
    <label for="loginPass" class="sr-only">Password</label>
    <input type="password" id="loginPass" name="loginPass" class="form-control" placeholder="Password" required="">
    <button class="btn btn-lg btn-primary btn-block" name="loginSubmit" type="submit">Sign in</button>
</form>


<?php include ('./footer.php'); ?>