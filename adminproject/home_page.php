<?php
  session_start();
  include('include/header.php');
  include('include/sidebar.php');
  include('include/config.php');
  if(isset($_SESSION['logined'])&& isset($_SESSION['roleid'])){
$sql="SELECT
  (SELECT MAX(id) FROM register) AS max_register_id,
  (SELECT COUNT(*) FROM register WHERE status = 0) AS count_status_zero,
  (SELECT MAX(id) FROM password_reset) AS max_password_reset_id
FROM dual";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $maxId = $row['max_register_id'];
    $countStatusZero = $row['count_status_zero'];
    $passwordResetId = $row['max_password_reset_id'];
} else {
    echo "Error: " . mysqli_error($connection);
    }
  }

?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="container">
            <div class="row">

                <div class="col-lg-4 mt-3">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4" style="height: 200px;color:white;">
                            <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0 text-white">Clients</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        <?php echo $maxId; ?>
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-4 mt-3">
                    <div class="card l-bg-blue-dark">
                        <div class="card-statistic-3 p-4" style="height: 200px;color:white;">
                            <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0 text-white">Active Users</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        <?php echo $countStatusZero; ?>
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4 mt-3">
                    <div class="card l-bg-green-dark">
                        <div class="card-statistic-3 p-4" style="height: 200px;color:white;">
                            <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0 text-white">Ticket Resolved</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        <?php echo $passwordResetId;?>
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>10% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php
include ('include/footer.php');
?>