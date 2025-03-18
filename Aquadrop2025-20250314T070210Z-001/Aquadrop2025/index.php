<?php 
require ('session.php');
require ('db.php');
?>
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
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
       
        <a class="navbar-brand ps-3" href="home.html">Aquadrop</a>
       
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav ms-auto  me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.html">Settings</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="home.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="orders.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Orders
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Home</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Welcome to Aquadrop Dashboard</li>
                    </ol>
                    <div class="container mt-4">
                        <h2 class="text-center mb-4">Water Products</h2>
                       
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <img src="logo.png" alt="Boiled Water Logo" class="img-fluid mb-1" style="max-width: 150px;">
                                        <h3 class="card-title">Boiled Water</h3>
                                        <p class="card-text">Price: 40 Php</p>
                                        <div class="d-flex justify-content-center align-items-center mb-1">
                                            <button class="btn btn-secondary" onclick="updateQuantity('boiled', -1)">-</button>
                                            <span class="mx-3" id="boiled-qty">1</span>
                                            <button class="btn btn-secondary" onclick="updateQuantity('boiled', 1)">+</button>
                                        </div>
                                        <p class="total-price mt-2">Total: <span id="boiled-total">40.0</span> Php</p>
                                        <p class="text-muted">Payment Method: Cash on Delivery (COD) only</p>
                                        <button class="btn btn-primary order-button">Order</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <img src="logo.png" alt="Test Product Logo" class="img-fluid mb-3" style="max-width: 100px;">
                                        <h3 class="card-title">Test</h3>
                                        <p class="card-text">Price: 10 Php</p>
                                        <div class="d-flex justify-content-center align-items-center mb-2">
                                            <button class="btn btn-secondary" onclick="updateQuantity('test', -1)">-</button>
                                            <span class="mx-3" id="test-qty">1</span>
                                            <button class="btn btn-secondary" onclick="updateQuantity('test', 1)">+</button>
                                        </div>
                                        <p class="total-price mt-2">Total: <span id="test-total">10.0</span> Php</p>
                                        <p class="text-muted">Payment Method: Cash on Delivery (COD) only</p>
                                        <button class="btn btn-primary order-button">Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
