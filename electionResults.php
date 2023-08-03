<?php header('Content-Type: Application/json');
    require('./db.php');
    
    if(isset($_GET['pollingUnit'])) {
        $pollingUnit = $_GET['pollingUnit'];
        $query = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid='$pollingUnit'";
        $punitGet = mysqli_query($conn, $query);
        if(mysqli_num_rows($punitGet) == 0) {
            echo json_encode(['error' => 'no result']);
        } else {
            $returnValue;
            while ($returnValue[] = mysqli_fetch_assoc($punitGet));
            echo json_encode($returnValue);
        }
    }
    
?>