<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Super Admin — Hospitals & Memberships</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #fff5f5; }
    .card-soft { border: 0; border-radius: 1rem; box-shadow: 0 10px 30px rgba(2,6,23,.06); }
    .table thead th { white-space: nowrap; }
    .table-hover tbody tr { transition: background-color .2s ease; }
    .required::after { content: " *"; color: #dc3545; }
    .offcanvas-rounded { border-top-left-radius: 1rem; border-top-right-radius: 1rem; }
    .badge-pill { border-radius: 50rem; }
    .cursor-pointer{ cursor:pointer; }
    .ines-nav{
      background: url("assets/bloodshape.webp") no-repeat; background-size: cover;}
  </style>
</head>
<body>
  <!-- Nav -->
  <nav class="navbar navbar-expand-lg ines-nav border-bottom sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-white" href="#"><i class="bi bi-hospital"></i> Super Admin</a>
      <div class="d-flex gap-3">
          <button class="btn btn-outline-secondary position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#notificationsOffcanvas">
        🔔
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notifCount">0</span>
      </button>
        <button class="btn btn-danger btn-sm" data-bs-toggle="offcanvas" data-bs-target="#createHospitalCanvas">
          <i class="bi bi-plus-circle"></i> New Hospital + Admin
        </button>
        
      </div>
    </div>
  </nav>

  <main class="container-fluid py-4">
    <!-- Stats -->
    <div class="row g-3 mb-3">
      <h2 class="mb-3">Global Overview</h2>
      <div class="col-12 col-md-3">
        <div class="card card-soft">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary">Total Hospitals</div>
              <div class="h4 mb-0" id="statHospitals">0</div>
            </div>
            <i class="bi bi-buildings h2 text-secondary"></i>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card card-soft">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary">Active Memberships</div>
              <div class="h4 mb-0" id="statActive">0</div>
            </div>
            <i class="bi bi-badge-ad h2 text-success"></i>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card card-soft">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary">Expiring ≤ 30 days</div>
              <div class="h4 mb-0" id="statExpiring">0</div>
            </div>
            <i class="bi bi-alarm h2 text-danger"></i>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-3">
        <div class="card card-soft">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="text-secondary">Total Staff</div>
              <div class="h4 mb-0" id="statStaff">0</div>
            </div>
            <i class="bi bi-people h2 text-primary"></i>
          </div>
        </div>
      </div>
    </div>

       <div class="row g-3 mt-1">
        <div class="col-lg-4">
          <div class="card card-shadow h-100">
            <div class="card-header bg-danger text-white">Membership Distribution</div>
            <div class="card-body"><canvas id="membershipChart"></canvas></div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-shadow h-100">
            <div class="card-header bg-danger text-white">Hospital per Region</div>
            <div class="card-body"><canvas id="renewalsChart"></canvas></div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-shadow h-100">
            <div class="card-header bg-danger text-white">Top Hospitals by Staff</div>
            <div class="card-body"><canvas id="topHospitalsChart"></canvas></div>
          </div>
        </div>
      </div>
<!-- Manage Memberships -->
<section class="mb-5">
    <h2 class="mb-3">Manage Memberships</h2>

    <!-- Create Membership Form -->
    <form action="{{ route('memberships.store') }}" method="POST" class="d-flex gap-2 mb-4">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="Membership Name" required>
        <input type="number" name="duration_months" class="form-control" placeholder="Duration (months)" required>
        <input type="number" name="price" class="form-control" placeholder="Price (FCFA)" required>
        <button type="submit" class="btn btn-success">Add</button>
    </form>

    <!-- Membership Cards -->
    <div class="row mb-4">
        @foreach($memberships as $membership)
            <div class="col-md-2">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title text-danger">{{ $membership->name }}</h5>
                        <p class="card-text">
                            Duration: <strong>{{ $membership->duration_months }} months</strong><br>
                            Price: <strong>{{ number_format($membership->price) }} FCFA</strong>
                        </p>

                        <!-- Edit Button -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editMembership{{ $membership->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('memberships.destroy', $membership->id) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this membership?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editMembership{{ $membership->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('memberships.update', $membership->id) }}"
                          method="POST" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title">Edit Membership</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="name" class="form-control mb-3"
                                   value="{{ $membership->name }}" required>
                            <input type="number" name="price" class="form-control mb-3"
                                   value="{{ $membership->price }}" required>
                            <input type="number" name="duration_months" class="form-control mb-3"
                                   value="{{ $membership->duration_months }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>




      <section id="monitoring" class="mb-5">
      <h3>System Monitoring</h3>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card card-shadow h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <div class="text-muted small">API Latency</div>
                  <div class="h4" id="metricLatency">–</div>
                </div>
                <span class="badge badge-soft">ms</span>
              </div>
              <div class="form-text">Average request time (last 5 min)</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-shadow h-100">
            <div class="card-body">
              <div class="text-muted small">Queue Jobs</div>
              <div class="h4" id="metricQueue">–</div>
              <div class="form-text">Pending jobs in Laravel queue</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-shadow h-100">
            <div class="card-body">
              <div class="text-muted small">Storage Usage</div>
              <div class="h4" id="metricStorage">–</div>
              <div class="form-text">Used / Total</div>
            </div>
          </div>
        </div>
      </div>
    </section>

  

    <!-- Filters -->
     <h3 class="mb-0">Hospitals</h3>
    <div class="card card-soft mb-3">
      <div class="card-body row g-2 align-items-end">
        <div class="col-12 col-md-4">
          <label class="form-label">Search</label>
          <input id="searchInput" class="form-control" type="text" placeholder="Search hospital, admin, email...">
        </div>
        <div class="col-6 col-md-3">
          <label class="form-label">Status</label>
          <select id="statusFilter" class="form-select">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="expiring">Expiring ≤ 30d</option>
            <option value="expired">Expired</option>
            <option value="none">No Membership</option>
          </select>
        </div>
        <div class="col-6 col-md-3">
          <label class="form-label">Sort</label>
          <select id="sortBy" class="form-select">
            <option value="name">Hospital Name</option>
            <option value="expiry">Expiry Date</option>
            <option value="staff">Staff Count</option>
          </select>
        </div>
        <div class="col-12 col-md-2 d-grid">
          <button class="btn btn-outline-secondary" id="resetFilters"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
        </div>
      </div>
    </div>

    <!-- Hospitals Table -->
    <div class="card card-soft">
      <div class="card-header d-flex justify-content-between  bg-danger text-white align-items-center">
        <h5 class="mb-0">Registered Hospitals</h5>
        <small class="text-white">Rows in <span class="text-success fw-semibold">red</span> are nearing expiry or expired.</small>
      </div>
      <div class="table-responsive">
      <table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>Hospital</th>
            <th>Region</th>
            <th>Admin</th>
            <th>Membership</th>
            <th>Start</th>
            <th>Expiry</th>
            <th>Status</th>
            <th>Staff</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hospitals as $h)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $h->name }}</td>
            <td>{{ $h->region }}</td>
            <td>{{ $h->admin->name }} ({{ $h->admin->email }})</td>
            <td>{{ $h->membership?->name ?? 'None' }}</td>
            <td>{{ $h->membership_start?->format('Y-m-d') ?? '-' }}</td>
            <td data-end-date="{{ $h->membership_end?->format('Y-m-d') ?? '' }}">
                {{ $h->membership_end?->format('Y-m-d') ?? '-' }}
            </td>
            <td>
                @if(!$h->membership_id)
                    <span class="badge bg-secondary">No Membership</span>
                @elseif($h->membership_end < now())
                    <span class="badge bg-danger">Expired</span>
                @elseif($h->membership_end <= now()->addDays(30))
                    <span class="badge bg-warning">Expiring</span>
                @else
                    <span class="badge bg-success">Active</span>
                @endif
            </td>
            <td>{{ $h->staff_count }}</td>
            <td>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#logsModal{{ $h->id }}">Logs</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

      </div>
    </div>
  </main>

  <!-- Offcanvas: Create Hospital + Admin -->
  <div class="offcanvas offcanvas-end offcanvas-rounded" tabindex="-1" id="createHospitalCanvas" aria-labelledby="createHospitalLabel">
    <div class="offcanvas-header">
      <h5 id="createHospitalLabel">Create Hospital & Link Admin</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

      <form id="hospitalForm" class="needs-validation" method="POST" action="{{ route('hospitals.store') }}" novalidate>
       @csrf

        <div class="mb-3">
          <label class="form-label required">Hospital Name</label>
          <input type="text" class="form-control" id="hospitalName" name="hospital_name" required>
          <div class="invalid-feedback">Hospital name is required.</div>
        </div>
        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label required">Admin Full Name</label>
            <input type="text" class="form-control" id="adminName" name="admin_name" required>
            <div class="invalid-feedback">Admin name is required.</div>
          </div>
          <div class="col-12 col-md-6">
                <label class="form-label required">Region</label>
                <select class="form-select" id="region" name="region" required>
                  <option value="">-- Select Region --</option>
                  <option value="Far North">Far North</option>
                  <option value="Adamawa">Adamawa</option>
                  <option value="North">North</option>
                  <option value="Center">Center</option>
                  <option value="Littoral">Littoral</option>
                  <option value="West">West</option>
                  <option value="South">South</option>
                  <option value="North West">North West</option>
                  <option value="South West">South West</option>
                  <option value="East">East</option>
                </select>
                <div class="invalid-feedback">Region is required.</div>
              </div>
          <div class="col-12 col-md-6">
            <label class="form-label required">Admin Email</label>
            <input type="email" class="form-control" id="adminEmail" name="admin_email" required>
            <div class="invalid-feedback">Valid email required.</div>
          </div>
        </div>
        <div class="row g-3 mt-1">
          <div class="col-12 col-md-6">
            <label class="form-label">Temp Password</label>
            <input type="text" class="form-control" id="adminPassword" name="admin_password" placeholder="Auto-generated if empty">
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Initial Staff Count</label>
            <input type="number" class="form-control" id="staffCount" name="staff_count" min="0" value="0">
          </div>
        </div>

        <hr class="my-4">
        <h6 class="mb-2">Initial Membership (optional)</h6>
        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label">Plan</label>
            <select class="form-select" id="membershipPlan" name="membership_id">
              <option value="">No membership</option>
                      @foreach($memberships as $m)
              <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->duration_months }}m)</option>
            @endforeach
            </select>
          </div>
         
          <div class="col-6 col-md-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="membership_start" id="membershipStart">
          </div>
        </div>

        <div class="d-grid mt-4">
          <button class="btn btn-danger" type="submit"><i class="bi bi-plus-circle"></i> Create Hospital</button>
        </div>
      </form>
    </div>
  </div>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="notificationsOffcanvas">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Notifications</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body" id="notifList"></div>
