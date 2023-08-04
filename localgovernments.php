<?php header('Content-Type: Application/json');
    require('./db.php');
    
    if(isset($_GET['all'])) {
        $query = "SELECT * FROM lga WHERE state_id='25'";
        $lgaGet = mysqli_query($conn, $query);
        if(mysqli_num_rows($lgaGet) == 0) {
            echo json_encode(['error' => 'no local government area found']);
        } else {
            $returnValue;
            while ($returnValue[] = mysqli_fetch_assoc($lgaGet));
            echo json_encode($returnValue);
        }
    }
    
    if(isset($_GET['votes'])) {
        $lga = $_GET['votes'];
        
        $query = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid IN (SELECT uniqueid FROM polling_unit WHERE lga_id='$lga')";
        
        $lgaGet = mysqli_query($conn, $query);
        if(mysqli_num_rows($lgaGet) != 0) {
            $returnValue;
            while ($returnValue[] = mysqli_fetch_assoc($lgaGet));
            echo json_encode($returnValue);
        } else {
            echo json_encode(['error' => 'no result found']);
        }
        
    }
    
?>