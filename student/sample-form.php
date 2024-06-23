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
    <title>Student P-6</title>
</head>
<body class="bg-ghostwhite" style="overflow-x: hidden;overflow-y: hidden;">

    <div class="container-fluid border pt-3 mx-auto">
        <!-- Header text -->
        <div class="header-text display-5 ms-5 mt-4 mb-3" style="width:90%;">
            <h4 style="font-weight: 700; padding-bottom: 6px;">
                <a href="student-7.php"><i class="bi bi-arrow-left-circle-fill text-jet"></i></a> 
                <span class="ms-2">Methods of Research</span>
            </h4>
        </div>

        <div class="main-content row mx-5 mt-4 mb-3 p-4" style="border: 1px solid #CED4DA;border-radius: 5px; box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25); ">
            <div class="form-header">
                <h4 style="font-weight: 700; padding-bottom: 6px; border-bottom: 3px solid #DC8116;"> 
                    <span class="ms-2 text-jet">Student Researcher Information</span>
                </h4>
            </div>
            <form action="studentInfo.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-5">
                        <div class="me-2">
                            <span class="form-label mt-2">Group Members <span class="text-rejected">*</span> </span>
                            <div class="mb-1 mt-2">
                                <input type="text" class="form-control form-control-sm" name="memberOne" id="memberOne" aria-describedby="helpId" placeholder="" required/>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="memberTwo" id="memberTwo" aria-describedby="helpId" placeholder="" required/>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="memberThree" id="memberThree" aria-describedby="helpId" placeholder="" required/>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="memberFour" id="memberFour" aria-describedby="helpId" placeholder="" required/>
                            </div>
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="memberFive" id="memberFive" aria-describedby="helpId" placeholder=""/>
                            </div>
                          </div>
                            <div class="mb-3 mt-3 me-2">
                            <?php
                                include '../php/functions.php';
                                $conn = db_connect();

                                $getAdviserQuery = "SELECT * FROM faculty WHERE role_adviser = 'YES'";
                                $getAdviserResult = mysqli_query($conn, $getAdviserQuery);
                                $getAdviserCount = mysqli_num_rows($getAdviserResult);
                                if ($getAdviserCount > 0) {
                            ?>
                                <span class="form-label mt-2">Research Adviser <span class="text-rejected">*</span></span>
                                <select class="form-select form-select-sm mt-2" name="selectAdviser" id="selectAdviser">
                                    <option disabled>Select one</option>
                                <?php while ($getAdviserCount = $getAdviserResult->fetch_assoc()) { ?>
                                        <option value="<?php echo $getAdviserCount['facultyid'];?>"><?php echo $getAdviserCount['name']; }}?></option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <span class="form-label mt-2">Course <span class="text-rejected">*</span></span>
                                        <select class="form-select form-select-sm mt-2" name="selectCourse" id="selectCourse">
                                            <option disabled>Select one</option>
                                            <option value="BSCPE">BSCPE</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <span class="form-label mt-2">Year & Section <span class="text-rejected">*</span></span>
                                        <select class="form-select form-select-sm mt-2" name="selectYearSection" id="selectYearSection">
                                            <option disabled>Select one</option>
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
                                    <div class="col">
                                        <span class="form-label mt-2">Group <span class="text-rejected">*</span></span>
                                        <select class="form-select form-select-sm mt-2" name="selectGroup" id="selectGroup" required>
                                            <option disabled>Select one</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                    <div class="col-7">
                        <div class="mb-3">
                            <label for="formFile" class="form-label mt-2">Upload your Title Proposals/s here: <span class="text-rejected">*</span> </label>
                        <!--    <input onchange="Output()" name="drag-file-upload" type="file" class="drag-file-upload-inputfile" id="mor-1-3-file-upload" accept=".pdf" hidden required /> -->
                            <input class="form-control" type="file" name="file" id="file" required> 
                        </div>
                        <!-- <div class="mb-3">
                            <label for="mor-1-3-file-upload"  class="drag-file-upload" id="drag-file-upload">
                                    <span class="description">Upload the chapter 1 to 3 of your thesis for Title Defense</span>
                                    <img src="assets/drag.svg" id="drag-file-upload-logo"/>
                                    <input onchange="Output()" name="drag-file-upload" type="file" class="drag-file-upload-inputfile" id="mor-1-3-file-upload" accept=".pdf" hidden required />
                            </label> 
                        </div> -->
                        <div class="mb-3">
                            <label for="title" class="form-label mt-2">Provide your title/s here: <span class="text-rejected">*</span> </label>
                            <input class="form-control my-2" type="textarea" name="titleOne" id="formFile">
                            <input class="form-control my-2" type="textarea" name="titleTwo" id="formFile">
                            <input class="form-control my-2" type="textarea" name="titleThree" id="formFile">
                        </div>
                        <div class="mb-3 mt-5 text-end pe-0">
                            <button type="reset" class="btn btn-white text-primary border-primary border-2 m-1">Clear</button>
                            <button type="submit" class="btn btn-primary text-white m-1" name="btnStudentForm" id="btnStudentForm">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                const limit = 12; // Maximum number of checkboxes that can be checked
                const checkboxes = document.querySelectorAll('.form-check-input');

                checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('click', () => {
                    const checkedCount = document.querySelectorAll('.form-check-input:checked').length;

                    if (checkedCount > limit) {
                        checkbox.checked = false;
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
</body>
</html>