</div>

<!-- Edit Modal -->
            <div class="modal fade" id="editMembership{{ $membership->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('memberships.update', $membership->id) }}" method="POST" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title">Edit Membership</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="name" class="form-control mb-3"
                                   value="{{ $membership->name }}" required>
                            <input type="number" name="price" class="form-control mb-3"
                                   value="{{ $membership->price }}" required>
                            <input type="number" name="duration_months" class="form-control mb-3"
                                   value="{{ $membership->duration_months }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>

  <!-- Modal: Create/Renew Membership -->
  <div class="modal fade" id="membershipModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="membershipModalTitle">Create Membership</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="membershipForm">
          <div class="modal-body">
            <input type="hidden" id="membershipHospitalId">
            <div class="mb-3">
              <label class="form-label">Plan</label>
              <select class="form-select" id="modalPlan" required>
                <option value="6m">6 months</option>
                <option value="12m">1 year</option>
                <option value="custom">Custom (months)</option>
              </select>
              <div class="invalid-feedback">Select a plan.</div>
            </div>
            <div class="row g-3">
              <div class="col-6">
                <label class="form-label">Custom Months</label>
                <input type="number" min="1" class="form-control" id="modalCustomMonths" disabled>
              </div>
              <div class="col-6">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" id="modalStart" required>
                <div class="form-text">If blank, today will be used.</div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal: Logs -->
  <div class="modal fade" id="logsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-activity"></i> Activity Logs</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group" id="logsList"></ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Container -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ====== Local Storage Helpers ======
