
    <style>
        .error{
            color:red;
        }
        .whiteColor{
            color: white;
        }
    </style>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand" style="background: #357ca5;">
      <!-- Left navbar links -->
      <ul class="navbar-nav" >
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars whiteColor"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link whiteColor">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link whiteColor">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link whiteColor" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">1</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <!--start for each new feedbacks -->
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
          <!--end for each new feedbacks -->

            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link whiteColor" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">1</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">1 Notifications</span>
            <div class="dropdown-divider"></div>
            <!--start for each new notification types -->
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <!--end for each new notification types -->
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"> Zoe </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <!-- start user profile image -->
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              <!-- end of profile image -->
          </div>
          <div class="info">
              <!-- start of user name -->
            <a href="#" class="d-block">Alexander Pierce</a>
              <!-- end of user name -->
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item" id="advertisementList">
                <a href="/Advertisement/addAdvertisement" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Advertisements
                  </p>
                </a>
             </li>

              <li class="nav-item" id="newsList">
                <a href="/News/addNews" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    News
                  </p>
                </a>
              </li>


              <li class="nav-item has-treeview" id="paymentList">
                <a href="#" class="nav-link" id="paymentNav">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Payments
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/Payment/internationalPaymentsNotPayed" class="nav-link" id="internationalPaymentNav">
                      <i class="far fa-circle nav-icon"></i>
                      <p>International Payments</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/Payment/localPaymentsNotPayed" class="nav-link" id="localPaymentNav">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Local Payments</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/Payment/telecomPaymentsNotPayed" class="nav-link" id="telecomPaymentNav">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Telecom Payments</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item" id="albumList">
                <a href="/Album/addAlbum" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Albums
                  </p>
                </a>
              </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
