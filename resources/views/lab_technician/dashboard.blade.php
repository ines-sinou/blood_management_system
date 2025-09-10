<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lab Technician Dashboard</title>
  <link rel="shortcut icon" href="assets/haima.png" type="image/x-icon">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

  <style>
   .sidebar{
    height: 100vh;
    background: url("assets/bloodshape.webp") no-repeat;
    position: fixed;
    width: 300px;
    background-size: cover;
     box-shadow: 2px 0 5px rgba(0,0,0,0.1);
   }
   .main-content{
    margin-left: 300px;
   }
   @media(max-width:768px){
    .sidebar{
      width: 70px;
    }
    .main-content{
      margin-left: 70px;
    }
    .haima-logo{
      font-size: 40px;
    }
   }
    .alert-box {
            background-color:black;
            color: white;
            border-radius: 8px;
            padding: 15px;
            font-size: 0.9rem;
        }
        .table-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        .search-bar {
            max-width: 400px;
            margin-bottom: 20px;
        }
         .card {
            border: none;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-3px);
        }
        .card-header {
            background-color: rgb(211, 67, 67);
            color: white;
            border-radius: 12px 12px 0 0;
            font-weight: 600;
            padding: 15px;
        }
          .chart-container {
            position: relative;
            height: 280px;
        }
        .btn-custom {
            background-color: #198754;
            color: white;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 0.9rem;
        }
        .btn-custom:hover {
            background-color: #157347;
        }
        .inventory-form {
            max-width: 500px;
            margin-bottom: 20px;
        }
   .ines-welcome-card {
            background: url("assets/bloodshape.webp") no-repeat;
            background-size: cover;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            padding: 20px;
        }
     
  </style>
