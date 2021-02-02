
{{ $pendingArtistNum = App\Http\Controllers\PendingArtistController::totalPendingArtists()}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                      class="fas fa-bars"></i></a>
          </li>

      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">1</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                  <!--start for each new feedbacks -->
                  <a href="#" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  Brad Diesel
                                  <span class="float-right text-sm text-danger"></span>
                              </h3>
                              <p class="text-sm">Call me whenever you can...</p>
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
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">{{$pendingArtistNum}} </span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">{{$pendingArtistNum}} Notifications</span>
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
          <img src="../../images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light"> Zoe </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <!-- start user profile image -->
                  <img src="../../images/avatar.png" class="img-circle elevation-2" alt="User Image">
                  <!-- end of profile image -->
              </div>
              <div class="info">
                  <!-- start of user name -->
                  <a href="#" class="d-block">Eyerus</a>
                  <!-- end of user name -->
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

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
                          <i class="nav-icon fas fa-ad"></i>
                          <p>
                              Advertisements
                          </p>
                      </a>
                  </li>

                  <li class="nav-item" id="newsList">
                      <a href="/News/addNews" class="nav-link">
                          <i class="nav-icon fas fa-blog"></i>
                          <p>
                              News
                          </p>
                      </a>
                  </li>


                  <li class="nav-item has-treeview" id="paymentList">
                      <a href="#" class="nav-link" id="paymentNav">
                          <i class="nav-icon fas fa-money-bill-alt"></i>
                          <p>
                              Payments
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview ml-4">
                          <li class="nav-item">
                              <a href="/Payment/internationalPaymentsNotPayed/0" class="nav-link"
                                  id="internationalPaymentNav">
                                  <p>International Payments</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/Payment/localPaymentsNotPayed/0" class="nav-link" id="localPaymentNav">
                                  <p>Local Payments</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/Payment/telecomPaymentsNotPayed/0" class="nav-link" id="telecomPaymentNav">
                                  <p>Telecom Payments</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item has-treeview" id="userList">
                      <a href="#" class="nav-link" id="userNav">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Users
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview ml-4">
                          <li class="nav-item">
                              <a href="/User/activeAdmins/0" class="nav-link" id="adminNav">
                                  <p>Administrators</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/User/registerArtist" class="nav-link" id="artistNav">
                                  <p>Artists</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/User/activeClients/0" class="nav-link" id="clientNav">
                                  <p>Clients</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="/User/registerChurchAdmin" class="nav-link" id="churchAdminNav">
                                  <p>Church Administrators</p>
                              </a>
                          </li>

                      </ul>
                  </li>


                  <li class="nav-item" id="churchList">
                      <a href="/Church/addChurch" class="nav-link" id="churchNav">
                          <i class="nav-icon fas fa-church"></i>
                          <p>
                              Church
                          </p>
                      </a>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
