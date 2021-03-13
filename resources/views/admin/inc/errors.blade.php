@if ($errors->any())
<div class="alert alert-danger" role="alert">
  @foreach ($errors->all() as $err)
      <p> {{$err}} </p>
  @endforeach
</div>
@endif
