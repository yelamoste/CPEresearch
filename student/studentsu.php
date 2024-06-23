<?php
    session_start();
    include '../php/functions.php';
    $conn = db_connect();
    
    if($conn){
        echo "Connected <br>";
        
    }else{
        echo "Not Connected";
    }

        if(isset($_POST['btnSignUp'])){

            $studentEmail = $_POST['studentSignupEmail'];
            $studentPassword = $_POST['studentSignupPass'];
            $studentNumber = $_POST['studentNumber'];
            
            echo $studentEmail.'<br>'.$studentPassword.'<br>'.$studentNumber;
     
            if(filter_var($studentEmail, FILTER_VALIDATE_EMAIL)){
                //encrypt the password
                echo "Emailokay <br>";
                $password_hash = password_hash($studentPassword, PASSWORD_DEFAULT);
                if (strlen($studentPassword)<8) {
                   //header('Location:/studentsu.php');
                   $errmessage = "Password must be at least 8 characters.";
                   echo "<script type='text/javascript'>alert('$errmessage');</script>";
                }else{
                    echo "Password okay <br>";
                    $sql = "SELECT * FROM student WHERE webmail = '$studentEmail'";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount) {
                        $errmessage = "Email already exist.";
                        //header('Location:/studentsu.php');
                        echo "<script type='text/javascript'>alert('$errmessage');</script>";
                    }else{
                        echo "Account Okay <br>";
                        $sql = "INSERT INTO student (studentNum, webmail, password) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                        if ($prepareStmt) {
                            // Bind variables to the prepared statement
                            echo "Bind variables to the prepared statement";
                            $stmt->bind_param("sss",$studentNumber, $studentEmail, $password_hash);
                            // Execute the prepared statement
                            if($stmt->execute()){
                                echo "Executed";
                                $_SESSION['studentNumber'] = $studentNumber;
                                $_SESSION['studentwebmail'] = $studentEmail;
                                // header("Location:sample-form.php");
                                redirect('sample-form.php');
                                // $_SESSION['successSignup'] = "Congratulations! You are now a member of our website. You can now sign-in.";
                                
                            }else {
                                $errmessage = "Something went wrong. Try again";
                                // header('Location:/studentsignup.php');
                                echo "<script type='text/javascript'>alert('$errmessage');</script>";
                                
                            }
                            
                        }else{
                           // header('Location:/website-research/faculty-signup.php');
                            $errmessage = "Something went wrong. Try again";
                            // header('Location:studentsignup.php');
                            echo "<script type='text/javascript'>alert('$errmessage');</script>";
                            
                        }
                    }
                }
            }else{
               // header('Location:/website-research/faculty-signup.php');
                $errmessage = "Invalid email format. ";
                // header('Location:/studentsignup.php');
                echo "<script type='text/javascript'>alert('$errmessage');</script>";
            }
        }else{
            //header('Location:/website-research/faculty-signup.php');
            $errmessage = "Error while signing up. Try again.";
            // header('Location:/studentsignup.php');
            echo "<script type='text/javascript'>alert('$errmessage');</script>";
        }
    ?>