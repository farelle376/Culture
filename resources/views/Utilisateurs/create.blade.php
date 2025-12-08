<x-app-layout>
@section('content')
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des utilisateurs</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Formulaire</li>
                </ol>
              </div>
            </div>

@endsection
    <div class="row g-4">
              <!--begin::Col-->
             
              <!--end::Col-->
              <!--begin::Col-->
              <div class="col-md-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form method="POST" action="{{ route('utilisateurs.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" />
                      </div>
                      <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input
                          type="text"
                          class="form-control"
                          name="prenom"
                        />
                         <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          name="email"
                        />
                         <div class="mb-3">
                        <label for="sexe" class="form-label">Sexe</label>
                        <input
                          type="text"
                          class="form-control"
                          name="sexe"
                        />
                         <div class="mb-3">
                        <label for="date_inscription" class="form-label">Date Inscription</label>
                        <input
                          type="date"
                          class="form-control"
                          name="date_inscription"
                        />
                         <div class="mb-3">
                        <label for="date_validation" class="form-label">Date Validation</label>
                        <input
                          type="date"
                          class="form-control"
                          name="date_validation"
                        />
                         <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <input
                          type="text"
                          class="form-control"
                          name="statut"
                        />
                      <br>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer" style="display: flex;">
                      <a href="{{ route('utilisateurs.index') }}"><button class="btn btn-primary" >Annuler</button></a>
                       <button type="submit" class="btn btn-success" style="margin-left:750px">Enregistrer</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
                <!--begin::Input Group-->
                
                  <!--end::JavaScript-->
                
                <!--end::Form Validation-->
        </div>
              <!--end::Col-->
    </div>
@endsection
</x-app-layout>