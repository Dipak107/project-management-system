<html>
    <head>
    <title>ProLink</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
 .form-gap {
    padding-top: 70px;
}

    </style>
    </head>
    <body>
        <?php
        session_start();
        if(isset($_SESSION["invaliduser"]))
        {
            if($_SESSION["invaliduser"]=="yes")
            {
                 $_SESSION["invaliduser"]="no";
                 ?>
        <script>alert("user does not exist with this mail id ");</script>
        
        <?php
            }
           
        }
        
        ?>
        <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-unlock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                      <form  action="php/forgetpassword.php" role="form"  class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email" required pattern="[a-zA-Z0-9.]+@(gmail.com|utu.ac.in)" title="invalid email">
                        </div>
                      </div>
                      <div class="form-group">
                          <input  name="otpbtn" class="btn btn-lg btn-primary btn-block" value="Send OTP" type="submit">
                                </br>
                        <a href="/project_final/index.php">Back TO Login</a>
                      </div>
                      
                      
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>

</body>
</html>