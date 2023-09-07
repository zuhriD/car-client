<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
   
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Showroom Cars</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="cars.php">List Cars</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
            <!-- <form> -->
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
            <!-- </div> -->

            <button type="submit" class="btn btn-primary mt-3" id="btn-add">Add</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="script-car.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   
    <script>
        $('#btn-add').click(function () {

    $.ajax({
      
        url: 'http://127.0.0.1:8000/api/brand',
        type: 'POST',
        dataType: 'json',
        data: {
            'name': $('#name').val(),
        },
        success: function(result) {
            console.log("masuk");
            console.log(result);
            window.location.href = "brands.php";
        },
        error: function(result) {
            console.log(result);
        }
    })
    
}
);
   </script>
</body>

</html>