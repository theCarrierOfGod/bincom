<?php header('Content-Type: Application/json');
    require('./db.php');
    
    if(isset($_GET['lga'])) {
        $lga_id = $_GET['lga'];
        $query = "SELECT * FROM ward WHERE lga_id='$lga_id'";
        $wardGet = mysqli_query($conn, $query);
        if(mysqli_num_rows($wardGet) == 0) {
            echo json_encode(['error' => 'no ward found']);
        } else {
            $returnValue;
            while ($returnValue[] = mysqli_fetch_assoc($wardGet));
            echo json_encode($returnValue);
        }
    }
    
?>