<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Add Category</h1>

                <br><br>
             
                <?php
             
                if(isset($_SESSION['add']))
                {
                      echo $_SESSION['add'];
                      unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                       echo $_SESSION['upload'];
                       unset($_SESSION['upload']);
                }

                ?>

               <br><br>

                <!-- Add Category Form Starts -->
                  <form action="" method="POST" enctype="multipart/form-data">

                      <table clsaa="tbl-30">
                         <tr>
                            <td>Title: </td>
                            <td>
                                <input type="text" name="title" placeholder="category Title">
                            </td>
                        </tr>

                         <tr>
                            <td>Select Image: </td>
                            <td>
                                <input type="file" name="image">
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
                                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                            </td>
                         </tr>

                       </table>


                  </form>
                <!-- Add Category Form Ends -->
              
                <?php

                     //Check whether the submit button is clicked or not
                     if(isset($_POST['submit']))
                     {
                          // echo"clicked";
                         //1. Get the value from category form
                        // $title=$_POST['title'];

                         $title=mysqli_real_escape_string($conn, $_POST['title']);
                         
                          //For radio input, we need to check whether the  button is selected or not
                        if(isset($_POST['featured']))
                        {
                              //Get the value from form
                              $featured = $_POST['featured'];
                        }
                        else
                        {
                              //Set the default value
                              $featured = "no";
                        }

                         if(isset($_POST['active']))
                         {
                               $active = $_POST['active'];
                         }
                         else
                         {
                                 $active = "no";
                         }
                        
                         //Check whether the image is selected or not and set the value for image name successfully
                          //print_r($_FILES['image']);
                          //die(); //Break the code here
                           if(isset($_FILES['image']['name']))
                           {
                              //Upload the Image
                              //To upload the image we need image name, source path and destination path
                              $image_name = $_FILES['image']['name'];
                               
                              // Upload the Image only if image is selected
                              if($image_name!="")
                              {
                                   
                            
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
                                        header('location:'.SITEURL.'admin/add-category.php');
                                        //Stop the process
                                        die();
                                    }
                                }  

                            }
                           else
                           {
                               //Don't upload the image
                               $image_name="";
                           }


                       //2. Create sql query to insert category into database
                       $sql="INSERT INTO tbl_tablecategory SET
                           title='$title',
                           image_name='$image_name',
                           featured='$featured',
                           active='$active'
                           ";

                        //3. Execute the query and save in database
                         $res=mysqli_query($conn, $sql);

                         // 4. Check whether the query executed or not and data added or not
                         if($res==true)
                         {
                               //Query executed and category added
                               $_SESSION['add'] ="<div class='success'>Category Added Successfully.</div>";
                               //Redirect ot manage category page
                               header('location:'.SITEURL.'admin/manage-category.php');

                         }
                         else
                         {
                              //Failed to add category
                              $_SESSION['add'] ="<div class='error'>Failed to Add Category.</div>";
                               //Redirect ot manage category page
                               header('location:'.SITEURL.'admin/add-category.php');

                         }











                    

                     }

                ?>









            </div>
        </div>


<?php include('partials/footer.php');?>