<div class="page-sidebar-wrapper">
       
       <div class="page-sidebar navbar-collapse collapse">

           <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
               <li class="nav-item">
                   <a href="index.php" class="nav-link nav-toggle">
                       <i class="icon-home"></i>
                       <span class="title">Dashboard</span>
                       <span class="selected"></span>
                       <span class="arrow open"></span>
                   </a>
               </li>
              
               <li class="nav-item  ">
                   <a href="#" class="nav-link nav-toggle">
                       <i class="icon-settings"></i>
                       <span class="title">Parameter</span>
                       <span class="arrow"></span>
                   </a>
                   <ul class="sub-menu">
                        <?php 
                       if ($_SESSION['leveluser']=='1'){
                       ?>
                       <!-- <li class="nav-item">
                           <a href="index.php?menu=modul_user" class="nav-link ">
                               <span class="title">User</span>
                           </a>
                       </li> -->
                       <li class="nav-item">
                           <a href="index.php?menu=modul_outlet" class="nav-link ">
                               <span class="title">Outlet</span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="index.php?menu=produk" class="nav-link ">
                               <span class="title">produk</span>
                           </a>
                       </li>
                       
                       <!-- <li class="nav-item">
                           <a href="index.php?menu=size" class="nav-link ">
                               <span class="title">Size</span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="index.php?menu=warna" class="nav-link ">
                               <span class="title">Warna</span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="index.php?menu=slide" class="nav-link ">
                               <span class="title">Slide</span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="index.php?menu=kurir" class="nav-link ">
                               <span class="title">Kurir</span>
                           </a>
                       </li> -->
                       <li class="nav-item">
                           <a href="disc.php?log=<?php echo $log;?>" class="nav-link ">
                               <span class="title">Setting diskon</span>
                           </a>
                       </li> 
                       <!-- <li class="nav-item">
                           <a href="size_chart.php?log=<?php echo $log;?>" class="nav-link ">
                               <span class="title">Setting Size Chart</span>
                           </a>
                       </li> -->
                       <li class="nav-item">
                           <a href="import_master.php" class="nav-link ">
                               <span class="title">Import Master</span>
                           </a>
                       </li>
                       <?php } ?>
                       <li class="nav-item">
                           <a href="index.php?menu=masterproduk" class="nav-link ">
                               <span class="title">Master produk</span>
                           </a>
                       </li>
                   </ul>
               </li>
               <?php 
                   if ($_SESSION['leveluser']=='1'){
               ?>
               <li class="nav-item">
                   <a href="#" class="nav-link nav-toggle">
                       <i class="icon-basket"></i>
                       <span class="title">Order</span>
                       <span class="arrow"></span>
                   </a>
                   <ul class="sub-menu">
                       <li class="nav-item">
                           <a href="not_confirm.php" class="nav-link ">
                               <span class="title">Belum Konfirmasi </span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="confirm.php" class="nav-link ">
                               <span class="title">Sudah Konfirmasi</span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="approve.php" class="nav-link ">
                               <span class="title">Sudah Approve</span>
                           </a>
                       </li>                         
                   </ul>
               </li>
               <?php } 
                       
               if ($_SESSION['leveluser']=='3'){
                       ?>
               <li class="nav-item">
                   <a href="#" class="nav-link nav-toggle">
                       <i class="icon-basket"></i>
                       <span class="title">Order Admin</span>
                       <span class="arrow"></span>
                   </a>
                   <ul class="sub-menu">
                       <li class="nav-item">
                           <a href="not_confirm_pusat.php" class="nav-link ">
                               <span class="title">Belum Konfirmasi </span>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="confirm_pusat.php" class="nav-link ">
                               <span class="title">Sudah konfirmasi</span>
                           </a>
                       </li>
                       <!-- <li class="nav-item">
                           <a href="approve_pusat.php" class="nav-link ">
                               <span class="title">Approved</span>
                           </a>
                       </li>          -->                
                   </ul>
               </li>
               
               <li class="nav-item  ">
                   <a href="?menu=modul_katalog" class="nav-link nav-toggle">
                       <i class="icon-layers"></i>
                       <span class="title">Member</span>
                       <span class="arrow"></span>
                   </a>
                   <ul class="sub-menu">
                       <li class="nav-item">
                           <a href="member.php" class="nav-link ">
                               <span class="title">Data member </span>
                           </a>
                       </li>
                       <!-- <li class="nav-item">
                           <a href="?menu=modul_katalog&kat=<?php echo $idkat;?>" class="nav-link ">
                               <span class="title">Testimonial</span>
                           </a>
                       </li>                                 -->
                   </ul>
               </li>
               <?php } ?>
               <!-- <li class="nav-item  ">
                   <a href="tracking.php" class="nav-link nav-toggle">
                       <i class="fa fa-truck" aria-hidden="true"></i>
                       <span class="title">Tracking</span>
                       <span class="arrow"></span>
                   </a> -->
                   <!-- <ul class="sub-menu">
                       <li class="nav-item  ">
                           <a href="prepare.php" class="nav-link ">
                               <span class="title">Prepare</span>
                           </a>
                       </li>
                       <li class="nav-item  ">
                           <a href="transit.php" class="nav-link ">
                               <span class="title">Perjalanan</span>
                           </a>
                       </li>
                       <li class="nav-item  ">
                           <a href="receive.php" class="nav-link ">
                               <span class="title">Diterima</span>
                           </a>
                       </li>                     
                   </ul> -->
               <!-- </li> -->
               <!-- <li class="nav-item  ">
                   <a href="javascript:;" class="nav-link nav-toggle">
                      <i class="fa fa-user" aria-hidden="true"></i>
                       <span class="title">CRM</span>
                       <span class="arrow"></span>
                   </a>
                   <ul class="sub-menu">
                       <li class="nav-item  ">
                           <a href="best-customer.php?id=<?php echo $log;?>" class="nav-link ">
                               <span class="title">Customer per order</span>
                           </a>
                       </li>
                       <li class="nav-item  ">
                           <a href="best-area.php?id=<?php echo $log;?>" class="nav-link ">
                               <span class="title">Customer per area</span>
                           </a>
                       </li>
                       <li class="nav-item  ">
                           <a href="best-barang.php?id=<?php echo $log;?>" class="nav-link ">
                               <span class="title">Best Produk</span>
                           </a>
                       </li>  
                       <li class="nav-item  ">
                           <a href="index.php?menu=chatting" class="nav-link ">
                               <span class="title">Chatting</span>
                           </a>
                       </li>                    
                   </ul>
               </li> -->
               <li class="nav-item  ">
                   <a href="javascript:;" class="nav-link nav-toggle">
                      <i class="fa fa-object-group" aria-hidden="true"></i>
                       <span class="title">Laporan</span>
                       <span class="arrow"></span>
                   </a>
                   <ul class="sub-menu">
                       <li class="nav-item  ">
                           <a href="transaction_report.php" class="nav-link ">
                               <span class="title">Laporan per invoice</span>
                           </a>
                       </li>
                      <!--  <li class="nav-item  ">
                           <a href="layout_language_bar.html" class="nav-link ">
                               <span class="title">Laporan transaksi detail</span>
                           </a>
                       </li> -->           
                   </ul>
               </li>
           </ul>
           <!-- END SIDEBAR MENU -->
       </div>
       <!-- END SIDEBAR -->
   </div>