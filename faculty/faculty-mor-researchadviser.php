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
                <div class="row box-grpMembers bg-white" style="font-size:14px;box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
                    <div class="col-auto mx-1">
                        <p for="grpList" class="labelgrpList text-jet mb-0 mt-1">Group Members:</p>
                            <ul id="grpList" style="list-style-type: none;padding-left: 0;">
                            <?php 
                                $grpList = explode(", " , $_SESSION['group_member']);
                                for ($i = 0; $i < count($grpList); $i++) {
                            ?>
                                <li class="text-muted"><?php echo $grpList[$i]; ?></li>
                            <?php } ?>
                            </ul>
                    </div>
                    <div class="col-auto p-2 mx-4">
                        <div class="row">
                            <p class="labelgrpList col-auto text-jet mb-0">Research Adviser: </p>
                            <p class="col-auto text-muted px-0 mb-0"><?php echo $_SESSION['username']; ?></p>
                        </div>
                        <div class="row">
                            <p class="labelgrpList col-auto text-jet mb-0">Course & Section: </p>
                            <p class="col-auto text-muted px-0 mb-0"><?php echo $_SESSION['course_section']; ?></p>
                        </div>
                        <div class="row">
                            <p class="labelgrpList col-auto text-jet mb-0">Group Number: </p>
                            <p class="col-auto text-muted px-0 mb-0"><?php echo $_SESSION['group_num']; ?></p>
                        </div>
                        <div class="row">
                            <p class="labelgrpList col-auto text-jet mb-0">Subject: </p>
                            <p class="col-auto text-muted px-0 mb-0"><?php echo $_SESSION['subject']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row box-thesisTitle mt-2">
                        <p class="box-label ps-0 mb-1 fw-bold">Proposed Research Title</p>
                        <div class="text-thesisTitle bg-white p-3" style="font-size:14px; box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
                            <p><?php echo $_SESSION['title']; ?></p>
                        </div>
                </div>

                <form action="../php/morApprovalProcess.php" method="POST">
                <div class="row box-Response mt-2">
                    <p class="box-label ps-0 mb-1 fw-bold">Title Proposal Response</p>
                    <div class="approvResponse px-0" style="font-size:14px;box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
                        <table class="table bg-gray400" style="font-size: 14px;">
                            <thead class="border">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Research Adviser</th>
                                    <th scope="col">Status</th>
                                </tr>
                            <tbody class="border">
                                <tr>
                                    <th scope="row"></th>
                                    <td><?php echo $_SESSION['username']; ?></td>
                                    <td>
                                        <div class="checkResponse row d-flex align-items-end">
                                            <div class="col form-check">
                                                <input class="form-check-input" type="radio" value="approved" id="checkAccepted" name="response" />
                                                <label class="form-check-label" for="checkAccepted">Approved</label>
                                            </div>
                                            <div class="col form-check">
                                                <input class="form-check-input" type="radio" value="rejected" id="checkRejected" name="response" />
                                                <label class="form-check-label" for="checkRejected">Rejected</label>
                                            </div>
                                        </div>  
                                    </td>
                                    
                                    <!-- To allow only one checkbox to be checked -->
                                    <script>
                                        $('.checkResponse input[type="checkbox"]').on('change', function() {
                                        $(this).siblings('input[type="checkbox"]').prop('checked', false);
                                    });
                                    </script>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                

                <div class="row box-recommendation mt-2" style="font-size:14px;">
                    <p class="box-label ps-0 mb-1 fw-bold">Recommendation</p>
                    <div class="recommendation mt-1 m-0 px-0" style="box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);">
                        <textarea type="text" name="comment" class="comment-input d-grid border-0 p-2" style="width: 100%;" placeholder="Write a recommendation here"></textarea>
                    </div>
                    <div class="text-end mt-4 pe-0">
                        <button class='btn btn-primary text-ghostwhite' type="submit" id="btnResponseForm" name="btnResponseForm" value="<?php ?>">Submit</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="two col-auto">
                <div id="pdf">
                <embed src="<?php echo $_SESSION['filepath']; ?>" width="500px" height="520" />
                </div>
            </div>
            </div>
        </div>
</body>
</html>