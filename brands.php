<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    <title>Bootstrap demo</title>
     <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="script-car.js"></script>
    
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Showroom Mobil</span>
      </a>
  
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="cars.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="add_brands.php" class="nav-link">Tambah Brands</a>
          </li>
        </ul>
      </div>
  
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-bars"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-sign-out-alt"></i> LogOut
            </a>
            
          </div>
        </li>
        
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
        <div class="content-wrapper">
            <div class="content-header">

            </div>
            <section class="content">
                <div class="container">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-6">
                            <h1 class="text-center">Search Brands</h1>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="search-input" placeholder="Keyword" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="search-button" onclick="searchBrand()">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <hr>
                    <div class="row" id="cars-list">
                        
                    </div>
                </div>
            </section>
        </div>
    </div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            getDataBrands();
        });
        function getDataBrands() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/brand',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            // let cars = result;
            // console.log(cars);
            if (result.success == true) {
                $.each(result.data, function (i, data) {
                    $('#cars-list').append(`
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Brand</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${data.name}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="getBrandDetail(${data.id})">
                                        Detail
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="editBrand(${data.id})">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="deleteBrand(${data.id})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    
                `);
                });
                
            }
           
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function getBrandDetail(id) {
    
    $('.modal-body').html( ' ' );
    $.ajax({
        url: 'http://127.0.0.1:8000/api/brand/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            if (result.success == true) {
               $('.modal-body').append(`
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group"> 
                                <li class="list-group-item"><h3>` + result.data.name + `</h3></li>
                            </ul>
                        </div>
                    </div>
                `);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function editBrand(id) {
    $('.modal-body2').html( ' ' );
    $.ajax({
        url: 'http://127.0.0.1:8000/api/brand/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            if (result.success == true) {
               $('.modal-body2').append(`
                   <div class="container">
                   
                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="${result.data.name}">
                            </div>
                            <button type="submit" class="btn btn-primary" onClick="updateData('${result.data.id}')">Submit</button>
                        
                     </div>
                `);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });            
}
function updateData(id) {

    $.ajax({
        url: 'http://127.0.0.1:8000/api/brand/' + id,
        type: 'PUT',
        dataType: 'json',
        data: {
            'name': $('#name').val(),
        },
        success: function (result) {
            console.log(result);
            if (result.success == true) {
               window.location.reload();
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function searchBrand() {
    $('#cars-list').html( ' ' );
    $.ajax({
        url: 'http://127.0.0.1:8000/api/brands',
        type: 'POST',
        dataType: 'json',
        data: {
            'name': $('#search-input').val(),
        },
        success: function (result) {
            if (result.success == true) {
                $.each(result.data, function (i, data) {
                    $('#cars-list').append(`
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Brand</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${data.name}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="getBrandDetail(${data.id})">
                                        Detail
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="editBrand(${data.id})">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="deleteBrand(${data.id})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `);
                });
            }
        },
        error: function (error) {
            $('#cars-list').append(`
                    <div class="col-md-12">
                        <h1 class="text-center">Car Not Found</h1>
                    </div>
                `);
        }
    });
}
function deleteBrand(id){
    $.ajax({
        url: 'http://127.0.0.1:8000/api/brand/' + id,
        type: 'DELETE',
        dataType: 'json',
        success: function (result) {
            if (result.success == true) {
               window.location.reload();
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}
    </script>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Brand Detail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Brand Detail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body2">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>

</html>