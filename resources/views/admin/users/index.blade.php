@extends('admin.layout')



@section('style')

    <link rel="stylesheet" href="{{url("/")}}/admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection




@section('content')


    <section class="content-header">

        <a href="{{ URL::to( url("/") . '/admin/'.$data['module'].'/create') }}" class='btn btn-success  pull-left' data-toggle='tooltip' data-original-title='اضغط لاضافة' data-placement='bottom'><i class='fa fa-plus' aria-hidden='true'></i> Add new {{$data['name']}} </a>



    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
    </ol>


    </section>



    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users table</h3>
                    </div>
                @include('admin.common.flash_message')
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="table" class="table">
                            <thead>
                                <th>id</th>
                                <th>Name</th>
                                <th>email</th>
                                <th>created at</th>
                                <th>updated at</th>
                                <th>Action</th>
                            </thead>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection



@section('js')

    <script src="{{url('/')}}/admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>


        $(function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax:'{{url('/')}}/admin/get-users',
                columns:[
                    {data:  'id'},
                    {data:  'name'},
                    {data:  'email'},
                    {data:  'created_at'},
                    {data:  'updated_at'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                    ]

            })
            
        })
    </script>


@endsection