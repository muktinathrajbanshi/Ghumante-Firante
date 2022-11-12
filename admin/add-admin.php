<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
    <h1>Add Admin</h1>

    <br /> <br />
 
  <form action=""method="POST">
    <table class="tbl-30">
        <tr>
            <td>Full Name: </td>
            <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
    </tr>
         <tr>
            <td>User Name: </td>
            <td>
                <input type="text" name="user_name" placeholder="Your Username">
          </td>
     </tr>
         <tr>
            <td>Password: </td>
            <td>
                <input type="password" name="password" placeholder="Your Password">
     </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type ="submit" name="submit" value="Add Admin" class="btn-secondary">
    </td>
   </tr>
 </table>


 </div>
 </div>

<?php include('partials/footer.php');?>

<?php
   //Process the value from form and save it in Database

   //Check whether the submit button is clicked or not

   if(isset($_POST['submit']))
   {
         //Button Clicked  
      // echo"Button Clicked";
       //1. Get the Data from form
       //$full_name=$_POST['full_name'];
       //$Username=$_POST['user_name'];
       //$password=md5($_POST['password']); //password Encryption with MD5 

       $full_name=mysqli_real_escape_string($conn, $_POST['full_name']);
       $Username=mysqli_real_escape_string($conn, $_POST['user_name']);
       $raw_password=md5($_POST['password']); //password Encryption with MD5
       $password=mysqli_real_escape_string($conn, $raw_password); 
       
       //2. SQL Query to Save the data into database
       $sql="INSERT INTO tbl_admin SET
       full_name='$full_name',
       user_name='$Username',
       password='$password'
       ";
      
      // 3. Executing Query and Saving Data into Database
      $res = mysqli_query($conn,$sql) or die(mysqli_error());

      // 4. Check Whether the (Query is executed)data is inserted or not and display appropriate message)  
       if($res==TRUE)
       {
          //Data Inserted
         // echo"Data Inserted";
         //Create a Session Variable to display message
         $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
         //Redirect page to Manage Admin
         header("location:".SITEURL.'admin/manage-admin.php');

       }
       else
       {
            //Failed to insert Data
            //echo"Failed to Inserted Data";
            //Create a Session Variable to display message
         $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
         //Redirect page to Add Admin
         header("location:".SITEURL.'admin/add-admin.php');

       }

   }
   
 ?>


