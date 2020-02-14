<?php //include('db_connnection.php');

function arrange_array($issues) {
	if (count($issues) == 1) {
		$res = $issues[0];
	} elseif (count($issues) == 2) {
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

function check_for_missing_data($row) {
	
	#echo 'Check missing data dump: '; 		# debug code ...
	#var_dump($row);						# debug code ...
	#echo ' Strlen: ' . strlen($row) . ' ';	# debug code ...
    if (empty($row)) {
		#echo ' Missing declared<br>';		# debug code ...
        return '<span class="missing-data">Missing data</span>';
    } else {
		echo 'Data found <br>';
		return $row;
    }
}

function complex_check ($row) {
	if (strlen($row) == 0) {
		$val = check_for_missing_data($row);
	} else {
		$val = explode(',', $row);
		$val = arrange_array($val);
	}
	return $val;
}

# generator function
function read_data(){
	$conn = OpenCon();

	try{
		echo 'generator function!';
	}	
	finally
	{
		$result -> free_result();
		CloseCon($conn);
		$generator->rewind();
	}
}

?>
