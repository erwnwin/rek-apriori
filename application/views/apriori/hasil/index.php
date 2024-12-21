         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Hasil Algoritma Apriori : Tahapan</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <!-- <div class="row">
                         <div class="col-md-12 text-right">
                             <a href="<?= base_url('hasil/export') ?>" class="btn btn-success">
                                 <i class="fas fa-file-excel"></i> Export ke Excel
                             </a>
                         </div>
                     </div> -->

                     <div class="row">
                         <div class="col-12">
                             <div class="card card-successku">
                                 <div class="card-header">
                                     <h3 class="card-title">Tahap 1 ~ Menampilkan Transaksi</h3>

                                     <div class="card-tools">
                                         <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-minus"></i>
                                         </button> -->
                                         <form action="<?= base_url('hasil/export') ?>" method="POST">
                                             <button type="submit" class="btn btn-primaryku btn-sm">
                                                 <i class="fas fa-file-excel"></i> Export ke Excel
                                             </button>
                                             <!-- <button type="submit" class="btn btn-sm btn-primaryku"></button> -->
                                         </form>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <table class="table table-bordered table-hover">
                                         <thead>
                                             <th>ID Transaksi</th>
                                             <th>ID Produk</th>
                                         </thead>
                                         <tbody>
                                             <?php foreach ($transactions as $id_trans => $products): ?>
                                                 <tr>
                                                     <td><?= $id_trans; ?></td>
                                                     <td><?= implode(', ', $products); ?></td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>

                             <!-- Tahap 2 -->
                             <div class="card card-dangerku">
                                 <div class="card-header">
                                     <h3 class="card-title">Tahap 2 ~ Menghitung Jumlah Qty Setiap Produk</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-minus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <table class="table table-bordered  table-hover">
                                         <thead>
                                             <th>ID Produk</th>
                                             <th>Qty</th>
                                         </thead>
                                         <tbody>
                                             <?php foreach ($product_support as $product_id => $support): ?>
                                                 <tr>
                                                     <td><?= $product_id; ?></td>
                                                     <td><?= round($support * count($transactions)); ?></td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>

                             <!-- Tahap 3 -->
                             <div class="card card-primaryku">
                                 <div class="card-header">
                                     <h3 class="card-title">Tahap 3 ~ Menghitung Support Setiap Produk</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-minus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <table class="table table-hover table-hpver">
                                         <thead class="bg-secondaru">
                                             <th>ID Produk</th>
                                             <th>Support</th>
                                         </thead>
                                         <tbody>
                                             <?php foreach ($product_support as $product_id => $support): ?>
                                                 <tr>
                                                     <td><?= $product_id; ?></td>
                                                     <td><?= round($support, 2); ?></td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>


                             <!-- Tahap 4 -->
                             <div class="card card-infoku">
                                 <div class="card-header">
                                     <h3 class="card-title">Tahap 4 ~ Kombinasi Produk yang Lolos</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-minus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <table class="table table-bordered table-hover">
                                         <thead>
                                             <th>No</th>
                                             <th>Kombinasi Produk</th>
                                         </thead>
                                         <tbody>
                                             <?php $no = 1;
                                                foreach ($pair_support as $pair => $count): ?>
                                                 <tr>
                                                     <td><?= $no++; ?></td>
                                                     <td><?= $pair; ?></td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>

                             <!-- Tahap 5 -->
                             <div class="card card-warningku">
                                 <div class="card-header">
                                     <h3 class="card-title">Tahap 5 ~ Menghitung Jumlah Transaksi Kombinasi</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-minus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <table class="table table-sm table-hover table-bordered">
                                         <thead>
                                             <th>Kombinasi Produk</th>
                                             <th>Jumlah Transaksi</th>
                                         </thead>
                                         <tbody>
                                             <?php foreach ($pair_support as $pair => $count): ?>
                                                 <tr>
                                                     <td><?= $pair; ?></td>
                                                     <td><?= $count; ?></td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>

                             <!-- Tahap 4 -->
                             <div class=" card card-secondaryku">
                                 <div class="card-header">
                                     <h3 class="card-title">Tahap 6 ~ Menghitung Confidence</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-minus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <table class="table table-bordered table-hover">
                                         <thead>
                                             <th>Produk Utama</th>
                                             <th>Rekomendasi Produk</th>
                                             <th>Confidence (%)</th>
                                         </thead>
                                         <tbody>
                                             <?php foreach ($recommendations_with_names as $recommendation): ?>
                                                 <tr>
                                                     <td><?= htmlspecialchars($recommendation['product_main']) ?></td>
                                                     <td><?= htmlspecialchars($recommendation['recommendation']) ?></td>
                                                     <td><?= number_format($recommendation['confidence'], 2) ?>%</td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
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