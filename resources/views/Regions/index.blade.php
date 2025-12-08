<x-app-layout>

@section('content')
@section('css')

 <link rel="stylesheet" href="{{ URL::asset('adminlte/css/adminlte.css') }}" />
@endsection
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des regions</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Régions</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Création</li>
                </ol>
              </div>
            </div>

@endsection

        <!-- Table Container -->
        <div class="table-container" >
            <div class="table-header">

                <div class="search-box"  >
                
                    <a href="{{ Route('regions.create') }}"><button class="btn btn-primary" id="" >
                    <i class="fas fa-plus"></i> Ajouter une Région
                </button></a>
                </div>
                
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nom de la région</th>
                        <th>Description</th>
                        <th>Population</th>
                        <th>Superficie</th>
                        <th>Localisation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($regions as $region )
                        <tr >
                          <td>{{ $region->nom_region }}</td>
                          <td> {{ $region->description }}</td>
                          <td>{{ $region->population }}</td>
                          <td>{{ $region->superficie }}</td>
                          <td>{{ $region->localisation }}</td>
                          <td>
<div class="action-buttons" style="display: flex; gap:6px;">
                        <a href="">
                            <button class="btn btn-primary">
                                <i>👁️</i>
                            </button>
                        </a>

                        <a href="">
                            <button class="btn btn-warning">
                                <i>✏️</i>
                            </button>
                        </a>

                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                               >
                                <i>🗑️</i>
                            </button>
                        </form>
                    </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            
        </div>


 

@endsection
</x-app-layout>