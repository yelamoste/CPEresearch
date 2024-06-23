<?php
    session_start();
    include '../php/functions.php';
    $conn = db_connect();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['btnSignUp'])){

            $facultyEmail = $_POST['facultySignupEmail'];
            $facultyPassword = $_POST['facultySignupPass'];
     
            if(filter_var($facultyEmail, FILTER_VALIDATE_EMAIL)){
                //encrypt the password
                $password_hash = password_hash($facultyPassword, PASSWORD_DEFAULT);
                if (strlen($facultyPassword)<8) {
                   header('Location:signup.php');
                   $_SESSION['errormsg'] = "Password must be at least 8 characters.";
                }else{
                    $sql = "SELECT * FROM faculty WHERE webmail = '$facultyEmail'";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount) {
                       // header('Location:/website-research/faculty-signup.php');
                        $_SESSION['errormsg'] = "Email already exist.";
                        header('Location:signup.php');
                        session_write_close();
                    }else{
                        $sql = "INSERT INTO faculty (webmail, password) VALUES ( ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                        if ($prepareStmt) {
                            // echo $facultyEmail;
                            // Bind variables to the prepared statement
                            $stmt->bind_param("ss", $facultyEmail, $password_hash);
                            // Execute the prepared statement
                            if($stmt->execute()){
                                $_SESSION['facultywebmail'] = $facultyEmail;
                                header("Location:faculty-form1.php");
                                // $_SESSION['successSignup'] = "Congratulations! You are now a member of our website. You can now sign-in.";
                                
                            }else {
                                $_SESSION['errormsg'] = "Something went wrong. Try again";
                                header('Location:signup.php');
                                session_write_close();
                            }
                            
                        }else{
                           // header('Location:/website-research/faculty-signup.php');
                            $_SESSION['errormsg'] = "Something went wrong. Try again";
                            header('Location:signup.php');
                            session_write_close();
                        }
                    }
                }
            }else{
               // header('Location:/website-research/faculty-signup.php');
               $_SESSION['errormsg'] = "Invalid email format. ";
                header('Location:signup.php');
                session_write_close();;
            }
        }else{
            //header('Location:/website-research/faculty-signup.php');
            $_SESSION['errormsg'] = "Error while signing up. Try again.";
            header('Location:signup.php');
            session_write_close();
        }
    }
        
    ?>