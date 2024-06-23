<?php 
    if(isset($errmessage)){
        $errmessage = $_SESSION['errormsg'];
        echo "<script type='text/javascript'>alert('$errmessage');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link href="../css/customize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" 
       integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Sign Up - Faculty</title>
</head>
<body style="background-color: ghostwhite;">
    <!-- CDN via jsDelivr-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <div class="container-flex justify-content-center align-items-center border m-0">
        <div class="row">
          <div class="col-7 p-0">
            <div class="d-grid p-0">
                <img src="../assets/books.jpeg" class="img-fluid" alt="" style="height: 100vh;"/> 
            </div>
          </div>
          <div class="col" style="height: 100vh;">
            <div class="form-cont" style="margin-top: 105px;">
                <div class="cpelogo text-center mt-3">
                    <img src="../assets/cmpedept-logo.jfif" class="cpeImage" alt="">
                </div>
                <div class="text-center mt-3">
                    <span class="h2 text-uppercase" style="font-family:'Inter', sans-serif;font-weight: 800;">Faculty</span>
                    <br>
                    <span class="text-jet" style="font-size: 14px;">Commodo quis imperdiet massa tincidunt nunc pulvinar sapien et</span>
                </div>
                <div class="text-center mt-3 px-5">
                    <form action="sample.php" method="POST" accept-charset="UTF-8">
                        <div class="mb-3 py-1">
                            <input type="email" class="form-control" name="facultySignupEmail" id="facultySignupEmail" placeholder="PUP webmail" required/>
                        </div>
                        <div class="mb-3 py-1">
                            <input type="password" class="form-control" name="facultySignupPass" id="facultySignupPass" placeholder="Password" required/>
                        </div>
                        <div class="mb-3 py-1 d-grid">
                            <button type="submit" class="btn btn-primary text-ghostwhite" name="btnSignUp">
                                <span class="h5">Sign Up</span></button>
                                <div class="mt-2 text-end">
                                    <a href="../php/forgotPassword.php" class="pe-2 text-secondary text-decoration-none">Forgot Password</a>
                                    <a href="signin.php" class="ps-2 text-secondary text-decoration-none">Sign In here</a>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            
          </div>
        </div>
      </div>
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
</body>
</html>