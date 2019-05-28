<!DOCTYPE html>
<html>
<head>
	<title>Add new patient</title>

</head>
<body>
	
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
<input type="text" name="name" placeholder="Full Name">
<input type="text" name="age" placeholder="Age">
<input type="text" name="phone" placeholder="Phone Number">
<input type="submit" name="submit" value="submit">

</form>


</body>
</html>