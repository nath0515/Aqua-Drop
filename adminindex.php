<?php 
	require ('session.php');
	require ('db.php');

    $sql = "SELECT * FROM sales";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_total_payment = "SELECT SUM(payment) AS total_payment FROM sales";
    $stmt_total_payment = $conn->prepare($sql_total_payment);
    $stmt_total_payment->execute();
    $total_payment = $stmt_total_payment->fetch(PDO::FETCH_ASSOC)['total_payment'];

    // Prepare arrays for the chart
    $dates = [];
    $payments = [];
    
    // Temporary array to store the sum of payments by date
    $datePayments = [];
    
    foreach ($data as $row) {
        // Format the timestamp into "Mar 1" format (also for sorting purposes)
        $formatted_date = date('Y-m-d', strtotime($row['date'])); // Sortable format (e.g., 2025-03-01)
        
        // If the date already exists in the array, add the payment
        if (isset($datePayments[$formatted_date])) {
            $datePayments[$formatted_date] += $row['payment'];
        } else {
            $datePayments[$formatted_date] = $row['payment'];
        }
    }

    // Sort the dates (ascending order)
    ksort($datePayments); // ksort sorts by keys (dates) in ascending order

    // Now, fill the dates and payments arrays from the aggregated results
    foreach ($datePayments as $date => $total_payment) {
        // Convert the sorted date to a more readable format (e.g., "Mar 1")
        $formatted_date_display = date('M j', strtotime($date)); // Display format (e.g., "Mar 1")
        $dates[] = $formatted_date_display;
        $payments[] = $total_payment;
    }

    $sql = "SELECT * FROM expenses";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_total_amounts = "SELECT SUM(amount) AS total_amount FROM expenses";
    $stmt_total_amounts = $conn->prepare($sql_total_amounts);
    $stmt_total_amounts->execute();
    $total_amounts = $stmt_total_amounts->fetch(PDO::FETCH_ASSOC)['total_amount'];

    // Prepare arrays for the chart
    $dates = [];
    $amounts = [];
    
    // Temporary array to store the sum of payments by date
    $dateAmounts = [];
    
    foreach ($data1 as $row) {
        // Format the timestamp into "Mar 1" format (also for sorting purposes)
        $formatted_date = date('Y-m-d', strtotime($row['date'])); // Sortable format (e.g., 2025-03-01)
        
        // If the date already exists in the array, add the payment
        if (isset($dateAmounts[$formatted_date])) {
            $dateAmounts[$formatted_date] += $row['amount'];
        } else {
            $dateAmounts[$formatted_date] = $row['amount'];
        }
    }

    // Sort the dates (ascending order)
    ksort($dateAmounts); // ksort sorts by keys (dates) in ascending order

    // Now, fill the dates and payments arrays from the aggregated results
    foreach ($dateAmounts as $date => $total_amount) {
        // Convert the sorted date to a more readable format (e.g., "Mar 1")
        $formatted_date_display = date('M j', strtotime($date)); // Display format (e.g., "Mar 1")
        $dates[] = $formatted_date_display;
        $amounts[] = $total_amount;
    }

    $allDates = array_unique(array_merge(array_keys($datePayments), array_keys($dateAmounts)));
    sort($allDates);

    $dates = [];
    $income = [];
    foreach ($allDates as $date) {
        $payment = isset($datePayments[$date]) ? $datePayments[$date] : 0;
        $amount = isset($dateAmounts[$date]) ? $dateAmounts[$date] : 0;
        $dates[] = date('M j', strtotime($date)); // Display format "Mar 1"
        $income[] = $payment - $amount;
    }

    $total_income = $total_payment - $total_amount;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Homepage</title>
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
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
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
                         
                            <a class="nav-link" href="adminindex.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                           
                            <a class="nav-link" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                                Orders
                            </a>

                            <a class="nav-link" href="stocks.html">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-seam-fill"></i></div>
                                Stock
                            </a>

                            <a class="nav-link" href="sales.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Sales
                            </a>

                             <a class="nav-link" href="expenses.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Expenses
                            </a>
                            
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
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Good Afternoon, Admin</h1>
                        <ol class="breadcrumb mb-4">
                            
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body" style="font-size: 25px;">Sales
                                        <ol class="breadcrumb">
                            
                                            ₱ <?php echo number_format($total_payment, 2);?>
                                        </ol>
                                    </div>
                                    
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="sales.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body" style="font-size: 25px;">Income
                                        <ol class="breadcrumb">
                                        ₱ <?php echo number_format($total_income, 2); ?>
                                        </ol>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body" style="font-size: 25px;">Expenses
                                        <ol class="breadcrumb">
                                            ₱ <?php echo number_format($total_amounts, 2); ?>
                                        </ol>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="expenses.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Sales
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Expenses
                                    </div>
                                    <div class="card-body"><canvas id="Expenses" width="100%" height="40"></canvas></div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Income
                                    </div>
                                    <div class="card-body"><canvas id="income" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                           
                            <div class="card-body">
                               
                                   
                                    
                                   
                               
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels:  <?php echo json_encode($dates); ?>,
                datasets: [{
                label: "Payments",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: <?php echo json_encode($payments); ?>,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: Math.min(...<?php echo json_encode($payments); ?>),
                    max: Math.max(...<?php echo json_encode($payments); ?>),
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });


            var ctx = document.getElementById("Expenses");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                label: "Amounts",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: <?php echo json_encode($amounts); ?>,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: Math.min(...<?php echo json_encode($amounts); ?>),
                    max: Math.max(...<?php echo json_encode($amounts); ?>),
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });

            var ctx = document.getElementById("income");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($allDates); ?>,
                datasets: [{
                label: "Income (Payment - Expenses)",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: <?php echo json_encode($income); ?>,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: Math.min(...<?php echo json_encode($income); ?>),
                    max: Math.max(...<?php echo json_encode($income); ?>),
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });
        </script>
    </body>
</html>
