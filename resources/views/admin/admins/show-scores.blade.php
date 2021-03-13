@extends('admin.admin-layout')


@section('head')
  Show Scores {{ $student->name }}
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
            <h3 class="card-title"> Scores </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">
                Add new
              </button>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Exam </th>
                <th>Score</th>
                <th>Time</th>
                <th>At</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($exams as $exam)

                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $exam->name('en') }} </td>
                  <td> {{ $exam->pivot->score }} </td>
                  <td> {{ $exam->pivot->time_mins }} </td>
                  <td> {{ $exam->pivot->created_at }} </td>
                  <td> {{ $exam->pivot->status }} </td>
                  <td>
                    @if ($exam->pivot->status == 'closed')
                      <a class="btn btn-sm btn-success"
                        href=" {{ url("/dashboard/students/open-exam/$student->id/$exam->id") }} ">
                        <i class="fas fa-lock-open"></i>
                      </a>
                      @else
                      <a class="btn btn-sm btn-danger"
                        href=" {{ url("/dashboard/students/close-exam/$student->id/$exam->id") }} ">
                        <i class="fas fa-lock"></i>
                      </a>

                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          {{-- <div class="d-flex justify-content-center py-2 my-2">
            {{ $students->links() }}
          </div> --}}
        </div>
      </div>


    </div>

  </div>

@endsection
