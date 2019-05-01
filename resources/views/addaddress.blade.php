
@extends ('layouts.sidemenu')

@section('content')
<div class="container main">
  <div class="row">
    <div class="col-md-12 mt-4">
      <h4 class="mb-3"> Add an address</h4>
    </div>
      <div class="col-md-12">
        <form method="post" action="{{ route('addaddress.store') }}" id="addaddress">
          @csrf
          <div class="form-group">
            <div class="form-group">


            <label for="streetname">Streetname:</label>
            <input type="text" class="form-control" name="streetname" required />
            <div>

              <div>
                <label for="place">Place:</label>
                <input type="text" class="form-control" name="place" required />
                <div>
                  <label for="zipcode">Zipcode:</label>
                  <input type="text" class="form-control" name="zipcode" required />
                </div>
                <hr class="mb-4">

                <button type="submit" class="btn btn-primary">Add this address</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
