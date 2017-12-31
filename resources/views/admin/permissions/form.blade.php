

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





</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-success btn-lg">Submit</button>

    <a href="{{route('admin.permissions.index')}}" class="btn btn-info btn-lg">Back</a>
</div>