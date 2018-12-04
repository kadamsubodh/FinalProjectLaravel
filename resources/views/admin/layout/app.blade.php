<!DOCTYPE html>
<html>
<head>
  @section('head')
  @show
</head>
@section('bodyTag')
@show
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="/index2" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs"> Welcome, {{Auth::user()->firstname}} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                {{Auth::user()->firstname}} - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <a href="/doLogOut" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->firstname}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>        
       @hasrole('superadmin')
         <li class="{{str_contains(Request::path(),'admin/users') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>User Management</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/users "><i class="fa fa-circle-o"></i>User List</a></li>
            <li><a href="/admin/users/create "><i class="fa fa-circle-o"></i> Create New User</a></li>
          </ul>
         </li>
     
         <li class="{{str_contains(Request::path(),'admin/configurations') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Configuration</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/configurations "><i class="fa fa-circle-o"></i>Configuration List</a></li>
            <li><a href="/admin/configurations/create "><i class="fa fa-circle-o"></i> Create New Configuration</a></li>
          </ul>
         </li>
    
          <li class="{{str_contains(Request::path(),'admin/banners') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Banners</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/banners "><i class="fa fa-circle-o"></i>Banners List</a></li>
            <li><a href="/admin/banners/create "><i class="fa fa-circle-o"></i> Create New Banner</a></li>
          </ul>
         </li>
        @endhasrole
        @hasrole('superadmin|admin')
         <li class="{{str_contains(Request::path(),'admin/categories') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Categories</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/categories "><i class="fa fa-circle-o"></i>Category List</a></li>
            <li><a href="/admin/categories/create "><i class="fa fa-circle-o"></i> Create New Category</a></li>
          </ul>
         </li>
         <li class="{{str_contains(Request::path(),'admin/coupons') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Coupons</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/coupons "><i class="fa fa-circle-o"></i>Coupons List</a></li>
            <li><a href="/admin/coupons/create "><i class="fa fa-circle-o"></i> Create New Coupon</a></li>
          </ul>
         </li>
         <li class="{{str_contains(Request::path(),'admin/mailTemplate') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Mail Templates</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/mailTemplate "><i class="fa fa-circle-o"></i>Mail Template List</a></li>
            <li><a href="/admin/mailTemplate/create "><i class="fa fa-circle-o"></i> Create New Template</a></li>
          </ul>
         </li>
         <li class="{{str_contains(Request::path(),'admin/contactUs') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Recieved Queries</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/contactUs "><i class="fa fa-circle-o"></i>Query List</a></li>           
          </ul>
         </li>
         <li class="{{str_contains(Request::path(),'admin/orderManagement') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Order Management</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/orderManagement "><i class="fa fa-circle-o"></i>View Orders</a></li>           
          </ul>
         </li>
       @endhasrole
       <li class="{{str_contains(Request::path(),'admin/productsattributes') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Products Attributes</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/productsattributes "><i class="fa fa-circle-o"></i>Product Attributes List</a></li>
            <li><a href="/admin/productsattributes/create "><i class="fa fa-circle-o"></i> Create New Product Attributes</a></li>
          </ul>
         </li>
        <li class="{{str_contains(Request::path(),'admin/products') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Products</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/products "><i class="fa fa-circle-o"></i>Product List</a></li>
            <li><a href="/admin/products/create "><i class="fa fa-circle-o"></i> Create New Product</a></li>
          </ul>
         </li>


         <li class="{{str_contains(Request::path(),'admin/cms') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>CMS</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/cms "><i class="fa fa-circle-o"></i>CMS List</a></li>
            <li><a href="/admin/cms/create "><i class="fa fa-circle-o"></i> Create New</a></li>
          </ul>
         </li>

         <li class="{{str_contains(Request::path(),'admin/reports') ? 'active' : ''}} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Reports</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/reports/salesReport "><i class="fa fa-circle-o"></i>Sales Reports</a></li>
            <li><a href="/admin/reports/customerReport "><i class="fa fa-circle-o"></i>Customer Report</a></li>
            <li><a href="/admin/reports/couponReport "><i class="fa fa-circle-o"></i>Coupon Report</a></li>

          </ul>
         </li>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    @section('contentHeader')
    @show
    <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div>
    </section>
     
    <!-- Main content -->
    <section class="content">
      @section('content')
      @show()
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
 
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
@section('scripts')
  <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <!-- jvectormap  -->
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script src="{{asset('/js/app.js')}}"></script>

@show
</body>
</html>
