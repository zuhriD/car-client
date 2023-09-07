function getData() {
    $.ajax({
        url: 'http://127.0.0.1:8000/api/car',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            // let cars = result;
            // console.log(cars);
            if (result.success == true) {
                $.each(result.data, function (i, data) {
                    $('#cars-list').append(`
                    <div class="col-md-4">
                        <div class="card card-primary card-outline shadow mb-4">
                        <img src="images/${data.image}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title ">` + data.name + `</h5>
                            <p class="card-text">Rp.` + data.price + `</p>
                            <p class="card-text">` + data.description + `</p>
                            <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
                        onClick="getDetail('${data.id}')">Detail</a>
                        <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" 
                        onClick="showEdit('${data.id}')">Edit</a>
                        <a class="btn btn-danger btn-sm" onClick="deleteData('${data.id}')">Hapus</a>
                         </div>
                        </div>
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


function login(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'http://127.0.0.1:8000/api/login',
        type: 'POST',
        data: {
            'email': 'diki@gmail.com',
            'password': '12345'
        },
        success: function(result){
           console.log(result);
        //    window.location = '/';
        },
        error: function(result){
          console.log(result);
        }
    });
}
function getDetail(id) {
    
    $('.modal-body').html( ' ' );
    $.ajax({
        url: 'http://127.0.0.1:8000/api/car/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            if (result.success == true) {
               $('.modal-body').append(`
                    <div class="row">
                        <div class="col-md-6">
                            <img src="images/${result.data.image}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group"> 
                                <li class="list-group-item"><h3>` + result.data.name + `</h3></li>
                                <li class="list-group-item">` + result.data.price + `</li>
                                <li class="list-group-item">` + result.data.description + `</li>
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

function showEdit(id) {
    $('.modal-body2').html( ' ' );
    $.ajax({
        url: 'http://127.0.0.1:8000/api/car/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            if (result.success == true) {
               $('.modal-body2').append(`
                   <div class="container">
                   <form enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="${result.data.name}">
                            </div>
                            <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" class="form-control" id="year" value="${result.data.year}">
                            </div>
                            <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" value="${result.data.description}">
                            </div>
                            <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" value="${result.data.image}">
                            </div>
                            <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" value="${result.data.price}">
                            </div>
                            <button type="submit" class="btn btn-primary" onClick="updateData('${result.data.id}')">Submit</button>
                        </form>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'http://127.0.0.1:8000/api/car/' + id,
        type: 'PUT',
        dataType: 'json',
        data: {
            'name': $('#name').val(),
            'year': $('#year').val(),
            'description': $('#description').val(),
            'image': $('#image').val().replace(/C:\\fakepath\\/i, ''),
            'price': $('#price').val(),
        },
        success: function (result) {
            console.log(result);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function search() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#cars-list').html( ' ' );
    $.ajax({
        url: 'http://127.0.0.1:8000/api/cars',
        type: 'POST',
        dataType: 'json',
        data: {
            name: $('#search-input').val(),
        },
        success: function (result) {
            if (result.success == true) {
                $.each(result.data, function (i, data) {
                    $('#cars-list').append(`
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <img src="images/${data.image}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title ">` + data.name + `</h5>
                                <h6 class="card-subtitle mb-2 text-muted">` + data.price + `</h6>
                                <p class="card-text">` + data.description + `</p>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                            onClick="getDetail('${data.id}')">Detail</a>
                            </div>
                        </div>
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

function deleteData(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'http://127.0.0.1:8000/api/car/' + id,
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

function youtube(name) {
   $('.modal-body3').html('');
    $.ajax({
        url: 'https://www.googleapis.com/youtube/v3/search',
        type: 'GET',
        dataType: 'json',
        data: {
            'key' : 'AIzaSyDrj4JfG11PcKOVujQoUxnvnns0tgOCG8U',
            'part' : 'snippet',
            'q' : 'review '+ name,
            'type' : 'video',
            'maxResults' : 1,
            'videoEmbeddable' : true,
        },
        success: function (data) {
           let videos = data.items;
              $('.modal-body3').append(`
              <div class="container ">
                <h3 class="text-center">Review `+ name +`</h3>
                <div class="embed-responsive embed-responsive-16by9">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/${videos[0].id.videoId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                </div>
                `);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
               




