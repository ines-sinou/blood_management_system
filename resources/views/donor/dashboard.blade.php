<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">


    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff5f5;
            min-height: 100vh;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background: linear-gradient(180deg, #dc3545, #b02a37);
            color: white;
            padding-top: 30px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link {
            color: white;
            padding: 15px 20px;
            border-radius: 0 25px 25px 0;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #ffffff22;
            color: #fff;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
            .ines-welcome-card {
            background: url('{{ asset('/assets/bloodshape.webp') }}') no-repeat;
            background-size: cover;
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            padding: 10px 20px; /* reduced padding */
            display: flex;
            align-items: center;
            justify-content: space-between; /* push items to edges */
            flex-wrap: wrap;
        }
        .ines-welcome-card .welcome-text {
            max-width: 70%; /* avoid overlap with button */
        }

        .stat-card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .progress-circle {
            width: 120px;
            height: 120px;
            background: conic-gradient(#dc3545 0% var(--progress), #e9ecef 0%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0 auto;
        }
        .progress-circle::before {
            content: attr(data-progress) '%';
            position: absolute;
            background: white;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #dc3545;
        }
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .btn-donate {
            background: #dc3545;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-donate:hover {
            background: #b02a37;
            transform: scale(1.05);
        }
        #calendar {
            max-width: 100%;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <i class="fas fa-heartbeat fa-4x"></i>
            <h4 class="mt-2">haima</h4>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="#dashboard"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
            <a class="nav-link" href="#history"><i class="fas fa-history me-2"></i> Donation History</a>
            <a class="nav-link" href="#appointments"><i class="fas fa-calendar-check me-2"></i> Appointments</a>
            <a class="nav-link" href="#profile" data-bs-toggle="modal" data-bs-target="#profileModal">
                <i class="fas fa-user me-2"></i> Profile
            </a>
            <form action="{{ route('logout') }}" method="POST" class="nav-link m-0 p-0">
                @csrf
                <button type="submit" class="btn btn-link text-white text-start w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <div class="ines-welcome-card mb-4">
            <h2>Welcome, {{ auth()->user()->name }}</h2>
            <p>Your contributions have saved <strong>12 lives</strong> so far. Keep making a difference!</p>
            <button class="btn btn-light btn-donate" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                <i class="fas fa-calendar-plus me-2"></i> Schedule Donation
            </button>

        </div>

        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stat-card bg-white">
                    <div class="card-body text-center">
                        <h5 class="card-title"> <i class="fas fa-hand-holding-heart text-danger me-2"></i>Total Donations</h5>
                        <h2 class="card-text text-danger">4</h2>
                        <p class="text-muted">Units Donated</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card bg-white">
                    <div class="card-body text-center">
                        <h5 class="card-title"> <i class="fas fa-tint me-2 text-danger"></i>Blood Group</h5>
                        <h2 class="card-text text-danger">A+</h2>
                        <p class="text-muted">Your Blood Type</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card bg-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Next Donation</h5>
                        <h2 class="card-text text-danger">2025-11-15</h2>
                        <p class="text-muted">Scheduled Date</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card stat-card bg-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Donation Progress</h5>
                        <div class="progress-circle" style="--progress: 75%;" data-progress="75"></div>
                        <p class="mt-3 text-muted">You're 75% towards your next milestone!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="card-title mb-0">Donation History</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Units</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-08-10</td>
                                    <td>Yaounde Central Hospital</td>
                                    <td>1</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>2025-05-15</td>
                                    <td>Yaounde General Hospital</td>
                                    <td>1</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>2025-02-20</td>
                                    <td>Chantal Biya Foundation</td>
                                    <td>1</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar -->
     <div class="row mb-4 mt-3">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Upcoming Donations</h5>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('donors.update', auth()->user()->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i class="fas fa-user fa-3x me-3"></i> Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', auth()->user()->donor->name ?? auth()->user()->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', auth()->user()->donor->email ?? auth()->user()->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', auth()->user()->donor->phone ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Blood Group</label>
                        <select name="blood_group" class="form-control" required>
                            <option value="">Select</option>
                            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $group)
                                <option value="{{ $group }}"
                                  {{ old('blood_group', auth()->user()->donor->blood_group ?? '') == $group ? 'selected' : '' }}>
                                  {{ $group }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control"
                            value="{{ old('dob', auth()->user()->donor->dob ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', auth()->user()->donor->address ?? '') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Save Profile</button>
                </div>
            </form>
        </div>
      </div>
    </div>

    <!-- Schedule Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-calendar-plus me-2"></i> Schedule Donation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <!-- Hospital -->
                <div class="mb-3">
                    <label for="hospital" class="form-label">Select Hospital</label>
                    <select name="hospital_id" id="hospital" class="form-select" required>
                        <option value="">-- Choose Hospital --</option>
                        @foreach($hospitals as $hospital)
                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date/Time -->
                <div class="mb-3">
                    <label for="appointment_time" class="form-label">Appointment Date & Time</label>
                    <input type="datetime-local" name="appointment_date" id="appointment_time"
                           class="form-control" required>
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes (optional)</label>
                    <textarea name="notes" id="notes" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Save Appointment</button>
            </div>
        </form>
    </div>
  </div>
</div>


    <!-- Scripts -->
     <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar active state
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.getAttribute('href') === window.location.hash) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // Hide alert after 3s
        setTimeout(() => {
            let alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);

        // Calendar init
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($events),
                eventClick: function(info) {
                    let cancelUrl = `/appointments/${info.event.id}/cancel`;
                    if (confirm(`Do you really want to cancel this appointment at ${info.event.title}?`)) {
                        window.location.href = cancelUrl;
                    }
                },
               eventDidMount: function(info) {
                new bootstrap.Tooltip(info.el, {
                    title: 'Status: ' + info.event.extendedProps.status +
                      (info.event.extendedProps.notes ? '\nNotes: ' + info.event.extendedProps.notes : ''),
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
    });
}

            });

            calendar.render();
        });
    </script>
</body>
</html>
