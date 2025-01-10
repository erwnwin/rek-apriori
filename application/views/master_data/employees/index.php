         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Data Employees</h1>
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
                                     <h3 class="card-title">Daftar Employees</h3>

                                     <!-- <button type="button" class="btn btn-sm btn-primaryku float-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus-circle"></i> Add New</button> -->
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body p-0">
                                     <div class="table-responsive">
                                         <table class="table table-hover ">
                                             <thead>
                                                 <tr>
                                                     <th style="width: 10px">#</th>
                                                     <th>First Name</th>
                                                     <th>Last Name</th>
                                                     <th>Username</th>
                                                     <th>Number Phone</th>
                                                     <th>Address</th>
                                                     <th>Status</th>
                                                     <th></th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $no = 1;
                                                    foreach ($employes as $p) { ?>
                                                     <tr>
                                                         <td><?= $no++; ?></td>
                                                         <td><?= $p->first_name ?></td>
                                                         <td><?= $p->last_name ?></td>
                                                         <td><?= $p->username ?></td>
                                                         <td><?= $p->phone ?></td>
                                                         <td><?= $p->address ?></td>
                                                         <td>
                                                             <?php if ($p->status == '1') { ?>
                                                                 <span class="badge bg-success"><i class="fas fa-check-circle"></i> Aktif</span>
                                                             <?php } else { ?>
                                                                 <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Non Aktif</span>
                                                             <?php } ?>
                                                         </td>
                                                         <td>
                                                             <!-- <button class="btn btn-sm btn-danger" disabled><i class="fas fa-times-circle"></i> No Action Here</button> -->
                                                             <!-- <button class="btn btn-sm btn-dangerku"><i class="fas fa-trash"></i></button> -->
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