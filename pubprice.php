 <?php  
  
  $count = 0;
  // connecto database
 
  $title = "Scarlet Witch";
  require_once "./functions/database_functions.php";
   // require_once "./template/hd.php";
  $conn = db_connect();
  $row = select4Latestlaptop($conn); 

  $query = "SELECT * FROM pubprice ORDER BY pubpriceid";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
 
  }
  if(mysqli_num_rows($result) == 0){
    echo "Empty publisher ! Something wrong! check again";
   
  }
?>

<div class="row">

  <nav id="navbar" class="navbar">

            <ul>

             
              <li class="dropdown"><a href="#" style="color:grey"><span>Chọn theo giá </span> <i class="bi bi-chevron-right"></i></a>
                <ul style="border-radius: 30px">
                           <?php 
    while($pubprice = mysqli_fetch_assoc($result)){
      $count = 0; 
      $query = "SELECT pubpriceid FROM laptops";
      $result3 = mysqli_query($conn, $query);
      if(!$result3){
        echo "Can't retrieve data " . mysqli_error($conn);
      
      }
      while ($pubInPrice = mysqli_fetch_assoc($result3)){
        if($pubInPrice['pubpriceid'] == $pubprice['pubpriceid']){
          $count++;
        }
      }
  ?>
                  <li><a href="laptopPerprice.php?puid=<?php echo $pubprice['pubpriceid']; ?>"><img class="img-responsive img-thumbnail1" style="width:150px"  src="./assets/img/<?php echo $pubprice['pubprice_img']; ?>" ></a></li>
                   <?php } ?>
                </ul>
              </li>
             
            </ul>
          </nav>
</div>
