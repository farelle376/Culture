<x-app-layout>

@section('css')

{{-- DataTables CSS --}}

<!-- CSS -->



@endsection

@section('title')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Gestion des langues</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Langues</a></li>
            <li class="breadcrumb-item active" aria-current="page">Création</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="table-container">

    {{-- ===== BARRE DE RECHERCHE STYLISÉE ===== --}}
    <div class="mb-3" style="gap: 550px; display:flex;">
         <a href="{{ Route('contenus.create') }}"><button class="btn btn-primary" id="" >
                    <i class="fas fa-plus"></i> Ajouter un contenu
                </button></a>
    </div>
    {{-- ===== FIN BARRE DE RECHERCHE ===== --}}

    <table class="stripe hover w-full text-left" id="myTable">
        <thead>
            <tr>
                <th>Code Langue</th>
                <th>Nom de la Langue</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($langues as $langue)
            <tr>
                <td>{{ $langue->code_langue }}</td>
                <td>{{ $langue->nom_langue }}</td>
                <td>
                    <div class="action-buttons" style="display: flex; gap:6px;">
                        <a href="{{ route('langues.show', $langue->id) }}">
                            <button class="btn btn-primary">
                                <i>👁️</i>
                            </button>
                        </a>

                        <a href="{{ route('langues.edit', $langue->id) }}">
                            <button class="btn btn-warning">
                                <i>✏️</i>
                            </button>
                        </a>

                        <form action="{{ route('langues.destroy', $langue->id) }}" method="POST">
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

</div>

@endsection


@section('script')

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#myTable').DataTable();
});
</script>




@endsection
</x-app-layout>
