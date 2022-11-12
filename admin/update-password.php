<?php include('partials/menu.php');?>
   <div class="main-content">
       <div class="wrapper">
          <h1>Change Password</h1>
          <br><br>
        
           <?php
             if(isset($_GET['id']))
             {
                   $id=$_GET['id'];
             }
           ?>


            <form action="" method="POST">
                <table class="tbl-30">
                     <tr>
                        <td>Current Password: </td>
                        <td>
                        <input type="password" name="current_password" placeholder="current password"> 
                       </td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td>
                         <input type="password" name="new_password" placeholder="new password">
                       </td>
                       </tr>
                       
                    <tr>
                        <td>Confirm Password: </td>
                        <td>
                         <input type="password" name="confirm_password" placeholder="confirm password">
               </td>
              </tr>   
              
              <tr>
                <td colspan="2">
                    <input type ="hidden" name="id" value="<?php echo $id; ?>">
                    <input type ="submit" name="submit" value="change password" class="btn-secondary">
            </td>
            </tr>
            </table>
            </form>            



       </div>
   </div>
     

   <?php
            // Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {

                  //echo "button clicked";
                  //1. Get the Data from form
                 // $id=$_POST['id'];
                  //$current_password=md5($_POST['current_password']);
                 // $new_password=md5($_POST['new_password']);
                 // $confirm_password=md5($_POST['confirm_password']);

                  $id=$_POST['id'];
                  $u_current_password=md5($_POST['current_password']);
                  $current_password=mysqli_real_escape_string($conn, $u_current_password);


                  $u_new_password=md5($_POST['new_password']);
                  $new_password=mysqli_real_escape_string($conn, $u_new_password);
                  

                  $u_confirm_password=md5($_POST['confirm_password']);
                  $confirm_password=mysqli_real_escape_string($conn, $u_confirm_password);


                  //2. Check whether the user with Current ID AND current Password Exists or Not
                  $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                  //3. Execute the query
                  $res=mysqli_query($conn, $sql);

                  if($res==true)
                  {
                      //Check whether data is available or not
                      $count=mysqli_num_rows($res);
                      if($count==1)
                      {
                          //User Exists and password can be changed
                         // echo "user found";
                         //Check whether the new password and confirm match or not
                         if($new_password==$confirm_password)
                         {
                              //Update the password
                              //echo "password match";
                           $sql2="UPDATE tbl_admin SET
                           password='$new_password'
                           WHERE id=$id
                           ";
                          //Execute the Query
                          $res2=mysqli_query($conn,$sql2);

                          //Check whether the query Execute or not
                          if($res2==true)
                          {
                               //Display Success Message
                               //Redirect to manage admin page with success
                               $_SESSION['change-pwd']="<div class='success'>Password Changed Successfuly.</div>";
                               //redirect the user
                                header('location:'.SITEURL.'admin/manage-admin.php');
                          }
                          else
                          {
                              //Display Error Message
                              //Redirect to manage Admin page with Error Message
                              $_SESSION['change-pwd']="<div class='error'>Failed to change Password.</div>";
                               //redirect the user
                                header('location:'.SITEURL.'admin/manage-admin.php');

                          }


                         }
                         else
                         {
                             //Redirect to manage Admin page with Error manage
                             $_SESSION['pwd-not-match']="<div class='error'>Password Did Not Match.</div>";
                               //redirect the user
                                header('location:'.SITEURL.'admin/manage-admin.php');
                         }





                      }
                      else
                      {
                        //User Does not Exists set message and redirect
                        $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                      }
                  }
            }




   ?>

<?php include('partials/footer.php');?>