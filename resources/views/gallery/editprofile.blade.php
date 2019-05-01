@extends('gallery.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit product
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('editprofile.update', $userid) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Product name:</label>
          <input type="text" class="form-control" name="name" value={{ $product->product_name }} />
        </div>
        <div class="form-group">
          <label for="price">Product description:</label>
          <input type="text" class="form-control" name="description" value={{ $product->product_description }} />
        </div>
        <div class="form-group">
          <label for="quantity">Product price:</label>
          <input type="text" class="form-control" name="price" value={{ $product->price }} />
        </div>
        <label for="exampleSelect2">Select Tags</label>
				<select multiple class="form-control" name="tags" id="exampleSelect2" value={{ $product->ProductTag->name}}/>
					<option>Black/White</option>
					<option>Abstract</option>
					<option></option>
				</select>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
