<?php
    session_start();
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
    <title>Title Proposal - Research Adviser</title>

    <style>
    </style>
</head>
<body class="body bg-ghostwhite" style="overflow-x:hidden;">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <?php include '../php/header.php'; ?>

    <div class="container-fluid mx-4">
        <div class="header-text display-5 ms-5 mt-4 mb-3" style="width:90%;">
            <h4 style="font-weight: 700; border-bottom: 5px solid #DC8116; padding-bottom: 6px;">
                <a href="student-7.html"><i class="bi bi-arrow-left-circle-fill text-jet"></i></a> 
                <span class="ms-2">Title Proposal - Research Adviser</span>
            </h4>
        </div>
        <div class="main-content row ms-5 mt-4 mb-3">
            <div class="one col-md-6">
                <div class="row box-approvalsheet mt-2">
                    <p class="box-label ps-0 mb-1 fw-bold">Approval Response <?php ?></p>
                    <div class="text-thesisTitle bg-white" style="font-size:14px; box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
                    <table class="table text-jet">
                        <thead style="border-bottom: 2px solid #2f2f2f">
                            <tr>
                                <th scope="col">Research Adviser</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="p-0">
                                <td class="col-9"><?php echo "JUAN DELA CRUZ"; ?></td>
                                <td><span class="badge bg-<?php echo "approved"; ?> text-uppercase"><?php echo "approved"; ?></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table text-jet">
                        <thead style="border-bottom: 2px solid #2f2f2f">
                            <tr>
                                <th scope="col">Research Committee</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-9"><?php echo "JUAN DELA CRUZ"; ?></td>
                                <td><span class="badge bg-<?php echo "approved"; ?> text-uppercase"><?php echo "approved"; ?></span></td>
                            </tr>
                            <tr>
                                <td class="col-9"><?php echo "JUAN DELA CRUZ"; ?></td>
                                <td><span class="badge bg-<?php echo "rejected"; ?> text-uppercase"><?php echo "rejected"; ?></span></td>
                            </tr>
                            <tr>
                                <td class="col-9"><?php echo "JUAN DELA CRUZ"; ?></td>
                                <td><span class="badge bg-<?php echo "pending"; ?> text-uppercase"><?php echo "pending"; ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            
            <div class="two col-auto">

            </div>
        </div>
    </div>
</body>