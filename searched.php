<?php
require_once "config.php";
require_once "cid.php";
$searchedterm = $_GET["searchterm"];
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
    <li class="breadcrumb-item active" aria-current="page">Search for: <span style="color:black"><?php echo $searchedterm;?></span></li>
  </ol>
</nav>
<?php
                    $sql = "SELECT * FROM table1 WHERE C5 LIKE :searchterm AND C10 !=0";
					$stmt = $pdo->prepare($sql);
					$searchterm = $_GET["searchterm"] . '%';
					// bind parameters to statement
					$stmt->bindParam(":searchterm", $searchterm);
					// execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
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
                                while($row = $stmt->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
										echo "<td>" . $row['C5'] . "</td>";
                                        echo "<td>" . $row['C6'] . "</td>";
                                        echo "<td>" . $row['C7'] . "</td>";
                                        echo "<td>" . $row['C10'] . "</td>";
										echo "<td>" . $row['C15'] . "</td>";
										echo "<td>" . "COO: " . $row['C16'] . ", HS CODE: " . $row['C17'] . "</td>"; 
                                        echo "<td>";
                                            echo "<a href='searched-update.php?cid=" . $cid . "&id=" . $row['id'] . "&searchterm=" . $searchedterm . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-edit'></span></a>";
											echo "&nbsp;";
											echo "<a href='searched-ship.php?cid=" . $cid . "&id=". $row['id'] . "&searchterm=" . $searchedterm ."' title='Ship/View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-plane'></span></a>";
											echo "&nbsp;";
                                            echo "<a href='searched-delete.php?cid=" . $cid . "&id=". $row['id'] . "&searchterm=" . $searchedterm ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
										if ($row['C10'] == $row['C15'] && $row['C18'] != 'shipped') {
										echo "<td>" . "Line Complete" . "</td>";	
										} else {
										echo "<td>" . $row['C18'] . "</td>";
										}
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($stmt);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        } 
                    
                    // Close connection
                    unset($pdo);
					
?>

</body>
</html>