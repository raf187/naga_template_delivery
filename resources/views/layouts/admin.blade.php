<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="{{ asset('media/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('media/favicon.ico') }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">


    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset("vendor/fontawesome-free/css/all.css") }}>
    <link href="{{ asset('css/styleBack.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pulgins/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">



</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <i class="text-success nav-icon fas fa-user px-2"></i>
                </div>
                <div class="info">
                    <span class="d-block text-success font-weight-bold">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('homeAdmin') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Accueil
                        </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Commandes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            <!--<span class="badge badge-info right">6</span>-->
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dayOrder') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Commandes du Jour</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('futureOrder') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Commandes à venir
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('oldOrder') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Historique des commandes
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customers') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Clients
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('info') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>
                                Infos service
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('deliRevenu') }}" class="nav-link">
                            <i class="nav-icon fas fa-shipping-fast"></i>
                            <p>
                                Total livraisons
                            </p>
                        </a>
                    </li>
                    @role('superadministrator')
                        <li class="nav-header">Administrateur</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Utilisateurs
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('newAdmin') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Créer utilisateur</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('listAdmin') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gérer utilisateurs</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('dayClose') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-day"></i>
                                <p>
                                    Jours de fermeture
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('newsletter') }}" class="nav-link">
                                <i class="nav-icon fas fa-envelope-open"></i>
                                <p>
                                    Newsletter
                                </p>
                            </a>
                        </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('listeInfo') }}" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>
                                Info liste
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('revenue') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice-dollar"></i>
                            <p>
                                Comptabilité
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>
                                Réglages
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            <!--<span class="badge badge-info right">6</span>-->
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('clickAndCollect') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Click&Collect</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('schedules') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Horaires
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('homeMsg') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Msg accueil
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('offStock') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Disponiblité
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endrole
                    <li class="nav-header">
                        <hr>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-toggle="modal" data-target="#logOut">
                            <i class="nav-icon fas fa-sign-out-alt fa-sm fa-fw"></i>
                            <p>
                            {{ __('Déconnexion') }}
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('adminContent')
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>

@include('modal.logOut')
@include('modal.payMethod')
<!-- ./wrapper -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}" crossorigin="anonymous"></script>
<!--Tinymce-->
<script src="https://cdn.tiny.cloud/1/bnbduad1phrfj1pd2rzog44qm13pvuu41gh4j1qmomm7k0j1/tinymce/5.0.6/tinymce.min.js" referrerpolicy="origin"></script>
<script>

    tinymce.init({
        selector: '.mailingContent',
        plugins: [
            "advlist autolink lists link image charmap preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media save table directionality",
            "paste textpattern"
        ],
        toolbar: "insertfile undo redo | formatselect styleselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | fullscreen code",
        /* enable title field in the Image dialog*/
        image_title: true,
        height: 400,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

</script>

<script>
    tinymce.init({
        selector: '.InfoContent',
        height: 400,
    });
</script>

<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('js/dayOrderAdmin.js') }}"></script>
<script src="{{ asset('js/animation.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/ajaxCalls.js') }}"></script>
<script src="{{ asset('js/mainBack.js') }}"></script>


<script src="{{ asset('vendor/pulgins/jquery.dataTables.js') }}"></script>
<script src="{{ asset('vendor/pulgins/dataTables.bootstrap4.js') }}"></script>

<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(function () {

        var table = $('#exemple').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
            },
            order:[[5,"desc"]]
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#revenue').DataTable( {
            dom: 'Bfrtip',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
            },
            order:[[0,"desc"]],
            buttons: [
                'csv', 'excel', 'pdf'
            ]
        } );
    } );
</script>
</body>
</html>
