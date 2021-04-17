<?php
    session_start();
    require_once "../functions/admin.php";
    $title = "Add new Laptop";
    // require "./template/header.php";
    require "../functions/database_functions.php";
    $conn = db_connect();

    if(isset($_POST['add'])){
        $isbn = trim($_POST['isbn']);
        $isbn = mysqli_real_escape_string($conn, $isbn);
        
        $title = trim($_POST['title']);
        $title = mysqli_real_escape_string($conn, $title);

        $ram = trim($_POST['ram']);
        $ram = mysqli_real_escape_string($conn, $ram);

        $size = trim($_POST['size']);
        $size = mysqli_real_escape_string($conn, $size);

        $cpu = trim($_POST['cpu']);
        $cpu = mysqli_real_escape_string($conn, $cpu);

        $ocung = trim($_POST['ocung']);
        $ocung = mysqli_real_escape_string($conn, $ocung);

        $year = trim($_POST['year']);
        $year = mysqli_real_escape_string($conn, $year);

        $author = trim($_POST['author']);
        $author = mysqli_real_escape_string($conn, $author);
        
        $descr = trim($_POST['descr']);
        $descr = mysqli_real_escape_string($conn, $descr);
        
        $price = floatval(trim($_POST['price']));
        $price = mysqli_real_escape_string($conn, $price);

        $khuyenmai = floatval(trim($_POST['khuyenmai']));
        $khuyenmai = mysqli_real_escape_string($conn, $khuyenmai);
        
        $publisher = trim($_POST['publisher']);
        $publisher = mysqli_real_escape_string($conn, $publisher);

        $quantity = floatval($_POST['quantity']);
        $quantity = mysqli_real_escape_string($conn, $quantity);

        $pubprice = trim($_POST['pubprice']);
        $pubprice = mysqli_real_escape_string($conn, $pubprice);

        // add image
        if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
            $image = $_FILES['image']['name'];
            $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
            $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
            $uploadDirectory .= $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
        }

        // find publisher and return pubid
        // if publisher is not in db, create new
        $findPub = "SELECT * FROM publisher WHERE publisher_name = '$publisher'";
        $findResult = mysqli_query($conn, $findPub);
        if(!$findResult){
            // insert into publisher table and return id
            $insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$publisher')";
            $insertResult = mysqli_query($conn, $insertPub);
            if(!$insertResult){
                echo "Can't add new publisher " . mysqli_error($conn);
                exit;
            }
            $publisherid = mysql_insert_id($conn);
        } else {
            $row = mysqli_fetch_assoc($findResult);
            $publisherid = $row['publisherid'];
        }
        $findPrice = "SELECT * FROM pubprice WHERE pubpriceid = '$pubprice'";
        $findResult = mysqli_query($conn, $findPrice);
        if(!$findResult){
            // insert into publisher table and return id
            $insertPubprice = "INSERT INTO pubprice(pubpriceid) VALUES ('$pubprice')";
            $insertResult = mysqli_query($conn, $insertPubprice);
            if(!$insertResult){
                echo "Can't add new publisher " . mysqli_error($conn);
                exit;
            }
            $pubpriceid = mysql_insert_id($conn);
        } else {
            $row = mysqli_fetch_assoc($findResult);
            $pubpriceid = $row['pubpriceid'];
        }


        $query = "INSERT INTO laptops VALUES ('" . $isbn . "', '" . $title . "', '" . $author . "', '" . $image . "', '" . $descr . "', '" . $publisherid . "', '" . $ram . "', '" . $size . "', '" . $cpu . "', '" . $ocung . "', '" . $year . "', '" . $price . "', '" . $khuyenmai . "', '" . $quantity . "', '" . $pubpriceid . "')";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "Can't add new data " . mysqli_error($conn);
            exit;
        } else {header("Location: ./admin_laptop.php");
        }
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
        <script type="text/javascript" src="../template/ckeditor/ckeditor.js"></script>

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="./admin_laptop.php"><i class="menu-icon fa fa-laptop"></i>Quản Lý Sản Phẩm </a>
                    </li>
                    <li class="menu-title">UI elements</li><!-- /.menu-title -->
                    <li class="active">
                        <a href="#"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Add new laptops</a>
                       
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Quản lý giỏ hàng</a>
                       
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Quản lý khách hàng</a>
                       
                    </li>

                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="https://lh3.googleusercontent.com/a-/AOh14Gi1ueWbioC1wuPGyCqwx2LW3ftNBOQZ7X22Wtq9Cg=s96-c" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="../admin_signout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
           
                <!--  Traffic  -->
                
                <!--  /Traffic -->
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders" >
                    <div class="row" >
                        <div class="col-xl-8">
                            <div class="card" style="width: 1000px">
                                <div class="card-body">
                                    <h4 class="box-title">Add new laptops</h4>
                                </div>
                               
    <form method="post" action="admin_add.php" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <th>Mã Sản Phẩm</th>
                <td><input type="text" name="isbn"></td>
            </tr>
            <tr>
                <th>Tên Sản Phẩm</th>
                <td><input type="text" name="title" required></td>
            </tr>
            <tr>
                <th>Drive</th>
                <td><input type="text" name="author" required></td>
            </tr>
            <tr>
                <th>Ram</th>
                <td><input type="text" name="ram" required></td>
            </tr>
            <tr>
                <th>Size</th>
                <td><input type="text" name="size" required></td>
            </tr>
            <tr>
                <th>CPU</th>
                <td><input type="text" name="cpu" required></td>
            </tr>
            <tr>
                <th>Ổ Cứng</th>
                <td><input type="text" name="ocung" required></td>
            </tr>
            <tr>
                <th>Năm Phát Hành</th>
                <td><input type="text" name="year" required></td>
            </tr>
            <tr>
                <th>Image</th>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <th>Nội Dung</th>
                <td><textarea name="descr" rows="5" cols="150"></textarea></td>
                <!-- <td><textarea name="descr" cols="40" rows="5"></textarea></td> -->
            </tr>
            <tr>
                <th>Price</th>
                <td><input type="text" name="price" required></td>
            </tr>
            <tr>
                <th>Giá khuyến mãi</th>
                <td><input type="text" name="khuyenmai" required></td>
            </tr>
            <tr>
                <th>Số Lượng Trong Kho</th>
                <td><input type="text" name="quantity" required></td>
            </tr>
            <tr>
                <th>Publisher</th>
                <td>
                    <input list="publisher" name="publisher" required>
<datalist id="publisher">
<option value="Apple">
<option value="Asus">
<option value="HP">
<option value="Dell">
<option value="Lenovo">
<option value="Aser">
</datalist>
</td>
            </tr>
            <tr>
                <th>Pubprice</th>
                <td><input type="text" name="pubprice" required></td>
            </tr>
        </table>
        <input type="submit" name="add" value="Add new Laptop" class="btn btn-primary">
        <input type="reset" value="cancel" class="btn btn-default">
    </form>
      <script>
    // Thay thế <textarea id="post_content"> với CKEditor
    CKEDITOR.replace( 'descr' );// tham số là biến name của textarea
</script>
                                   
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->

                        <!-- /.col-md-4 -->
                    </div>
                </div>
                <!-- /.orders -->
               
             
            <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 Ela Admin
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
      
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                  series: [
                  [0, 18000, 35000,  25000,  22000,  0],
                  [0, 33000, 15000,  20000,  15000,  300],
                  [0, 15000, 28000,  15000,  30000,  5000]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                        datasets: [
                        {
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>
    <?php
    if(isset($conn)) {mysqli_close($conn);}
   
?>
</body>
</html>
