<?php include('db_connnection.php');


function arrange_issues($issues) {
	if (count($issues) == 2) {
		$res = $issues[0] . ' and ' . $issues[1];
	} else {
		$res = '';
		for ($i = 0; $i <= count($issues)-1; $i++) {
			if ($i == 0) {
				$res = $issues[$i];
			} else {
				$res = $res . ', ' . $issues[$i];
			}
		}	
	}
	return $res;
}

function read_data(){
	$conn = OpenCon();

	try{
	 	if ($result = $conn -> query('SELECT * FROM leads_table;')) {
	  		echo 'Returned rows are: ' . $result -> num_rows;
	  		while ($row = mysqli_fetch_assoc($result)) {
	  			
	  			if (empty($row["Technical Issues"])) {
	  				yield '<p>Website ' . $row["Website"] . ' has no technical issues' . '</p>';

	  			} else {

	  				$issues = explode(",", $row["Technical Issues"]);

	  				yield '<h4>Sent email to '. $row["Personal Email Address"] . '</h4><h3>Hello ' . $row["Company Name"] . ', </h3><p>We analyzed your website ' . $row["Website"] . ' and we noticed a few issues with it, such as ' . arrange_issues($issues) . '</p><br>';
				}
			}
		}
	}	
	finally
	{
		$result -> free_result();
		CloseCon($conn);
	}
}

$generator = read_data();
foreach ($generator as $value) {
    echo "$value\n";
}

?>
