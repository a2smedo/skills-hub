@extends('admin.admin-layout')


@section('head')
  Create Exam
@endsection

@section('content')

  <div class="col">

    <form method="POST" action="{{ url("/dashboard/exams/questions/update/$exam->id/$ques->id") }}">
      @csrf




      <div class="form-group">
        <label for="name">Question title </label>
        <input type="text" class="form-control" name="title" value="{{ $ques->title }}">
      </div>


        <div class="form-group">
          <label for="name">Right Ansewrs </label>
          <input type="number" class="form-control" name="right_ans" min="1" max="4" value="{{ $ques->right_ans }}">
        </div>


        <div class="form-group">
          <label for="name"> Option 1 </label>
          <input type="text" class="form-control" name="option_1" value="{{ $ques->option_1 }}">
        </div>


        <div class="form-group">
          <label for="name"> Option 2 </label>
          <input type="text" class="form-control" name="option_2" value="{{ $ques->option_2 }}">
        </div>


        <div class="form-group">
          <label for="name"> Option 3 </label>
          <input type="text" class="form-control" name="option_3" value="{{ $ques->option_3 }}">
        </div>


        <div class="form-group">
          <label for="name"> Option 4 </label>
          <input type="text" class="form-control" name="option_4" value="{{ $ques->option_4 }}">
        </div>





        <div class="row pb-3">
          <div class="col text-right">
            <button type="submit" class="btn btn-success"> Update </button>
          </div>
        </div>

    </form>
  </div>
@endsection
