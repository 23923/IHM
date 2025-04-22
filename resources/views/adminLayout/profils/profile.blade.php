<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('adminLayout.sidebar')

        <div class="main-panel">
            <!-- Navbar -->
            @include('adminLayout.navbar')

            <!-- Main Content -->
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Profile</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="#">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Profiles</a>
                        </li>
                    </ul>
                </div>

               <!-- ... (le reste du code avant le formulaire principal reste inchangé) ... -->

<!-- Formulaire principal pour les informations du profil -->
<form action="{{ route('profiles.update', $profile) }}" method="POST" enctype="multipart/form-data" id="mainForm">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $profile->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="specialite">Spécialité:</label>
                        <input type="text" class="form-control" name="specialite" value="{{ old('specialite', $profile->specialite) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $profile->email) }}">
                    </div>

                    <div class="form-group">
                        <label for="role">Rôle:</label>
                        <input type="text" class="form-control" name="role" value="{{ old('role', $profile->role) }}">
                    </div>

                    <div class="form-group">
    <label>Compétences :</label>
    @php
        $competences = old('competence', $profile->competence ? explode(',', $profile->competence) : []);
    @endphp
    <div id="competence-container">
    @foreach($competences as $index => $comp)
        <div class="input-group mb-2 competence-item">
            <input type="text" name="competence[]" class="form-control" value="{{ $comp }}">
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-competence" data-index="{{ $index }}">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    @endforeach
</div>

<div class="input-group mt-2">
    <input type="text" id="new-competence" class="form-control" placeholder="Nouvelle compétence">
    <div class="input-group-append">
        <button type="button" id="add-competence" class="btn btn-success">
            <i class="fas fa-plus"></i> Ajouter
        </button>
    </div>
</div>

<script>
$(document).ready(function() {
    // Ajouter une compétence
    $('#add-competence').click(function() {
        const newComp = $('#new-competence').val().trim();
        if (newComp) {
            const newField = `
                <div class="input-group mb-2 competence-item">
                    <input type="text" name="competence[]" class="form-control" value="${newComp}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-competence">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#competence-container').append(newField);
            $('#new-competence').val('');

            // Envoyer la nouvelle compétence au backend via AJAX
            $.ajax({
                url: '/profile/{{ Auth::user()->id }}/add-competence', // Remplacer par l'URL de votre route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    competence: newComp
                },
                success: function(response) {
                    console.log(response); // Vous pouvez gérer la réponse ici si nécessaire
                },
                error: function(xhr, status, error) {
                    console.error('Erreur:', error);
                }
            });
        }
    });

    // Supprimer une compétence
    $(document).on('click', '.remove-competence', function() {
        const competenceItem = $(this).closest('.competence-item');
        const competenceValue = competenceItem.find('input').val();
        const competenceIndex = $(this).data('index');

        // Supprimer l'élément du DOM
        competenceItem.remove();

        // Envoyer la suppression de la compétence au backend via AJAX
        $.ajax({
            url: '/profile/{{ Auth::user()->id }}/delete-competence/' + competenceIndex, // Remplacer par l'URL de votre route
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
                competence: competenceValue
            },
            success: function(response) {
                console.log(response); // Vous pouvez gérer la réponse ici si nécessaire
            },
            error: function(xhr, status, error) {
                console.error('Erreur:', error);
            }
        });
    });
});
</script>


                    <div class="form-group mt-3">
                        <label for="cv_path">CV:</label>
                        <input type="file" class="form-control" name="cv_path">
                        
                        @if($profile->cv_path)
                            <div class="mt-2">
                                <a href="{{ route('profiles.cv_path.download', $profile) }}" class="btn btn-sm btn-outline-primary">
                                    Télécharger CV actuel
                                </a>
                                <span class="text-muted ml-2">{{ basename($profile->cv_path) }}</span>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        function confirmDelete() {
            swal({
                title: "Êtes-vous sûr?",
                text: "Une fois supprimé, vous ne pourrez pas récupérer ce profil!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }

        // Initialisation des plugins seulement si les éléments existent
        $(document).ready(function() {
            // Éviter les erreurs si les éléments de carte n'existent pas
            if ($('#map').length) {
                // Initialisation des cartes
            }

            // Autres initialisations conditionnelles
        });
    </script>
<script>$(document).ready(function() {
    // Ajouter une compétence
    $('#add-competence').click(function() {
        const newComp = $('#new-competence').val().trim();
        if (newComp) {
            const newField = `
                <div class="input-group mb-2 competence-item">
                    <input type="text" name="competence[]" class="form-control" value="${newComp}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-competence">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#competence-container').append(newField);
            $('#new-competence').val('');
        }
    });

    // Supprimer une compétence
    $(document).on('click', '.remove-competence', function() {
        $(this).closest('.competence-item').remove();
    });
});
</script>
</body>
</html>
