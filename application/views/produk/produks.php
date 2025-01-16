         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Data Produks</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <?php if ($this->session->flashdata('success')): ?>
                         <div class="alert custom-alert-success alert-dismissible">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                             <?= $this->session->flashdata('success') ?>
                         </div>
                     <?php endif; ?>

                     <?php if ($this->session->flashdata('error')): ?>
                         <div class="alert custom-alert-danger alert-dismissible">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             <h5><i class="icon far fa-question-circle"></i> Mohon Diperhatikan!</h5>
                             <?= $this->session->flashdata('error') ?>
                         </div>
                     <?php endif; ?>

                     <div class="row">
                         <div class="col-12">

                             <div class="card">
                                 <div class="card-header">
                                     <h3 class="card-title">List Data Produk Terdaftar</h3>

                                     <button type="button" class="btn btn-sm btn-primaryku float-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus-circle"></i> Add Produks</button>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body p-0">
                                     <div class="table-responsive">
                                         <table class="table table-hover ">
                                             <thead>
                                                 <tr>
                                                     <th style="width: 10px">#</th>
                                                     <th>Nama Produk/Buku</th>
                                                     <th>Deskripsi</th>
                                                     <th style="width: 80px">Penerbit</th>
                                                     <th style="width: 60px">Price</th>
                                                     <th style="width: 30px">Qty</th>
                                                     <th></th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1;
                                                    foreach ($product as $p) { ?>
                                                     <tr>
                                                         <td><?= $no++; ?></td>
                                                         <td><?= $p->nama_produk ?></td>
                                                         <td><?= $p->description ?></td>
                                                         <td><?= $p->nama_publisher ?></td>
                                                         <td>
                                                             <?= $p->price ?>
                                                         </td>
                                                         <td><?= $p->qty ?></td>
                                                         <td>
                                                             <button class="btn btn-sm btn-info btn-edit" data-id="<?= $p->id ?>" data-name="<?= $p->nama_produk ?>" data-publisher="<?= $p->publisher_id ?>" data-description="<?= $p->description ?>" data-price="<?= $p->price ?>" data-qty="<?= $p->qty ?>">
                                                                 <i class="fas fa-edit"></i>
                                                             </button>

                                                             <button class="btn btn-sm btn-dangerku btn-delete" data-id="<?= $p->id ?>">
                                                                 <i class="fas fa-trash"></i>
                                                             </button>
                                                         </td>
                                                     </tr>
                                                 <?php } ?>

                                             </tbody>
                                         </table>
                                         <div class="mt-3">
                                             <?= $pagination; ?>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- /.card-body -->
                             </div>
                             <!-- /.card -->

                         </div>
                     </div>

                 </div>
             </section>


             <div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content modal">
                         <div class="modal-header">
                             <h4 class="modal-title" id="standard-modalLabel">Form Add Data Produks</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         </div>
                         <div class="modal-body">
                             <form class="form-horizontal" method="post" action="<?= base_url('produks/act') ?>" enctype="multipart/form-data">
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Nama Produk</label>
                                     <div class="col-9">
                                         <input type="text" name="name" class="form-control" placeholder="Nama Produk" required>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Publishers</label>
                                     <div class="col-9">
                                         <select class="form-control" name="publisher_id" required>
                                             <option value="">Pilih Publisher</option>
                                             <?php foreach ($publisher as $p) { ?>
                                                 <option value="<?= $p->id ?>"><?= $p->name ?></option>
                                             <?php } ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Deskripsi</label>
                                     <div class="col-9">
                                         <textarea name="description" id="description" rows="3" cols="3" class="form-control" required placeholder="Type deskripsi"></textarea>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Price</label>
                                     <div class="col-9">
                                         <input type="number" name="price" class="form-control" placeholder="Type number" required>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Qty</label>
                                     <div class="col-9">
                                         <input type="number" name="qty" class="form-control" placeholder="Type number" required>
                                     </div>
                                 </div>

                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Nama Produk</label>
                                     <div class="col-9">
                                         <input type="file" name="image" class="form-control" accept="image/*" required>
                                     </div>
                                 </div>

                         </div>
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                             <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                         </div>
                         </form>
                     </div><!-- /.modal-content -->
                 </div><!-- /.modal-dialog -->
             </div><!-- /.modal -->


             <!-- Modal Edit -->
             <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content modal">
                         <div class="modal-header">
                             <h4 class="modal-title" id="edit-modalLabel">Form Edit Data Produk</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         </div>
                         <div class="modal-body">
                             <form class="form-horizontal" method="post" action="<?= base_url('produks/update') ?>" enctype="multipart/form-data">
                                 <input type="hidden" name="id" id="edit-id">
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Nama Produk</label>
                                     <div class="col-9">
                                         <input type="text" name="name" id="edit-name" class="form-control" placeholder="Nama Produk" required>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Publishers</label>
                                     <div class="col-9">
                                         <select class="form-control" name="publisher_id" id="edit-publisher" required>
                                             <option value="">Pilih Publisher</option>
                                             <?php foreach ($publisher as $p) { ?>
                                                 <option value="<?= $p->id ?>"><?= $p->name ?></option>
                                             <?php } ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Deskripsi</label>
                                     <div class="col-9">
                                         <textarea name="description" id="edit-description" rows="3" cols="3" class="form-control" required placeholder="Type deskripsi"></textarea>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Price</label>
                                     <div class="col-9">
                                         <input type="number" name="price" id="edit-price" class="form-control" placeholder="Type number" required>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Qty</label>
                                     <div class="col-9">
                                         <input type="number" name="qty" id="edit-qty" class="form-control" placeholder="Type number" required>
                                     </div>
                                 </div>
                                 <div class="form-group row mb-3">
                                     <label class="col-3 col-form-label">Gambar</label>
                                     <div class="col-9">
                                         <input type="file" name="image" class="form-control" accept="image/*">
                                         <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                     </div>
                                 </div>
                         </div>
                         <div class="modal-footer">
                             <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                             <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                         </div>
                         </form>
                     </div><!-- /.modal-content -->
                 </div><!-- /.modal-dialog -->
             </div><!-- /.modal -->



             <!-- Modal Delete -->
             <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content modal">
                         <div class="modal-header">
                             <h4 class="modal-title" id="delete-modalLabel">Konfirmasi Hapus Data</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         </div>
                         <div class="modal-body">
                             <p id="delete-message">Apakah Anda yakin ingin menghapus data ini?</p>
                             <p id="delete-error" class="text-danger" style="display: none;">Data tidak dapat dihapus karena digunakan di tabel lain.</p>
                         </div>
                         <div class="modal-footer">
                             <form id="delete-form" method="post" action="<?= base_url('produks/delete') ?>">
                                 <input type="hidden" name="id" id="delete-id">
                                 <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                 <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                             </form>
                         </div>
                     </div><!-- /.modal-content -->
                 </div><!-- /.modal-dialog -->
             </div><!-- /.modal -->


             <div>
                 <br>
             </div>
         </div>