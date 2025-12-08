<x-app-layout>
@section('content')
@section('css')

 <link rel="stylesheet" href="{{ URL::asset('adminlte/css/adminlte.css') }}" />
@endsection
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des types de media</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Type de Media</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Création</li>
                </ol>
              </div>
            </div>

@endsection
        <!-- Table Container -->
        <div class="table-container" >
            <div class="table-header">

                <div class="search-box"  >
                  
                    <a href="{{ Route('typeMedias.create') }}"><button class="btn btn-primary" id="" >
                    <i class="fas fa-plus"></i> Ajouter un type de media
                </button></a>
                </div>
                
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        
                        <th>Nom du Type de Media</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($typeMedias as $typeMedia )
                        <tr >
                         
                          <td> {{ $typeMedia->nom }}</td>
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