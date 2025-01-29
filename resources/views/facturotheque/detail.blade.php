<base href="/public">
@include('header')
<style>
    .breadcomb-report {
        display: inline-block;
        margin-right: 10px; /* Espace entre les boutons */
    }

    #pagination-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    #pagination-controls button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        margin: 0 5px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #pagination-controls button:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }

    #pagination-controls button:hover:not(:disabled) {
        background-color: #0056b3;
    }

    #pagination-controls #page-number {
        margin: 0 10px;
        font-weight: bold;
    }

</style>
@notifyCss

<x-notify::notify />

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ url('/mesfacture') }}">
                        @include('search')
                    </form>

                    <!-- Tableau -->
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                            <tr>
                                <th>libelle</th>
                                <th>qte</th>
                                <th>prixUnit</th>
                                <th>Montant</th>
                            </tr>
                            </thead>
                            @foreach ($f as $facture)
                            <tbody>
                                 <tr>
                                    <td>
                                            {{ $facture->nom }}

                                    </td>

                                    <td>
                                        <span
                                            data-original-quantite="{{ $facture->quantite }}">
                                            {{ number_format($facture->quantite, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="editable-price"
                                            data-id="{{ $facture->id }}"
                                            data-original-price="{{ $facture->prix }}">
                                            {{ number_format($facture->prix, 2) }}
                                        </span>
                                    </td>

                                    <td>{{ number_format($facture->montant, 2) }} </td>
                                    <td>
                                        <!--<div class="d-flex justify-content-center align-items-center">
                                                    <a class="dropdown-item" href="{{ route('facture.modifier', $facture->id) }}">modifier</a>
                                                    <a class="dropdown-item" href="{{url('/facture/delete', $facture->id)}}">Supprimer</a>
                                        </div> -->
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')

@notifyJs
