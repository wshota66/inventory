<?php
require_once "config.php";
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Inventory</title>
</head>
<body>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Inventory</li>
  </ol>
</nav>
<div class="container">
<div class="row float-right">
	<div>
	<a href="data-remove.php" class="btn btn-secondary float-right">Remove Duplicates</a>
	<a href="data-update.php" class="btn btn-dark float-right">Update Data</a>
	</div>
</div>
<div class="row">
<main role="main">
<h2>Customers</h2>
<ul class="list-group list-group-flush">

<li class="list-group-item"><?php echo "<a href='list.php?cid=". "1" . "'>";?>Korean Air</a></li>
<li class="list-group-item"><?php echo "<a href='list.php?cid=". "2" . "'>";?>OK Trading</a></li>
<li class="list-group-item"><?php echo "<a href='list.php?cid=". "3" . "'>";?>YB Trading</a></li>
<li class="list-group-item"><?php echo "<a href='list.php?cid=". "4" . "'>";?>Bridgetron</a></li>
<li class="list-group-item"><?php echo "<a href='list.php?cid=". "5" . "'>";?>Aviall Airstocks</a></li>
<li class="list-group-item"><?php echo "<a href='list.php?cid=". "6" . "'>";?>Aerotech</a></li>
</ul>
</main>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>