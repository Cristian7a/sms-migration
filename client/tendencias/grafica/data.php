<?php
header('Content-Type: application/json');
$con = mysqli_connect('localhost', 'sms','smseio2018','sms');


if (mysqli_connect_errno($con)) {
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
} else {
    $data_points = array();
    $result = mysqli_query($con, "SELECT * FROM TEN");
    while ($row = mysqli_fetch_array($result)) {
        $point = array("valorx" => $row['IDETEN'], "valory" => $row['INCTEN'], "valorp" => $row['NOMTEN']);
        array_push($data_points, $point);
    }
    echo json_encode($data_points);
}
mysqli_close($con);
?>
