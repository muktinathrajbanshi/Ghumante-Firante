<?php include('../config/constants.php');?>


<html>
    <head>
        <title>login-location order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
                 <br><br>
              
               <?php
                if(isset($_SESSION['login']))
                {
                       echo $_SESSION['login'];
                       unset($_SESSION['login']);
                }
                 
                if(isset($_SESSION['no-login-message']))
                {
                          echo $_SESSION['no-login-message'];
                          unset($_SESSION['no-login-message']);
                }



               ?>


              <br><br>

              <!--Login Form Starts Here -->
              <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
              </form>
              <!--Login Form Ends Here -->
               

            <p class="text-center">Created By -<a href="www.muktinathrajbanshi.com">Muktinath Rajbanshi</a></p>
        </div>

    </body>
</html>
<?php 
        //Check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
              // process for login
              //1. Get the data from login form
              // $username=$_POST['username'];
              // $password=md5($_POST['password']);

               $username=mysqli_real_escape_string($conn, $_POST['username']);
               $raw_password=md5($_POST['password']);
              $password=mysqli_real_escape_string($conn, $raw_password);




            //2. Sql to check whether the user with username and password exists or not
            $sql="SELECT * FROM tbl_admin WHERE user_name='$username' AND password='$password'";
            //3. Execute the query
            $res=mysqli_query($conn, $sql);

            //4. Count rows to check whether the user exists or not
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                       //User Available and login Success
                       $_SESSION['login']="<div class='success'>Login Successful.</div>";
                       $_SESSION['user'] =$username; //this is to check whether the user is login or not and logout will unset it
                       //Redirect to home page
                       header('location:'.SITEURL.'admin/');
                }
                else
                {
                      //User not Available
                      $_SESSION['login']="<div class='error text-center'>Username or password Did not match.</div>";
                      //Redirect to login page
                      header('location:'.SITEURL.'admin/login.php');
                }
           



        }
?>



