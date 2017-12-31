

@include('admin.common.flash_message')


<div class="box-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Role Name</label>
        {!! Form::text('display_name',null,['class'=>'form-control','id'=>'exampleInputEmail1','placeholder'=>"Role name"]) !!}

    </div>

    <div class="form-group">
        <label for="name">Description</label>
        {!! Form::textarea('description',null,['class'=>'form-control','id'=>'name','placeholder'=>"Description"]) !!}

    </div>




    <div class="form-group">


        <label>
           Permissions
        </label>
        <br/>

        @if($form_type=='edit')
        <div class="col-md-5">
            {!! Form::select('permissions[]',$permissions,@$role->perms->pluck('id'),['class'=>'form-control  ','multiple '=>'multiple ']) !!}
        </div>

        <div class="col-md-5">
            {!! Form::select('permissions2[]',$role->perms->pluck('display_name','id'),1,['class'=>'form-control ','disabled'=>'disabled','multiple '=>'multiple ']) !!}
        </div>

        @else

            <div class="col-md-5">
                {!! Form::select('permissions[]',$permissions,0,['class'=>'form-control  ','multiple '=>'multiple ']) !!}
            </div>

        @endif

    </div>

</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-success btn-lg">Submit</button>

    <a href="{{route('admin.roles.index')}}" class="btn btn-info btn-lg">Back</a>
</div>