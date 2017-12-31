

    @include('admin.common.flash_message')


    <div class="box-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            {!! Form::email('email',null,['class'=>'form-control','id'=>'exampleInputEmail1','placeholder'=>"Enter email"]) !!}

        </div>

        <div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>"Enter name"]) !!}

        </div>



        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password"  name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>



        @foreach($roles as $role)
        <div class="checkbox">
            <label>
                {!! Form::checkbox('role_id[]',$role->id,@$user->hasRole($role->name),['class'=>'minimal']) !!} {{$role->display_name}}
            </label>
        </div>
        @endforeach
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-success btn-lg">Submit</button>

        <a h="submit" class="btn btn-success btn-lg">Submit</a>
    </div>