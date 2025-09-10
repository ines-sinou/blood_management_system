<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hospital Staff Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    body {
      background: #fff5f5; 
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .sidebar {
      background: url("assets/bloodshape.webp") no-repeat;
      background-size: cover;
      height: 100vh;
      position: fixed;
      width: 250px;
      padding-top: 20px;
    }

    .sidebar a {
      color: white;
      padding: 15px;
      display: block;
      text-decoration: none;
      transition: background 0.3s;
    }

    .sidebar a.active {
      background-color: #dc3545;
      font-weight: bold;
      border-left: 4px solid white;
    }

    .sidebar a:hover {
      background-color: #c82333;
    }

    .content {
      margin-left: 270px;
      padding: 20px;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #c82333;
    }

    .navbar {
      background: url("assets/bloodshape.webp") no-repeat;
      background-size: cover;
      border-radius: 10px;
    }

    .navbar-brand, .navbar-text {
      color: white !important;
    }

    .form-control:focus {
      border-color: #dc3545;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .d-none {
      display: none !important;
    }

    .alert {
      font-weight: bold;
    }

    .badge {
      font-size: 0.75rem;
      padding: 5px 8px;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="text-center text-white mb-4">
    <i class="fas fa-heartbeat fa-4x"></i>
    <h4 class="mt-2">haima</h4>
  </div>
  <a href="#search" class="active"><i class="fas fa-search me-2"></i> Search Blood</a>
  <a href="#results"><i class="fas fa-vial me-2"></i> View Results</a>
  <a href="#donors"><i class="fas fa-users me-2"></i> Contact Donors</a>
  <a href="#logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="content">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Hospital Staff Dashboard</a>
      <div class="navbar-text ms-auto d-flex align-items-center">
        <button class="btn btn-outline-secondary position-relative me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#notificationsOffcanvas">
        <i class="fas fa-bell text-white"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notifCount">0</span>
      </button>
        <span class="text-white">Welcome, Sinou ines</span>
      </div>
    </div>
  </nav>

  <!-- Flash Message -->
  <div id="flash-message" class="alert alert-success d-none" role="alert">
    Blood reserved successfully!
  </div>

  <!-- Search Section -->
  <section id="search" class="mt-4">
    <div class="card p-4 mb-4">
      <h2 class="mb-4">Search Blood or Components</h2>
      <form class="needs-validation" novalidate>
        <div class="row g-3">
          <div class="col-md-4">
            <label for="bloodType" class="form-label">Blood Type</label>
            <select class="form-select" id="bloodType" required>
              <option value="">Choose...</option>
              <option>A+</option><option>A-</option><option>B+</option><option>B-</option>
              <option>AB+</option><option>AB-</option><option>O+</option><option>O-</option>
            </select>
            <div class="invalid-feedback">Please select a blood type.</div>
          </div>
          <div class="col-md-4">
            <label for="component" class="form-label">Component</label>
            <select class="form-select" id="component" required>
              <option value="">Choose...</option>
              <option>Whole Blood</option>
              <option>Plasma</option>
              <option>Platelets</option>
              <option>Red Cells</option>
            </select>
            <div class="invalid-feedback">Please select a component.</div>
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-danger w-100">Search</button>
          </div>
        </div>
      </form>
    </div>
  </section>

  <!-- Results -->
  <section id="results" class="mt-4">
    <div class="card p-4 mb-4">
      <h2 class="mb-4">Blood Inventory Results</h2>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Blood Type</th>
            <th>Component</th>
            <th>Quantity</th>
            <th>Location</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr data-blood="A+" data-component="Whole Blood">
            <td>A+</td>
            <td>Whole Blood</td>
            <td>5 units</td>
            <td>Central Hospital</td>
            <td><button class="btn btn-sm btn-danger reserve-btn" data-bs-toggle="modal" data-bs-target="#reserveModal">Reserve</button></td>
          </tr>
          <tr data-blood="O-" data-component="Plasma">
            <td>O-</td>
            <td>Plasma</td>
            <td>3 units</td>
            <td>General Hospital</td>
            <td><button class="btn btn-sm btn-danger reserve-btn" data-bs-toggle="modal" data-bs-target="#reserveModal">Reserve</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Donors -->
  <section id="donors" class="mt-4">
    <div class="card p-4">
      <h2 class="mb-4">Contact Donors</h2>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Blood Type</th>
            <th>Contact</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Fembe Veronique</td>
            <td>O+</td>
            <td>fembe@email.com</td>
            <td><button class="btn btn-sm btn-danger">Contact</button></td>
          </tr>
          <tr>
            <td>Chendjou Ivan</td>
            <td>A-</td>
            <td>chendjou@gmail.com</td>
            <td><button class="btn btn-sm btn-danger">Contact</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</div>

<!-- Reserve Modal -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content needs-validation" id="reserveForm" novalidate>
      <div class="modal-header">
        <h5 class="modal-title" id="reserveModalLabel">Reserve Blood</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="patientId" class="form-label">Patient ID</label>
          <input type="text" class="form-control" id="patientId" required>
          <div class="invalid-feedback">Patient ID is required.</div>
        </div>
        <div class="mb-3">
          <label for="modalBloodType" class="form-label">Blood Type</label>
          <input type="text" class="form-control" id="modalBloodType" readonly>
        </div>
        <div class="mb-3">
          <label for="modalComponent" class="form-label">Component</label>
          <input type="text" class="form-control" id="modalComponent" readonly>
        </div>
        <div class="mb-3">
          <label for="units" class="form-label">Units</label>
          <input type="number" class="form-control" id="units" required>
          <div class="invalid-feedback">Please enter number of units.</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Confirm Reservation</button>
      </div>
    </form>
  </div>
</div>

<!-- Notifications Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="notificationsOffcanvas">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Notifications</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body" id="notifList"></div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Form Validation
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', e => {
        if (!form.checkValidity()) {
          e.preventDefault()
          e.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()

  // Handle Reserve button click to prefill modal
  document.querySelectorAll('.reserve-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const row = this.closest('tr');
      const blood = row.getAttribute('data-blood');
      const component = row.getAttribute('data-component');
      document.getElementById('modalBloodType').value = blood;
      document.getElementById('modalComponent').value = component;
    });
  });

  // Handle modal form submission
  document.getElementById('reserveForm').addEventListener('submit', function (e) {
    e.preventDefault();
    if (!this.checkValidity()) {
      this.classList.add('was-validated');
      return;
    }

    // Simulate reservation success
    const modal = bootstrap.Modal.getInstance(document.getElementById('reserveModal'));
    modal.hide();

    // Show flash message
    const flash = document.getElementById('flash-message');
    flash.classList.remove('d-none');
    setTimeout(() => flash.classList.add('d-none'), 3000);

    // Show notification badge
    document.getElementById('notif-badge').classList.remove('d-none');

    this.reset();
    this.classList.remove('was-validated');
  });

  
</script>

</body>
</html>
