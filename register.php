<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                <div class="card-body">
                                    <form action="registeracc.php" method="POST">
                                        <div class="mb-3">
                                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="address" class="form-control" placeholder="Address" required>
                                        </div>
                                
                                      
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                                <span class="input-group-text" onclick="togglePassword('password', this)">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="confirmpassword" name="confirmpassword" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                                                <span class="input-group-text" onclick="togglePassword('confirmPassword', this)">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        function togglePassword(fieldId, element) {
            var passwordField = document.getElementById(fieldId);
            var icon = element.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

    <?php if (isset($_GET['status'])): ?>
        <script>
            <?php if ($_GET['status'] == 'xmatch'): ?>
            Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo "Passwords do not match." ?>',
            });
            <?php elseif ($_GET['status'] == 'error'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong while creating the account.',
                });
            <?php elseif ($_GET['status'] == 'success'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Account Added!',
                    text: 'The account has been successfully created.',
                }).then((result) => { window.location.href = "login.php";
                });
            <?php endif ?>
        </script>
    <?php endif; ?>
</body>
</html>
