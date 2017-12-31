@extends('admin.layout')




@section('content')


    <section class="content-header">
        <h1>
            Add new role
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/roles">Roles</a></li>
            <li class="active">Add role</li>
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
                        <h3 class="box-title">Role Details</h3>
                    </div>
                    <!-- /.box-header -->

                    {!! Form::model($role,['route' => ['admin.'.$data['module'].'.update',$role->id],'method'=>'PATCH']) !!}

                    @include('admin.roles.form',['form_type'=>'edit'])


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