</head>
<body>
    <div class="sidebar d-flex flex-column p-2 text-center ">
      <div class="text-center text-white mb-4">
            <i class="fas fa-heartbeat fa-3x haima-logo"></i>
            <h4 class="mt-2">haima</h4>
        </div>
      <ul class="nav nav-pills flex-column mb-auto mt-4">
          
            <li class="nav-item mb-3" data-bs-toggler="tooltip" data-bs-placement="right" title="Dashboard" >
              <a href="" class="nav-link d-flex align-items-center text-white fw-bold"><i class="fas fa-home me-2"></i>
                <span class="link-text d-none d-md-inline">Dashboard</span>
              </a>
            </li>

              <li class="nav-item mb-3" data-bs-toggler="tooltip" data-bs-placement="right" title="Donor Management" >
              <a href="" class="nav-link d-flex align-items-center text-white  fw-bold"><i class="fas fa-users me-2"></i>
                <span class="link-text d-none d-md-inline">Donor Dashboard</span>
              </a>
            </li>

            <li class="nav-item mb-3" data-bs-toggler="tooltip" data-bs-placement="right" title="Requests" >
              <a href="" class="nav-link d-flex align-items-center text-white fw-bold"><i class="fas fa-hand-holding-medical me-2"></i>
                <span class="link-text d-none d-md-inline">Requests</span>
              </a>
            </li>
            <li class="nav-item mb-3" data-bs-toggler="tooltip" data-bs-placement="right" title="Inventory" >
              <a href="" class="nav-link d-flex align-items-center text-white fw-bold"><i class="fas fa-warehouse me-2"></i>
                <span class="link-text d-none d-md-inline">Inventory</span>
              </a>
            </li>
            
             <li class="nav-item mb-3" data-bs-toggler="tooltip" data-bs-placement="right" title="Reports" >
              <a href="" class="nav-link d-flex align-items-center text-white fw-bold"><i class="fas fa-chart-line me-2"></i>
                <span class="link-text d-none d-md-inline">Reports</span>
              </a>
            </li>

             <li class="nav-item mb-3" data-bs-toggler="tooltip" data-bs-placement="right" title="Settings" >
              <a href="" class="nav-link d-flex align-items-center text-white fw-bold"><i class="fas fa-cog me-2"></i>
                <span class="link-text d-none d-md-inline">Settings</span>
              </a>
            </li>
      </ul>
    </div>

    <div class="main-content  p-4">
        <div class="ines-welcome-card mb-4 justify-content-between align-items-center d-flex">
            <form class=" d-md-flex flex-grow-1 mx-3" role="search">
        <div class="input-group me-2">
          <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
          <input class="form-control" type="search" placeholder="Search donors, units,requests…" aria-label="Search">
          <button class="btn btn-success" type="button"><i class="fas fa-filter me-1"></i>Filters</button>
        </div>
           <button class="btn btn-outline-secondary position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#notificationsOffcanvas">
        <i class="fas fa-bell text-white"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notifCount">0</span>
      </button>
      </form>


        </div>
      
        <div class="alert-box mb-4 d-none">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Critical: O- Plasma (5 units remaining)
            <button class="btn btn-light btn-sm float-end">Take Action</button>
        </div>

        <!-- Overview Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-light text-dark"><i class="fas fa-users text-danger  me-2"></i> Total Donors</div>
                    <div class="card-body">
                        <h3 class="card-title">1,300</h3>
                        <p class="card-text">+7% from last month</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-light text-dark"><i class="fas fa-tint text-danger  me-2"></i> Total Units in Stock</div>
                    <div class="card-body">
                        <h3 class="card-title">5,200</h3>
                        <p class="card-text">Blood, Plasma, Platelets</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-light text-dark"><i class="fas fa-users text-danger  me-2"></i> Pending Requests</div>
                    <div class="card-body">
                        <h3 class="card-title">3</h3>
                        <p class="card-text">Awaiting approval</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-light text-dark"><i class="fas fa-users text-danger  me-2"></i> Tests Completed</div>
                    <div class="card-body">
                        <h3 class="card-title">350</h3>
                        <p class="card-text">This week</p>
                    </div>
                </div>
            </div>
        </div>
           <!-- Charts Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Component Distribution</div>
                     <div class="card-body">
                        <div class="chart-container">
                            <canvas id="componentChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Donation Trends</div>
                      <div class="card-body">
                        <div class="chart-container">
                            <canvas id="donationTrendChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Inventory Management Section -->
        <div class="table-container mb-4">
            <div class="card-header mb-4">Inventory Management </div>
            <div class="card-body">
                <div class="inventory-form ">
                
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" id="componentName" class="form-control mb-2" placeholder="Component (e.g., Plasma)">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="bloodType" class="form-control mb-2" placeholder="Blood Type (e.g., A+)">
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="units" class="form-control mb-2" placeholder="Units">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-custom"><i class="fas fa-plus d-inline me-2"></i>Add</button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover" id="inventoryTable">
                    <thead>
                        <tr>
                            <th>Component</th>
                            <th>Blood Type</th>
                            <th>Units in Stock</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Whole Blood</td>
                            <td>A+</td>
                            <td>120</td>
                            <td>2025-08-20</td>
                            <td><button class="btn btn-custom btn-sm">Update</button></td>
                        </tr>
                        <tr>
                            <td>Plasma</td>
                            <td>O-</td>
                            <td>50</td>
                            <td>2025-08-19</td>
                            <td><button class="btn btn-custom btn-sm">Update</button></td>
                        </tr>
                        <tr>
                            <td>Platelets</td>
                            <td>B+</td>
                            <td>80</td>
                            <td>2025-08-18</td>
                            <td><button class="btn btn-custom btn-sm">Update</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <div class="table-container mb-4">
            <div class="card-header bg-danger text-white mb-4">Appointments for Validation</div>

            <div class="card-body">
                @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Donor</th>
                <th>Appointment Time</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->donor->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->notes ?? '-' }}</td>
                    <td>
                        @if($appointment->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($appointment->status == 'confirmed')
                            <span class="badge bg-success">Confirmed</span>
                        @elseif($appointment->status == 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if($appointment->status == 'pending')
                            <form action="{{ route('labtech.appointments.confirm', $appointment) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Confirm</button>
                            </form>
                            <form action="{{ route('labtech.appointments.reject', $appointment) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <em>No action</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No appointments found</td></tr>
            @endforelse
        </tbody>
    </table>
            </div>
    
</div>

        <div class="table-container mb-4">
            <div class="card-header bg-danger text-white">Registered Donors</div>
            <div class="card-body">
                 <table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Blood Group</th>
            <th>DOB</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @forelse($donors as $donor)
            <tr>
                <td>{{ $donor->name }}</td>
                <td>{{ $donor->email }}</td>
                <td>{{ $donor->phone }}</td>
                <td>{{ $donor->blood_group }}</td>
                <td>{{ $donor->dob ?? 'N/A' }}</td>
                <td>{{ $donor->address ?? 'N/A' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No donors found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

            </div>
        </div>

       
       
    </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="notificationsOffcanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body" id="notifList"></div>
           </div>
     <script>
       // Component Distribution Chart
        const componentChart = new Chart(document.getElementById('componentChart'), {
            type: 'pie',
            data: {
                labels: ['Whole Blood', 'Plasma', 'Platelets'],
                datasets: [{
                    data: [60, 25, 15],
                    backgroundColor: ['#ff6b6b', '#4dabf7', '#ffd43b']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
                // Donation Trends Chart
        const donationTrendChart = new Chart(document.getElementById('donationTrendChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                datasets: [{
                    label: 'Donations',
                    data: [45, 55, 65, 60, 75, 85, 80, 90],
                    borderColor: '#0d6efd',
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
   
</body>
</html>
