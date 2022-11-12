<?php include('partials-front/menu.php'); ?>

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
            <h2 class="text-center">Adventures & Places</h2>

              <?php
                   //Display all the categores that are active
                   //Sql Query
                   $sql = "SELECT * FROM tbl_tablecategory WHERE active='yes'";

                   //Execute the query
                   $res = mysqli_query($conn, $sql);

                   //Count rows
                   $count = mysqli_num_rows($res);

                   //Check whether categories available or not
                   if($count>0)
                   {
                      //Categories Available
                      while($row=mysqli_fetch_assoc($res))
                      {
                           //Get the values
                           $id = $row['id'];
                           $title = $row['title'];
                           $image_name = $row['image_name'];

                           ?>
                         
                            <a href="<?php echo SITEURL; ?>category-locations.php?category_id=<?php echo $id; ?>">
                            <div class="box-4 float-container">
                                <?php
                                   if($image_name=="")
                                   {
                                         //Image not Available
                                         echo "<div class='error'>Image Not Found.</div>";

                                   }
                                   else
                                   {
                                       //Image Available

                                         ?>
                                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="category for location" class="img-catresponsive img-curve">
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
                      //Categores Not Available
                      echo "<div class='error'>Category Not Found.</div>";
                   }

                 ?>


           
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>