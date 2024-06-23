<?php 

    session_start();

    include '../php/functions.php';
    $conn = db_connect();
    
    //TO FIX: the get method URL should be encrypted

    if(isset($_GET['userid']) && isset($_GET['username']) && isset($_POST['viewProposal'])){

        $userid = $_GET['userid'];
        $username = $_GET['username'];
        $proposalid = $_POST['viewProposal'];

        $query = "SELECT * FROM mor_one WHERE idmor_one = '$proposalid' AND (adviser_response = 'approved' OR adviser_response = 'rejected')";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION['proposalid'] = $proposalid;
                $_SESSION['title'] = $row['title'];
                $_SESSION['group_member'] = $row['group_member'];
                $_SESSION['username'] = $_GET['username'];
                $_SESSION['course_section'] = $row['course'].' '.$row['year_section'];
                $_SESSION['group_num'] = $row['group_num'];
                $_SESSION['filename'] = $row['filename'];
                $_SESSION['filepath'] = $row['filepath'];
                $_SESSION['subject'] = "Methods of Research";
                $_SESSION['adviser_response'] = $row['adviser_response'];
                $_SESSION['student'] = $row['student'];
                $_SESSION['adviserid'] = $row['adviser'];
                header('Location: ../faculty/faculty-mor-researchadviser1.php');
                redirect('../faculty/faculty-mor-researchadviser1.php');

        }else{
            // Redirect to 6.1 page
            $query = "SELECT * FROM mor_one WHERE idmor_one = '$proposalid' AND adviser_response IS NULL";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION['proposalid'] = $proposalid;
                $_SESSION['title'] = $row['title'];
                $_SESSION['group_member'] = $row['group_member'];
                $_SESSION['username'] = $_GET['username'];
                $_SESSION['course_section'] = $row['course'].' '.$row['year_section'];
                $_SESSION['group_num'] = $row['group_num'];
                $_SESSION['filename'] = $row['filename'];
                $_SESSION['filepath'] = $row['filepath'];
                $_SESSION['subject'] = "Methods of Research";
                $_SESSION['student'] = $row['student'];
                $_SESSION['adviserid'] = $row['adviser'];
                header('Location: ../faculty/faculty-mor-researchadviser.php');
                redirect('../faculty/faculty-mor-researchadviser.php');

            }else{
                
            }
            
        }
    }
?>