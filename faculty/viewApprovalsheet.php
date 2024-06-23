<?php
    // TO FIX HERE IN THIS PHP PAGE
    // TO FIX: Add the code for the total approve response. 
    // TO FIX: Add the code for the table for Research Panelist
    // TO FIX: Add the code for the comment section from table comment. Inner join the comment from 
    //          adviser, committee, panelist and student. 
    // TO FIX: Alter the table response. Remove the column response. 
    
    session_start();
    include '../php/functions.php';
    $conn = db_connect();
    
    if(isset($_GET['id'])){
        $proposalid= $_GET['id'];
        
        // This code fetches data related to a research adviser for a specific proposal.
        // $proposalid is assumed to be a variable containing the ID of the proposal.
        // Create a SQL query to join two tables:
        //  - mor_one: This table likely holds information about MOR step 1.
        //  - faculty: This table likely holds information about faculty members.
        $query = "SELECT mor_one.* ,faculty.* 
                FROM mor_one 
                INNER JOIN faculty ON mor_one.adviser = faculty.facultyid 
                WHERE mor_one.idmor_one = '$proposalid' AND faculty.role_adviser = 'YES'";
        
        // Execute the query using the mysqli connection ($conn).
        $result = mysqli_query($conn, $query);
        $countRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        // Check if any results were returned.
        if ($countRow) {
            // If a row is found, extract data from the faculty table:
            //  - $adviser: This variable will store the faculty member's name.
            //  - $adviser_response: This variable will store the adviser's response 
            //  (e.g., approved, rejected, pending).
            $adviserName = $countRow['name'];
            $adviserResponse = $countRow['adviser_response'];
            $badgeColorAdviser = $countRow['adviser_response'];
        }else{
            $adviserName = 'No Research Adviser';
            $adviserResponse = 'none';
            $badgeColorAdviser = 'gray400';
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
    <title>Approval Sheet and Suggestion</title>
</head>
<body class="body bg-ghostwhite" style="overflow-x:auto;">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <?php include '../php/header.php'; ?>
    
    <div class="container-fluid mx-4 border-secondary p-1">
        <div class="header-text display-5 ms-5 mt-4 mb-3" style="width:90%;">
            <h4 style="font-weight: 700; border-bottom: 5px solid #DC8116; padding-bottom: 6px;">
                <a href="student-7.html"><i class="bi bi-arrow-left-circle-fill text-jet"></i></a> 
                <span class="ms-2">Approval Sheet and Suggestion</span>
            </h4>
        </div>
        
        <div class="row ms-5 mt-4 mb-3" style="width:90%;">
            <div class="col box-Response mt-2 ps-0">
                    <p class="box-label ps-0 mb-2 fw-bold" style="font-size:14px;">Title Proposal Response 
                    <span>(<?php echo "12/12"; ?> Accepted)</span></p>
                    
                    <!-- Table for Research Adviser -->
                    <div class="approvResponse px-0" style="font-size:14px;">
                        <table class="table bg-gray400" style="font-size: 14px;">
                            <thead class="border">
                                <tr>
                                    <th scope="col" class="col-9 ms-1 text-jet">Research Adviser</th>
                                    <th scope="col" class="text-jet">Status</th>
                                </tr>
                            <tbody class="border">
                                <tr>
                                    <td class="col-9 ms-1"><?php echo $adviserName; ?></td>
                                    <td>
                                        <div class="checkResponse row d-flex align-items-end">
                                            <div class="col form-check">
                                                <span class="text-uppercase badge bg-<?php echo $badgeColorAdviser; ?> text-ghostwhite p-1"><?php echo $adviserResponse; ?></span>
                                            </div>
                                        </div>  
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Table for Research Committee --> 
                    <div class="approvResponse px-0 mt-0" style="font-size:14px;">
                        <table class="table bg-gray400" style="font-size: 14px;">
                            <thead class="border">
                                <tr>
                                    <th scope="col" class="col-9 ms-1 text-jet">Research Committee</th>
                                    <th scope="col" class="text-jet">Status</th>
                                </tr>
                            <tbody class="border">
                    
            <?php
                // Create a SQL query to join three tables:
                //  - mor_one: This table likely holds information about MOR Step 1.
                //  - faculty: This table likely holds information about faculty members.
                //  - mor_two: This table likely holds information about MOR Step 2.
                $queryForCommittee = "SELECT mor_one.*,faculty.*,mor_two.* 
                    FROM mor_one
                    INNER JOIN mor_two ON mor_one.idmor_one = mor_two.idmor_one
                    INNER JOIN faculty ON mor_two.id_committee = faculty.facultyid
                    WHERE mor_one.idmor_one = '$proposalid' AND faculty.role_committee = 'YES'";
                // Execute the query using the mysqli connection ($conn).
                $resultForCommittee = mysqli_query($conn, $queryForCommittee);
                $countRowForCommittee =  mysqli_num_rows($resultForCommittee);
                    
                if ($resultForCommittee->num_rows > 0){
                    while($countRowForCommittee = $resultForCommittee->fetch_assoc() ){
            ?>
                 <tr>
                    <td class="col-9 ms-1"><?php echo $countRowForCommittee['name']; ?></td>
                    <td>
                        <div class="checkResponse row d-flex align-items-end">
                            <div class="col form-check">
                                <span class="text-uppercase badge bg-<?php echo $countRowForCommittee['committee_response']; ?> text-ghostwhite p-1"><?php echo $countRowForCommittee['committee_response']; ?></span>
                            </div>
                        </div>  
                    </td>
                </tr>
            <?php
                    }
                }else{
                    $committeeName = 'No Research Committee';
                    $committeeResponse = 'none'; 
                    $badgeColorCommittee = 'gray400';
                }
            ?>
                <tr>
                    <td class="col-9 ms-1"><?php echo $committeeName; ?></td>
                        <td>
                            <div class="checkResponse row d-flex align-items-end">
                                <div class="col form-check">
                                    <span class="text-uppercase badge bg-<?php echo $badgeColorCommittee; ?> text-ghostwhite p-1"><?php echo $committeeResponse; ?></span>
                                </div>
                            </div>  
                        </td>
                </tr>
            </tbody>
        </table>
    </div>

                    <!-- Table for Research Panelist --> 
                    <div class="approvResponse px-0" style="font-size:14px;">
                            <table class="table bg-gray400" style="font-size: 14px;">
                                <thead class="border">
                                    <tr>
                                        <th scope="col" class="col-9 ms-1 text-jet">Research Panelist</th>
                                        <th scope="col" class="text-jet">Status</th>
                                    </tr>
                                <tbody class="border">

                        <?php
                        
                        // Create a SQL query to join three tables:
                        //  - mor_one: This table likely holds information about MOR Step 1.
                        //  - faculty: This table likely holds information about faculty members.
                        //  - mor_two: This table likely holds information about MOR Step 2.
                        $queryForPanelist = "SELECT mor_one.*,faculty.*,mor_three.* 
                            FROM mor_one
                            INNER JOIN mor_three ON mor_one.idmor_one = mor_three.idmor_one
                            INNER JOIN faculty ON mor_three.id_panelist = faculty.facultyid
                            WHERE mor_one.idmor_one = '$proposalid' AND faculty.role_panelist = 'YES'";
                        // Execute the query using the mysqli connection ($conn).
                        $resultForPanelist = mysqli_query($conn, $queryForPanelist);
                        $countRowForPanelist =  mysqli_num_rows($resultForPanelist);
                            
                        if ($resultForPanelist->num_rows > 0){
                            while($countRowForPanelist = $resultForPanelist->fetch_assoc() ){        
                        ?>

                                    <tr>
                                        <td class="col-9 ms-1"><?php echo $countRowForPanelist['name']; ?></td>
                                        <td>
                                            <div class="checkResponse row d-flex align-items-end">
                                                <div class="col form-check">
                                                    <span class="text-uppercase badge bg-<?php echo $countRowForPanelist['panelist_response']; ?> text-ghostwhite p-1"><?php echo $countRowForPanelist['panelist_response']; ?></span>
                                                </div>
                                            </div>  
                                        </td>
                                    </tr>
            <?php
                    }
                    }else{
                            $panelistName = 'No Research Panelist';
                            $panelistResponse = 'none';
                            $badgeColorPanelist = 'gray400';
                    }
                
            ?>  
                                <tr>
                                        <th scope="col" class="col-9 ms-1 text-jet">Research Panelist</th>
                                        <th scope="col" class="text-jet">Status</th>
                                    </tr>
                                <tbody class="border">
                                    <tr>
                                        <td class="col-9 ms-1"><?php echo $panelistName; ?></td>
                                        <td>
                                            <div class="checkResponse row d-flex align-items-end">
                                                <div class="col form-check">
                                                    <span class="text-uppercase badge bg-<?php echo $badgeColorPanelist; ?> text-ghostwhite p-1"><?php echo $panelistResponse; ?></span>
                                                </div>
                                            </div>  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <div class="col">
                
            <?php 
                $commentQuery = "SELECT response.*, faculty.*
                                FROM response
                                INNER JOIN faculty
                                ON response.facultyid = faculty.facultyid
                                WHERE response.idmor_one = '$proposalid'";
                $resultForComment = mysqli_query($conn, $commentQuery);
                $row =  mysqli_num_rows($resultForComment);
                
                if ($resultForComment->num_rows > 0){
            ?>
                <div class="col box-Suggestion mt-2 ps-0">
                    <p class="box-label ps-0 mb-2 fw-bold" style="font-size:14px;">Comment/Suggestion</p>
                    <!-- For faculty comment -->
            <?php  while($row = $resultForComment->fetch_assoc() ){   ?>
                    <div class="px-0 mb-2 pb-2" style="font-size:14px;">
                        <div class="row">
                            <div class="col-2 icon pe-0" style="width:10%;">
                                <i class="bi bi-person-circle text-gray400 fw-bold" style="font-size:2rem;"></i>
                            </div>
                            <div class="col-8 pe-0 pt-1 ps-0" style="width:90%;">
                                <div class="row mb-1">
                                    <span class="col-auto accoun-name text-primary fw-bold"><?php echo $row['name']; ?></span>
                                    <span class="col-auto text-muted"><?php echo getTimeDifference($row['date']); ?></span>
                                </div>
                                <p class="mb-2"><?php echo $row['comment']; ?></p>
                                <a href="##" class="text-secondary p-0" style="text-decoration:none;">Reply here</a>
                            </div>
                        </div>
                    </div>
            <?php 
                
                    }   
                }else{
                    $errmessage = "No comment/suggestion."
            ?>
                    
                    <div class="px-0 mb-2 pb-2" style="font-size:14px;">
                        <div class="row">
                            <div class="col-8 pe-0 pt-1 ps-0" style="width:90%;">
                                <div class="row mb-1">
                                    <span class="col-auto accoun-name text-primary fw-bold"><?php echo $errmessage; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php 
                    
                }
            } 
            ?>
            </div>
        </div>
    </div>
</body>