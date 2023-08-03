<?php header('Content-Type: Application/json');
    require('./db.php');
    
    if(isset($_GET['ward'])) {
        $ward_id = $_GET['ward'];
        $query = "SELECT * FROM polling_unit WHERE ward_id='$ward_id'";
        $punitGet = mysqli_query($conn, $query);
        if(mysqli_num_rows($punitGet) == 0) {
            echo json_encode(['error' => 'no polling unit found']);
        } else {
            $returnValue;
            while ($returnValue[] = mysqli_fetch_assoc($punitGet));
            echo json_encode($returnValue);
        }
    }
    
?>