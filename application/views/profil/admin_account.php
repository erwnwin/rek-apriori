         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Profil Account</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">


                     <div class="row">
                         <div class="col-md-2">
                         </div>
                         <div class="col-md-8">
                             <!-- Profile Image -->
                             <div class="card card-default card-outline">
                                 <div class="card-body box-profile">
                                     <div class="text-center">
                                         <img class="profile-user-img img-fluid img-circle"
                                             src="<?= base_url('assets/img/profile.png') ?>"
                                             alt="User profile picture">
                                     </div>

                                     <h3 class="profile-username text-center"><?= htmlspecialchars($user['first_name']) ?> <?= htmlspecialchars($user['last_name']) ?></h3>

                                     <p class="text-muted text-center">***************</p>

                                     <ul class="list-group list-group-unbordered mb-3">
                                         <li class="list-group-item">
                                             <b>Email</b> <a class="float-right"> <?= htmlspecialchars($user['email']) ?></a>
                                         </li>
                                         <li class="list-group-item">
                                             <b>Nomor HP</b> <a class="float-right"> <?= htmlspecialchars($user['phone']) ?></a>
                                         </li>
                                         <li class="list-group-item">
                                             <b>Dibuat pada</b> <a class="float-right"> <?= htmlspecialchars($user['create_at']) ?></a>
                                         </li>
                                     </ul>

                                     <a href="<?= base_url('profile/edit') ?>" class="btn btn-primaryku btn-block"><b>Edit Profile</b></a>
                                 </div>
                                 <!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                         </div>
                         <!-- /.col -->
                         <div class="col-md-2">
                         </div>

                     </div>

                 </div>
             </section>


             <div>
                 <br>
             </div>
         </div>