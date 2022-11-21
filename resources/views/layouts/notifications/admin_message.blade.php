@if (Session::has('message'))
    <div class="alert alert-light-success color-success my-2">
        <ul class="my-0">
            <li>{{ Session::get('message') }}</li>
        </ul>
    </div>
@endif
@if (isset($errors) && $errors->any())
    <div class="alert alert-light-danger color-danger my-2">
        <ul class="my-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
