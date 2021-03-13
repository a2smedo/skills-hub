@extends('admin.admin-layout')


@section('head')
  Show Message
@endsection

@section('content')



  <div class="col py-2">

    <div class="row">
      <div class="col">
        @if (session('msgAdd'))
          <div class="alert alert-success" role="alert">
            {{ session('msgAdd') }}
          </div>
        @endif

        @if (session('msgUpdate'))
          <div class="alert alert-info" role="alert">
            {{ session('msgUpdate') }}
          </div>
        @endif

        @if (session('msgDeleted'))
          <div class="alert alert-warning" role="alert">
            {{ session('msgDeleted') }}
          </div>
        @endif

        @if (session('msgNoDeleted'))
          <div class="alert alert-danger" role="alert">
            {{ session('msgNoDeleted') }}
          </div>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Message </h3>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <tbody>
              <tr>
                <th>Name</th>
                <td> {{ $message->name }} </td>
              </tr>

              <tr>
                <th>Email</th>
                <td> {{ $message->email }} </td>
              </tr>

              <tr>
                <th>Subject</th>
                <td> {{ $message->subject ?? '...' }} </td>
              </tr>

              <tr>
                <th>Body</th>
                <td> {{ $message->body }} </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>



    <div class="row mt-3">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Send Response </h3>
          </div>
        </div>
        <div class="card-body p-0">

          <form action="{{ url("/dashboard/messages/response/$message->id") }}" method="post">
            @csrf


            <div class="form-group">
              <label for="title">Title</label>
              <input id="title" class="form-control" type="text" name="title">
            </div>

            <div class="form-group">
              <label for="body">Body</label>
              <textarea id="body" class="form-control" name="body" rows="3"></textarea>
            </div>

            <div class="row pb-3">
              <div class="col">
                <a class="btn btn-primary" href=" {{ url()->previous() }} ">
                  Back
                </a>
              </div>
              <div class="col text-right">
                <button type="submit" class="btn btn-success"> Send </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        @include('admin.inc.errors')
      </div>
    </div>



  </div>

@endsection
