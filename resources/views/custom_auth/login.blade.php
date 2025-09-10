<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css"> 
    <link rel="shortcut icon" href="assets/haima.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>loginform</title>
</head>
<style>
    body{
    margin: 0;
    padding: 0;
}
.container-fluid{
    height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: row;
   background-image: linear-gradient(90deg, pink, white, pink );
    justify-content: center;
    align-items: center;
    gap: 40px;
}
.image{
    width: 35%;
    height: 80%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.image img{
    width: 100%;
    height: 100%;
    object-fit: cover;

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
      text-decoration: none;
    }

    .text-link a:hover {
      color: black;
      text-decoration: underline;
    }
#forgot-password{
    text-decoration: none;
}
#forgot-password:hover{
    color: black;
}
</style>
<body>
   <div class="container-fluid">
    <div class="image d-none d-md-flex ">
        <img src="assets/Zw.webp" alt="">
    </div>
    <div class="loginform">

        <form action="{{ route('login.custom') }}" method="POST" class="w-75 h-80 p-5 rounded-4 bg-transparent-blur">

                   @csrf
            <h2 class="text-center fw-bold fs-2">login</h2>
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
                <input type="email" class="form-control"  name="email" placeholder="name@example.com" required>
             <label>Email address</label>
            </div>

            <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password"  placeholder="Password" required>
            <label>Password</label>
              <a href="resetpassword.html" class="forgot-password text-white" id="forgot-password">Forgot password ?</a>
            </div>

             <div class="d-grid gap-2 d-flex justify-content-center">
               <button type="submit" class="btn btn-danger w-75 ">Login</button>
           </div>

  
         <div class="text-link">
            Don't have an account? <a href="{{ route('register.show') }}">Sign up</a>
        </div>

      

        </form>
    </div>
      
   </div> 
</body>
</html>