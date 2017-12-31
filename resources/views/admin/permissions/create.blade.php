@extends('admin.layout')




@section('content')


    <section class="content-header">
        <h1>
            Add new Permission
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/permissions">permissions</a></li>
            <li class="active">Add permission</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permissions Details</h3>
                    </div>
                    <!-- /.box-header -->

                    {!! Form::open(['route' => ['admin.'.$data['module'].'.store'],'method'=>'POST']) !!}

                        @include('admin.permissions.form',['form_type'=>'create'])


                    {!! Form::close() !!}

                </div>
                <!-- /.box -->




            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection