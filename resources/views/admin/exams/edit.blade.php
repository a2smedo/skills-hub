@extends('admin.admin-layout')


@section('head')
  Edit Exam
@endsection

@section('content')

  <div class="col">

    <form method="POST" action="{{ url("dashboard/exams/update/$exam->id") }}" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Exam Name </label>
            <input type="text" class="form-control" name="nameEn" value="{{$exam->name('en')}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="float-right"> أسم الامتحان </label>
            <input type="text" class="form-control text-right" name="nameAr" value="{{$exam->name('ar')}}">
          </div>
        </div>
      </div>




      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="img">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label> Skill </label>
            <select class="custom-select form-control" name="skill_id">
              <option disabled>Choese Skill </option>
              @foreach ($skills as $skill)
                <option value="{{ $skill->id }}" @if ($exam->skill_id == $skill->id)
                    selected @endif >
                    {{ $skill->name('en') }}

                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>


      <div class="form-group">
        <label for="name">Exam Name </label>
        <textarea name="descEn" class="form-control" rows="3">{{$exam->desc('en')}} </textarea>
      </div>

      <div class="form-group">
        <label class="float-right" for="name"> شرح الامتحان </label>
        <textarea name="descAr" class="form-control text-right" rows="3">{{$exam->desc('ar')}}</textarea>
      </div>

      <div class="row">
        {{-- <div class="col-md-4">
          <div class="form-group">
            <label for="name"> Questions Number </label>
            <input type="number" name="question_no" class="form-control" id="" min="3" max="15">
          </div>
        </div> --}}

        <div class="col-md-6">
          <div class="form-group">
            <label for="name"> Difficulty </label>
            <input type="number" name="difficulty" class="form-control" id="" min="1" max="5" value="{{$exam->difficulty}}">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="name"> Duration (mins.) </label>
            <input type="number" name="duration_mins" class="form-control" id="" min="10" max="90" value="{{$exam->duration_mins}}">
          </div>
        </div>
      </div>

      <div class="row pb-3">

        <div class="col">
          <a class="btn btn-primary" href=" {{ url()->previous() }} ">
            Back
          </a>
        </div>

        <div class="col text-right">
          <button type="submit" class="btn btn-success"> Update </button>
        </div>
      </div>

    </form>
  </div>
@endsection
