<?php include('partials/menu.php') ?>

     <div class="main-content">
        <div class="wrapper">
            <h1>Add Location</h1>

            <br><br>
            <?php
               if(isset($_SESSION['upload']))
               {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
               }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the location">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of the location."></textarea>
                    </td>
                </tr>
                  <!-- <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                   </tr> -->
                   <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                   </tr>
                   <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                          
                        <?php
                              //Create php code to display categories from database
                              //1. Create sql to get all active categories from database
                               $sql="SELECT * FROM tbl_tablecategory WHERE active ='yes'";

                               //Executing query
                               $res = mysqli_query($conn, $sql);

                               //Count rows to check whether we have categories or not
                               $count = mysqli_num_rows($res);

                               //If count is greater than zero, we have categories else we donot have categories
                               if($count>0)
                               {
                                  //We have categories
                                  while($row=mysqli_fetch_assoc($res))
                                  {
                                     //Get the details of categories
                                     $id = $row['id'];
                                     $title = $row['title'];
                                     ?>

                                       <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                     <?php
                                  }
                               }
                               else
                               {
                                  //We do not havae categories
                                  ?>
                                   <option value="0">No Category Found</option>
                                  <?php
                               }
                              //2. Display on Dropdown
                        
              
   
                            ?>
                                  
                            
                        </select>
                    </td>
                   </tr>
                   <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes">yes
                        <input type="radio" name="featured" value="no">no
                    </td>
                   </tr>
                   <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes">yes
                        <input type="radio" name="active" value="no">no
                    </td>
                   </tr>
                   <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Location" class="btn-secondary">
                    </td>
                   </tr>
                </table>
            </form>

            <?php
                 //Check whether the button is clicked or not
                 if(isset($_POST['submit']))
                 {
                    //Add the food in database
                    //echo "Clicked";
                    
                    //1. Get the data from form 
                  //  $title = $_POST['title'];
                  //  $description = $_POST['description'];
                 //   $price = $_POST['price'];
                  //  $category = $_POST['category'];

                    $title =mysqli_real_escape_string($conn, $_POST['title']);
                    $description =mysqli_real_escape_string($conn, $_POST['description']);
                    $category =mysqli_real_escape_string($conn, $_POST['category']);
                    
                    
                    //Check whether radio button for featured and active are checked or not
                    if(isset($_POST['featured']))
                     {
                           $featured = $_POST['featured'];
                     }
                     else
                     {
                        $featured = "no"; //setting the default value
                     }

                     if(isset($_POST['active']))
                     {
                           $active = $_POST['active'];
                     }
                     else
                     {
                         $active = "no"; //setting default value
                     }
                    //2. Upload the image into database
                    //checked whether the select image is clicked or not and upload the image only if the image is selected
                    if(isset($_FILES['image']['name']))
                    {
                            //Get the details of the selected image
                            $image_name = $_FILES['image']['name'];

                            //Check whether teh image is selected or not and upload image only if selected
                            if($image_name!="")
                            {
                                 //Image is Selected
                                 //A. Rename the image
                                 //Get the extension of selected image (jpg, png, gif, etc. ) mukti-nath.jpg
                                 $ext = end(explode('.',$image_name));

                                 //Create New name for image
                                 $image_name = "Location-Name-".rand(0000,9999).".".$ext; //new image name may be "Food-Name-657.jpg"


                                 //B. Upload the image
                                 //Get the source path and Destination path

                                 //Source path is the current location of the image
                                 $src = $_FILES['image']['tmp_name'];
                                 
                                 //Destination path for the image to be uploaded
                                 $dst = "../images/location/".$image_name;

                                 //Finally Upload the food image
                                 $upload = move_uploaded_file($src, $dst);

                                 //Check whether image uploaded or not
                                 if($upload==false)
                                 {
                                        //Failed to upload the image
                                        //Redirect to Add Food page With error message
                                        $_SESSION['upload']="<div class='error'>Faile to Upload Image.</div>";
                                        header('location:'.SITEURL.'admin/add-location.php');
                                        //Stop the process
                                        die();
                                 }
                                
                            }
                    }
                    else
                    {
                          $image_name = ""; //Setting default value as blank
                    }

                    //3. Insert Into Database
                    
                    //Create a sql query to save or add food
                    //For numerical we do not need to pass the value inside quotes '' but for string value it is compulsary to add quotes ''
                    $sql2="INSERT INTO tbl_location SET
                             title = '$title',
                             description = '$description',
                             image_name = '$image_name',
                             category_id = $category,
                             featured = '$featured',
                             active = '$active'

                          ";

                         //Execute the Query
                         $res2=mysqli_query($conn, $sql2);
                         
                         //Check whether the data inserted or not
                         if($res2 == true)
                         {
                               //Data inserted successfully
                               $_SESSION['add']="<div class='success'>Location Added Successfully.</div>";
                               header('location:'.SITEURL.'admin/manage-location.php');
                         }
                         else
                         {
                              //Failed to insert data
                              $_SESSION['add']="<div class='error'>Failed to Add Location.</div>";
                               header('location:'.SITEURL.'admin/manage-location.php');
                         }

                    //4. Redirect with message to manage location page
                 }
                 
            ?>

        </div>
     </div>




<?php include('partials/footer.php'); ?>
