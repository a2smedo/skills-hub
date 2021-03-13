@extends('admin.admin-layout')


@section('head')
  Exams
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
            <h3 class="card-title"> All Exams </h3>

            <div class="card-tools">
                <a href="{{ url('/dashboard/exams/create') }}" class="btn btn-primary btn-sm">Add new</a>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name (en) </th>
                <th>Name (ar) </th>
                <th>Image</th>
                <th>Skill</th>
                <th>Questions Number</th>
                <th>Active</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($exams as $exam)

                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $exam->name('en') }} </td>
                  <td> {{ $exam->name('ar') }} </td>
                  <td>
                    <img src="{{ asset("uploads/$exam->img") }}" alt="" style="height:30px;">
                  </td>
                  <td> {{ $exam->skill->name('en') }}</td>
                  <td> {{ $exam->question_no }}</td>


                  <td>
                    @if ($exam->active == 1)
                      <span class="badge badge-success">Active</span>
                    @else
                      <span class="badge badge-danger">Dactive</span>
                    @endif
                  </td>


                  <td>

                    <a class="btn btn-sm btn-info" href=" {{ url("/dashboard/exams/show/{$exam->id}") }} ">
                      <i class="fas fa-eye"></i>
                    </a>

                    <a class="btn btn-sm btn-dark" href=" {{ url("/dashboard/exams/show/{$exam->id}/questions") }} ">
                      <i class="fas fa-question"></i>
                    </a>

                    <a class="btn btn-sm btn-secondary" href=" {{ url("/dashboard/exams/toggle/{$exam->id}") }} ">
                      <i class="fas fa-toggle-on"></i>
                    </a>

                    <a class="btn btn-sm btn-warning" href=" {{ url("/dashboard/exams/edit/{$exam->id}") }} ">
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

          <div class="d-flex justify-content-center py-2 my-2">
            {{ $exams->links() }}
          </div>
        </div>
      </div>


    </div>

  </div>



  {{-- Add Form --}}

  {{-- <div class="modal fade show" id="addModal" style="display: none;" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Add New Skill </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.inc.errors')

          <form id="addForm" method="POST" action=" {{ url('/dashboard/skills/store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Skill Name </label>
                  <input type="text" class="form-control" name="nameEn">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="float-right"> أسم المهارة </label>
                  <input type="text" class="form-control text-right" name="nameAr">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
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
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label> Category </label>
                  <select class="custom-select form-control" name="cat_id">
                    <option disabled>Choese Category </option>
                    @foreach ($cats as $cat)
                      <option value="{{ $cat->id }}"> {{ $cat->name('en') }} </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="addForm">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div> --}}


  {{-- Edit Form --}}

  {{-- <div class="modal fade show" id="editModal" style="display: none;" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Edit Skill </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.inc.errors')
          <form id="editForm" method="POST" action=" {{ url('/dashboard/skills/update') }} "
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" id="editId">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Skill Name </label>
                  <input type="text" class="form-control" name="nameEn" id="nameEn">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name" class="float-right"> أسم المهارة </label>
                  <input type="text" class="form-control text-right" name="nameAr" id="nameAr">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
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
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label> Category </label>
                  <select class="custom-select form-control" name="cat_id" id="cat_id">
                    <option disabled>Choese Category </option>
                    @foreach ($cats as $cat)
                      <option value="{{ $cat->id }}"> {{ $cat->name('en') }} </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="editForm">Update changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div> --}}
@endsection



@section('Script')

  <script>
    $('.editBtn').click(function() {
      let id = $(this).attr('data-id');
      let name_en = $(this).attr('data-name-en');
      let name_ar = $(this).attr('data-name-ar');
      let img = $(this).attr('data-img');
      let catId = $(this).attr('data-catId');

      $('#editId').val(id);
      $('#nameEn').val(name_en);
      $('#nameAr').val(name_ar);
      //   $('#img').val(img);
      $('#cat_id').val(catId);


    });

  </script>

@endsection
