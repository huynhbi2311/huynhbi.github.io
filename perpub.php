 <?php  
  
  $count = 0;
  // connecto database
 
  $title = "Scarlet Witch";
  require_once "./functions/database_functions.php";
   // require_once "./template/hd.php";
  $conn = db_connect();
  $row = select4Latestlaptop($conn); 

  $query = "SELECT * FROM publisher ORDER BY publisherid";
  
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

             
              <li class="dropdown"><a href="#" style="color:grey"><span>Chọn theo Nhãn Hàng </span> <i class="bi bi-chevron-right"></i></a>
                <ul style="border-radius: 20px">
                           <?php 
    while($pub = mysqli_fetch_assoc($result)){
      $count = 0; 
      $query = "SELECT publisherid FROM laptops";
      $result2 = mysqli_query($conn, $query);
      if(!$result2){
        echo "Can't retrieve data " . mysqli_error($conn);
     
      }
      while ($pubInBook = mysqli_fetch_assoc($result2)){
        if($pubInBook['publisherid'] == $pub['publisherid']){
          $count++;
        }
      }
  ?>
                  <li><a href="laptopPerPub.php?pubid=<?php echo $pub['publisherid']; ?>"><img class="img-responsive img-thumbnail1" style="width:150px"  src="./assets/img/<?php echo $pub['publisher_img']; ?>" ></a></li>
                   <?php } ?>
                </ul>
              </li>
             
            </ul>
          </nav>
</div>
