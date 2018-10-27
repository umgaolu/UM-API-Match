<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{csrf_token()}}">

  <title>UM Hackathon</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="/css/welcome.css" rel="stylesheet">
</head>
<body>
  <main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Hello, world!</h1>
      <p>Find your interest</p>
    </div>
  </div>
  <div class="container fade-in" style="display:none;">
    <div class="card-deck">
        <div class="card border-primary mb-3 shadow-sm">
          <img class="card-img-top" src="/FrontPage/Meal.png" alt="">
          <div class="card-body">
            <h5 class="card-title">How many people are enjoying meals?</h5>
            <a href="/meal" class="btn btn-lg btn-outline-primary">Let's See</a>
          </div>
        </div>
        <div class="card border-success mb-3 shadow-sm">
          <img class="card-img-top" src="/FrontPage/Event.png" alt="">
          <div class="card-body">
            <h5 class="card-title">What interesting events are on the way?</h5>
            <a href="/event" class="btn btn-lg btn-outline-success">Go Ckeck</a>
          </div>
      </div>
        <div class="card border-info mb-3 shadow-sm">
          <img class="card-img-top" src="/FrontPage/News.png" alt="">
          <div class="card-body">
            <h5 class="card-title">What is happening around UM?</h5>
            <a href="#" class="btn btn-lg btn-outline-info">Get informed</a>
          </div>
        </div>
        <div class="card mb-3 shadow-sm">
          <img class="card-img-top" src="/FrontPage/Other.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">More is coming</h5>
          </div>
        </div>
    </div>

    <hr>

  </div> <!-- /container -->

</main>

<footer class="container">
  <p>UM Hackathon 26-27/10/2018</p>
</footer>

<script src="/js/echarts.min.js"></script>
<script src="/js/dark.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
  $(function(){
    $('.fade-in').fadeIn(1000);
  });
</script>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>
</body>

</html>
