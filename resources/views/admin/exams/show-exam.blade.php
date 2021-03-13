@extends('admin.admin-layout')


@section('head')
  {{ $exam->name('en') }}
@endsection

@section('content')

  <div class="col">

    <div class="row">
      <div class="col">
        @if (session('msgUpdate'))
          <div class="alert alert-info" role="alert">
            {{ session('msgUpdate') }}
          </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Exam details</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-sm">

              <tbody>
                <tr>
                  <th>Name (en)</th>
                  <td>
                    {{ $exam->name('en') }}
                  </td>
                </tr>
                <tr>
                  <th>Name (ar)</th>
                  <td>
                    {{ $exam->name('ar') }}
                  </td>
                </tr>

                <tr>
                  <th>Description (en)</th>
                  <td>
                    {{ $exam->desc('en') }}
                  </td>
                </tr>
                <tr>
                  <th>Description (ar)</th>
                  <td>
                    {{ $exam->desc('ar') }}
                  </td>
                </tr>

                <tr>
                  <th>Skill</th>
                  <td>
                    {{ $exam->skill->name('en') }}
                  </td>
                </tr>

                <tr>
                  <th>Image</th>
                  <td>
                    <img src="{{ asset("uploads/$exam->img") }}" alt="" height="50px">
                  </td>
                </tr>

                <tr>
                  <th>Question Number</th>
                  <td>
                    {{ $exam->question_no }}
                  </td>
                </tr>
                <tr>
                  <th>Difficulty</th>
                  <td>
                    {{ $exam->difficulty }}
                  </td>
                </tr>
                <tr>
                  <th>Duration (mins.)</th>
                  <td>
                    {{ $exam->duration_mins }}
                  </td>
                </tr>

                <tr>
                  <th>Active</th>
                  <td>
                    @if ($exam->active)
                      <span class="badge badge-success">Active</span>
                    @else
                      <span class="badge badge-danger">Deactive</span>
                    @endif
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <div class="row pb-3">
      <div class="col-md-10 mx-auto text-right">
        <a class="btn  btn-success" href=" {{ url("/dashboard/exams/show/{$exam->id}/questions") }} ">
          Show Questions
        </a>

        <a class="btn  btn-primary" href=" {{ url()->previous() }} ">
          Back
        </a>
      </div>
    </div>
  </div>

@endsection
