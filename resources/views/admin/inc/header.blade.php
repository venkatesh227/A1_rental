      <!--start header -->
      <header>
          <div class="topbar d-flex align-items-center">
              <nav class="navbar navbar-expand gap-3">
                  <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                  </div>
                  <div class="top-menu ms-auto">
                      <ul class="navbar-nav align-items-center gap-1">

                      </ul>
                  </div>
                  <div class="user-box dropdown px-3">
                      <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                          href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="user-info">
                              <p class="user-name mb-0">Admin</p>
                          </div>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end">

                          <li><a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}"><i
                                      class="bx bx-log-out-circle"></i><span>Logout</span></a>
                          </li>
                      </ul>
                  </div>
              </nav>
          </div>
      </header>
      <!--end header -->
