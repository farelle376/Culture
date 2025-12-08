<x-app-layout>

@section('title')
<div class="row mb-3">
    <div class="col-sm-6">
        <h3 class="mb-0">{{ $langues->nom_langue }}</h3>
    </div>
    <div class="col-sm-6 text-end">
        <span class="badge bg-success fs-6">Code : {{ $langues->code_langue }}</span>
    </div>
</div>
@endsection

@section('content')
<div class="row g-4">

    <!-- Carte principale -->
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fas fa-info-circle me-2"></i>Description</h5>
                <p class="fs-6">{{ $langues->description ?? 'Aucune description disponible.' }}</p>
            </div>
        </div>
    </div>

    <!-- Région et Statistiques -->
    <div class="col-md-6">
        <div class="card border-primary shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                <div>
                    <h6 class="mb-0">Région associée</h6>
                    <p class="mb-0">{{ $langues->region->nom_region ?? 'Non définie' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-warning shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="fas fa-file-alt fa-2x text-warning"></i>
                <div>
                    <h6 class="mb-0">Contenus associés</h6>
                    <p class="mb-0">{{ $langues->contenus->count() ?? 0 }} contenu(s)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenus associés -->
    @if($langues->contenus->count() > 0)
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-book me-2"></i>Contenus associés</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach($langues->contenus as $contenu)
                    <div class="col-md-3">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">{{ Str::limit($contenu->titre, 20) }}</h6>
                                <p class="card-text">{{ Str::limit($contenu->description, 50) }}</p>
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ route('contenus.show', $contenu->id) }}" class="btn btn-sm btn-primary">
                                    Voir
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Bouton retour -->
    <div class="col-md-12 text-end mt-3">
        <a href="{{ route('langues.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i>Retour</a>
    </div>

</div>
@endsection

</x-app-layout>
