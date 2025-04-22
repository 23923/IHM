<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        @include('adminLayout.sidebar')
        <div class="main-panel">
            @include('adminLayout.navbar')

            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Liste des Formations</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addFormationModal">
                                <i class="fa fa-plus"></i> Ajouter une Formation
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="text" id="searchInput" class="form-control mb-4" placeholder="Rechercher une formation">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Formateur</th>
                                    <th>Niveau</th>
                                    <th>Sous-Catégorie</th>
                                    <th style="width: 10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="formationsTable">
                                <!-- Contenu généré dynamiquement -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal d'Ajout -->
            <div class="modal fade" id="addFormationModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title"><span class="fw-mediumbold"> Ajouter </span><span class="fw-light"> Formation </span></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addFormationForm">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" id="addTitle" class="form-control" placeholder="Titre de la formation" >
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="addDescription" class="form-control" placeholder="Description de la formation" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="text" id="addImage" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Formateur</label>
                                    <select id="addFormateurID" class="form-control" ></select>
                                </div>
                                <div class="form-group">
                                    <label>Niveau</label>
                                    <select id="niveau" class="form-control" required>
                                        <option value="">Sélectionner le niveau</option>
                                        <option value="débutant">Débutant</option>
                                        <option value="intermédiaire">Intermédiaire</option>
                                        <option value="avancé">Avancé</option>
                                    </select>
                                </div>    
                                <div class="form-group">
                                    <label>Sous-Catégorie</label>
                                    <select id="sousCategorieID" class="form-control" ></select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" id="addFormationBtn"  class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal d'Édition -->
            <div class="modal fade" id="editFormationModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title"><span class="fw-mediumbold"> Modifier </span><span class="fw-light"> Formation </span></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editFormationForm">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" id="editTitle" class="form-control" placeholder="Titre de la formation" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="editDescription" class="form-control" placeholder="Description de la formation" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="text" id="editImage" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Formateur</label>
                                    <select id="editFormateurID" class="form-control" required></select>
                                </div>
                                <div class="form-group">
                                    <label>Niveau</label>
                                    <select id="editNiveau" class="form-control" required>
                                        <option value="">Sélectionner le niveau</option>
                                        <option value="débutant">Débutant</option>
                                        <option value="intermédiaire">Intermédiaire</option>
                                        <option value="avancé">Avancé</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sous-Catégorie</label>
                                    <select id="editSousCategorieID" class="form-control" required></select>
                                </div>
                                <input type="hidden" id="editFormationId">
                            </form>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" id="editFormationBtn" class="btn btn-primary">Modifier</button>
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
            // Initialisation
            fetchFormations();
            
            // Gestion des modals
            $('#addFormationModal').on('show.bs.modal', fetchFormateursAndSousCategories);
            $('#editFormationModal').on('show.bs.modal', fetchFormateursAndSousCategoriesForEdit);

            // Fonction d'ajout
            $("#addFormationBtn").click(async function() {
                const btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> En cours...');

                try {
                    const formData = {
                        titre: $("#addTitle").val().trim(),
                        description: $("#addDescription").val().trim(),
                        image: $("#addImage").val().trim(),
                        formateur_id: $("#addFormateurID").val(),
                        sous_categorie_id: $("#sousCategorieID").val(),
                        niveau: $("#niveau").val()
                    };

                    // Validation
                    if (!formData.titre || !formData.description || !formData.formateur_id || !formData.sous_categorie_id) {
                        throw new Error("Veuillez remplir tous les champs obligatoires.");
                    }

                    const response = await fetch('/api/formations', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(formData)
                    });

                    if (!response.ok) throw await response.json();

                    $('#addFormationModal').modal('hide');
                    $("#addFormationForm")[0].reset();
                    fetchFormations();
                    alert("Formation ajoutée avec succès!");
                } catch (error) {
                    console.error("Erreur:", error);
                    alert(error.message || "Une erreur est survenue");
                } finally {
                    btn.prop('disabled', false).html('Ajouter');
                }
            });

            // Fonction de modification
            $("#editFormationBtn").click(async function() {
                // Implémentation similaire à addFormationBtn
            });

            // Recherche
            $("#searchInput").on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                $("#formationsTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().includes(searchTerm));
                });
            });
        });

        // Fonctions API
        async function fetchFormations() {
            try {
                const response = await fetch('/api/formations');
                if (!response.ok) throw new Error('Erreur réseau');
                
                const data = await response.json();
                renderFormations(data);
            } catch (error) {
                console.error("Erreur:", error);
                $("#formationsTable").html('<tr><td colspan="6" class="text-center">Erreur de chargement</td></tr>');
            }
        }

        async function fetchFormateursAndSousCategories() {
            try {
                const [formateursRes, sousCategoriesRes] = await Promise.all([
                    fetch('/api/formateurs'),
                    fetch('/api/souscategories')
                ]);

                if (!formateursRes.ok || !sousCategoriesRes.ok) throw new Error('Erreur réseau');

                const [formateurs, sousCategories] = await Promise.all([
                    formateursRes.json(),
                    sousCategoriesRes.json()
                ]);

                $("#addFormateurID").html(
                    formateurs.map(f => `<option value="${f.id}">${f.name}</option>`).join('')
                );
                
                $("#sousCategorieID").html(
                    sousCategories.map(sc => `<option value="${sc.id}">${sc.nomscategorie}</option>`).join('')
                );
            } catch (error) {
                console.error("Erreur:", error);
                $("#formateur_id, #sousCategorieID").html('<option value="">Erreur de chargement</option>');
            }
        }

        function fetchFormateursAndSousCategoriesForEdit() {
            // Similaire à fetchFormateursAndSousCategories mais pour le modal d'édition
        }

        function renderFormations(formations) {
            const content = formations.map(formation => `
                <tr>
                    <td>${formation.titre}</td>
                    <td>${formation.description}</td>
                    <td>${formation.image ? `<img src="${formation.image}" alt="Image" style="width: 50px; height: auto;">` : 'Aucune image'}</td>
                    <td>${formation.formateur?.name || 'Non spécifié'}</td>
                    <td>${formation.sous_categorie?.nomscategorie || 'Non spécifié'}</td>
                    <td>${formation.niveau}</td>
                    <td>
                        <button class="btn btn-link btn-primary" onclick="showEditModal(${formation.id}, '${formation.titre}', '${formation.description}', ${formation.formateur_id},${formation.niveau} ,${formation.sous_categorie_id})">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-link btn-danger" onclick="deleteFormation(${formation.id})">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
            
            $("#formationsTable").html(content || '<tr><td colspan="6" class="text-center">Aucune formation trouvée</td></tr>');
        }

        // Autres fonctions (showEditModal, updateFormation, deleteFormation)
    </script>
</body>
</html>