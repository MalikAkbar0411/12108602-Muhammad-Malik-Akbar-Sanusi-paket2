<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Login</title>
  </head>
  <style>
    .form-login{
      border: 6px solid;
      padding: 10px;
      border-radius:10px;
    }
  </style>
  <body>
    <div class="content">
        <div class="container d-flex flex-column justify-content-center align-items-center" style="height:100vh">
          <div class="form-login">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('message') }}
              </div>
            </div>              
            @endif         
            <form  action ="{{route('login')}}" method="POST" style="width:350px">
                @csrf
                <div class="mb-5 text-center" >
                    <h3>LOGIN</h3>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">email</label>
                  <input type="text" name="email" class="form-control" id="email"  >
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-dark w-100">Submit</button>
              </form>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>