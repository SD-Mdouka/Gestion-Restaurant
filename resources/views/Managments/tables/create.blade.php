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
                                <i class="fas fa-plus"></i> Ajoutér une table
                            </h3>
                            <form action="{{ route("tables.store") }}" method="post">
                                @csrf
                                <div class="form-group">
                                  <input type="text" name="name" id="name" class="form-control" placeholder="Titre"/>
                                </div>
                                <div class="form-group">
                                    <select name="status">
                                        <option value="" selected disabled>Disponible</option>
                                        <option value="1">Oui</option>
                                        <option value="0">No</option>
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
