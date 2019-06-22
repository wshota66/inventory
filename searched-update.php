<?php
require_once "config.php";
require_once "cid.php";
// Define variables and initialize with empty values
$quantity_received = $coo = $hscode = "";
$quantity_received_err = $coo_err = $hscode_err = "";
$searchedterm = $_GET["searchterm"];
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate Quantity Received
    $input_quantity_received = trim($_POST["quantityReceived"]);
    if(empty($input_quantity_received)){
        $quantity_received_err = "Please enter the Quantity Recieved amount.";     
    } elseif(!ctype_digit($input_quantity_received)){
        $quantity_received_err = "Please enter a positive integer value.";
    } else{
        $quantity_received = $input_quantity_received;
    }
    
    // Validate COO
    $input_coo = trim($_POST["coo"]);
	$coo = $input_coo;
	/*
    if(empty($input_coo)){
        $coo_err = "Please enter a Country of Origin.";     
    } else{
        $coo = $input_coo;
    }
    */
	
	// Validate HS CODE
    $input_hscode = trim($_POST["hscode"]);
	$hscode = $input_hscode;
	/*
    if(empty($input_hscode)){
        $hscode_err = "Please enter a HS CODE.";     
    } else{
        $hscode = $input_hscode;
    }
    */
	
    // Check input errors before inserting in database
    //if(empty($quantity_received_err_err) && empty($coo_err) && empty($hscode_err)){
	if(empty($quantity_received_err_err)){
        // Prepare an update statement
        $sql = "UPDATE table1 SET C15=:quantityReceived, C16=:coo, C17=:hscode WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":quantityReceived", $param_quantityReceived);
            $stmt->bindParam(":coo", $param_coo);
            $stmt->bindParam(":hscode", $param_hscode);
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_quantityReceived = $quantity_received;
            $param_coo = $coo;
            $param_hscode = $hscode;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                //header("location: searched.php?searchterm=" . $_GET['searchterm']);
				header("location: searched.php?cid=" . $cid . "&searchterm=" . $_GET['searchterm']);
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM table1 WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $quantity_received = $row["C15"];
                    $coo = $row["C16"];
                    $hscode = $row["C17"];
					$line = $row["C6"];
					$partnumber = $row["C7"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    //header("location: searched.php?searchterm=" . $_GET['searchterm']);
					header("location: searched.php?cid=" . $cid . "&searchterm=" . $_GET['searchterm']);
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
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
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item"><?php echo "<a href='list.php?cid=". $cid . "'>" . $identify_customername[$cid] . "</a>";?></li>
    <li class="breadcrumb-item active" aria-current="page">Search for: <span style="color:black"><?php echo $searchedterm;?></span></li>
	<li class="breadcrumb-item active" aria-current="page">Update record</li>
  </ol>
</nav>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
					<table class="table">
					<thead>
					<tr>
					<th scope="col">MAI PO#</th>
					<th scope="col">Line#</th>
					<th scope="col">Part#</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td><?php echo $_GET['searchterm'];?></td>
					<td><?php echo $line;?></td>
					<td><?php echo $partnumber; ?></td>
					</tbody>
					</table>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($quantity_received_err)) ? 'has-error' : ''; ?>">
                            <label>Quantity Received</label>
                            <input type="text" name="quantityReceived" class="form-control" value="<?php echo $quantity_received; ?>">
                            <span class="help-block"><?php echo $quantity_received_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($coo_err)) ? 'has-error' : ''; ?>">
                            <label>COO</label>
							<input type="text" name="coo" class="form-control" value="<?php echo $coo; ?>">
                    
                            <span class="help-block"><?php echo $coo_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($hscode_err)) ? 'has-error' : ''; ?>">
                            <label>HS CODE</label>
                            <input type="text" name="hscode" class="form-control" value="<?php echo $hscode; ?>">
                            <span class="help-block"><?php echo $hscode_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="<?php echo "searched.php?cid=" . $cid . "&searchterm=" . $_GET["searchterm"] ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>