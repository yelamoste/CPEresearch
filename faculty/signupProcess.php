<?php
session_start();
include '../php/functions.php';
$conn = db_connect();

if($conn){
    echo "Connected!";
}

if(isset($_SESSION["facultywebmail"])){
    if(isset($_POST['btnFacultyForm'])){
        if((isset($_POST['facultyName']) && isset($_POST['facultyDepartment'])) && (isset($_POST['adviser']) || isset($_POST['committee']) || isset($_POST['panelist']))){
            $facultyEmail = $_SESSION['facultywebmail'];
            $facultyName = $_POST['facultyName'];

            if(!empty($_POST['adviser'])){
                $facultyAdviser = 'YES';
            }else{
                $facultyAdviser = 'NO';
            }
            if(!empty($_POST['committee'])){
                $facultyCommittee = 'YES';
            }else{
                $facultyCommittee = 'NO';
            }
            if(!empty($_POST['panelist'])){
                $facultyPanelist = 'YES';
            }else{
                $facultyPanelist = 'NO';
            }

            $facultyDepartment = $_POST['facultyDepartment'];
            

            $query = "UPDATE faculty SET name = '$facultyName', department = '$facultyDepartment', role_adviser = '$facultyAdviser',
            role_committee = '$facultyCommittee', role_panelist = '$facultyPanelist' WHERE webmail = '$facultyEmail'";
            if (mysqli_query($conn, $query)) {
                // $_SESSION['successmsg'] = "Welcome! ".$facultyName." ";
                //$_SESSION['facultywebmail'] = $facultyEmail;
                $sql = "SELECT facultyid FROM faculty WHERE webmail = '$facultyEmail'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if($result->num_rows > 0){
                    header("Location:faculty-main.php");
                    $row = mysqli_fetch_array($result);
                    $_SESSION['userid'] = $row['facultyid'];
                    $_SESSION['username'] = $row['name'];
                    $_SESSION['role_adviser'] = $row['role_adviser'];
                    $_SESSION['role_committee'] = $row['role_committee'];
                    $_SESSION['role_panelist'] = $row['role_panelist'];
                }else{
                    $errmessage = "Something went wrong. Try again.";
                    echo $errmessage;
                }
                
            }else {
                echo "Error updating record: " . mysqli_error($conn);
            }

            // header('location:../faculty/faculty-form1.php');
            // $successmsg = "Success!";
            // echo "<script type='text/javascript'>alert('$successmsg');</script>";

            //$query = 'INSERT INTO faculty (name, ) VALUES ( ?, ?)';
        }
    }else{
        header('location:faculty-form1.php');
        $errmessage = "Something went wrong with the form. Try again.";
        // echo "<script type='text/javascript'>alert('$errmessage');</script>";
    }
}else{
    header('location:faculty-form1.php');
        $errmessage = "Something went wrong.";
        echo $errmessage;
        // echo "<script type='text/javascript'>alert('$errmessage');</script>";
}
?>