function loadStore(){
  return JSON.parse(localStorage.getItem('hemaStore') || '{"hospitals":[]}');
}
function saveStore(){
  localStorage.setItem('hemaStore', JSON.stringify(store));
}
function uid(){ return Math.random().toString(36).substr(2,9); }

// ====== Global State ======
let store = loadStore();
let hospitals = store.hospitals;

// ====== Utility ======
function toast(msg){
  const el = document.createElement('div');
  el.className = 'toast align-items-center text-bg-primary border-0 show';
  el.role = 'alert';
  el.innerHTML = `<div class="d-flex">
    <div class="toast-body">${msg}</div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
  </div>`;
  document.body.appendChild(el);
  setTimeout(()=> el.remove(), 3000);
}
function log(hid, text){
  const h = hospitals.find(h=>h.id===hid);
  if(!h) return;
  h.logs.push({ ts: new Date().toISOString(), text });
  saveStore();
}

// ====== Membership Handling ======
function setMembership(hid, {plan, startISO, months}){
  const h = hospitals.find(h=>h.id===hid);
  if(!h) return;
  h.membership = { plan, startISO, months };
  log(hid, `Membership set to ${plan} for ${months} month(s).`);
  saveStore();
}

// ====== Rendering ======
function renderHospitals(){
  const tbody = document.querySelector('#hospitalsTable tbody');
  tbody.innerHTML = '';
  hospitals.forEach(h=>{
    const tr = document.createElement('tr');
    const membershipText = h.membership
      ? `${h.membership.plan} (${h.membership.months}m)`
      : '<span class="text-muted">None</span>';
    tr.innerHTML = `
      <td>${h.name}</td>
      <td>${h.region}</td>
      <td>${h.admin.name} (${h.admin.email})</td>
      <td>${membershipText}</td>
      <td>${h.staffCount}</td>
    `;
    tbody.appendChild(tr);
  });
}

