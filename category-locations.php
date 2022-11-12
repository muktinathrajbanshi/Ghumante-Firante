  <?php include('partials-front/menu.php'); ?>

     <?php
       
       //Check whether id is passed or not
       if(isset($_GET['category_id']))
       {
              //Category id is set and get the id
              $category_id = $_GET['category_id'];
              //Get the category title based on category id
              $sql = "SELECT title FROM tbl_tablecategory WHERE id = $category_id";

              //Execute the query
              $res = mysqli_query($conn, $sql);
               
              //Get the value form database
              $row = mysqli_fetch_assoc($res);
              //Get the title
              $category_title = $row['title'];


       } 
       else
       {
              //Category not passed
              //Redirect to home page
              header('location:'.SITEURL);
       }

      ?>


    <!-- Location sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2 class="text-red">TO Do List on <a href="#" class="text-navy"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- Location sEARCH Section Ends Here -->



    <!-- Location MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"></h2>

                 <?php
                    //Create SQL query to Get location based on selected category
                    $sql2 = "SELECT * FROM tbl_location WHERE category_id = $category_id";

                    //Execute the query 
                    $res2 = mysqli_query($conn, $sql2);

                    //Count the rows
                    $count2 = mysqli_num_rows($res2);

                    //check whether location is available or not
                    if($count2>0)
                    {
                           //Location is Available
                           while($row2=mysqli_fetch_assoc($res2))
                           {
                               $id = $row2['id'];
                               $title = $row2['title'];
                               $description = $row2['description'];
                               $image_name = $row2['image_name'];

                                ?>
                                    <div class="food-menu-box">
                                        <div class="food-menu-img">
                                              <?php

                                                    if($image_name=="")
                                                    {
                                                            //Image not Available
                                                            echo "<div class='error'>Image Not Available.</div>";
                                                    }            
                                                    else
                                                    {
                                                            //Image Available
                                                            ?>

                                                           <img src="<?php echo SITEURL; ?>images/location/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                                           <?php
                                                    }
                
                                               ?>
                                            
                                        </div>

                                        <div class="food-menu-desc">
                                            <h4 class="text-center"><?php echo $title; ?></h4>
                                            <p class="text-left" class="food-detail">
                                                <?php echo $description; ?>
                                            </p>
                                            <br>

                                
                                        </div>
                                    </div>

                                <?php
                           }
                    }
                    else
                    {
                            //Location Not Available
                            echo "<div class='error'>Location Not Available.</div>";
                    }
                     
                   ?>

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Location Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>