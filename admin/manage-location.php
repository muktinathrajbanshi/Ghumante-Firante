<?php include('partials/menu.php');?>

<div class ="main-content">
    <div class ="wrapper">
    <h1>Manage Location</h1>
    <br /> <br />

          <!-- Button to Add Admin -->
           <a href ="<?php echo SITEURL; ?>admin/add-location.php" class="btn-primary">Add Location</a>
          
            <br /> <br />

           <?php
               if(isset($_SESSION['add']))
               {
                  echo $_SESSION['add'];
                  unset($_SESSION['add']);
               }
               if(isset($_SESSION['delete']))
               {
                  echo $_SESSION['delete'];
                  unset($_SESSION['delete']);
               }
               if(isset($_SESSION['upload']))
               {
                  echo $_SESSION['upload'];
                  unset($_SESSION['upload']);
               }
               if(isset($_SESSION['unauthorized']))
               {
                  echo $_SESSION['unauthorized'];
                  unset($_SESSION['unauthorized']);
               }
               if(isset($_SESSION['update']))
               {
                  echo $_SESSION['update'];
                  unset($_SESSION['update']);
               }
               
               
           ?>


         <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
              //Create a sql query to get all the food
              $sql="SELECT * FROM tbl_location";

              //Execute the query
              $res = mysqli_query($conn, $sql);

              //Count Rows to check whether we have foods or not
              $count = mysqli_num_rows($res);

              //Create serial number variable and set default value as 1
              $sn = 1;
              if($count>0)
              {
                  //We have food in database
                  //Get the food from database and display
                  while($row=mysqli_fetch_assoc($res))
                  {
                        //Get the values from individual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                <?php
                                  //Check whether we have image or not
                                  if($image_name=="")
                                  {
                                      //We do not have image. Display error message
                                      echo "<div class='error'>Image not Added.</div>";
                                  }
                                  else
                                  {
                                    //we have image, Display image
                                    ?>
                                     <img src="<?php echo SITEURL; ?>images/location/<?php echo $image_name; ?>"width="300px">
                                    
                                    <?php
                                  }
                                
                                 ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-location.php?id=<?php echo $id; ?>" class="btn-secondary">Update Location</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-location.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Location</a>
                            </td>
                            </tr>
                        <?php
                  }
              }
              else
              {
                   //Location not added in database
                   echo "<tr><td colspan='7' class='error'> Location not Added Yet. </td></tr>"; //html code inside php
              }



            ?>
            
              
        </table>
</div>
</div>

<?php include('partials/footer.php');?>

