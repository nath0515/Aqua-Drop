<?php 
	require ('session.php');
	require ('db.php');

    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        if (validateDate($start_date) && validateDate($end_date)) {
            $start_datetime = $start_date . ' 00:00:00';
            $end_datetime = $end_date . ' 23:59:59';

            $sql = "SELECT order_id, name, contact_number, address, date, quantity, t.price, (o.quantity * t.price) AS total_price,  rider, o.status_id, status_name, type_name FROM orders o
            JOIN status s ON o.status_id = s.status_id
            JOIN type t ON o.type_id = t.type_id WHERE date BETWEEN :start_date AND :end_date AND o.status_id = 4";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':start_date', $start_datetime, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $end_datetime, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sql_total_payment = "SELECT SUM(payment) AS total_payment FROM orders WHERE date BETWEEN :start_date AND :end_date AND status_id = 4";
            $stmt_total_payment = $conn->prepare($sql_total_payment);
            $stmt_total_payment->bindParam(':start_date', $start_datetime, PDO::PARAM_STR);
            $stmt_total_payment->bindParam(':end_date', $end_datetime, PDO::PARAM_STR);
            $stmt_total_payment->execute();
            $total_payment = $stmt_total_payment->fetch(PDO::FETCH_ASSOC)['total_payment'];
        }
    }
    else{
        $sql = "SELECT order_id, name, contact_number, address, date, quantity,price, (o.quantity * t.price) AS total_price, rider, o.status_id, status_name, type_name FROM orders o
        JOIN status s ON o.status_id = s.status_id
        JOIN type t ON o.type_id = t.type_id
        WHERE o.status_id = 4";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql_total_payment = "SELECT SUM(payment) AS total_payment FROM orders WHERE status_id=4";
        $stmt_total_payment = $conn->prepare($sql_total_payment);
        $stmt_total_payment->execute();
        $total_payment = $stmt_total_payment->fetch(PDO::FETCH_ASSOC)['total_payment'];
    }
	
    function validateDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
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
            <a class="navbar-brand ps-3" href="index.html">


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
                         
                            <a class="nav-link" href="adminindex.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                           
                            <a class="nav-link" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                                Orders
                            </a>

                            <a class="nav-link" href="stocks.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-seam-fill"></i></div>
                                Stock
                            </a>

                            <a class="nav-link" href="sales.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Sales
                            </a>

                             <a class="nav-link" href="expenses.php ">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Expenses
                            </a>
                            
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
                        <h1 class="mt-4">Sales : ₱ <?php echo number_format($total_payment, 2); ?></h1>                      
                        <ul class="navbar-nav ms-auto me-3 me-lg-4 d-flex align-items-">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-filter-circle-fill fs-2"></i> Filter by Date Range
                                </a>
                                <div class="dropdown-menu p-4" aria-labelledby="navbarDropdown">
                                    <form action="sales.php" method="GET">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </form>
                                </div>
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
                                            <th>Price</th>
                                            <th>Payment</th>
                                            <th>Type</th>
                                             <th>Status</th>
                                             <th>Rider</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact #</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Payment</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Rider</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($data as $row): ?>
                                        <tr>
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['contact_number']?></td>
                                            <td><?php echo $row['address']?></td>
                                            <td><?php echo $row['date']?></td>
                                            <td><?php echo $row['quantity']?></td>
                                            <td><?php echo $row['price']?></td>
                                            <td>₱ <?php echo $row['total_price']?></td>
                                            <td><?php echo $row['type_name']?></td>
                                            <td><?php echo $row['status_name']?></td>
                                            <td><?php echo $row['rider']?></td>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>