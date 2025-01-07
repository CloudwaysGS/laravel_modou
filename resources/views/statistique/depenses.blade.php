@include('header')
<style>
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .badge-info {
        background-color: #17a2b8;
        color: #fff;
    }
    .btn-sm {
        padding: 0.2rem 0.5rem;
    }
</style>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mt-5">
    <a href="{{url('/expenses/create')}}" class="float-end mb-4 font-weight-bold text-primary"><h5>Ajouter une dépense</h5></a>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="breadcomb-wp">
                <div class="breadcomb-icon">
                    <i class="notika-icon notika-windows"></i>
                </div>
                <div class="breadcomb-ctn">
                    <h2>Tableau de données dépenses</h2>
                    <p>Bienvenue sur le <span class="bread-ntd">modèle d'administration</span> Coulibaly</p>
                </div>
            </div>
        </div>

    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover shadow-lg rounded-lg">
            <thead class="thead-dark">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Date</th>
                <th class="text-center">Montant</th>
                <th class="text-center">Catégorie</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($expenses as $index => $expense)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($expense->created_at)->format('d/m/Y') }}</td>
                    <td class="text-center text-success font-weight-bold">{{ number_format($expense->amount, 2) }} FCFA</td>
                    <td class="text-center"><span class="badge badge-info">{{ $expense->category }}</span></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="notika-icon notika-menu"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a href="{{ route('expenses.edit', $expense->id) }}" ><i class="fas fa-edit"></i> Modifier</a>
                                                        <a href="{{ route('expenses.extraire', $expense->id) }}" ><i class="fas fa-edit"></i> Extraire</a>

                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline delete-expense-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" >
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Liens de pagination -->
        <div class="d-flex justify-content-center">
            {{ $expenses->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-expense-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                // Afficher une alerte de confirmation
                const confirmed = confirm("Êtes-vous sûr de vouloir supprimer cette dépense ?");
                if (confirmed) {
                    // Soumettre le formulaire associé
                    button.closest('form').submit();
                }
            });
        });
    });

</script>
@include('footer')
