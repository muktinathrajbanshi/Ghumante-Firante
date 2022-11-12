     <?php include('partials-front/menu.php'); ?>

    <!-- Location sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <h2 class="text-white"><b>GHUMANTE-FIRANTE</b></h2> 


        </div>
    </section>
    <!-- Location sEARCH Section Ends Here -->



    <!-- Location MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Travel & Adventure</h2>

               <?php
                    //Display location that are active
                    $sql = "SELECT * FROM tbl_location WHERE active='yes'";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //Count Rows
                    $count = mysqli_num_rows($res);

                    //Check whether the location are available or not
                    if($count>0)
                    {
                            //Location Available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                   //Get the value
                                   $id = $row['id'];
                                   $title = $row['title'];
                                   $description = $row['description'];
                                   $image_name = $row['image_name'];

                                     ?>
                                      <div class="food-menu-box">
                                        <div class="food-menu-img">
                                               <?php 
                                                  //Check whether image available or not
                                                  if($image_name=="")
                                                  {
                                                        //Image not available
                                                        echo "<div class='error'>Image Not Available.</div>";
                                                  }
                                                  else
                                                  {
                                                        //Image available
                                                        ?>
                                                          <img src="<?php echo SITEURL; ?>images/location/<?php echo $image_name; ?>" alt="location image" class="img-responsive img-curve">
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
                            //Locations Not Available
                            echo "<div class='error'>Location Not Found.</div>";
                        
                    }

                ?>

            

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Location Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>