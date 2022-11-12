<?php include('partials/menu.php');?>

  <?php
        //Check whether id is set or not
        if(isset($_GET['id']))
        {
               //Get all the details
               $id = $_GET['id'];

               //Sql query to Get the Selected Food
               $sql2 = "SELECT * FROM tbl_location WHERE id=$id";

               //Execute the Query
               $res2 = mysqli_query($conn, $sql2);

               //Get the value based on query executed
               $row2 = mysqli_fetch_assoc($res2);

               //Get the individual values of Selected Food
               $title = $row2['title'];
               $description = $row2['description'];
               $current_image = $row2['image_name'];
               $current_category = $row2['category_id'];
               $featured = $row2['featured'];
               $active = $row2['active'];
        }
        else
        {
              //Redirect to Manage Food
              header('location:'.SITEURL.'admin/manage-location.php');
        }
   ?>



       <div class="main-content">
        <div class="wrapper">
            <h1>Update Location</h1>
            <br><br>
            <form action=""method ="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                  <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                  </tr>
                 
                  <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                         if($current_image == "")
                         {
                                //Image not Available
                                echo "<div class ='error'>Image not Available.</div>";
                         }
                         else
                         {
                             //Image Available
                             ?>
                             <img src="<?php echo SITEURL; ?>images/location/<?php echo $current_image; ?>"width="150px">

                             <?php
                         }
                          ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                  </tr>
                  <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                          
                          <?php
                          //Query to Get Active Categories
                            $sql="SELECT * FROM tbl_tablecategory WHERE active='yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);

                            //Count Rows
                            $count = mysqli_num_rows($res);

                            //Check whether category is available or not
                            if($count>0)
                            {
                                   //Category available
                                   while($row=mysqli_fetch_assoc($res))
                                   {
                                     $category_title = $row['title'];
                                     $category_id = $row['id'];

                                    // echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                         <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                   }
                            }
                            else
                            {
                                  //Category Not available
                                  echo "<option value='0'>Category Not Available.</option>";
                            }
                          ?>


                           
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="yes">yes
                        <input <?php if($featured=="no"){echo "checked";}?> type="radio" name="featured" value="no">no
                    </td>
                  </tr>
                  <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="yes"){echo "checked";}?> type="radio" name="active" value="yes">yes
                        <input <?php if($active=="no"){echo "checked";}?> type="radio" name="active" value="no">no
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Location" class="btn-secondary">
                    </td>
                  </tr>
                </table>
            </form>
           <?php
              if(isset($_POST['submit']))
              {
                   //echo "Button clicked";

                   //1. Get all the details from form
                     //$id = $_POST['id'];
                    // $title = $_POST['title'];
                    // $description = $_POST['description'];
                    // $price = $_POST['price'];
                    // $current_image = $_POST['current_image'];
                    // $category = $_POST['category'];
                     
                    // $featured = $_POST['featured'];
                   //  $active = $_POST['active'];

                     $id = $_POST['id'];
                     $title =mysqli_real_escape_string($conn, $_POST['title']);
                     $description =mysqli_real_escape_string($conn, $_POST['description']);
                     $current_image = $_POST['current_image'];
                     $category = $_POST['category'];
                     
                     $featured = $_POST['featured'];
                     $active = $_POST['active'];
                   //2. Upload the image if selected
                   
                   //Check whether upload button is clicked or not
                   if(isset($_FILES['image']['name']))
                   {
                        //Upload Button Clicked
                        $image_name = $_FILES['image']['name']; //New Image name

                        //Check whether the file is available or not
                        if($image_name!="")
                        {
                             //Image is available
                             //A. Uploading new image

                             //Rename the image
                             $ext = end(explode('.',$image_name)); //Gets the extension of the image

                             $image_name = "Location-Name-".rand(0000,9999).'.'.$ext; //This will be rename image

                             //Get the Source path and Destination path
                             $src_path = $_FILES['image']['tmp_name'];
                             $dest_path = "../images/location/".$image_name; //Destination path

                             //Upload the image
                             $upload = move_uploaded_file($src_path, $dest_path);

                             //Check whether the image is uploaded or not
                             if($upload==false)
                             {
                                  //Failed to upload
                                  $_SESSION['upload']="<div class='error'>Failed to Upload new Image.</div>";
                                  //Redirect to manage food
                                  header('location:'.SITEURL.'admin/manage-location.php');
                                  //stop the process
                                  die();
                             }
                             //B.Remove current image if available
                             if($current_image!="")
                             {
                                 //Current image is available
                                 //Remove the image
                                 $remove_path = "../images/location/".$current_image;

                                 $remove = unlink($remove_path);

                                 //check whether the image is remove or not[
                                 if($remove==false)
                                 {
                                      //Failed to remove current image
                                      $_SESSION['remove-failed']="<div class='error'>Failed to remove current image.</div>";
                                      //Redirect to manage food
                                      header('location:'.SITEURL.'admin/manage-location.php');
                                      //stop the process
                                      die();
                                 }
                             }
                        }
                        else
                        {
                            $image_name = $current_image; //Default image when image is not selected

                        }
                   }
                   else
                   {
                      $image_name = $current_image; //Default image when button is not clicked
                   }

                

                   //4. Update the Location in database
                   $sql3 = "UPDATE tbl_location SET
                      title = '$title',
                      description = '$description',
                      image_name = '$image_name',
                      category_id = '$category',
                      featured = '$featured',
                      active = '$active'
                      WHERE id=$id;
                   ";

                  //Execute the SQL Query
                  $res3 = mysqli_query($conn, $sql3);

                  //Check whether the query is executed or not
                  if($res3==true)
                  {
                     //Query executed Location Updated
                     $_SESSION['update']="<div class ='success'>Location Updated Successfully.</div>";
                     header('location:'.SITEURL.'admin/manage-location.php');
                  }
                  else
                  {
                        //Failed to update Location
                        $_SESSION['update']="<div class ='error'>Failed to Update Location.</div>";
                        header('location:'.SITEURL.'admin/manage-location.php');
                  }

            
              }


             ?>

        </div>
       </div>


<?php include('partials/footer.php');?>