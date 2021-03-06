<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet/less" type="text/css" href="style.less">
    <script src="less.js" type="text/javascript" defer></script>
    <script src="js/java.js" type="text/javascript" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Shirts</title>
</head>
<body>
    <!-- Database connection!-->
    <?php
        //FOR TWIG
        require_once './vendor/autoload.php';
     
        $loader = new Twig_Loader_Filesystem('./templates');
        $twig = new Twig_Environment($loader);
        $headerTemp = $twig->load('header.html');
        $contentTemp = $twig->load('tableF.html');
        $footerTemp = $twig->load('footer.html');
        
        //FOR DATABASE
        $servername = "localhost"; //localhost
        $username = "TonyHawk";
        $password = "SkateBoard";
        $database = "atropos";
        $shirts = array();
        
        // -----------------------------------------FOR TABLE-----------------------------------------
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
    
         // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    
        //call procedure1
        if (!$conn->multi_query("CALL getShorts()")) {
            echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $result =$conn->store_result();
         //PRINT RESULT
        if (mysqli_num_rows($result) > 0) {
        //output data of each row
            while($row = mysqli_fetch_array($result)) {
              $shirts[] = $row;
            }
        }        
        // close connection
        $conn->close();
    ?>
    <div class="wrapper"> 
            <!--Header template!-->
        <?php
            echo $headerTemp->render(array(
            ));
        ?>
            <!--content template-->
        <?php
            echo $contentTemp->render(array(
                "contArr" => $shirts,
                "subtitle" => "Shirts"
            ));
        ?>
            <!--footer template-->
        <?php
            echo $footerTemp->render(array(
            ));
        ?>
        
    </div><!-- End of Wrapper!-->
</body>
