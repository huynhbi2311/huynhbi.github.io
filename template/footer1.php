      	<hr>

      	<footer>
          

        	<div class="text-muted pull-left" style="float: left;">
              
              <?php
require_once ('logingg.php');
 require_once "./functions/database_functions.php";
  
// Nếu kết nối thành công, sau đó xử lý thông tin và lưu vào database
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    $user = $service->userinfo->get(); //get user info 
    // connect to database
    $mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_error .') '. $mysqli->connect_error);
    }
 
    //Kiểm tra xem nếu user này đã tồn tại, sau đó nên login tự động
    $result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
    $user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist
 

 
    if($user_count) // Nếu user tồn tại thì show thông tin hiện có
    {
        echo 'Welcome back '.$user->name.'! [<a href="index.php">tiếp tục vào trang chủ</a>]';
    }
    else //Ngược lại tạo mới 1 user vào database
    { 
        echo 'Hi '.$user->name.', Thanks for Registering![<a href="index.php">Log Out</a>]';
        $statement = $mysqli->prepare("INSERT INTO google_users (google_id, google_name, google_email,  google_picture_link) VALUES (?,?,?,?)");
        $statement->bind_param('isss', $user->id,  $user->name, $user->email, $user->picture);
        $statement->execute();
        echo $mysqli->error;
    }
        //show user picture
    echo '<img src="'.$user->picture.'" style="border-radius:30px; width:20px;" align="left" />';
    exit;
}
 
//Nếu sẵn sàng kết nối, sau đó lưu session với tên access_token
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else { // Ngược lại tạo 1 link để login
    $authUrl = $client->createAuthUrl();
}
 

?>
      	</div>
        	<div class="text-muted pull-right" style="float: right">
          		<a href="admin.php">Admin Login</a> |||
              <a href="login.php">User Login</a> 2021
        	</div>

      	</footer>

    </div>
    <!-- Footer -->
<!-- Footer -->
  </body>
</html>