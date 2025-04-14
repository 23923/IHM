
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Sous-Catégories</title>
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        @include('adminLayout/sidebar')
        <div class="main-panel">
            @include('adminLayout/navbar')

            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Liste des Sous-Catégories</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addSubCategoryModal">
                                <i class="fa fa-plus"></i> Ajouter une Sous-Catégorie
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="text" id="searchInput" class="form-control mb-4" placeholder="Rechercher une sous-catégorie">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Catégorie</th>
                                    <th style="width: 10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="subCategoriesTable">
                                <!-- Contenu généré dynamiquement -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal d'Ajout -->
            <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title"><span class="fw-mediumbold"> Ajouter </span><span class="fw-light"> Sous-Catégorie </span></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addSubCategoryForm">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" id="addName" class="form-control" placeholder="Nom de la sous-catégorie" required>
                                </div>
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select id="categorieID" class="form-control" required></select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" id="addSubCategoryBtn" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal d'Édition -->
            <div class="modal fade" id="editSubCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title"><span class="fw-mediumbold"> Modifier </span><span class="fw-light"> Sous-Catégorie </span></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editSubCategoryForm">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" id="editName" class="form-control" placeholder="Nom de la sous-catégorie" required>
                                </div>
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select id="editCategorieID" class="form-control" required></select>
                                </div>
                                <input type="hidden" id="editSubCategoryId">
                            </form>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" id="editSubCategoryBtn" class="btn btn-primary">Modifier</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            fetchSousCategories();
            $('#addSubCategoryModal').on('show.bs.modal', fetchCategories);
            $('#editSubCategoryModal').on('show.bs.modal', fetchCategoriesForEdit);

            $("#addSubCategoryBtn").click(function () {
    let name = $("#addName").val();
    let categoryID = $("#categorieID").val();
    if (name && categoryID) {
        addSousCategorie(name, categoryID);
    } else {
        alert("Veuillez remplir tous les champs.");
    }
});



            $("#editSubCategoryBtn").click(function () {
                let name = $("#editName").val();
                let categoryID = $("#editCategorieID").val();
                let id = $("#editSubCategoryId").val();
                if (name && categoryID) {
                    updateSousCategorie(id, name, categoryID);
                } else {
                    alert("Veuillez remplir tous les champs.");
                }
            });

            $("#searchInput").on('keyup', function () {
                let searchTerm = $(this).val().toLowerCase();
                $("#subCategoriesTable tr").each(function () {
                    let text = $(this).find("td:first").text().toLowerCase();
                    $(this).toggle(text.includes(searchTerm));
                });
            });
        });

        function fetchSousCategories() {
            fetch('http://localhost:8000/api/scategories')
                .then(res => res.json())
                .then(data => {
                    let content = "";
                    data.forEach(sub => {
                        content += `
                            <tr>
                                <td>${sub.nomscategorie}</td>
                                <td>${sub.categorie ? sub.categorie.nomcategorie : 'Non spécifié'}</td>
                                <td>
                                    <button class="btn btn-link btn-primary" onclick="showEditModal(${sub.id}, '${sub.nomscategorie}', ${sub.categorie ? sub.categorie.id : 'null'})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-link btn-danger" onclick="deleteSousCategorie(${sub.id})">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>`;
                    });
                    $("#subCategoriesTable").html(content);
                })
                .catch(err => console.error("Erreur:", err));
        }

        function fetchCategories() {
            fetch('http://localhost:8000/api/categories')
                .then(res => res.json())
                .then(categories => {
                    let options = categories.map(cat => `<option value="${cat.id}">${cat.nomcategorie}</option>`).join("");
                    $("#categorieID").html(options);
                })
                .catch(err => console.error("Erreur:", err));
        }

        function fetchCategoriesForEdit() {
            fetch('http://localhost:8000/api/categories')
                .then(res => res.json())
                .then(categories => {
                    let options = categories.map(cat => `<option value="${cat.id}">${cat.nomcategorie}</option>`).join("");
                    $("#editCategorieID").html(options);
                })
                .catch(err => console.error("Erreur:", err));
        }

        function addSousCategorie(name, categoryID) {
    $.ajax({
        url: '/api/scategories',
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            nomscategorie: name,
            categorieID: categoryID
        },
        success: function(response) {
            console.log("Succès:", response);
            window.location.reload(); // Recharge après succès
        },
        error: function(xhr, status, error) {
            console.error("Échec:", xhr.responseText);
            alert("Erreur: " + xhr.responseJSON?.message || xhr.statusText);
        }
    });
}

        function showEditModal(id, name, categoryID) {
            $("#editSubCategoryId").val(id);
            $("#editName").val(name);
            $("#editCategorieID").val(categoryID);
            $('#editSubCategoryModal').modal('show');
        }

        function updateSousCategorie(id, name, categoryID) {
            fetch(`http://localhost:8000/api/scategories/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nomscategorie: name, categorieID: categoryID })
            })
            .then(() => {
                $('#editSubCategoryModal').modal('hide');
                fetchSousCategories();
            })
            .catch(err => console.error("Erreur:", err));
        }

        function deleteSousCategorie(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette sous-catégorie ?')) {
                fetch(`http://localhost:8000/api/scategories/${id}`, { method: 'DELETE' })
                    .then(() => fetchSousCategories())
                    .catch(err => console.error("Erreur:", err));
            }
        }

        // Ajouter cette fonction pour supprimer la classe 'modal-backdrop' après la fermeture du modal
        $('#addSubCategoryModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
        });

        $('#editSubCategoryModal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').remove();
        });
    </script>
</body>
</html>

