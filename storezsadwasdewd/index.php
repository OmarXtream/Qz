<?php 
die("!");
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Buy Stuff</title>
</head>

<body>
  <br/><br/><br/><br/>
  <center>
  <form method="post" action="checkout">
	<input type="text" name="item" id="item" placeholder="Item Name Here ..." /><br/><br/>
	<input type="number" name="price" id="price" placeholder="Enter Price Here..$" /><br/><br/>
	<button type="submit" name="submit">pay</button>
  </form>
  </center>
  
</body>
</html>