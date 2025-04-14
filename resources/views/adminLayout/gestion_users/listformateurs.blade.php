<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

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
                                <h4 class="card-title">Liste des Formateurs</h4>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="formateurs-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Spécialité</th>
                                            <th>Compétences</th>
                                            <th>CV</th>
                                            <th>Statut</th>
                                            <th style="width: 10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($formateurs as $formateur)
                                        <tr>
                                            <td>{{ $formateur->name }}</td>
                                            <td>{{ $formateur->email }}</td>
                                            <td>{{ $formateur->specialite ?? '-' }}</td>
                                            <td>{{ Str::limit($formateur->competence, 30) ?? '-' }}</td>
                                            <td>
                                              @if($formateur->cv_path)
                                                  <a href="{{ asset('storage/'.$formateur->cv_path) }}" target="_blank" class="btn btn-sm btn-info">
                                                      <i class="fa fa-eye"></i> Voir
                                                  </a>
                                              @else
                                                  <span class="text-muted">Non fourni</span>
                                              @endif
                                          </td>
                                            <td>
                                                <span class="badge {{ $formateur->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $formateur->is_active ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <form method="POST" action="{{ route('users.toggle-block', $formateur) }}" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn btn-link {{ $formateur->is_active ? 'btn-warning' : 'btn-success' }}"
                                                                data-bs-toggle="tooltip" 
                                                                title="{{ $formateur->is_active ? 'Bloquer' : 'Débloquer' }}">
                                                            <i class="fa {{ $formateur->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-link btn-info btn-lg" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#contactModal{{ $formateur->id }}"
                                                    title="Envoyer un email">
                                                <i class="fa fa-envelope"></i>
                                            </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @foreach($formateurs as $formateur)
                                        <div class="modal fade" id="contactModal{{ $formateur->id }}" tabindex="-1" aria-hidden="true">
                                            <!-- Même contenu que pour candidats en remplaçant $candidat par $formateur -->
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title">Envoyer un email à {{ $formateur->name }}</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <form method="POST" action="{{ route('user.contact', $formateur) }}">
                                                      @csrf
                                                      <div class="modal-body">
                                                          <div class="mb-3">
                                                              <label class="form-label">Sujet</label>
                                                              <input type="text" name="subject" class="form-control" required>
                                                          </div>
                                                          <div class="mb-3">
                                                              <label class="form-label">Message</label>
                                                              <textarea name="message" class="form-control" rows="5" required></textarea>
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                          <button type="submit" class="btn btn-primary">Envoyer</button>
                                                      </div>
                                                  </form>
                                              </div>
                                          </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    </div>
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('assets/js/setting-demo2.js')}}"></script>
    <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script>

    <!-- JS Files -->
    @stack('scripts')
</body>
</html>