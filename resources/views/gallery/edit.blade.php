
@extends ('layouts.sidemenu')

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
      <form method="post" action="{{ route('gallery.update', $product->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Product Name</label>
          <input type="text" class="form-control" name="name" value="{{ $product->product_name }}" />
        </div>
        <br />
        <label for="exampleTextArea">Description</label>
        <br />
        <div class="upload_form">
        How would you describe your product?
        </div>
        <br />
        <textarea class="form-control" maxlength="300" name="description" rows="2" value="{{ $product->product_description }}">{{ $product->product_description }}</textarea>
        <small class="text-secondary">{{ $errors->first('description') }}</small>
        <br />
        <label for="exampleSelect4">Price</label>
        <div class="upload_form">
        What is your product worth?
        </div>
        <br />
        <div class="form-group">
        <input type="text" class="form-control" name="price" value="{{ $product->price }}" />
        </div>
        <small class="text-secondary">{{ $errors->first('price') }}</small>
        <br />

        <label for="exampleInputText2">Tags</label>
        <br />
        <div class="upload_form">
        How can others find your product?
        </div>
        <br />
        <input type="text" class="form-control" name="Tag1" value="{{ $product->ProductTag->name }}" />
        <br />

        <div class="form-group{{ $errors->has('color1') ? ' has-error' : '' }}">
          Select Color
          <br />
          <div class="upload_form">
          Which colors do you see in your product?
          </div>
          <br />
          @foreach($colors as $color)
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="color" value="{{ $color->id }}">{{ $color->name }}
              </label>
            </div>

            @endforeach

        </div>
        <br />
        <label for="exampleSelect2">Select Category</label>
        <br />
        <div class="upload_form">
        Choose the category that is most suitable to your product
        </div>
        <br />
        @foreach($category_list as $category)
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="category" value="{{ $category->id }}">{{$category->name}}
            </label>
          </div>
          @endforeach
        <small class="text-secondary">{{ $errors->first('category') }}</small>
        <br />

        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
