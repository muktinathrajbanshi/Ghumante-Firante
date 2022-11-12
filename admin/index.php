
<?php include('partials/menu.php');?>
     <!--Main Content Section Starts-->
     <div class = "Main-Content">
        <div class="wrapper">
        <h1>Overview</h1>
          <br><br>
                 <?php
                        if(isset($_SESSION['login']))
                        {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                        }
               ?>
           <br><br>
        <div class = "col-4 text-center">
        
                <?php
                   //Sql Query
                  $sql = "SELECT * FROM tbl_tablecategory";
                   //Execute Query
                   $res = mysqli_query($conn, $sql);
                   //Count the Rows
                   $count = mysqli_num_rows($res);
                 ?>
            <h1><?php echo $count; ?></h1>
            categories
    </div>
    <div class = "col-4">
                       <?php
                        //Sql Query
                        $sql2 = "SELECT * FROM tbl_location";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count the Rows
                        $count2 = mysqli_num_rows($res2);
                        ?>
            <h1><?php echo $count2; ?></h1>
            Locations with different categories
    </div>

            
                
                
    <div class="clearfix"></div>
     </div>
      </div>
    <!--Main Content Section Ends-->

   <?php include('partials/footer.php');?>