


@if(session()->has('error')||session()->has('success'))



    <div class="alert alert-{{session()->has('error')?'danger':'success'}}">

        <button type="button" class="close" data-dismiss="alert">

            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

        </button>

        {{session()->has('error')?session('error'):session('success')}}

    </div>

    <?php @session()->forget('success'); @session()->forget('error'); ?>

@endif


@if ($errors->any())

    <br/>
    <div class="alert alert-danger">

        <button type="button" class="close" data-dismiss="alert">

            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

        </button>

        <ul>

            {!!  implode('', $errors->all('<li class="error">:message</li>'))  !!}

        </ul>

    </div>

@endif