<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="signup.css">
    <link rel="shortcut icon" href="assets/haima.png" type="image/x-icon">
    <title>Sign Up</title>
</head>
<style>
    body{
    margin: 0;
    padding: 0;
}
.container-fluid{
    height: 100vh;
    width: 100%;
   background-image: linear-gradient(90deg, pink, white, pink );
    justify-content: center;
    align-items: center;
    
}
.loginform{
    width: 40%;
    height: 80%;
    background-image: url("assets/bloodsack.webp");
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
    gap: 10px;
}
.bg-transparent-blur{
    backdrop-filter: blur(20px);
    box-shadow: white 0px 0px 20px;
}
 .text-link {
      text-align: center;
      margin-top: 1rem;
      display: block;
      color: wheat;
    }

    .text-link a {
        color: white;
      text-decoration: underline;
    }

    .text-link a:hover {
      color: black;
    }
</style>
<body>
    <div class="container-fluid d-flex justify-content-center">
    <div class="loginform">

        <form action="{{ route('register.custom') }}" method="POST" class="w-75 h-80 p-5 rounded-4 bg-transparent-blur">
               @csrf
            <h2 class="text-center fw-bold fs-2">Sign Up</h2>
                        {{-- Show error messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

             <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name"  value="{{ old('name') }}" placeholder="Username" required>
             <label>Username</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control"  name="email" value="{{ old('name') }}" placeholder="name@example.com" required>
             <label>Email address</label>
            </div>

            <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <label>Password</label>
            </div>

             <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password" required>
            <label> Confirm Password</label>
            </div>

             <div class="d-grid gap-2 d-flex justify-content-center">
               <button type="submit" class="btn btn-danger w-75 ">SUBMIT</button>
           </div>

  
         <div class="text-link">
            You have an account Already? <a href="{{ route('login.show') }}">Login</a>
        </div>

        </form>
    </div>
    
    </div>
     

</body>
</html>