// ====== Form: Create Hospital + Admin ======
document.getElementById('hospitalForm').addEventListener('submit', (e)=>{
  e.preventDefault();
  e.stopPropagation();
  const form = e.target;
  form.classList.add('was-validated');
  if (!form.checkValidity()) return;

  // Collect inputs
  const name = document.getElementById('hospitalName').value.trim();
  const region = document.getElementById('region').value.trim();
  const adminName = document.getElementById('adminName').value.trim();
  const adminEmail = document.getElementById('adminEmail').value.trim();
  const password = document.getElementById('adminPassword').value.trim() || Math.random().toString(36).slice(2, 10);
  const staffCount = parseInt(document.getElementById('staffCount').value || '0', 10);

  // Create hospital object
  const id = uid();
  const hospital = { 
    id, 
    name, 
    region, 
    admin: { name: adminName, email: adminEmail, tempPassword: password }, 
    staffCount, 
    membership: null, 
    logs: [] 
  };

  hospitals.unshift(hospital);
  log(id, `Hospital created and admin linked (${adminName} — ${adminEmail}).`);

  // Optional Membership
  const plan = document.getElementById('membershipPlan').value;
  const customMonths = parseInt(document.getElementById('customMonths').value || '0', 10);
  const start = document.getElementById('membershipStart').value
    ? new Date(document.getElementById('membershipStart').value)
    : new Date();

  if (plan){
    const months = plan === '12m' ? 12 : plan === '6m' ? 6 : (customMonths || 1);
    setMembership(id, { plan, startISO: start.toISOString(), months });
  }

  // Save + UI
  saveStore();
  renderHospitals();
  toast('Hospital created');

  // Reset form
  form.reset();
  form.classList.remove('was-validated');
  document.getElementById('customMonths').disabled = true;
  bootstrap.Offcanvas.getInstance('#createHospitalCanvas').hide();
});

// ====== Membership Plan Form ======
document.getElementById('membershipPlan').addEventListener('change', e=>{
  document.getElementById('customMonths').disabled = (e.target.value !== 'custom');
});

// ====== Init ======
renderHospitals();
</script>

</body>
</html>