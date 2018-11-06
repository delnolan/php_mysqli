<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "openshift_php";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Table doesn't exist so create it
$create_table = "CREATE TABLE openshift_table (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
reg_date TIMESTAMP
)";

if ($conn->query($create_table) === TRUE) {
echo "Table openshift_table created successfully";

} else {
	// Table exists so add an entry
	$insert_row = "INSERT INTO openshift_table(reg_date) VALUES (CURRENT_TIMESTAMP())";
	if ($conn->query($insert_row) === TRUE) {
		echo "Inserted a row.<br/>";
	} else {
		echo $conn->error;
	}
	
	// And count all the entries
	$count_entries = "SELECT id FROM openshift_table";
	if ($result=mysqli_query($conn,$count_entries)){
		// Return the number of rows in result set
		$rowcount=mysqli_num_rows($result);
		
		echo "There are " . $rowcount . " entries.";
		// Free result set
		mysqli_free_result($result);
	}
}
	


mysqli_close($conn);
?>