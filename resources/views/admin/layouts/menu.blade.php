@php
    $current_route = Route::current() -> getName();
    $prefix = Request::route() -> getPrefix();

@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="{{ asset('../images/logo-dark.png') }}" alt="">
						  <h3><b>Sunny</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="{{ ($current_route == 'dashboard' ? 'active' : '') }}">
          <a href="{{ route('dashboard') }}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>

        <li class="treeview {{ ($current_route == 'admin.blog.index' ? 'active' : '') }}">
          <a href="{{ route('admin.blog.index') }}">
            <i data-feather="file-text"></i>
            <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=" {{ ($current_route == 'admin.blog.index' ? 'active' : '') }}"><a href="{{ route('admin.blog.index') }}"><i class="ti-more"></i>All Post</a></li>
            <li class=" {{ ($current_route == 'admin.blog.create' ? 'active' : '') }}"><a href="{{ route('admin.blog.create') }}"><i class="ti-more"></i>Add Post</a></li>
            <li class=" {{ ($current_route == 'admin.blog.category.show' ? 'active' : '') }}"><a href="{{ route('admin.blog.category.show') }}"><i class="ti-more"></i>Blog Categorys</a></li>
            <li class=" {{ ($current_route == 'tag.index' ? 'active' : '') }}"><a href="{{ route('tag.index') }}"><i class="ti-more"></i>Blog Tags</a></li>
          </ul>
        </li>



        <li class="treeview {{ ($prefix == '/brand' ? 'active' : '') }}">
          <a href="{{ url('/brand/') }}">
            <i data-feather="shopping-bag"></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($prefix == '/brand' ? 'active' : '') }}"><a href="{{ url('/brand/') }}"><i class="ti-more"></i>Brand</a></li>
            <li class="{{ ($prefix == '/producttag' ? 'active' : '') }}"><a href="{{ url('/producttag/') }}"><i class="ti-more"></i>Tag</a></li>

            <li class="{{ ($prefix == '/productcateory' ? 'active' : '') }}"><a href="{{ url('/productcateory') }}"><i class="ti-more"></i>Category</a></li>

            <li class="{{ ($current_route == 'product.add' ? 'active' : '') }}"><a href="{{ route('product.add')}}"><i class="ti-more"></i>Add Product</a></li>

            <li class="{{ ($current_route == 'product.index' ? 'active' : '') }}"><a href="{{ route('product.index')}}"><i class="ti-more"></i>Manage Product</a></li>

          </ul>
        </li>



        <li class=" treeview {{ ($prefix == '/slider' ? 'active' : '') }}">
          <a href="{{ url('/slider') }}">
            <i data-feather="file"></i>
            <span>Theme Option</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($prefix == '/slider' ? 'active' : '') }}"><a href="{{ url('/slider') }}"><i class="ti-more"></i>Slider</a></li>
          </ul>
        </li>


		<li class="treeview {{ ($current_route == 'settings' ? 'active' : '') }}">
            <a href="{{ url('settings/') }}">
              <i data-feather="settings"></i>
              <span>Settings</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=" {{ ($current_route == 'settings/' ? 'active' : '') }}"><a href="{{ url('settings/') }}"><i class="ti-more"></i>Site Settings</a></li>
              <li class=" {{ ($current_route == 'settings/seo' ? 'active' : '') }}"><a href="{{ url('settings/seo') }}"><i class="ti-more"></i>SEO Settings</a></li>
            </ul>
          </li>


      </ul>
    </section>

	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>
