<?php
   //include constant page
   include('../config/constants.php');
  //echo "delete food page";
  if(isset($_GET['id']) && isset($_GET['image_name'])) //Either user && and AND
  {
        //Process to Delete
        //echo "Process to Delete";

        //1. Get ID and Image Name
          $id = $_GET['id'];
          $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
         //Check whether the image is available or not delete only if available
         if($image_name!="")
         {
               //It has image and need to remove from folder
               //Get the image path
               $path = "../images/location/".$image_name;

               //Remove image file from folder
               $remove = unlink($path);

               //Check whether the image is removed or not
               if($remove==false)
               {
                  //Failed to Remove image
                  $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                  //Redirect to Manage Food
                  header('location:'.SITEURL.'admin/manage-location.php');
                  //stop the process of deleting location
                  die();
               }
         }
        //3. Delete location from database
        $sql="DELETE  FROM tbl_location WHERE id=$id";

        //Executer the query
        $res = mysqli_query($conn, $sql);

        //Check whether the query is executed or not and set session message respectively
        if($res==true)
        {
             //Location deleted
             $_SESSION['delete'] ="<div class='success'>Location Deleted Successfully.</div>";
             header('location:'.SITEURL.'admin/manage-location.php');
        }
        else
        {
            //Failed to delete location
            $_SESSION['delete'] ="<div class='error'>Failed to Delete Location.</div>";
             header('location:'.SITEURL.'admin/manage-location.php');
        }

        //4. Redirect to manage location with session message
  }
  else
  {
      //Redirect to Manage location Page
      //echo "Redirect";
      $_SESSION['unauthorized']="<div class='error'>Unauthorized Access.</div>";
      header('location:'.SITEURL.'admin/manage-location.php');
  }
?>