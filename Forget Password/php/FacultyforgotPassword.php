
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
    <title>Forgot Password</title>
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
                    <span class="h2 text-uppercase" style="font-family:'Inter', sans-serif;font-weight: 800;">Forgot Password</span>
                    <br>
                    <span class="text-jet" style="font-size: 14px;">Insert your PUP webmail to access your PUP Research Library Account.</span>
                </div>



                <div class="text-center mt-3 px-5">
                    <form action="FacultysendPasswordReset.php" method="POST">
                        <div class="mb-3 py-1">
                            <input type="email" class="form-control" name="forgotPassEmail" id="forgotPassEmail" placeholder="PUP webmail" required/>
                        </div>
                            <button type="submit" class="btn btn-primary text-ghostwhite" name="btnSend">
                                <span class="h5">Send</span></button>
                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
      </div>
</body>
</html>