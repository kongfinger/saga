
<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>

<?php

function array2string($data){
    $log_a = "";
    foreach ($data as $key => $value) {
        if(is_array($value))    $log_a .= "<br>".$key." => ". array2string($value). " \n";
        else                    $log_a .= "<br>".$key." => ".$value."\n";
    }
    return $log_a;
}
$q = strval($_GET['fn']);
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
echo $q;
$sql = "SELECT * FROM jsonincomequarterly WHERE symbol='".$q."'";
$sql2="SELECT * FROM corporation WHERE symbol='".$q."'";
$result = $conn->query($sql);
$result2=$conn->query($sql2);
echo ' # results: '.$result->num_rows.'<br>';
echo " # results coporate: ".$result2->num_rows.'<br>';
//echo "<table><tr><td>";

while( $ro = mysqli_fetch_array($result2)){
echo "<br>".$ro["symbol"]."<br>";
echo $ro["name"]."<br>";
echo $ro["stockindex"]."<br>";
echo $ro["industry"]."<br>";
echo $ro["country"]."<br>";
//echo "</";
}
echo "<table><tr>";
while($row = mysqli_fetch_array($result)) {

		echo "<td>".$row["symbol"]."<br>";
$r=$row["date"];
echo $r."<br>";
$a = json_decode($row["jsonincomeentry"],true);
echo array2string($a)."</td>";
}
echo "</tr>";



echo "</table>";
mysqli_close($conn);
?>
</body>
</html> 

