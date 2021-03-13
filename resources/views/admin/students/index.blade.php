@extends('admin.admin-layout')


@section('head')
  Students
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
            <h3 class="card-title"> All Students </h3>

            {{-- <div class="card-tools">
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">
                Add new
              </button>
            </div> --}}
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Email</th>
                <th>Verified</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)

                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $student->name }} </td>
                  <td> {{ $student->email }} </td>


                  <td>
                    @if ($student->email_verified_at)
                      <span class="badge badge-success">Verified</span>
                    @else
                      <span class="badge badge-danger">Not Verified</span>
                    @endif
                  </td>

                  <td>
                    <a class="btn btn-sm btn-success" href=" {{ url("/dashboard/students/show-scores/$student->id") }} ">
                      <i class="fas fa-percent"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="d-flex justify-content-center py-2 my-2">
            {{ $students->links() }}
          </div>
        </div>
      </div>


    </div>

  </div>

@endsection
