@if (session()->has('success') )

<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $err)
    <p class="p-0"> {{$err}} </p>
    @endforeach
</div>
@endif
