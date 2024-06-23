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
    <title>Faculty - Main</title>
</head>
<?php 
    session_start();
    include '../php/functions.php';
    $conn = db_connect();

    if (isset($_POST['btnSignin'])) {
    $facultyEmail = $_POST['facultySigninEmail'];
    $facultyPassword = $_POST['facultySigninPass'];

    $sql = "SELECT * FROM faculty WHERE webmail = '$facultyEmail'";
    $result = mysqli_query($conn, $sql);
    $countRow = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($countRow) {
        if (password_verify($facultyPassword, $countRow["password"])) {
            $userid = $_SESSION['userid'] = $countRow['facultyid'];
            $username =  $_SESSION['username'] = $countRow['name'];
            $_SESSION['role_adviser'] = $countRow['role_adviser'];
            $_SESSION['role_committee'] = $countRow['role_committee'];
            $_SESSION['role_panelist'] = $countRow['role_panelist'];
?>
<body class="bg-ghostwhite" style="overflow-y: hidden;overflow-x: hidden;">
    <!-- include the navigation bar -->
    <?php include '../php/header.php'; ?>

    <div class="container-fluid" style="overflow-y: hidden;">
        <div class="header-text display-5 ms-5 mt-4 mb-3">
            <h4 style="font-weight: 700;">Overview</h4>
        </div>

        <div class="row justify-content-center align-items-center g-2">
            <div class="col-7">
                <div class="search-bar ms-5" style="margin-right: 2.1rem;" style="width:100%;">
                    <form action="../php/mainsearch.php" method="post">
                        <div class="row">
                            <div class="col ps-2 pe-0 mb-3">
                                <input type="text" class="search-input form-control form-control-sm rounded-end-0 bg-ghostwhite border border-gray400 border-2 d-grid" name="" id="" aria-describedby="helpId" placeholder="Search here"/>
                            </div>
                            <div class="col-auto px-0">
                                <button type="submit" class="btn btn-sm btn-primary h6 text-ghostwhite rounded-start-0 border border-2 border-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="proposal-table ms-5" style="width:100%;">
                    <div class=" mt-1 ps-2 py-1">
                        <h6 style="font-weight: 600;">Title Proposals</h6>
                    </div>
                    <div class="list-filter d-flex px-0">
                        <form action="" class="d-flex">
                        <div class="select-course">
                            <select class="form-select form-select-sm bg-ghostwhite rounded-0 border-0 text-jet border-end border-3 border-primary" name="selectCourse" id="selectCourse">
                                <option selected>Course</option>
                                <option value="BSCOE">BSCOE</option>
                            </select>
                        </div>
                        <div class="select-yearsection">
                            <select class="form-select form-select-sm bg-ghostwhite rounded-0 border-0 text-jet border-end border-3 border-primary" name="selectYearSection" id="selectYearSection">
                                <option selected>Year-Section</option>
                                <option value="3-1">3-1</option>
                                <option value="3-2">3-2</option>
                                <option value="3-3">3-3</option>
                                <option value="3-4">3-4</option>
                                <option value="3-5">3-5</option>
                                <option value="4-1">4-1</option>
                                <option value="4-2">4-2</option>
                                <option value="4-3">4-3</option>
                                <option value="4-4">4-4</option>
                                <option value="4-5">4-5</option>
                            </select>
                        </div>
                        <div class="select-group">
                            <select class="form-select form-select-sm bg-ghostwhite rounded-0 border-0 text-jet border-end border-3 border-primary" name="selectGroup" id="selectGroup">
                                <option selected>Group</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="select-apply ms-3 mb-2">
                            <button class="btn btn-sm btn-ghostwhite text-primary border-bottom" type="submit">Apply</button>
                        </div>
                        </form>
                    </div>
                </div>
                <form action="viewmorProposal.php?userid=<?php echo $_SESSION['userid'];?>&username=<?php echo $_SESSION['username'];?>" method="POST">
                    <div class="proposal-list ms-5 me-2 mt-2 d-grid" style="height:58vh;overflow-y:auto;scrollbar-width: none;">
                        
                        <?php
                            // need to change codes for mor two and mor three
                            if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
                                $userid = $_SESSION['userid'];
                                $_SESSION['username'];
                                $subject = "Methods of Research";
                        
                                $sql = "SELECT * FROM mor_one WHERE adviser = '$userid'";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($result);

                                if($count > 0){
                                while ($count = $result->fetch_assoc()) {
                        ?>
                        <button class="proposal-btn btn m-0 mb-2 ps-2 border-start border-primary border-3 rounded-0 h-auto" type="submit" id="viewProposal" name="viewProposal" value = "<?php echo $count['idmor_one']; ?>" style="box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
                            <div class="">
                                <h6 class="text-break text-start" style="font-weight: 600;"><?php echo $count['title'];?></h6>
                            </div>
                            <div class="sub-title d-flex">
                                <p class="pe-2 mb-0 text-secondary"><?php echo $count['course'].'-'.$count['year_section']; ?><span class="vl"> |</span></p>
                                <p class="pe-2 mb-0 text-secondary">Group <?php echo $count['group_num']; ?><span class="vl"> |</span></p>
                                <p class="pe-2 mb-0 text-secondary"><?php echo $subject; ?></p>
                            </div>
                            <div class="sub-title d-flex">
                                <p class="mb-0 text-secondary">Research Adviser: </p>
                                <p class="mb-0 ms-1 text-secondary"><?php echo $_SESSION['username']; ?></p>
                            </div>
                        </button>
                        <?php       }
                                }else{ 
                        ?>
                                        <div class="proposal m-0 mb-3 ps-2" style="height: 10rem;">
                                            <h6 class="text-break text-start text-primary" style="font-weight: 600;"><?php echo "No proposal.";?></h6>
                                        </div>
                        <?php 
                                }
                                
                            }else{
                        ?>
                                <div class="proposal m-0 mb-3 ps-2" style="height: 10rem;">
                                    <h6 class="text-break text-start text-primary" style="font-weight: 600;"><?php echo "Something went wrong.";?></h6>
                                </div>
                        <?php 
                            }
                        ?>
                    </div>
                </form>
            </div>

            <div class="col-auto me-5">
                <div class="notif border border-2 border-gray200 rounded-1 p-2">
                    <div class="notif-header border-bottom">
                        <h6 style="font-weight: 600;color: #DC8116;">Notification</h>
                    </div>
                    <div class="notif-list">
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>
                        <div class="notif-card border-bottom">
                            <div class="notif-card-header d-flex p-2 mb-0">
                                <h6 class="pe-2 mb-0 text-secondary">Maria Hiwaga Sasagorl</h6>
                                <h6 class="mb-0 text-secondary">left a comment.</h6>
                            </div>
                            <div class="notif-card-subheader p-2 mb-0">
                                <small class="form-text text-muted">1 day ago</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
                    
            <?php        
                }else{
                    $errmessage = "Password does not match.";
                    echo "<script type='text/javascript'>alert('$errmessage');</script>";
                    header("Location:/signin.php");
                }
            }else{
                $errmessage = "Credentials does not match.";
                echo "<script type='text/javascript'>alert('$errmessage');</script>";
                header("Location:/signin.php");
            }
        }

    ?>