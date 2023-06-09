<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Startmin - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/startmin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets/startmin/css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="assets/startmin/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="assets/startmin/css/dataTables/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/startmin/css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/startmin/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Bogor Lapor</a>
            </div>





            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> </a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout.operator') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href=""><i class="fa fa-table fa-fw"></i> Pengaduan Tanggapan</a>
                        </li>
                        <li>
                            <a href="{{ route('register.petugas') }}"><i class="fa fa-edit fa-fw"></i> Register
                                Petugas </a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tables</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                DataTables Advanced Tables
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>

                                            <tr>
                                                <th>Tanggal Pengaduan</th>
                                                <th>NIK</th>
                                                <th>Laporan</th>
                                                <th>Foto</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datas as $pengaduan)
                                            <tr class="odd gradeX">
                                                <td>{{ $pengaduan->tgl_pengaduan }}</td>
                                                <td>{{ $pengaduan->nik }}<</td>
                                                <td>{{ $pengaduan->isi_laporan }}</td>
                                                <td>
                                                @if ($pengaduan->foto)
                                                    <img style="width:50px; height:50px; ofervlow:hidden;"
                                                        src="{{ asset('storage/' . $pengaduan->foto) }}" alt=" ">
                                                    @else
                                                    <img style="width:50px; height:50px; ofervlow:hidden;"
                                                    src="{{ asset('img/ppnull.jpg') }}" alt="">
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($pengaduan->status == 'belumproses')
                                                    <span class="badge bg-danger"><i class="bi bi-collection me-1"></i>{{ ($pengaduan->status == 'belumproses') ? 'Belum Di Proses' : ''  }}</span>
                                                    @endif     
                                                    @if ($pengaduan->status == 'proses')
                                                    <span class="badge bg-info"><i class="bi bi-star me-1"></i>{{ ($pengaduan->status == 'proses') ? 'Proses' : ''  }}</span>
                                                    @endif          
                                                    @if ($pengaduan->status == 'selesai')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>{{ ($pengaduan->status == 'selesai') ? 'Selesai' : ''  }}</span>
                                                    @endif          
                                                </td>
                                                <td>
                                                        
                                                            @if ($pengaduan->status == 'proses')
                                                              <a class="dropdown-item" href="{{ route('tanggapan.create', $pengaduan->id_pengaduan) }}">Tanggapi</a>
                                                            @endif
                                    
                                                            @if ($pengaduan->status == 'selesai')
                                                            <a class="dropdown-item" href="{{ route('tanggapan.show', $pengaduan->id_pengaduan) }}">Show</a>
                                                            @endif
                                    
                                                            @if ($pengaduan->status == 'selesai'  && Auth::guard('admin')->user()->level == 'admin')
                                                            <a class="dropdown-item" href="{{ route('tanggapan.pdf', $pengaduan->id_pengaduan) }}">Cetak Pdf</a>
                                                            @endif
                                    
                                                            @if ($pengaduan->status == 'belumproses')
                                                              <form action="{{ route('pengaduan.status', $pengaduan->id_pengaduan) }}">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">Verifikasi</button>
                                                              </form>
                                                            @endif
                                    
                                                            <form action="{{ route('pengaduan.destroy', $pengaduan->id_pengaduan) }}">
                                                              @csrf
                                                              @method('delete')
                                                              <button type="submit" class="dropdown-item">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>


                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="assets/startmin/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/startmin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets/startmin/js/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="assets/startmin/js/dataTables/jquery.dataTables.min.js"></script>
    <script src="assets/startmin/js/dataTables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/startmin/js/startmin.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
</body>

</html>
