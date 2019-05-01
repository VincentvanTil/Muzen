
@extends ('layouts.sidemenu')

@section('content')
<div class="container main">
  <div class="row">
    <div class="col-md-12 mt-4">
      <h4 class="mb-3">Describe yourself</h4>
    </div>
      <div class="col-md-12">
        <form method="post" action="{{ route('editdescription.store') }}" id="adduserdesc">
          @csrf
          <div class="form-group">
            <div class="form-group">


            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" required />
            <div>

                <hr class="mb-4">

                <button type="submit" class="btn btn-primary">Add this description</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
