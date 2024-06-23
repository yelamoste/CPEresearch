<?php
  session_start();
  $studentNumber = $_SESSION['studentNumber'];
  include '../php/functions.php';
  
  //database connection
  $conn = db_connect();

  //target directory
  $targetDir = "../proposal/mor_one/";

  //
  if(isset($_SESSION['studentNumber']) && isset($_POST['btnStudentForm']) && isset($_FILES['file'])){
    $studentNum = $_SESSION['studentNum'];
    $findStudentQuery = "SELECT studentid FROM student WHERE studentNum = '$studentNumber'";
    $findStudentResult = mysqli_query($conn, $findStudentQuery);
    $findStudentCount = mysqli_num_rows($findStudentResult);
    if ($findStudentCount > 0) {
        echo "Meron";
      while($findStudentCount = $findStudentResult->fetch_assoc()){
        $studentid = $findStudentCount['studentid'];
        echo $studentid;
      }
    }
    $grpMember = $_POST['memberOne'].', '.$_POST['memberTwo'].', '.$_POST['memberThree'].', '.$_POST['memberFour'].', '.$_POST['memberFive'];
    $adviser = $_POST['selectAdviser'];
    $course = $_POST['selectCourse'];
    $yearSection = $_POST['selectYearSection'];
    $group = $_POST['selectGroup'];
    $titleOne = $_POST['titleOne'];
    $titleTwo = $_POST['titleTwo'];
    $titleThree = $_POST['titleThree'];
    $filename = $yearSection.$group.'-'.basename($_FILES['file']['name']);
    $targetPath = $targetDir.''.$filename;
    
    echo $grpMember; echo "<br>";
    echo $adviser; echo "<br>";
    echo $course; echo "<br>";
    echo $yearSection; echo "<br>";
    echo $group; echo "<br>";
    echo $titleOne; echo "<br>";
    echo $titleTwo; echo "<br>";
    echo $titleThree; echo "<br>";
    echo $targetPath; echo "<br>";
    echo $filename; echo "<br>";
    echo "<br>";

    //Moving the file to targetPath 
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        echo "file move successfully <br>";
      // Moved successfully, write details to database
      if(!empty($titleOne)){
        $sql = "INSERT INTO mor_one (title, course, year_section, group_num, group_member, adviser, student, filename, filepath) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if ($prepareStmt) {
            echo $facultyEmail;
            // Bind variables to the prepared statement
            $stmt->bind_param("sssssssss",$titleOne,$course,$yearSection,$group,$grpMember,$adviser,$studentid,$filename,$targetPath);
            
            // Execute the prepared statement
            if($stmt->execute()){
            echo $studentNumber;
            // $_SESSION['successSignup'] = "Congratulations! You are now a member of our website. You can now sign-in.";
            echo "Title one record created successfully";
            }else {
                $errmessage = "Error creating record: " . mysqli_error($conn);
                echo $errmessage;
                //header('Location:../faculty/signup.php');
            }
                            
        }else{
            $errmessage = "Something went wrong. Try again";
            echo $errmessage;
            //header('Location:../faculty/signup.php');
            die("Something went wrong.");
        }
      }
      
      if(!empty($titleTwo)){
        $sql = "INSERT INTO mor_one (title, course, year_section, group_num, group_member, adviser, student, filename, filepath) 
                VALUES ('$titleTwo','$course','$yearSection','$group','$grpMember','$adviser','$studentid','$filename','$targetPath')";
        if (mysqli_query($conn, $sql)) {
          echo "Title two record created successfully";
        } else {
          echo "Error creating record: " . mysqli_error($conn);
        }
      }
      if(!empty($titleThree)){
        $sql = "INSERT INTO mor_one (title, course, year_section, group_num, group_member, adviser, student, filename, filepath) 
                VALUES ('$titleThree','$course','$yearSection','$group','$grpMember','$adviser','$studentid','$filename','$targetPath')";
        if (mysqli_query($conn, $sql)) {
          echo "Title three record created successfully";
        } else {
          echo "Error creating record: " . mysqli_error($conn);
        }
      }
    }

    // echo $studentNum.'<br>';
    // echo $grpMember.'<br>';
  }else{
    echo "Not set";
  }



?>