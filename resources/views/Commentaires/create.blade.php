<x-app-layout>
@section('content')
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des Commentaires</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Commentaires</a></li>
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
                  <form method="POST" action="{{ route('commentaires.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                        <label for="texte" class="form-label">Texte du commentaire</label>
                        <input type="text" class="form-control" name="texte" />
                      </div>
                       

                      <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input
                          type="number"
                          class="form-control"
                          name="note"
                          
                        />
                        
                      </div>
                      <div class="mb-3">
                        <label for="date_commentaire" class="form-label">Date du commentaire</label>
                        <input
                          type="date"
                          class="form-control"
                          name="date_commentaire"
                          
                        />
                        
                      </div>
                      <div class="mb-3">
                        <label for="id_utilisateur" class="form-label">Id de l'utilisateur</label>
                        <input
                          type="number"
                          class="form-control"
                          name="id_utilisateur"
                          
                        />
                        
                      </div>
                      <div class="mb-3">
                        <label for="id_contenu" class="form-label">Id du Contenu</label>
                        <input
                          type="number"
                          class="form-control"
                          name="id_contenu"
                          
                        />
                        
                      </div>
                      <br>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer" style="display: flex;">
                      <a href="{{ route('commentaires.index') }}"><button class="btn btn-primary" >Annuler</button></a>
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