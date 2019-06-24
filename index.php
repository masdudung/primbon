<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/primbon.css" crossorigin="anonymous">

    <title>PRIMBON KITAB BETALJEMUR ADAMMAKNA</title>
  </head>

  <body>
  <div id="loadContainer"><img src="assets/loading.gif"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">RAMALAN JODOH</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" target="_blank" href="https://fb.com/chentiz">About Us</a>
            </li>
        </ul>
    </div>
    </nav>

    <div class="container">
        <br>
        <form method="POST">
        <div class="form-group row">
            <label for="nama1" class="col-sm-2 col-form-label">Nama Kamu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama1" value="" name="nama1" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="date1" class="col-sm-2 col-form-label">Tanggal Lahir Kamu</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="date1" value="" name="date1" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama2" class="col-sm-2 col-form-label">Nama Pasangan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama2" value="" name="nama2" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="date2" class="col-sm-2 col-form-label">Tanggal Lahir pasangan</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="date2" value="" name="date2" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <input type="submit" class="form-control bg-primary" id="submit" name="submit" value="submit">
            </div>
        </div>
        </form>

        <div id="hasilRamalan">
            <!-- Button trigger modal -->
            <button type="button" hidden id="showModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">HASIL RAMALAN PERJODOHAN UNTUK PASANGAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info" role="alert">
                        <p>
                            Jangan mudah memutuskan suatu hubungan hanya karena perhitungan suatu perjodohan itu buruk menurut petung. Karena takdir yang belum terjadi masih bisa kita rubah.
                        </p>
                    </div>
                    <div class="fromAjax"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="assets/popper.min.js" crossorigin="anonymous"></script>
    <script src="assets/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="assets/primbon.js" crossorigin="anonymous"></script>
  </body>
</html>