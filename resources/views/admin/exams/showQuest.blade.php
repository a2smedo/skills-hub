@extends('admin.admin-layout')


@section('head')
  {{ $exam->name('en') }} questions
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
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Exam Questions</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">

            <table class="table table-sm table-hover text-nowrap text-center">
              <thead>
                <tr class="d-flex">
                  <th class="col-md-1">ID</th>
                  <th class="col-md-3">Title </th>
                  <th class="col-md-4">Options</th>
                  <th class="col-md-2">Right Answers</th>
                  <th class="col-md-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($exam->questions as $ques)

                  <tr class="d-flex">
                    <td class="col-md-1"> {{ $loop->iteration }} </td>
                    <td class="col-md-3 text-left">
                      <p class="text-wrap ">{{ $ques->title }}</p>
                    </td>

                    <td class="col-md-4 text-left">
                      <span class="d-block text-wrap">{{ $ques->option_1 }} |</span><br>
                      <span class="d-block text-wrap">{{ $ques->option_2 }} |</span><br>
                      <span class="d-block text-wrap">{{ $ques->option_3 }} |</span><br>
                      <span class="d-block text-wrap">{{ $ques->option_4 }} |</span>


                    </td>

                    <td class="col-md-2"> {{ $ques->right_ans }} </td>




                    <td class="col-md-2">

                      <a class="btn btn-sm btn-warning"
                        href=" {{ url("/dashboard/exams/questions/edit/$exam->id/$ques->id") }} ">
                        <i class="fas fa-edit"></i>
                      </a>

                      <a class="btn btn-sm btn-danger" href=" {{ url("/dashboard/exams/delete/{$exam->id}") }} ">
                        <i class="fas fa-trash"></i>
                      </a>

                    </td>


                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <div class="row pb-3">
      <div class="col-md-10 mx-auto text-right">
        <a class="btn  btn-success" href=" {{ url('/dashboard/exams') }} ">
          Show to All Exams
        </a>

        <a class="btn  btn-primary" href=" {{ url()->previous() }} ">
          Back
        </a>
      </div>
    </div>



  </div>


@endsection
