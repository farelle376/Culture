<x-app-layout>
@section('content')
@section('css')

 <link rel="stylesheet" href="{{ URL::asset('adminlte/css/adminlte.css') }}" />
@endsection
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des utilisateurs</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Création</li>
                </ol>
              </div>
            </div>

@endsection
        <!-- Table Container -->
        <div class="table-container" >
            <div class="table-header">

                <div class="search-box"  >
                    <a href="{{ Route('utilisateurs.create') }}"><button class="btn btn-primary" id="" >
                    <i class="fas fa-plus"></i> Ajouter un utilisateur
                </button></a>
                </div>
                
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Sexe</th>
                        <th>Date d'Inscription</th>
                        <th>Date de Naissance</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($utilisateurs as $utilisateur )
                        <tr >
                          <td>{{ $utilisateur->nom }}</td>
                          <td>{{ $utilisateur->prenom }}</td>
                          <td>{{ $utilisateur->email }}</td>
                          <td>{{ $utilisateur->sexe }}</td>
                          <td>{{ $utilisateur->date_inscription }}</td>
                          <td>{{ $utilisateur->date_validation }}</td>
                          <td>{{ $utilisateur->statut }}</td>
                          
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