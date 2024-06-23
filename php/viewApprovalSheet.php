<?php
    session_start();
    if (isset($_SESSION)) {
        if (!empty($_GET['morid'])) {
            $proposalid = $_GET['morid'];
            $userid = $_SESSION['userid'];

            if ($_SESSION['adviserid'] == $userid) {
                $role = "Research Adviser";
                echo $role;

                include '../php/functions.php';
                $conn = db_connect();

                $sql = "SELECT * FROM response WHERE idmor_one = '$proposalid'"; 
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $role = $row["role"];
                }
            }
            
        }elseif (!empty($_GET['dp1id'])) {
            $proposalid = $_GET['dp1id'];
        }elseif (!empty($_GET['dp2id'])) {
            $proposalid = $_GET['dp2id'];
        }else {
            echo 'Error';
        }
    }

?>
