<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Customers</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="row">
                <!-- Employee -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('employees') ?>" style="color: inherit; text-decoration: none;">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Employee</span>
                                <span class="info-box-number">
                                    <?= $total_employees ?>
                                    <small>orang</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- Publisher -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('publishers') ?>" style="color: inherit; text-decoration: none;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Publisher</span>
                                <span class="info-box-number"><?= $total_publishers ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- Transaksi -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('transaksi') ?>" style="color: inherit; text-decoration: none;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Transaksi</span>
                                <span class="info-box-number"><?= $total_transactions ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- Customers -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('customers') ?>" style="color: inherit; text-decoration: none;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Customers</span>
                                <span class="info-box-number"><?= $total_customers ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Penjualan</h3>
                                <!-- <a href="javascript:void(0);">View Report</a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">$<?= number_format($sales_statistics['current_month_sales'], 2) ?></span>
                                    <span>Sales Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-<?= ($sales_statistics['percentage_change'] >= 0) ? 'success' : 'danger' ?>">
                                        <i class="fas fa-arrow-<?= ($sales_statistics['percentage_change'] >= 0) ? 'up' : 'down' ?>"></i>
                                        <?= number_format(abs($sales_statistics['percentage_change']), 2) ?>%
                                    </span>
                                    <span class="text-muted">Sejak Bulan Lalu</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Tahun Ini
                                </span>

                                <span>
                                    <i class="fas fa-square text-gray"></i> Tahun Lalu
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart.js -->



                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Online Store Overview</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Sales Rate -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-up text-warning"></i> <?= number_format($sales_rate, 2) ?>%
                                    </span>
                                    <span class="text-muted">Rating Penjualan</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <!-- Registration Rate -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-people-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-down text-danger"></i> <?= number_format($registration_rate, 2) ?>%
                                    </span>
                                    <span class="text-muted">Rating Pendaftaran</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </section>


    <div>
        <br>
    </div>
</div>