<?php include('partials-front/menu.php'); ?>

    <!-- Location sEARCH Section Starts Here -->
 <section class="food-search text-center">
        <div class="container">
        <h2 class="text-white"><b>GHUMANTE-FIRANTE</b></h2> 

        <?php
             if(isset($_SESSION['update']))
             {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
             }
         ?>        

        <?php
       if(isset($_POST["submit"]))  
       {
        $name = $_POST["name"];
        $mobile = $_POST["mobile"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        $sql = "INSERT INTO tbl_contact (user_name, user_mobile_no, user_email, user_message) VALUES ('$name',
        '$mobile', '$email', '$message')";

        $res = mysqli_query($conn, $sql);

        /* if($res==true)
        {
           //Query executed Location Updated
           $_SESSION['update']="<div class ='success'>Contact Successfull.</div>";
           header('location:'.SITEURL.');
        }
        else
        {
              //Failed to update Location
              $_SESSION['update']="<div class ='error'>Failed to Contact.</div>";
              header('location:'.SITEURL.'contact.php');
        }
        */
             
       } 
      

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="contact-form">
<h1></h1>
<h2>Your Feedback!</h2>
</div>
<div class="contact-us">
<form id="contact-us" method="post" action="contact.php">
<input type="text" name="name" class="form-control" placeholder="Enter your name"
required>
<br>
<input type="text" name="mobile" class="form-control" placeholder="Enter your mobile
number">
<br>
<input type="email" name="email" class="form-control" placeholder="Enter your Email"
required>
<br>
<textarea name="message" class="form-control" cols="" rows="3" placeholder="Enter
your messege" required></textarea>
<br>
<input type="submit" name="submit" class="btn-primary" value="submit here">

</form>
</div>
</body>
</html>








        </div>
    </section>
    <!-- Location sEARCH Section Ends Here -->





     
    


<?php include('partials-front/footer.php'); ?>