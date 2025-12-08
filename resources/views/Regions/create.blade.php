<x-app-layout>
@section('content')
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des Regions</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Régions</a></li>
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
                  <form method="POST" action="{{ route('regions.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                        <label for="nom_region" class="form-label">Nom de la Region</label>
                        <input type="text" class="form-control" name="nom_region" />
                      </div>
                       

                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input
                          type="text"
                          class="form-control"
                          name="description"
                          
                        />
                        <div class="mb-3">
                        <label for="population" class="form-label">Population</label>
                        <input
                          type="number"
                          class="form-control"
                          name="population"
                          
                        />
                        <div class="mb-3">
                        <label for="superficie" class="form-label">Superficie</label>
                        <input
                          type="number"
                          class="form-control"
                          name="superficie"
                          
                        />
                        <div class="mb-3">
                        <label for="localisation" class="form-label">Localisation</label>
                        <input
                          type="text"
                          class="form-control"
                          name="localisation"
                          
                        />
                      <br>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer" style="display: flex;">
                      <a href="{{ route('regions.index') }}"><button class="btn btn-primary" >Annuler</button></a>
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