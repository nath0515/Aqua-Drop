<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
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
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav align-items-center">
                         
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                           
                            <a class="nav-link" href="orders.html">
                                <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                                Orders
                            </a>

                            <a class="nav-link" href="stocks.html">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-seam-fill"></i></div>
                                Stock
                            </a>

                            <a class="nav-link" href="sales.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Sales
                            </a>

                             <a class="nav-link" href="expenses.html">
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
                        <h1 class="mt-4">Orders</h1>
                       
                        <a href="all_orders.html" class="btn btn-primary mb-4 mt-3 me-2">All</a>
                        <a href="new_orders.html" class="btn btn-outline-primary mb-4 mt-3 ">New Orders</a>
                        <a href="Enroute.html" class="btn btn-outline-primary mb-4 mt-3 ">Enroute</a>
                        <a href="delivered.html" class="btn btn-outline-primary mb-4 mt-3 ">Delivered</a>
                       
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
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Rider</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $query = "SELECT * FROM orders";
                                        $result = mysqli_query($conn, $query);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo 
                                                "<tr>
                                                    <td>{$row['name']}</td>
                                                        <td>{$row['contact_number']}</td>
                                                        <td>{$row['address']}</td>
                                                        <td>{$row['date']}</td>
                                                        <td>{$row['quantity']}</td>
                                                        <td>{$row['type']}</td>
                                                        <td>{$row['status']}</td>
                                                        <td>{$row['rider']}</td>
                                                        <td class='text-center align-middle'>
                                                            <a href='edit_order.php?id={$row['id']}'><img src='icons/check.png' width='20' height='20' class='mx-auto d-block'></a>
                                                    </td>
                                                </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='9' class='text-center'>No orders found</td></tr>";
                                            }

                                            mysqli_close($conn);
                                            ?>
                                        <tr>
                                            <td>Klent Jylwen Garingers Jr.</td>
                                            <td>094697998891</td>
                                            <td>Pasong Putik Propper</td>
                                            <td>3/14/25</td>
                                            <td>10</td>
                                            <td>With Faucet</td>
                                            <td>Enroute</td>
                                            <td>Zach</td>
                                            <td class="text-center align-middle">
                                                <img src="icons/check.png" width="20" height="20" class="mx-auto d-block">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Klent Jylwen Garingers Jr.</td>
                                            <td>094697998891</td>
                                            <td>Pasong Putik Propper</td>
                                            <td>3/14/25</td>
                                            <td>10</td>
                                            <td>With Faucet</td>
                                            <td>New</td>
                                            <td>Zach</td>
                                            <td class="text-center align-middle">
                                                <img src="icons/check.png" width="20" height="20" class="mx-auto d-block">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Klent Jylwen Garingers Jr.</td>
                                            <td>094697998891</td>
                                            <td>Pasong Putik Propper</td>
                                            <td>3/14/25</td>
                                            <td>10</td>
                                            <td>With Faucet</td>
                                            <td>Delivered</td>
                                            <td>Zach</td>
                                            <td class="text-center align-middle">
                                                <img src="icons/check.png" width="20" height="20" class="mx-auto d-block">
                                            </td>
                                        </tr>
                                        </tr>
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
