
<?php

$usr ="root";
$pwd = "pass4student";
$host ="localhost";
$db = "calculator";

$conn = new mysqli($host, $usr, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT contributie , valoare,simbol FROM calculator";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "" . $row["contributie"]. " -" . $row["valoare"]. "" . $row["simbol"]."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>