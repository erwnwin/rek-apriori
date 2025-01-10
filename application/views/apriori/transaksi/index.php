         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>History Transaksi</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <div class="row">
                         <div class="col-12">
                             <div class="alert custom-alert-danger alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                 <h5><i class="icon far fa-question-circle"></i>Mohon Diperhatikan!</h5>
                                 Data transaksi berikut adalah data yang diolah untuk proses rekomendasi produk dengan <b>IMPLEMENTASI ALGORITMA APRIORI</b>!
                             </div>

                             <div class="card">
                                 <div class="card-body">
                                     <div class="row align-items-center mb-3">
                                         <!-- Search Bar -->
                                         <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                                             <label for="" class="d-block">Keyword</label>
                                             <input type="text" id="search_input" class="form-control form-control-sm" placeholder="Cari Nama atau Tanggal (YYYY-MM-DD)">
                                         </div>

                                         <!-- Filter Form -->
                                         <div class="col-lg-8 col-md-6 col-sm-12">
                                             <form id="filter-form" class="row">
                                                 <div class="col-md-4 col-sm-6 mb-2">
                                                     <label for="start_date" class="d-block">Start Date</label>
                                                     <input type="date" id="start_date" name="start_date" class="form-control form-control-sm">
                                                 </div>
                                                 <div class="col-md-4 col-sm-6 mb-2">
                                                     <label for="end_date" class="d-block">End Date</label>
                                                     <input type="date" id="end_date" name="end_date" class="form-control form-control-sm">
                                                 </div>
                                                 <div class="col-md-4 col-sm-12 mb-2">
                                                     <label for="status_filter" class="d-block">Status Pengiriman</label>
                                                     <select id="status_filter" name="status_filter" class="form-control form-control-sm">
                                                         <option value="">All</option>
                                                         <option value="pending_kirim">Pending</option>
                                                         <option value="kirim">Kirim</option>
                                                         <option value="selesai">Selesai</option>
                                                     </select>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                     <!-- Export Buttons -->
                                     <div class="row ">
                                         <div class="col-md-6 mb-1">
                                             <button id="export_pdf" class="btn btn-primaryku btn-block btn-sm" hidden>
                                                 <i class="fas fa-file-pdf"></i> Export to PDF
                                             </button>
                                         </div>
                                         <div class="col-md-6">
                                             <button id="export_excel" class="btn btn-info btn-block btn-sm" hidden>
                                                 <i class="fas fa-file-excel"></i> Export to Excel
                                             </button>
                                         </div>
                                     </div>

                                 </div>
                             </div>

                             <div class="card">
                                 <div class="card-header">
                                     <h3 class="card-title">History Transaksi</h3>

                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body p-0">
                                     <div class="table-responsive">
                                         <table class="table table-hover ">
                                             <thead>
                                                 <tr>
                                                     <th style="width: 10px">#</th>
                                                     <th>ID Transaksi</th>
                                                     <th>Nama Customer</th>
                                                     <th>Alamat Lengkap</th>
                                                     <th>Tanggal Transaksi</th>
                                                     <th>Status Transaksi</th>
                                                     <th>Status Kirim</th>
                                                     <th></th>
                                                 </tr>
                                             </thead>
                                             <!-- <tbody id="transaction_table">
                                             </tbody> -->
                                             <tbody id="transaction_table">
                                                 <?php if (!empty($transaksi)) : ?>
                                                     <?php foreach ($transaksi as $index => $t) : ?>
                                                         <tr>
                                                             <td><?= $index + 1; ?></td>
                                                             <td><?= $t->id_transaction; ?></td>
                                                             <td><?= $t->first_name . ' ' . $t->last_name; ?></td>
                                                             <td><?= $t->address; ?></td>
                                                             <td><?= $t->tgl_transaksi; ?></td>
                                                             <td>
                                                                 <?php
                                                                    switch ($t->status) {
                                                                        case 'pending':
                                                                            echo '<span class="badge bg-warning"><i class="fas fa-hourglass-half"></i> Pending</span>';
                                                                            break;
                                                                        case 'settlement':
                                                                            echo '<span class="badge bg-success"><i class="fas fa-check-circle"></i> Settlement</span>';
                                                                            break;
                                                                        default:
                                                                            echo '<span class="badge bg-secondary"><i class="fas fa-info-circle"></i> Unknown</span>';
                                                                            break;
                                                                    }
                                                                    ?>

                                                             </td>
                                                             <td>
                                                                 <?php
                                                                    switch ($t->status_kirim) {
                                                                        case 'pending_kirim':
                                                                            echo '<span class="badge bg-warning"><i class="fas fa-hourglass-half"></i> Pending Kirim</span>';
                                                                            break;
                                                                        case 'kirim':
                                                                            echo '<span class="badge bg-info"><i class="fas fa-check-circle"></i> Dikirim</span>';
                                                                            break;
                                                                        case 'selesai':
                                                                            echo '<span class="badge bg-success"><i class="fas fa-check-circle"></i> Selesai</span>';
                                                                            break;
                                                                    }
                                                                    ?>

                                                             </td>
                                                             <td>
                                                                 <a href="<?= base_url('transaksi/detail/' . $t->id_transaction); ?>" class="btn btn-sm btn-outline-info">Detail</a>
                                                             </td>
                                                         </tr>
                                                     <?php endforeach; ?>
                                                 <?php else : ?>
                                                     <tr>
                                                         <td colspan="7" class="text-center">Tidak ada data</td>
                                                     </tr>
                                                 <?php endif; ?>

                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="mt-3">
                                         <?= $pagination; ?>
                                     </div>
                                 </div>
                                 <!-- /.card-body -->
                             </div>
                             <!-- /.card -->



                         </div>
                     </div>

                 </div>
             </section>
             <div>
                 <br>
             </div>
         </div>