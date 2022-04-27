
<!DOCTYPE html>
<html>
<head><script>
function shs(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","teaentry.php?q="+str,true);
  xmlhttp.send();
</script>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = strval($_GET['q']);
$servername = "localhost";
$username = "root";
$password = "";
$dbname="sagafinancials";


$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

}

// Create database

$sql = "SELECT * FROM corporation WHERE country='".$q."'";

$result = $conn->query($sql);
echo '# results: '.$result->num_rows.'<br>';

echo "<table>
<tr>
<th>symbol</th>
<th>name</th>
<th>index</th>
<th>industry</th>
<th>country</th>
</tr>";
/*if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	echo "<tr>";
	echo "<td><a href="#" onclick="shs(this.value);return false;">".$row["symbol"]."</a></td>";
	echo "<td>".$row["name"]."</td>";
	echo "<td>".$row["stockindex"]."</td>";
	echo "<td>".$row["industry"]."</td>";
	echo "<td>".$row["country"]."</td>";
	echo "</tr><br>";
  }
} else {
  echo "0 results";*/

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td><a href='#' onclick='shs('".$row['symbol']."')'>" . $row['symbol'] . "</a></td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['stockindex'] . "</td>";
  echo "<td>" . $row['industry'] . "</td>";
  echo "<td>" . $row['country'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>
</body>
</html> 

