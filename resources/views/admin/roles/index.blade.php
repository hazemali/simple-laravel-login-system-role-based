@extends('admin.layout')



@section('style')

    <link rel="stylesheet" href="{{url("/")}}/admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection




@section('content')


    <section class="content-header">

        <a href="{{ URL::to( url("/") . '/admin/'.$data['module'].'/create') }}" class='btn btn-success  pull-left' data-toggle='tooltip' data-original-title='اضغط لاضافة' data-placement='bottom'><i class='fa fa-plus' aria-hidden='true'></i> Add new {{$data['name']}} </a>



    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Roles</li>
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

                        <table id="table" class="table table-responsive">
                            <thead>
                                <th>id</th>
                                <th>Name</th>

                                <th>created at</th>
                                <th>updated at</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @forelse($roles as $role)

                                <tr>
                                    <td>
                                        {{$role->id}}
                                    </td>

                                    <td>
                                        {{$role->display_name}}
                                    </td>

                                    <td>
                                        {{$role->created_at->diffForHumans()}}
                                    </td>
                                    <td>
                                        {{$role->updated_at->format('Y-m-d')}}
                                    </td>
                                    <td>
                                        <a href="/admin/{{$data['module']}}/{{$role->id}}/edit" class="btn btn-success btn-circle " title="edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-toggle="modal"  data-target="#modal{{$role->id}}" class="btn btn-danger btn-circle" title="edit"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>

                                <div class="modal" tabindex="-1" role="dialog" id="modal{{$role->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete this item ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post"  action="/admin/{{$data['module']}}/{{$role->id}}/delete">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                    <tr>
                                        <td colspan="5">No data</td>
                                    </tr>
                            @endforelse
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection



@section('js')



@endsection