<?php include('partials/menu.php');?>
   <div class="main-content">
      <div class="wrapper">
        <h1>Update Category</h1>

         <br><br>
          <?php
            //Check whether the id is set or not
            if(isset($_GET['id']))
             {
                 //Get the id and all other details
                // echo "Getting the data";
                $id=$_GET['id'];

                //Create sql query to get all other details
                $sql="SELECT * FROM tbl_tablecategory WHERE id=$id";

                //Execute the query
                $res=mysqli_query($conn, $sql);

                //Count the rows to check whether the id is valid or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                      //Get all the data
                      $row= mysqli_fetch_assoc($res);
                      $title= $row['title'];
                      $current_image = $row['image_name'];
                      $featured = $row['featured'];
                      $active = $row['active'];
                }
                else
                {
                      //Redirect to manage category with message
                      $_SESSION['no-category-found']="<div class='error'>Category Not Found.</div>";
                      header('location:'.SITEURL.'admin/manage-category.php');
                }
             }
             else
             {
                   //Indirect to Manage Category
                   header('location:'.SITEURL.'admin/manage-category.php');
             }

          ?>



         <form action=""method="POST" enctype="multipart/form-data">
           <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                        if($current_image!="")
                        {
                              //Display the image
                              ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"width="150px">

                              <?php
                        }
                        else
                        {
                              //Display Message
                              echo "<div class='error'>Image Not Added.</div>";
                        }
                     ?>
                </td>
            </tr>

            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

           <tr>
            <td>Featured: </td>
            <td>
            <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">yes
            <input <?php if($featured=="no"){echo "checked";} ?> type="radio" name="featured" value="no">no
            </td>
           </tr>

           <tr>
            <td>Active: </td>
            <td>
            <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes">yes
            <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no">no
            </td>
           </tr>

           <tr>
            <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category"class="btn-secondary">
            </td>
           </tr>

           </table>

      </form>

       <?php
          if(isset($_POST['submit']))
          {
              // echo "clicked";
              // 1. Get all the values from our form
             // $title = $_POST['title'];
             // $id = $_POST['id'];
             // $current_image = $_POST['current_image'];
             // $featured = $_POST['featured'];
             // $active = $_POST['active'];

              $title =mysqli_real_escape_string($conn, $_POST['title']);
              $id = $_POST['id'];
              $current_image = $_POST['current_image'];
              $featured = $_POST['featured'];
              $active = $_POST['active'];

              //2. Updating new image if selected
              //Check whether the image is selected or not
               if(isset($_FILES['image']['name']))
               {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name!="")
                    {
                          //Image available
                          //A. Upload the new image
                          //Auto Rename our Image
                                    //Get the Extension of our image (jpg,png,gif,etc) e.g. "food1.jpg"
                                    $ext = end(explode('.',$image_name));

                                    //Rename the image 
                                    $image_name = "location_category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg


                                    $source_path = $_FILES['image']['tmp_name'];

                                    $destination_path = "../images/category/".$image_name;
                                    

                                    //Finally Upload the Image
                                    $upload = move_uploaded_file($source_path,$destination_path);

                                    //Check whether the image is upload or not
                                    //And if the image is not uploaded then we will stop the process and redirect with error message
                                    if($upload==false)
                                    {
                                        //Set message
                                        $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                                        //Redirect to Add Category page
                                        header('location:'.SITEURL.'admin/manage-category.php');
                                        //Stop the process
                                        die();
                                    }
                          //B. Remove the current image if available
                          if($current_image!="")
                          {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                         //Check whether the image is removed or not
                         //If failed to remove then display message and stop the process
                         if($remove==false)
                         {
                               //Failed to remove image
                               $_SESSION['failed-remove']="<div class='error'>Failed to remove current image.</div>";
                               header('location:'.SITEURL.'admin/manage-category.php');
                               //stop the process
                               die();
                         }   
                          }
                              

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
               }
               else
               {
                    $image_name = $current_image;
               }

              //3. Update the database
              $sql2="UPDATE tbl_tablecategory SET
                   title = '$title',
                   image_name='$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id= $id
                    ";

              //Execute the query
              $res2 = mysqli_query($conn, $sql2);

              //4. Redirect to Manage category with message
              //Check whether query executed or not
              if($res2==true)
              {
                  //Category Updated
                  $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
                  //redirect to manage category
                  header('location:'.SITEURL.'admin/manage-category.php');
              }
              else
              {
                  //Failed t update category
                  $_SESSION['update']="<div class='error'>Failed to Update Category.</div>";
                  //redirect to manage category
                  header('location:'.SITEURL.'admin/manage-category.php');
              }
              
          }
       ?>


      </div>
   </div>
   




<?php include('partials/footer.php');?>