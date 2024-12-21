         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Data Publisher</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <div class="row">
                         <div class="col-12">

                             <div class="card">
                                 <div class="card-header">
                                     <h3 class="card-title">List Data Publisher</h3>

                                     <button type="button" class="btn btn-sm btn-primaryku float-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus-circle"></i> Add New</button>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body p-0">
                                     <div class="table-responsive">
                                         <table class="table table-hover ">
                                             <thead>
                                                 <tr>
                                                     <th style="width: 10px">#</th>
                                                     <th>Nama Publisher</th>
                                                     <th>Deskripsi</th>
                                                     <th></th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1;
                                                    foreach ($publisher as $p) { ?>
                                                     <tr>
                                                         <td><?= $no++; ?></td>
                                                         <td><?= $p->name ?></td>
                                                         <td><?= $p->description ?></td>
                                                         <td>
                                                             <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                                                             <button class="btn btn-sm btn-dangerku"><i class="fas fa-trash"></i></button>
                                                         </td>
                                                     </tr>
                                                 <?php } ?>

                                             </tbody>
                                         </table>
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