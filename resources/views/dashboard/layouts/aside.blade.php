<aside class="main-sidebar sidebar-dark-primary elevation-4">

      <div class="d-flex justify-content-center brand-link">
            <a href="{{ route('dashboard') }}" style="color: white">
                  <span class="brand-text font-weight-light">{{ env('APP_NAME' ) }}</span>
            </a>
      </div>

      <div class="sidebar">

            <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- <li class="nav-item menu-open">
                              <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                          Starter Pages
                                          <i class="right fas fa-angle-left"></i>
                                    </p>
                              </a>
                              <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="#" class="nav-link active">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Active Page</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Inactive Page</p>
                                          </a>
                                    </li>
                              </ul>
                        </li> --}}

                        <li class="nav-item">
                              <a href="{{ route('categories.index') }}" class="nav-link 
                                    {{ request()->is('dashboard/categories*') ? ' active ' : '' }}
                                    ">
                                    <i class="nav-icon far fa-list-alt"></i>
                                    <p>Categories</p>
                              </a>
                        </li>

                        <li class="nav-item">
                              <a href="{{ route('products.index') }}" class="nav-link 
                                    {{-- {{ \Route::current()->getName() == 'products.index' ? ' active ' : '' }} --}}
                                    {{ request()->is('dashboard/products*') ? ' active ' : '' }}
                                    ">
                                    <i class="nav-icon fab fa-product-hunt"></i>
                                    <p>Products</p>
                              </a>
                        </li>

                        <li class="nav-item">
                              <a href="{{ route('logout') }}" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                              </a>
                        </li>

                  </ul>
            </nav>
      </div>
</aside>