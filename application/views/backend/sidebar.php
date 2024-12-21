 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="<?= base_url('dashboard') ?>" class="brand-link">
         <!-- <img src="<?= base_url() ?>public/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
         <center>
             <span class="brand-text font-weight-light text-center" style="text-align: center;"><strong> Katalindo Medikarya Utama
                 </strong></span>
         </center>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user (optional) -->
         <div class="user-panel mt-3 pb-3  d-flex">
             <div class="image">
                 <img src="<?= base_url() ?>public/user.png" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="<?= base_url('profile') ?>" class="d-block"><?= ucfirst(strtolower($this->session->userdata('first_name'))) ?> <?= ucfirst(strtolower($this->session->userdata('last_name'))) ?>
                 </a>
             </div>
         </div>


         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">




                 <li class="nav-header ">Admin</li>

                 <li class="nav-item">
                     <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
                         <!-- <i class="nav-icon fas fa-th-large"></i> -->
                         <svg width="17px" height="17px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                             <title>dashboard</title>
                             <desc>Created with Sketch.</desc>
                             <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <g id="Rounded" transform="translate(-341.000000, -245.000000)">
                                     <g id="Action" transform="translate(100.000000, 100.000000)">
                                         <g id="-Round-/-Action-/-dashboard" transform="translate(238.000000, 142.000000)">
                                             <g>
                                                 <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                                 <path d="M4,13 L10,13 C10.55,13 11,12.55 11,12 L11,4 C11,3.45 10.55,3 10,3 L4,3 C3.45,3 3,3.45 3,4 L3,12 C3,12.55 3.45,13 4,13 Z M4,21 L10,21 C10.55,21 11,20.55 11,20 L11,16 C11,15.45 10.55,15 10,15 L4,15 C3.45,15 3,15.45 3,16 L3,20 C3,20.55 3.45,21 4,21 Z M14,21 L20,21 C20.55,21 21,20.55 21,20 L21,12 C21,11.45 20.55,11 20,11 L14,11 C13.45,11 13,11.45 13,12 L13,20 C13,20.55 13.45,21 14,21 Z M13,4 L13,8 C13,8.55 13.45,9 14,9 L20,9 C20.55,9 21,8.55 21,8 L21,4 C21,3.45 20.55,3 20,3 L14,3 C13.45,3 13,3.45 13,4 Z" id="🔹Icon-Color" fill="#ffffff"></path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </g>
                         </svg>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>

                 <li class="nav-item <?= $this->uri->segment(1) == 'employees' || $this->uri->segment(1) == 'customers' || $this->uri->segment(1) == 'publishers' || $this->uri->segment(1) == 'regions' || $this->uri->segment(1) == 'banks' ? 'menu-open' : '' ?>">
                     <a href="#" class="nav-link <?= $this->uri->segment(1) == 'employees' || $this->uri->segment(1) == 'customers' || $this->uri->segment(1) == 'publishers' || $this->uri->segment(1) == 'regions' || $this->uri->segment(1) == 'banks' ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-database"></i>
                         <p>
                             Master Data
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="<?= base_url('publishers') ?>" class="nav-link <?= $this->uri->segment(1) == 'publishers' ? 'active' : '' ?>">
                                 <i class="far fa-check-circle nav-icon"></i>
                                 <p>Publisher</p>
                             </a>
                         </li>


                         <li class="nav-item">
                             <a href="<?= base_url('regions') ?>" class="nav-link <?= $this->uri->segment(1) == 'regions' ? 'active' : '' ?>">
                                 <i class="far fa-check-circle nav-icon"></i>
                                 <p>Region</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="<?= base_url('banks') ?>" class="nav-link <?= $this->uri->segment(1) == 'banks' ? 'active' : '' ?>">
                                 <i class="far fa-check-circle nav-icon"></i>
                                 <p>Bank</p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="<?= base_url('customers') ?>" class="nav-link <?= $this->uri->segment(1) == 'customers' ? 'active' : '' ?>">
                                 <i class="far fa-check-circle nav-icon"></i>
                                 <p>Customer</p>
                             </a>
                         </li>


                         <li class="nav-item">
                             <a href="<?= base_url('employees') ?>" class="nav-link <?= $this->uri->segment(1) == 'employees' ? 'active' : '' ?>">
                                 <i class="far fa-check-circle nav-icon"></i>
                                 <p>Employee</p>
                             </a>
                         </li>

                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('produks') ?>" class="nav-link <?= $this->uri->segment(1) == 'produks' ? 'active' : '' ?>">

                         <i class="nav-icon fas fa-book"></i>
                         <p>
                             Produk
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('profile') ?>" class="nav-link <?= $this->uri->segment(1) == 'profile' ? 'active' : '' ?>">

                         <i class="nav-icon fas fa-user-circle"></i>
                         <p>
                             Profile Account
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('logout') ?>" class="nav-link">
                         <i class="nav-icon fas fa-power-off"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                 </li>

                 <li class="nav-header ">Algoritma Apriori</li>
                 <li class="nav-item">
                     <a href="<?= base_url('transaksi') ?>" class="nav-link <?= $this->uri->segment(1) == 'transaksi' ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-file-alt"></i>
                         <p>
                             History Transaksi
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('proses-apriori') ?>" class="nav-link <?= $this->uri->segment(1) == 'proses-apriori' ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-calculator"></i>
                         <p>
                             Proses Apriori
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('hasil') ?>" class="nav-link <?= $this->uri->segment(1) == 'hasil' ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-poll"></i>
                         <p>
                             Hasil
                         </p>
                     </a>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>