<?php include('partials-front/menu.php');?>
  
  <!-- Location sEARCH Section Starts Here -->
  <section class="food-search text-center">
        <div class="container">
        <h2 class="text-white"><b>GHUMANTE-FIRANTE</b></h2>            

        </div>
    </section>
    <!-- Location sEARCH Section Ends Here -->

    
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Adventure & Places</h2>

             <?php
               //Create SQL Query to Display Categories From Database
               $sql="SELECT * FROM tbl_tablecategory WHERE active='yes' AND featured='yes' LIMIT 3";
               //Execute the query
               $res = mysqli_query($conn, $sql);

               //Count rows to check whether the category is available or not
               $count= mysqli_num_rows($res);

               if($count>0)
               {
                   //Categories Available
                   while($row=mysqli_fetch_assoc($res))
                   {
                      //Get the values like id, title, image_name
                      $id = $row['id'];
                      $title = $row['title'];
                      $image_name = $row['image_name'];

                         ?>
                         <a href="<?php echo SITEURL; ?>category-locations.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                              //Check whether the image is available or not
                               if($image_name=="")
                               {
                                    //Display message
                                    echo "<div class='error'>Message not Available</div>";
                               }
                               else
                               {
                                    //Image available
                                    ?>
                                     <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Category Location" class="img-catinresponsive img-curve">

                                    <?php
                               }
                             ?>
                       
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>

                         <?php
                   }
               }
               else
               {
                   //Categories not Available
                   echo "<div class='error'>Category Not Added.</div>";
               }

              ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->





    <!-- Location MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"></h2>
                
            <?php
               //Getting Location from database that are active and featured
                 //SQL query
                 $sql2="SELECT * FROM tbl_location WHERE active='yes' AND featured='yes' LIMIT 6";

                 //Execute the query
                 $res2 = mysqli_query($conn, $sql2);

                 //Count the rows
                 $count2 = mysqli_num_rows($res2);

                 //Check whether Location available or not
                 if($count2>0)
                 {
                      //Location Available
                      while($row=mysqli_fetch_assoc($res2))
                      {
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
                                           <img src="<?php echo SITEURL; ?>images/location/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                   }
                                ?>
                             
                             
                                </div>

                             <div class="food-menu-desc">
                             <h4 class="text-center"><?php echo $title; ?></h4>
                             <p class="food-detail">
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

        <p class="text-center">
            <a href="#">See All Location</a>
        </p>
    </section>
    <!-- Location Menu Section Ends Here -->

    <!-- Contact Section Start Here -- >
     
    




     <! -- Contact Section Ends Here -- >

   <?php include('partials-front/footer.php');?>