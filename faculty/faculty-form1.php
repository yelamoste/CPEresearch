<?php 
    session_start();
    if(isset($_SESSION['successSignup'])){
        $successSignup = $_SESSION['successSignup'];
        echo "<script type='text/javascript'>alert('$successSignup');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/faculty.css">
    <link href="../css/customize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" 
       integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Faculty Information Form</title>
</head>
<body class="body bg-ghostwhite">
    <!--Navigation Bar-->
    <?php include '../php/header.php'; ?>
    <!--Form-->
    <div class="container-fluid justify-content-center align-items-center">
        <div class="faculty-form position-absolute top-50 start-50 translate-middle border border-2 mt-4 p-4" style="width: 30rem;box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.15);border-radius: 0.5rem;">
            <div class="form-header">
                <h3>Faculty Information</h3>
            </div>
            <div class="divider mb-3" style="width: 26 rem;height: 0.20rem;border: 1rem; background-color:#2f2f2f; border-radius: 1rem;"></div>
            <form action="faculty-form1.php" method="POST" class="form-content">
                <div class="mb-3 text-secondary">
                    <small>Please fill up the form with your information.</small>
                </div>
                <div class="mb-3">
                    <label for="facultyName" class="labelFacultyForm mb-2">Name<span class="text-rejected">*</span></label>
                    <input type="name" class="form-control" name="facultyName" id="facultyName" placeholder="example: Juan Dela Cruz" required>
                </div>
                <div class="mb-3">
                    <label for="facultyDepartment" class="labelFacultyForm mb-2">Department<span class="text-rejected">*</span></label>
                    <select class="form-select" name="facultyDepartment" id="facultyDepartment" required>
                        <option selected disabled class="text-jet">Select one</option>
                        <option value="BSCPE" class="text-jet">Computer Engineering Department</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="labelFacultyForm mb-2" required>Role<span class="text-rejected">*</span></label>
                    <div class="form-check">
                        <label class="form-check-label" for="checkResearchAdviser">
                        <input class="form-check-input" type="checkbox" value="adviser" name="adviser[]" id="checkResearchAdviser">
                        Research Adviser</label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="checkapprovalCommittee">
                        <input class="form-check-input" type="checkbox" value="committee" name="committee[]" id="checkapprovalCommittee">
                        Approval Committee</label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="checkPanelist">
                        <input class="form-check-input" type="checkbox" value="panelist" name="panelist[]" id="checkPanelist">
                        Panelist</label>
                    </div>
                </div>
                <div class="form-button mt-5 text-end">
                    <button class="btn btn-ghostwhite border border-2 border-primary text-primary me-2" type="reset">Cancel</button>
                    <button class="btn btn-primary text-ghostwhite" type="submit" name="btnFacultyForm">Submit</button>
                </div>
            </form>
            <?php 
            session_start();
            include '../php/functions.php';
            $conn = db_connect();
            
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
                                $row = mysqli_fetch_array($result);
                                $_SESSION['userid'] = $row['facultyid'];
                                $_SESSION['username'] = $row['name'];
                                $_SESSION['role_adviser'] = $row['role_adviser'];
                                $_SESSION['role_committee'] = $row['role_committee'];
                                $_SESSION['role_panelist'] = $row['role_panelist'];
                                // header("Location:faculty-main.php");
                                redirect('faculty-main.php');
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
        </div>
    </div>
</body>
</html>
