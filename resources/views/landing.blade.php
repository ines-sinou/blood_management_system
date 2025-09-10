<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>welcome to our blood bank management system</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="assets/haima.png" type="image/x-icon">
</head>
<style>
    html{
    scroll-padding-top: 80px; 
}
body{
    margin: 0;
    padding: 0;
     width: 100%;
    min-height: 100vh;
}

nav{
    width: 100%;
    height: 10vh;
    background: linear-gradient(90deg, pink, white, pink );
}
.navbar .nav-link {
    color: black;
    margin-left: 15px;
    font-weight: bold;
}

.navbar .nav-link:hover {
    color: red;
}
.body{
    width: 100%;
    height: 90vh;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 15px;
    background-color: whitesmoke;
}
.textbox{
    width: 40%;
    height: 60%;
}
.content{
    text-align: center;
    padding: 20px;
}
.content h1 {
    font-size: 3.5rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
}
.content p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    font-style: italic;
}
.btn-donate {
    background-color: crimson;
    border: none;
    padding: 12px 30px;
    font-size: 1.1rem;
    margin: 10px;
}
.btn-request {
    border: 2px solid #dc3545;
    color: #dc3545;
    padding: 12px 30px;
    font-size: 1.1rem;
    margin: 10px;
}
.btn-donate:hover {
    background-color: #c82333;
}
.btn-request:hover {
    background-color: crimson;
    color: white;
}
.image{
    width: 60%;
    height: 100%;
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
.section{
    min-width: 100%;
    padding: 60px 0;
}
 
.section h2 {
    color: #dc3545;
    margin-bottom: 30px;
}
.services{
    min-width: 100%;
    display: flex;
    flex-direction: row;
}
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
  <div class="container-fluid">
     <img src="assets/haima.png" alt="Haima Logo" width="90" height="90" class="img-fluid">
     <span style="font-size: 30px;">Haima</span>

     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
     </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#home"><i class="fa-solid fa-home text-dark me-2"></i> Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about"><i class="fas fa-info-circle text-dark me-2"></i>About</a></li>
        <li class="nav-item"><a class="nav-link" href="#features"><i class="fas fa-star text-dark me-2"></i>Features</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact"><i class="fa-solid fa-phone text-dark me-2"></i>Contact</a></li>
      </ul>
      <div class="btn-group">
      <a href="{{ route('register.show') }}" class="btn btn-danger"><i class="fas fa-user-plus me-2" ></i> Register</a>
      <a href="{{ route('login.show') }}" class="btn btn-outline-danger"><i class="fas fa-sign-in-alt me-2"></i> Login</a>
      </div>
    </div>
  </div>
</nav>

   <div class="container-fluid">
   
    <section id="home" class="section">
        <div class="body">
            <div class="textbox">
                <div class="content">
                    <h1 class="display-1" >Be a Hero, Save a Life</h1>
                    <p>Your blood can be the heartbeat of hope for someone fighting for life. Every drop counts, every donation matters.</p>
                    <div>
                        <a href="{{ route('register.custom') }}" class="btn btn-donate text-white">JOIN AS DONOR</a>
                        <a href="{{ route('login.custom') }}" class="btn btn-request">LOGIN AS HOSPITAL</a>
                    </div>
                </div>
            </div>
            <div class="image">
                <img src="assets/image.png" alt="" class="img-fluid">
            </div>
        </div>
    </section>
   </div>


   <section id="about" class="section">
    <div class="container">
        <h2 class="text-center fw-bold">About Us</h2>
        <div class="row">
            <div class="col-md-6 fs-4">
                <p>We are dedicated to saving lives by connecting blood donors with those in need. Our mission is to ensure a safe and reliable blood supply for hospitals and patients across the region.</p>
            </div>
            <div class="col-md-6 fs-4">
                <p>With a network of committed donors and advanced facilities, we strive to make blood donation and request processes seamless and impactful.</p>
            </div>
        </div>
    </div>
</section>

<section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold text-danger mb-5">Why Choose Haima?</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card feature-card p-4 text-center">
                        <i class="fa-solid fa-heartbeat fa-3x text-danger mb-3"></i>
                        <h3 class="card-title">For Donors</h3>
                        <p class="card-text">Easily register, track your donations, and get real-time notifications for blood drives near you.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card feature-card p-4 text-center">
                        <i class="fa-solid fa-search fa-3x text-danger mb-3"></i>
                        <h3 class="card-title">For Requesters</h3>
                        <p class="card-text">Find compatible donors quickly, send requests, and coordinate with ease.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card feature-card p-4 text-center">
                        <i class="fa-solid fa-user-shield fa-3x text-danger mb-3"></i>
                        <h3 class="card-title">Secure & Compliant</h3>
                        <p class="card-text">Built with strong privacy and data protection standards for hospitals.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
<section id="contact" class="section bg-light">
  <div class="container">
    <h2 class="text-center text-danger mb-5">Contact Us</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Your Name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Your Email">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message:</label>
            <textarea class="form-control" id="message" rows="4" placeholder="Your Message"></textarea>
          </div>
          <button type="submit" class="btn btn-danger">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>


<footer class="bg-danger text-white text-center py-3">
  <div class="container">
    <p><i class="fa-solid fa-envelope"></i> info@haima.org</p>
        <p><i class="fa-solid fa-phone"></i> +237 676 454 328</p>
    <p class="mb-0">&copy; 2025 Haima Blood Bank  Management System | All rights reserved.</p>
  </div>
</footer>


</body>
</html>