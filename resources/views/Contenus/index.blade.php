
<x-app-layout>
    @section('content')
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des contenus</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Contenus</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Création</li>
                </ol>
              </div>
            </div>

@endsection
        <!-- Table Container -->
        <div class="table-container" >
            <div class="table-header">

                <div class="search-box"  >
                
                    <a href="{{ Route('contenus.create') }}"><button class="btn btn-primary" id="" >
                    <i class="fas fa-plus"></i> Ajouter un contenu
                </button></a>
                </div>
                
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Texte</th>
                        <th>Date de création</th>
                        <th>Date de validation</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($contenus as $contenu )
                        <tr >
                           <td>{{ $contenu->titre }}</td>
                           <td>{{ $contenu->texte }}</td>
                           <td>{{ $contenu->date_creation }}</td>
                           <td>{{ $contenu->date_validation }}</td>
                           <td>{{ $contenu->statut }}</td>
                          
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