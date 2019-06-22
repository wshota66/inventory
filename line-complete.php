<?php
require_once "config.php";
require_once "cid.php";
if(isset($_POST["searchterm"]) && !empty($_POST["searchterm"])){
	header("location: searched.php?searchterm=" . $_POST["searchterm"]);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

<style type="text/css">
table {
width: 100%;
        }
</style>

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item"><?php echo "<a href='list.php?cid=". $cid . "'>" . $identify_customername[$cid] . "</a>";?></li>
    <li class="breadcrumb-item active" aria-current="page">List: "Line Complete" & "Ship"</li>
  </ol>
</nav>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Inventory Details</h2>
                        <!--<a href="line-complete.php" class="btn btn-success pull-right">Show Line Complete & Shipped</a>-->
                    </div>
					<!--
					<div class="search-box">
					<input type="text" autocomplete="off" placeholder="Search by MAI PO#" />
					<div class="result"></div>
					-->
					<br>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM table1 WHERE C2='" . $identify_customerid[$cid] . "' AND C10=C15 OR C18='ship' AND C2='" . $identify_customerid[$cid] . "'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th>Index</th>";
                                        echo "<th>MAI PO#</th>";
                                        echo "<th>Line #</th>";
                                        echo "<th>P/N</th>";
                                        echo "<th>QTY Balance</th>";
                                        echo "<th>QTY Received</th>";
										echo "<th>Comment</th>";
										echo "<th>Action</th>";
										echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
										echo "<td>" . $row['C5'] . "</td>";
                                        echo "<td>" . $row['C6'] . "</td>";
                                        echo "<td>" . $row['C7'] . "</td>";
                                        echo "<td>" . $row['C10'] . "</td>";
										echo "<td>" . $row['C15'] . "</td>";
										echo "<td>" . "COO: " . $row['C16'] . ", HS CODE: " . $row['C17'] . "</td>"; 
                                        echo "<td>";
                                            echo "<a href='line-complete-update.php?cid=" . $cid . "&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-edit'></span></a>";
											echo "&nbsp;";
											echo "<a href='line-complete-ship.php?cid=" . $cid . "&id=". $row['id'] ."' title='Ship/View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-plane'></span></a>";
											echo "&nbsp;";
                                            echo "<a href='line-complete-delete.php?cid=" . $cid . "&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
										if ($row['C10'] == $row['C15'] && $row['C18'] != 'ship') {
										echo "<td>" . "Line Complete" . "</td>";	
										} else {
										echo "<td>" . $row['C18'] . "</td>";
										}
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($pdo);
					
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>