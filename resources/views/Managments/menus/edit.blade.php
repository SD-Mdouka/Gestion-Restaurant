@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @include("layouts.sidbar")
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-secondary border-bottom mb-3 p-2">
                                <i class="fas fa-plus"></i> Modifier une menu {{ $menu->title }}
                            </h3>
                            <form action="{{ route("menus.update",$menu->slug) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                  <input type="text" name="title" id="title" class="form-control" value="{{ $menu->title }}"/>
                                </div>
                                <div class="form-group">
                                    <textarea name="description" id="description" class="form-control"
                                    rows="5" cols="30"
                                     placeholder="description">{{ $menu->description }}</textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">$</div>
                                    </div>
                                    <input type="number" name="price" id="title" class="form-control" value="{{ $menu->price }}"/>
                                    <div class="input-group-append">
                                        <div class="input-group-text">.00</div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <img src="{{ asset("images/menus/". $menu->image ) }}" alt="{{ $menu->title}}"
                                    class ="img-fluid rounded" width="200" height="200"
                                   >
                                </div>
                                <div class="form-group">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="" selected disabled>Choisir une catégories</option>
                                        @foreach ($categories as $category)
                                         <option {{  $category->id ===  $menu->category->id ? "selected" : "" }}
                                          value="{{ $category->id }}">{{ $category->title}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary">Valide</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
