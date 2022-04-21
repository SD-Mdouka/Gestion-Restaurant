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
                                <i class="fas fa-plus"></i> Modifier une Serveur {{ $servants->title }}
                            </h3>
                            <form action="{{ route("servants.update",$servants->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                  <input type="text" name="name" id="name" class="form-control" value=" {{ $servants->name }}" placeholder="Nom & Prénom"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" id="address" class="form-control" value=" {{ $servants->address }}" placeholder="Address"/>
                                  </div>
                                <div class="form-group">
                                  <button class="btn btn-primary">Valide</button>
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
