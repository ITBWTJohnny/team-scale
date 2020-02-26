<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Upload file</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/statistics">Statistics</a>
            </li>

        </ul>

    </div>
</nav>
    <div class="container">
        <div class="row">
           <div class="col-md-4 offset-md-4">
               <form method="post" id="form" action="/import" enctype="multipart/form-data">
                   <div class="form-group">
                       <label for="exampleInputPassword1">Upload Csv File</label>
                       <input type="file" name="file" required class="form-control-file" id="exampleFormControlFile1">
                   </div>
                   <div style="display:flex">
                       <div class="spinner-border text-primary" id="spinner" role="status" style="display:none;margin-right: 1rem">
                           <span class="sr-only">Loading...</span>
                       </div>
                       <button type="submit" id="button" class="btn btn-primary">Submit</button>
                   </div>

               </form>
           </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        function submitForm() {
          let spinner = document.getElementById('spinner');
          let button = document.getElementById('button');
          spinner.style.display = 'inline-block';
          button.disabled = true;
        }

        document.getElementById("form").addEventListener("submit", submitForm);
    </script>
</body>
</html>