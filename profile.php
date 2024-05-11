<?php
session_start(); //Use this for creating the session

// Include config file
require_once "database.php";

if($_SESSION['id'] == " ") {
    //header("Location: users.php");
    header("location: register.php");
}


$getSingleUser = "SELECT * FROM user  WHERE user_id='". $_GET['id']. "'";
$getWinks = "SELECT * FROM wink WHERE user2_id = '". $_GET['id']. "'";
$getAllOtherUsers = "SELECT * FROM user WHERE user_id != '".$_GET['id']."'";

$getSingleUser = "SELECT * FROM user  WHERE user_id='". $_GET['id']. "'";
$getMessages = "SELECT * FROM messageboxe WHERE user2_id = '". $_GET['id']. "'";
$getAllOtherUsers = "SELECT * FROM user WHERE user_id != '".$_GET['id']."'";



$result = $connection->query($getSingleUser);
while($row = $result->fetch_assoc()) {  ?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/jumbotron/">

    <title>Biye Korbo</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="homepage.php"><img src="images/logos.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">


            <form class="form-inline mt-2 mt-md-0 navbar-form navbar-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" >
<!--                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">-->
<!--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
                <a href="logout.php"><button type="button" id="formButton" class="btn btn-success">Sign Out</button></a>
                <a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><button type="button" id="formButton" class="btn btn-success">My Profile</button></a>
            </form>

            <!--<a href="logout.php" class="btn btn-outline-success my-2 my-sm-0">
                Sign Out</a>
            <a href="profile.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-outline-success my-2 my-sm-0">
                My profile</a>-->

        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="container">
    <div class="col-md-4"></div>
    <div class="col-md-4 view-user-bg">
        <div class="card mb-4 shadow-sm">
            <img src="images/<?php echo $row["picture"]; ?>">
            <div class="card-body">
                <h4><?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>
                    <a href="editName.php?id=<?php echo $row["user_id"]; ?>">Edit Name</a></h4>
                    

                    <h6><label>Email:</label>  <?php echo $row["email"]; ?></h6>
                    <h6><label>Nid:</label>  <?php echo $row["nid"]; ?></h6>
                    <h6><label>Contact Number:</label>  <?php echo $row["phonenumber"]; ?></h6>
                    <h6><label>City & State:</label>  <?php echo $row["city"] .', '.$row["state"];?> 
                        <a href="editcity&state.php?id=<?php echo $row["user_id"]; ?>">Edit City & State</a></h6>
               

<h6><label>Gender:</label>  <?php echo $row["gender"]; ?></h6>


<h6><label>Height:</label>  <?php echo $row["height"]; ?> </h6>
<h6><label>Weight:</label>  <?php echo $row["weight"]; ?></h6>
<h6><label>Body Type:</label>  <?php if($row["body"] === 'y')
                    {
                        echo "Slim";
                    }
                    else
                    {
                        echo "Fat";
                    }?></h6>

<h6><label>Blood Group:</label>  <?php echo $row["blood"]; ?></h6>
<h6><label>Religion:</label>  <?php echo $row["religion"]; ?></h6>
<h6><label>Education:</label>  <?php echo $row["education"]; ?></h6>
<h6><label>Occupation:</label>  <?php echo $row["occupation"]; ?></h6>
<h6><label>Date of Birth:</label>  <?php echo $row["date_of_birth"]; ?></h6>


            </div>
        </div>
        <div class="wink-box">
            <?php
            $winkCountResult = $connection->query($getWinks);
            $winkers = array();
            while ($row1 = $winkCountResult->fetch_assoc())
            {
                array_push($winkers,$row1['user_id']);
            }
            $winkerResult = $connection->query($getAllOtherUsers);
            while($row2  = $winkerResult->fetch_assoc())
            {
                foreach ($winkers as $value)
                {
                    if($row2['user_id'] == $value)
                    {

                        
                        echo $row2  ['first_name'] . ', User ID: ' .  $row2  ['user_id' ]  .  "  message request at you <br>";  
                        

                        
                        }}}?>      

                        
        </div>



    </div>
    <?php
}?>
    <div class="col-md-4"></div>
</div>
</div>




<?php
require_once('footer.php');
?>
</body>
</html>
