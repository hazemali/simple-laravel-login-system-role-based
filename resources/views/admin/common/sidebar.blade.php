<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('/')}}/admin_assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="{{url('/')}}/admin"><i class="fa fa-circle text-success"></i> Online</a>
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


            @foreach($data['sidebar'] as $menu)

                @if($menu['title']=='Authorization'&&!Auth::user()->hasRole('super-admin'))
                    @continue
                @endif
                <li @if(isset($menu['sub'])) class="treeview" @endif>
                    <a href="@if(!isset($menu['sub'])){{url('/')}}/admin/{{$menu['href']}}@else#@endif" title="{{$menu['title']}}">
                        <i class="fa {{$menu['class']}}"></i>
                        <span>{{$menu['title']}}</span>


                        @if(!isset($menu['label']))
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                         </span>
                            <ul class="treeview-menu">
                                @foreach($menu['sub'] as $sub)
                                <li class="active"><a href="{{url('/')}}/admin/{{$sub['href']}}"><i class="fa {{$sub['class']}}"></i> {{$sub['title']}}

                                        @if(isset($sub['label']))
                                            <span class="pull-right-container">
                                                <small class="label label-primary pull-right">{{$sub['label']}}</small>
                                            </span>
                                        @endif
                                    </a></li>
                                @endforeach
                            </ul>
                        @endif

                @if(isset($menu['label']))
                    <span class="pull-right-container">
                        <small class="label label-primary pull-right">{{$menu['label']}}</small>
                    </span>
                @endif
                    </a>
                </li>


                @endforeach


            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>