<?php 
	require ('session.php');
	require ('db.php');

    $sql = "";
    if(isset($_GET['id'])){
        $sql = "SELECT order_id, name, contact_number, address, date, quantity, t.price, (o.quantity * t.price) AS total_price, rider, o.status_id, status_name, type_name FROM sales o
            JOIN status s ON o.status_id = s.status_id
            JOIN type t ON o.type_id = t.type_id WHERE date BETWEEN :start_date AND :end_date AND o.status_id=3";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status_id', $_GET['id']);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $sql = "SELECT order_id, name, contact_number, address, date, quantity,price, (o.quantity * t.price) AS total_price, rider, o.status_id, status_name, type_name FROM orders o
        JOIN status s ON o.status_id = s.status_id
        JOIN type t ON o.type_id = t.type_id
        WHERE o.status_id = 3" ;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Orders</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="adminindex.php">


                <img src="icons/transparentlogo.png" style="width: 200px; height: 150px;">

            </a>
            <!-- Sidebar Toggle-->
            <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->
            <!-- Navbar Search-->
           
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto  me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav align-items-center">
                           
                            <a class="nav-link" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                                Orders
                            </a>
                            <a class="nav-link" href="maps.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                                Map
                            </a>

                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                           
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Orders</h1>
                       
                        <ul class="navbar-nav ms-auto  me-3 me-lg-4">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" ><i class="bi bi-filter-circle-fill fs-2"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="orders.php">All</a></li>
                                    <li><a class="dropdown-item" href="orders.php?id=3">Delivering</a></li>
                                    <li><a class="dropdown-item" href="orders.php?id=4">Completed</a></li>
                                </ul>
                            </li>
                        </ul>
                       
                        <div class="card mb-4">
                           
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact #</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Payment</th>
                                            <th>Type</th>
                                             <th>Status</th>
                                             <th>Rider</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact #</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Payment</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Rider</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($data as $row): ?>
                                        <tr data-id="<?php echo $row['order_id']?>">
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['contact_number']?></td>
                                            <td><?php echo $row['address']?></td>
                                            <td><?php echo $row['date']?></td>
                                            <td><?php echo $row['quantity']?></td>
                                            <td><?php echo $row['total_price']?></td>
                                            <td><?php echo $row['type_name']?></td>
                                            <td><?php echo $row['status_name']?></td>
                                            <td><?php echo $row['rider']?></td>
                                            <td class="text-center align-middle">
                                                <button type='button' class='btn btn-outline-primary btn-lg' data-bs-toggle='modal' data-order-id='<?php echo $row['order_id']?>' data-id='<?php echo $row['status_id']?>' data-bs-target='#editstatus' title='Edit Task'>
                                                        <i class='fa fa-edit'></i>
                                                </button>
                                            </td> 
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
        <!-- Modal Structure -->
        <div class="modal fade" id="editstatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-plus-circle"></i>Edit Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="process_addorder.php" method="POST">
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-group">
                                <?php 
                                    $sql = "SELECT * FROM status WHERE status_id != 1 AND status_id != 2";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                ?>
                                <select class="form-select" name="status_id" id="editstatusid" required>
                                    <option value="">Select Status</option>
                                    <?php foreach($data as $row):?>
                                    <option value="<?php echo $row['status_id']?>" id="editstatus"><?php echo $row['status_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="order_id" id="editorderid" hidden>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </form>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqLYbSqHK4SpCq4FIGTf1JVC7CaLgUi6g&callback=initMap" async defer></script>

        <script>
            $('#editstatus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var statusId = button.data('id');
                var orderId = button.data('order-id');
                document.getElementById("editstatusid").value = statusId;
                document.getElementById("editorderid").value = orderId;
            });

        </script>

    <?php if (isset($_GET['status'])): ?>
        <script>
            <?php if ($_GET['status'] == 'success'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Order Updated!',
                    text: 'The order has been successfully updated.',
                }).then((result) => {
                });
            <?php elseif ($_GET['status'] == 'error'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong while editing the order.',
                });
            <?php endif; ?>
        </script>
    <?php endif; ?>

        
    </body>
</html>
