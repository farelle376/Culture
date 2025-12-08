@extends('layout')
@section('content')
@section('title')
 <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Gestion des langues</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Langues</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Modification</li>
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
                  <form method="POST" action="{{ route('langues.update', $langues->id) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                        <label for="code_langue" class="form-label">Code de la langue</label>
                        <input type="text" class="form-control" name="code_langue" value="{{ $langues->code_langue }}" />
                      </div>
                       

                      <div class="mb-3">
                        <label for="nom_langue" class="form-label">Nom de la langue</label>
                        <input
                          type="text"
                          class="form-control"
                          name="nom_langue"
                          value="{{ $langues->nom_langue }}"
                        />
                        
                      </div>
                      <div class="mb-3">
                        <label for="description" class="form-label">Description de la langue</label>
                        <textarea name="description"  class="form-control" id="" value="{{ $langues->description }}"></textarea>
                      </div>
                      
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer" style="display: flex;">
                      <a href="{{ route('langues.index') }}"><button class="btn btn-primary" >Annuler</button></a>
                       <button type="submit" class="btn btn-success" style="margin-left:750px">Modifier</button>
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