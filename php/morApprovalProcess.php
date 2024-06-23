<?php 
        session_start();
        
        
        if (isset($_POST['btnResponseForm'])) {
            
            include '../php/functions.php';
            $conn = db_connect();
            
            $username = $_SESSION['username'];
            $studentid = $_SESSION['student'];
            $proposalid = $_SESSION['proposalid'];
            $facultyid = $_SESSION['adviserid'];
            $comment = $_POST['comment'];
            $response = $_POST['response'];
            $currentTime = date("Y-m-d H:i:s"); 
            
            $updateQuery = "UPDATE mor_one SET adviser_response = ? WHERE idmor_one = ?";
            $stmt1 = mysqli_prepare($conn, $updateQuery);
            if(!$stmt1) {
                die("Unable to prepare statement: " . mysqli_error($conn));
            }else{
                // Bind parameters
                $bindParam = mysqli_stmt_bind_param($stmt1, "ss", $response, $proposalid);
                
                if(!$bindParam) {
                    die("Binding parameters failed: " . mysqli_stmt_error($stmt1));
                }else{
                    
                    if (mysqli_stmt_execute($stmt1)) {
                        // echo "Record updated successfully in table mor_one";
                        
                        $sql = "INSERT INTO response (facultyid, studentid, idmor_one, response, comment, date) VALUES ('$facultyid' ,'$studentid' ,'$proposalid' ,'$response' ,'$comment', '$currentTime')";
                        // Execute the query
                        $result = mysqli_query($conn, $sql);
            
                        if ($result) {
                                // echo "Data inserted successfully!";
                                $_SESSION['proposalid'] = $proposalid;
                                $_SESSION['username'] = $username;
                                $_SESSION['student'] = $studentid;
                                $_SESSION['adviserid'] = $facultyid;
                                redirect('../faculty/faculty-mor-researchadviser1.php');
                        }else {
                                "Error inserting data: " . mysqli_error($conn);
                        }
                        
                    }else {
                      echo "Error updating record: " . mysqli_stmt_error($stmt1);
                    }  
                            
                }
            }
        }else {
             echo "NOT SET";
        }
        
        
                ?>