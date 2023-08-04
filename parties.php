<?php header('Content-Type: Application/json');
    require('./db.php');
    
    if(isset($_GET['all'])) {
        $query = "SELECT * FROM party ORDER BY partyname ASC ";
        $lgaGet = mysqli_query($conn, $query);
        if(mysqli_num_rows($lgaGet) == 0) {
            echo json_encode(['error' => 'no party']);
        } else {
            $returnValue;
            while ($returnValue[] = mysqli_fetch_assoc($lgaGet));
            echo json_encode($returnValue);
        }
    }