         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Tahapan Algoritma Apriori</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <div class="row">
                         <div class="col-12">

                             <div class="alert custom-alert-success alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                 <h5><i class="icon fas fa-info-circle"></i>Informasi!</h5>
                                 Berikut adalah tahapan-tahapan dalam PENERAPAN atau <b>IMPLEMENTASI ALGORITMA APRIORI</b>! Silahkan klik icon plus (<small><i class="fas fa-plus"></i></small>)
                             </div>
                             <!-- Tahap 1 -->
                             <div class="card collapsed-card card-aprioriku">
                                 <div class="card-header text-white">
                                     <h3 class="card-title">Tahap 1 ~ Menampilkan Transaksi</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-plus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <div class="alert custom-alert-danger alert-dismissible alert-custom">
                                         Pada tahap ini, data transaksi diambil dari tabel database. Data berisi daftar ID transaksi dan ID produk yang dibeli dalam transaksi tersebut.!
                                         <br>
                                         <strong>Contoh:</strong> ID transaksi 1 -> Produk: 101, 102 dan juga pada tabel berikut
                                         <hr>
                                         <table class="table table-bordered table-sm table-hover">
                                             <thead class="bg-danger">
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
                             </div>

                             <!-- Tahap 2 -->
                             <div class="card collapsed-card card-aprioriku">
                                 <div class="card-header text-white">
                                     <h3 class="card-title">Tahap 2 ~ Menghitung Jumlah Qty Setiap Produk</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-plus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <div class="alert custom-alert-danger alert-dismissible alert-custom">
                                         <strong>Rumus:</strong>
                                         \[
                                         \text{Qty}(P) = \sum_{T} (\text{Jumlah Produk dalam Transaksi})
                                         \]
                                         Di mana \( P \) adalah ID Produk dan \( T \) adalah ID Transaksi.
                                         <hr>
                                         <table class="table table-bordered table-sm table-hover">
                                             <thead class="bg-danger">
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
                             </div>

                             <!-- Tahap 3 -->
                             <div class="card collapsed-card card-aprioriku">
                                 <div class="card-header text-white">
                                     <h3 class="card-title">Tahap 3 ~ Menghitung Support Setiap Produk</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-plus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <div class="alert custom-alert-danger alert-dismissible alert-custom">
                                         <strong>Rumus:</strong>
                                         \[
                                         \text{Support}(P) = \frac{\text{Qty}(P)}{\text{Total Transaksi}}
                                         \]
                                         Di mana \( P \) adalah produk dan support dihitung sebagai persentase jumlah transaksi yang mengandung produk tersebut.
                                         <hr>
                                         <table class="table table-bordered table-sm table-hover">
                                             <thead class="bg-danger">
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
                             </div>


                             <!-- Tahap 4 -->
                             <div class="card collapsed-card card-aprioriku">
                                 <div class="card-header text-white">
                                     <h3 class="card-title">Tahap 4 ~ Kombinasi Produk yang Lolos</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-plus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <div class="alert custom-alert-danger alert-dismissible alert-custom">
                                         <strong>Rumus Kombinasi:</strong>
                                         Kombinasi dihitung dengan menghasilkan semua pasangan produk:
                                         \[
                                         \text{Kombinasi}(P) = \binom{n}{k}
                                         \]
                                         Di mana \( n \) adalah jumlah produk yang memenuhi support minimum.
                                         <hr>
                                         <table class="table table-bordered table-sm table-hover">
                                             <thead class="bg-danger">
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
                             </div>

                             <!-- Tahap 5 -->
                             <div class="card collapsed-card card-aprioriku">
                                 <div class="card-header text-white">
                                     <h3 class="card-title">Tahap 5 ~ Menghitung Jumlah Transaksi Kombinasi</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-plus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <div class="alert custom-alert-danger alert-dismissible alert-custom">
                                         <strong>Deskripsi:</strong> Pada tahap ini, setiap kombinasi dihitung jumlah transaksinya.
                                         <hr>
                                         <table class="table table-bordered table-sm table-hover">
                                             <thead class="bg-danger">
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
                             </div>

                             <!-- Tahap 4 -->
                             <div class="card collapsed-card card-aprioriku">
                                 <div class="card-header text-white">
                                     <h3 class="card-title">Tahap 6 ~ Menghitung Confidence</h3>

                                     <div class="card-tools">
                                         <button type="button" class="btn btn-tool text-white" data-card-widget="collapse" title="Collapse">
                                             <i class="fas fa-plus"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <div class="alert custom-alert-danger alert-dismissible alert-custom">
                                         <p>
                                             <strong>Rumus:</strong>
                                             \[
                                             \text{Confidence}(A \Rightarrow B) = \frac{\text{Jumlah Kombinasi}(A,B)}{\text{Qty}(A)} \times 100\%
                                             \]
                                             Di mana \( A \) adalah produk utama dan \( B \) adalah produk rekomendasi.
                                         </p>
                                         <p>
                                             <strong>Deskripsi:</strong> Confidence dihitung untuk merekomendasikan produk berdasarkan kombinasi produk.
                                         </p>
                                         <hr>
                                         <table class="table table-bordered table-sm table-hover">
                                             <thead class="bg-danger">
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

                 </div>
             </section>


             <div>
                 <br>
             </div>
         </div>