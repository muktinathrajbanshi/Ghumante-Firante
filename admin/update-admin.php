<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Admin </ha>

        <br><br>

      <?php
          //1. Get the ID of Deleted Admin
           $id=$_GET['id'];

           //2. Create SQL Query to Get the Details
           $sql = "SELECT * FROM tbl_admin where id=$id";

           // Execute the Query
           $res=mysqli_query($conn, $sql);

           //Check whether the Query is executed or not
           if($res==true)
            {
              //Check whether the data is available or not
              $count=mysqli_num_rows($res);
              
              //Check whether we have admin data or not
              if($count==1)
              {
                //Get the details
                // echo "Admin Available";
                $row=mysqli_fetch_assoc($res);

                $full_name=$row['full_name'];
                $username=$row['user_name'];
              }
              else
              {
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-admin.php');
              }
            }
       ?>
              
        <form action ="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                  </tr>
              
                  <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                  </td>
                 </tr>

                 <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
             </td>
          </tr>
       </table>
   </form>
</div>
</div>

<?php
   //Checked whether the submit Button is clicked or not
   if(isset($_POST['submit']))
   {
     //echo "Button Clicked";
     //Get all the values form to update
     // $id=$_POST['id'];
     // $full_name=$_POST['full_name'];
     // $username=$_POST['username'];

      $id=$_POST['id'];
      $full_name=mysqli_real_escape_string($conn, $_POST['full_name']);
      $username=mysqli_real_escape_string($conn, $_POST['username']);

      // Create a SQL Query to Update Admin
      $sql="UPDATE tbl_admin SET
      full_name='$full_name',
      user_name='$username'
      WHERE id='$id'
      ";

      //Execute the Query
      $res=mysqli_query($conn, $sql);

      //Check whether the query executed successfully or not
      if($res==true)
      {
        //Query Executed and Admin updated
        $_SESSION['update']="<div class='success'>Admin updated successfully.</div>";
        //Redirect to Manage Admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
      }
      else
      {
        //Failed to update Admin
        $_SESSION['update']="<div class='error'>Failed to Delete Admin.</div>";
        //Redirect to manage Admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
      }

   }
?>

<?php include('partials/footer.php');?>