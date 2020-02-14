<html>
<head>

<?php
echo '<link rel="stylesheet" type="text/css" href="style.css">';
?>
	
</head>
<body>

<?php 
//include('./includes/read_data.php'); 
 /*
$generator = read_data();
foreach ($generator as $value) {
    echo "$value\n";
}
$generator->rewind();
*/
include('./includes/db_connnection.php');
include('read_data.php');

$conn = OpenCon();
if ($result = $conn -> query('SELECT * FROM leads_table;')) {
    echo '<div class="info-bar">Number of returned rows: <span class=accent>' . $result -> num_rows . '</span></div>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="email-container">';
        if (empty($row["Technical Issues"])) {
            echo '<div class="no-issues"><p>Website ' . $row["Website"] . ' has no technical issues' . '</p></div>';
        
        } else {

            $name = check_for_missing_data($row["First Name"]);
            $company = check_for_missing_data($row["Company Name"]);
            
            $job = complex_check($row["Job Title"]);
            $issues = complex_check($row["Technical Issues"]);
            $all_issues = complex_check($row["All Issues"]);
            $email = complex_check($row["Personal Email Address"]);
            $gmail = complex_check($row["Generic Company Email Address"]);
            $omail = complex_check($row["Other Company Email Address"]);
            
            echo '<div class="email-info">Name: '. $name . '<br>Job Title: ' . $job . '<br>Company name: ' . $company . '</div>';
            echo '<div class="emails">Personal email: ' . $email . '<br>Company email: ' . $gmail . '<br>Other company email: ' . $omail . '</div>';
            echo '<div class="all-issues">All issues: ' . $all_issues . '</div>';
            echo '<div class="email-content"><h3>Hello ' . $company . ', </h3><p>We analyzed your website ' . $row["Website"] . ' and we noticed a few issues with it, such as ' . $issues . '</p></div>';
            
        }
        echo '</div>';
    }
}

CloseCon($conn);
?>

</body>
</html>