<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
      <div class="container">

        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
          <input
            type="search"
            name="search"
            placeholder="Search for Food.."
            required
          />
          <input
            type="submit"
            name="submit"
            value="Search"
            class="btn btn-primary"
          />
        </form>
      </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    if(isset($_SESSION['order']))
    {
      echo $_SESSION['order'];
      unset($_SESSION['order']);
    }
    
    ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
      <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
          //create sql to display cg from db
          $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
          //execute
          $res=mysqli_query($conn,$sql);

          $count=mysqli_num_rows($res);
          if($count>0)
          {
            //availble
            while($row=mysqli_fetch_assoc($res))
            {
              //get values
              $id=$row['id'];
              $title=$row['title'];
              $image_name=$row['image_name'];
              ?>

        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
          <div class="box-3 float-container">
            <?php 
            if($image_name==""){
              echo "<div class='error'>Image Not Available.</div>";
            }
            else
            {
              ?>
                 <img
              src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"
              alt="Pizza"
              class="img-responsive img-curve"            
              width="320px"
             height="320px"
            />
              <?php
            }
            ?>
         
            <h3 class="float-text text-white"><?php echo $title ;?></h3>
          </div>
        </a>

              <?php
            }
          }
          else{
            //not availble
            echo "<div class='error'><h3>Category Not Aded</h3></div>";
          }
        ?>

        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Categories Section Ends Here -->




    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php
        
        //getting food from db that are active and featured
        $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        //execute
        $res2=mysqli_query($conn,$sql2);

        $count2=mysqli_num_rows($res2);

        //check if food is available or not
        if($count2>0)
        {
          //food availble
          while($row2=mysqli_fetch_assoc($res2))
          {
            $id=$row2['id'];
            $title=$row2['title'];
            $price=$row2['price'];
            $description=$row2['description'];
            $image_name=$row2['image_name'];
            ?>

        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            //chrck if avalble or not
            if($image_name==""){
              //not
              echo "<div class='error'><h3>Image Not Available.</h3></div>";
            }
            else
            {
              //yes
              
              ?>
              <img
              src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>"
              alt="Photo"
              class="img-responsive img-curve"
              width="120px"
              height="120px"
            />
              <?php
            }
            ?>
            
          </div>

          <div class="food-menu-desc">
            <h4><?php echo $title;?></h4>
            <p class="food-price">$<?php echo $price;?></p>
            <p class="food-detail">
            <?php echo $description;?>
            </p>
            <br />

            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>


            <?php
          }
        }
        else
        {
          //not 
          echo "<div class='error'><h3>Food Not Available.</h3></div>";

        }
        
        
        ?>

     

        <div class="clearfix"></div>
      </div>

      <p class="text-center">
        <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
      </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   
    <?php include('partials-front/footer.php');?>