<html>
<body>
<?php

echo "<p>SQL Commands:</p>";

require_once "../config.php";
require_once "randkey_foos.php";

$name = mysqli_real_escape_string($db, $_POST["name"]);
$email = mysqli_real_escape_string($db, $_POST["email"]);
$password = mysqli_real_escape_string($db, $_POST["password"]);
$customer_id = generateKey($db);

$sql = "INSERT INTO Customers VALUES ('$customer_id', '$name', '$email', '$password')";
echo "<p>$sql</p>";
mysqli_query($db, $sql) or die('Error querying database.');
echo "<h3>New record created successfully.</h3>";

if ($_POST["customer_type"] == "Regular") {
  $sql2 = "INSERT INTO Regulars VALUES ('$customer_id')";
  echo "<p>$sql2</p>";
  mysqli_query($db, $sql2) or die('Error querying database.');
  echo "<h3>New record created successfully.</h3>";
}
if ($_POST["customer_type"] == "Member") {
  $membership_id = generateKey($db);
  $sql2 = "INSERT INTO Members VALUES ('$customer_id', '$membership_id')";
  echo "<p>$sql2</p>";
  mysqli_query($db, $sql2) or die('Error querying database.');
  echo "<h3>New record created successfully.</h3>";
}

mysqli_close($db);
?>
</body>
</html>
