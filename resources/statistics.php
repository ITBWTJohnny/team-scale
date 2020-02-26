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
                <a class="nav-link" href="/">File upload</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/statistics">Statistics</a>
            </li>

        </ul>

    </div>
</nav>
    <div class="container">
        <div class="row">
           <div class="col-md-10 offset-md-2">
               <table class="table">
                   <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Same Continent Calls Count</th>
                            <th>Same Continent Calls Duration</th>
                            <th>Total number of calls</th>
                            <th>Total duration of calls</th>
                        </tr>
                   </thead>
                   <tbody>
                   <?php foreach ($statistics as $customerId => $item): ?>
                       <tr>
                           <td><?= $customerId; ?></td>
                           <td><?= $item['same_continent_call_count']; ?></td>
                           <td><?= $item['same_continent_duration']; ?></td>
                           <td><?= $item['call_count']; ?></td>
                           <td><?= $item['duration']; ?></td>
                       </tr>
                   <?php endforeach; ?>
                   </tbody>
               </table>

           </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>