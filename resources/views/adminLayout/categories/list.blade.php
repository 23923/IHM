<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        @include('adminLayout/sidebar')
        
        <div class="main-panel">
            @include('adminLayout/navbar')
            
            @yield('content')

            <div class="container">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Liste des catégories</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Ajouter une catégorie
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Formulaire de recherche -->
                            <div class="d-flex mb-4">
                                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une catégorie" />
                            </div>

                            <!-- Modal pour Ajouter une catégorie -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> Nouvelle </span>
                                                <span class="fw-light"> Catégorie </span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Nom de la catégorie</label>
                                                            <input id="addName" type="text" class="form-control" placeholder="Nom de la catégorie" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" id="addRowButton" class="btn btn-primary">
                                                Ajouter
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Fermer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal pour Modifier une catégorie -->
                            <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> Modifier </span>
                                                <span class="fw-light"> Catégorie </span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Nom de la catégorie</label>
                                                            <input id="editName" type="text" class="form-control" placeholder="Nom de la catégorie" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" id="editRowButton" class="btn btn-primary">
                                                Modifier
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Fermer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tableau des catégories -->
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody id="categoriesTableBody">
                                        <!-- Les catégories seront ajoutées ici via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <!-- Footer content -->
            </footer>
        </div>
    </div>

    <!-- JS Files -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Récupérer et afficher les catégories
            fetchCategories();

            // Ajouter une catégorie
            $("#addRowButton").click(function () {
                const categoryName = $("#addName").val();
                if (categoryName) {
                    addCategory(categoryName);
                }
            });

            // Modifier une catégorie
            $("#editRowButton").click(function () {
                const updatedName = $("#editName").val();
                const categoryId = $(this).data('category-id');
                if (updatedName) {
                    updateCategory(categoryId, updatedName);
                }
            });

            // Recherche en temps réel avec keyup
            $("#searchInput").on('keyup', function () {
                const searchTerm = $(this).val().toLowerCase();
                searchCategories(searchTerm);
            });
        });

        // Fonction pour récupérer les catégories
        function fetchCategories() {
            fetch('http://localhost:8000/api/categories') // API URL
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('categoriesTableBody');
                    tableBody.innerHTML = ''; // Vider le tableau avant d'ajouter les nouvelles données
                    data.forEach(category => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${category.nomcategorie}</td>
                            <td>
                                <button class="btn btn-link btn-primary btn-lg" onclick="editCategory(${category.id})">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-link btn-danger" onclick="deleteCategory(${category.id})">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération des catégories:', error));
        }

        // Fonction pour rechercher des catégories en temps réel
        function searchCategories(searchTerm) {
            fetch('http://localhost:8000/api/categories') // API URL
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('categoriesTableBody');
                    tableBody.innerHTML = ''; // Vider le tableau avant d'ajouter les nouvelles données
                    const filteredCategories = data.filter(category => category.nomcategorie.toLowerCase().includes(searchTerm));
                    filteredCategories.forEach(category => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${category.nomcategorie}</td>
                            <td>
                                <button class="btn btn-link btn-primary btn-lg" onclick="editCategory(${category.id})">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-link btn-danger" onclick="deleteCategory(${category.id})">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Erreur lors de la recherche des catégories:', error));
        }

        // Fonction pour ajouter une catégorie
        function addCategory(categoryName) {
            fetch('http://localhost:8000/api/categories', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ nomcategorie: categoryName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    fetchCategories(); // Recharge les catégories après l'ajout
                    $('#addRowModal').modal('hide'); // Ferme le modal après l'ajout
                    $('body').removeClass('modal-open'); // Retire la classe 'modal-open' du body
                    $('.modal-backdrop').remove(); // Retire l'arrière-plan sombre
                }
            })
            .catch(error => console.error('Erreur lors de l\'ajout de la catégorie:', error));
        }

        // Fonction pour éditer une catégorie
        function editCategory(id) {
            fetch(`http://localhost:8000/api/categories/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Pré-remplir le modal d'édition avec les données
                    document.getElementById('editName').value = data.nomcategorie;
                    $('#editRowModal').modal('show');
                    $('#editRowButton').data('category-id', id); // Stocker l'ID de la catégorie à modifier
                })
                .catch(error => console.error('Erreur lors de l\'édition de la catégorie:', error));
        }

        // Fonction pour supprimer une catégorie
        function deleteCategory(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')) {
                fetch(`http://localhost:8000/api/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {
                    if (response.ok) {
                        fetchCategories(); // Recharge les catégories après la suppression
                    }
                })
                .catch(error => console.error('Erreur lors de la suppression de la catégorie:', error));
            }
        }

        // Fonction pour mettre à jour une catégorie
        function updateCategory(id, updatedName) {
            fetch(`http://localhost:8000/api/categories/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ nomcategorie: updatedName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    fetchCategories(); // Recharge les catégories après la mise à jour
                    $('#editRowModal').modal('hide'); // Ferme le modal après la mise à jour
                    $('body').removeClass('modal-open'); // Retire la classe 'modal-open' du body
                    $('.modal-backdrop').remove(); // Retire l'arrière-plan sombre
                }
            })
            .catch(error => console.error('Erreur lors de la mise à jour de la catégorie:', error));
        }
    </script>
</body>
</html>
