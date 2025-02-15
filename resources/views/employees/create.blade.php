<base href="/public">
@include('header')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

<form action="{{ route('employees.store') }}" method="post">
    @csrf
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-example-wrap mg-t-30">
                <div class="cmp-tb-hd cmp-int-hd">
                    <h2>Ajouter un Employé</h2>
                </div>
                
                <div class="form-example-int form-horizental mg-t-15">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <label class="hrzn-fm">Nom :</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control input-sm" placeholder="Entrer le nom de l'employé ">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-example-int form-horizental mg-t-15">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <label class="hrzn-fm">Email :</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control input-sm" placeholder="Email">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-example-int form-horizental mg-t-15">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <label class="hrzn-fm">Téléphone :</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control input-sm" placeholder="Position">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-example-int form-horizental mg-t-15">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <label class="hrzn-fm">Position :</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="text" name="position" value="{{ old('position') }}" class="form-control input-sm" placeholder="Exemple: caissier">
                                </div>
                                @error('position')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-example-int form-horizental mg-t-15">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <label class="hrzn-fm">Salaire :</label>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <div class="nk-int-st">
                                    <input type="text" name="salary" value="{{ old('salary') }}" class="form-control input-sm" placeholder="Salaire de l'employé">
                                </div>
                                @error('salary')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="form-example-int mg-t-15">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                            <button class="btn btn-success notika-btn-success">Enrégistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const element = document.getElementById('produit-choices');
        const choices = new Choices(element, {
            searchEnabled: true, // Activer la recherche
            placeholderValue: 'Sélectionner un employé', // Placeholder
            noResultsText: 'Aucun employé trouvé', // Message si aucun résultat
        });
    });
</script>

@include('footer')
