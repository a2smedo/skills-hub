@extends('admin.admin-layout')


@section('head')
  Create Exam
@endsection

@section('content')

  <div class="col">

    <div class="row">
      <div class="col">
        @if (session('msgAdd'))
          <div class="alert alert-success" role="alert">
            {{ session('msgAdd') }}
          </div>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col">

        <form id="addForm" method="POST" action="{{ url("/dashboard/exams/questions/store/$exam_id") }}">
          @csrf
          @for ($i = 0; $i < $question_no; $i++)

            <h5> Question {{ $i + 1 }} </h5>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Question title </label>
                  <input type="text" class="form-control" name="titles[]">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Right Ansewrs </label>
                  <input type="number" class="form-control" name="right_ans[]" min="1" max="4">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name"> Option 1 </label>
                  <input type="text" class="form-control" name="option_1[]">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name"> Option 2 </label>
                  <input type="text" class="form-control" name="option_2[]">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name"> Option 3 </label>
                  <input type="text" class="form-control" name="option_3[]">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name"> Option 4 </label>
                  <input type="text" class="form-control" name="option_4[]">
                </div>
              </div>

            </div>
          @endfor

          <div class="row pb-3">
            <div class="col text-right">
              <button type="submit" class="btn btn-success"> Save </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
