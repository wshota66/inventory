<?php
require_once "config.php";
require_once "cid.php";
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
	$sql = "UPDATE table1 SET C18='ship' WHERE id=:id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
		$param_id = trim($_POST["id"]);
		
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            //header("location: searched.php?searchterm=" . $_GET['searchterm']);
			header("location: searched.php?cid=" . $cid . "&searchterm=" . $_GET['searchterm']);
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        //header("location: searched.php?searchterm=" . $_GET['searchterm']);
		header("location: searched.php?cid=" . $cid . "&searchterm=" . $_GET['searchterm']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<!--
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../inventory.php">Home</a></li>
    <li class="breadcrumb-item"><a href="./list.php">YB Trading</a></li>
	<li class="breadcrumb-item active" aria-current="page">List</li>
    <li class="breadcrumb-item active" aria-current="page">Ship</li>
  </ol>
</nav>
-->
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Ship this Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="alert alert-info fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to ship this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-info">
								<a href="<?php echo "searched.php?cid=" . $cid . "&searchterm=" . $_GET["searchterm"] ?>" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>