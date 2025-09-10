<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hospital Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
   <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
 
    body{ background: #fff5f5; }
    .ines-bg{
        background: url("assets/bloodshape.webp") no-repeat;
        background-size: cover;
    }
    .bg-gradient-red{ background: linear-gradient(135deg,#ef4444,#dc2626 60%,#b91c1c); }
    .card{border:1px solid rgba(0,0,0,.05);}
    .rounded-2xl{ border-radius: 1rem; }
    .shadow-soft{ box-shadow: 0 6px 24px rgba(185,28,28,.08); }
    .kpi .bi{ opacity:.85 }
    .badge-soft{ background: #ffe4e6; color:#991b1b; }
    .table > :not(caption) > * > *{ vertical-align: middle; }
    .sidebar-link{ color:#991b1b; text-decoration:none; display:flex; gap:.5rem; align-items:center; padding:.5rem .75rem; border-radius:.5rem; }
    .sidebar-link:hover{ background:#fee2e2; }
    .offcanvas-body{ padding-bottom:4rem; }
    .compat-tile{ border:1px solid #f3f4f6; background:#fff; }
    .compat-ok{ background:#ecfdf5; border-color:#bbf7d0; }
    .compat-bt{ font-weight:600; }
    footer{ color:#6b7280 }
  </style>
</head>
<body>
  <!-- Topbar -->
  <nav class="navbar navbar-expand-lg sticky-top ines-bg border-bottom">
    <div class="container-fluid px-3 px-lg-4">
      <button class="btn btn-light d-lg-none me-2" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
        <i class="bi bi-list"></i>
      </button>
      <a class="navbar-brand d-flex align-items-center" href="#">
        <i class="fas fa-heartbeat fa-3x text-white me-2"></i>
        <strong class="text-white">Haima Hospital-Admin</strong>
        <span class="badge ms-2 text-bg-danger">Cameroon</span>
      </a>

      <form class="d-none d-md-flex flex-grow-1 mx-3" role="search">
        <div class="input-group">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input class="form-control" type="search" placeholder="Search donors, units, staff, requests…" aria-label="Search">
          <button class="btn btn-success" type="button"><i class="bi bi-funnel me-1"></i>Filters</button>
        </div>
      </form>

      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#announceModal"><i class="bi bi-megaphone me-1"></i>Announce</button>
        <div class="dropdown">
          <button class="btn btn-danger" data-bs-toggle="dropdown"><i class="bi bi-bell"></i></button>
          <div class="dropdown-menu dropdown-menu-end p-2" style="min-width:20rem">
            <h6 class="dropdown-header">Alerts</h6>
            <div class="alert alert-danger d-flex align-items-start gap-2 mb-2 py-2">
              <i class="bi bi-exclamation-triangle-fill"></i>
              <div>
                <div class="fw-semibold">5 RBC units expiring in 3 days</div>
                <small class="text-muted">Consider reallocating to nearby hospitals.</small>
              </div>
            </div>
            <div class="alert alert-warning d-flex align-items-start gap-2 mb-0 py-2">
              <i class="bi bi-clipboard2-pulse"></i>
              <div>
                <div class="fw-semibold">New request RQ-2201</div>
                <small class="text-muted">Limbe RH requests 3 O- RBC units.</small>
              </div>
            </div>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn btn-link text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="badge rounded-circle text-bg-danger p-3">AD</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><h6 class="dropdown-header">Signed in as Admin</h6></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row g-0">
      <!-- Sidebar (offcanvas for mobile) -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" style="width:280px">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <nav class="d-grid gap-2">
            <a class="sidebar-link" href="#kpi"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a class="sidebar-link" href="#inventory"><i class="bi bi-droplet"></i> Inventory</a>
            <a class="sidebar-link" href="#donors"><i class="bi bi-people"></i> Donors</a>
            <a class="sidebar-link" href="#lab"><i class="bi bi-beaker"></i> Lab</a>
            <a class="sidebar-link" href="#requests"><i class="bi bi-clipboard2-check"></i> Requests</a>
            <a class="sidebar-link" href="#staff"><i class="bi bi-shield-plus"></i> Staff</a>
            <a class="sidebar-link" href="#announce"><i class="bi bi-megaphone"></i> Announcements</a>
            <a class="sidebar-link" href="#logs"><i class="bi bi-file-earmark-text"></i> Logs</a>
            <a class="sidebar-link" href="#settings"><i class="bi bi-gear"></i> Settings</a>
          </nav>
          
          <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#createUserModal"><i class="bi bi-plus-lg me-2"></i>Create Account</button>
          <div class="card mt-3">
            <div class="card-body">
              <small class="text-muted">Facility</small>
              <div class="fw-semibold mt-1"><i class="bi bi-hospital me-2 text-danger"></i>Yaounde Central Hospital</div>
              <div class="small text-muted mt-1"><i class="bi bi-geo-alt me-1"></i>Center, Cameroon</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <main class="col-12 col-lg px-3 px-lg-4 py-4">
        <!-- KPIs -->
        <section id="kpi" class="kpi">
          <div class="row g-3">
            <div class="col-12 col-md-6 col-xl-3">
              <div class="card rounded-2xl shadow-soft">
                <div class="card-body d-flex justify-content-between align-items-end">
                  <div>
                    <div class="text-muted small">Units in Stock</div>
                    <div class="display-6 fw-semibold" id="kpi-stock">0</div>
                  </div>
                  <span class="badge badge-soft">All components</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
              <div class="card rounded-2xl shadow-soft">
                <div class="card-body d-flex justify-content-between align-items-end">
                  <div>
                    <div class="text-muted small">Expiring Soon (7d)</div>
                    <div class="display-6 fw-semibold" id="kpi-expiring">12</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
              <div class="card rounded-2xl shadow-soft">
                <div class="card-body d-flex justify-content-between align-items-end">
                  <div>
                    <div class="text-muted small">Active Donors</div>
                    <div class="display-6 fw-semibold">418</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
              <div class="card rounded-2xl shadow-soft">
                <div class="card-body d-flex justify-content-between align-items-end">
                  <div>
                    <div class="text-muted small">Open Requests</div>
                    <div class="display-6 fw-semibold" id="kpi-requests">0</div>
                  </div>
                  <small class="text-muted">Across 6 facilities</small>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Charts -->
        <section class="mt-4" id="inventory">
          <div class="row g-3">
            <div class="col-12 col-xl-8">
              <div class="card rounded-2xl shadow-soft h-100">
                <div class="card-header bg-danger text-white"><i class="bi bi-activity text-white me-2"></i>Stock by Blood Type</div>
                <div class="card-body">
                  <canvas id="chartStock" height="120"></canvas>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4">
              <div class="card rounded-2xl shadow-soft h-100">
                <div class="card-header bg-danger text-white"><i class="bi bi-bezier text-white me-2"></i>Components Mix</div>
                <div class="card-body">
                  <canvas id="chartMix" height="220"></canvas>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Requests & Compatibility -->
        <section class="mt-4" id="requests">
          <div class="row g-3">
            <div class="col-12 col-xl-8">
              <div class="card rounded-2xl shadow-soft">
                <div class="card-header d-flex justify-content-between align-items-center bg-danger text-white">
                  <span><i class="bi bi-clipboard2-check text-white me-2"></i>Pending Requests</span>
                  <div class="input-group" style="max-width:220px">
                    <span class="input-group-text">Needed</span>
                    <select id="selectNeeded" class="form-select"></select>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table align-middle mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>Request ID</th>
                        <th>Hospital</th>
                        <th>Blood / Component</th>
                        <th>Units</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="requestsBody"></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4">
              <div class="card rounded-2xl shadow-soft h-100">
                <div class="card-header bg-danger text-white"><i class="bi bi-shield-plus text-whitw me-2"></i>Compatibility Helper</div>
                <div class="card-body">
                  <div class="small text-muted mb-2">Who can donate to <span class="badge text-bg-danger" id="needTag">O-</span>?</div>
                  <div class="row g-2" id="compatGrid"></div>
                  <small class="text-muted d-block mt-2">* Simplified ABO/Rh logic for quick triage. Confirm with lab SOP.</small>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Donations & Logs -->
        <section class="mt-4" id="donors">
          <div class="row g-3">
            <div class="col-12 col-xl-8">
              <div class="card rounded-2xl shadow-soft">
                <div class="card-header d-flex justify-content-between align-items-center bg-danger text-white">
                  <span><i class="bi bi-droplet text-danger me-2"></i>Recent Donations</span>
                  <div class="d-flex gap-2">
                    <button class="btn btn-outline-danger btn-sm"><i class="bi bi-download me-1"></i>Export</button>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead class="table-light"><tr>
                      <th>Donation ID</th><th>Donor</th><th>Blood</th><th>Units</th><th>Date</th><th>Collection Site</th>
                    </tr></thead>
                    <tbody id="donationsBody"></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4" id="logs">
              <div class="card rounded-2xl shadow-soft h-100">
                <div class="card-header bg-danger text-white"><i class="bi bi-file-earmark-text text-white me-2"></i>Audit Logs</div>
                <div class="list-group list-group-flush" id="logsList"></div>
              </div>
            </div>
          </div>
        </section>

        <!-- Staff Directory -->
        <section class="mt-4" id="staff">
          <div class="card rounded-2xl shadow-soft">
            <div class="card-header d-flex justify-content-between align-items-center bg-danger text-white">
              <span><i class="bi bi-people text-white me-2"></i>Staff Directory</span>
              <div class="d-flex gap-2">
                <input id="staffSearch" class="form-control" placeholder="Search staff…" style="max-width:240px" />
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal"><i class="bi bi-plus-lg me-1"></i>Add</button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table mb-0">
                <thead class="table-light"><tr>
                  <th>Staff ID</th><th>Name</th><th>Role</th><th>Phone</th><th>Email</th><th>Region</th><th class="text-end">Manage</th>
                </tr></thead>
                <tbody id="staffBody"></tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- Settings -->
        <section class="mt-4" id="settings">
          <div class="card rounded-2xl shadow-soft">
            <div class="card-header bg-danger text-white"><i class="bi bi-gear text-white me-2"></i>Settings</div>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Facility Name</label>
                  <input class="form-control" value="Yaounde Central Hospital" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Facility Code</label>
                  <input class="form-control" placeholder="e.g., CM-DLA-001" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Region</label>
                  <select class="form-select" id="facilityRegion">
                  </select>
                </div>
              
                <div class="col-md-4">
                  <label class="form-label">Auto-expiry Alerts</label>
                  <div class="form-check form-switch mt-1">
                    <input class="form-check-input" type="checkbox" checked>
                    <label class="form-check-label">Notify at 7 days</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Data Export</label><br>
                  <button class="btn btn-outline-danger"><i class="bi bi-download me-1"></i>PDF</button>
                </div>
              </div>
            </div>
          </div>
        </section>

        <footer class="py-5 text-center small">© 2025 Haima – Blood & Component Management • Cameroon</footer>
      </main>
    </div>
  </div>

  <!-- Create Staff Account Modal -->
  <div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-person-plus me-2 text-danger"></i>Create Staff Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form class="needs-validation" novalidate>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input class="form-control" placeholder="e.g., Dr. Ada Fon" required>
                <div class="invalid-feedback">Name is required.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input type="email" class="form-control" placeholder="name@hospital.cm" required>
                  <div class="invalid-feedback">Valid email required.</div>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone (Cameroon)</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                  <input class="form-control" placeholder="+237 6 xx xx xx" required>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Role</label>
                <select class="form-select" id="newUserRole" required>
                  <option>Admin</option>
                  <option selected>Hospital Staff</option>
                  <option>Lab Technician</option>
              
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Region</label>
                <select class="form-select" id="newUserRegion" required></select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Temporary Password</label>
                <input class="form-control" placeholder="Auto-generated">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
            <button class="btn btn-danger" type="submit">Create Account</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Announcement Modal -->
  <div class="modal fade" id="announceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-megaphone me-2 text-danger"></i>Send Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Audience</label>
              <select class="form-select" id="announceAudience">
                <option>Staff</option>
                <option>Lab Technicians</option>
                <option>Donors</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Channel</label>
              <select class="form-select" id="announceChannel">
                <option>SMS</option>
                <option>Email</option>
                <option>Push</option>
              </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="announceUrgent">
                <label class="form-check-label" for="announceUrgent">Mark as urgent</label>
              </div>
            </div>
            <div class="col-12">
              <label class="form-label">Subject</label>
              <input id="announceSubject" class="form-control" placeholder="e.g., O- urgently needed in Douala">
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea id="announceMessage" class="form-control" rows="5" placeholder="Write your announcement…"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-danger" id="sendAnnouncement">Send</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
  <script>
    // --- Data ---
    const bloodTypes = ["O+","O-","A+","A-","B+","B-","AB+","AB-"];
    const cmRegions = ["Adamawa","Centre","East","Far North","Littoral","North","North-West","West","South","South-West"];

    const stock = [120,40,90,25,65,15,20,8];
    const mix = [62,23,11,4]; // RBC, Plasma, Platelets, Cryo

    const donations = [
      { id:"DN-10021", donor:"Ngassa Jules", blood:"O+", units:1, date:"2025-09-01", site:"Douala Laquintinie" },
      { id:"DN-10022", donor:"Amina N.", blood:"A-", units:2, date:"2025-09-01", site:"Yaoundé CHU" },
      { id:"DN-10023", donor:"Basil M.", blood:"B+", units:1, date:"2025-08-31", site:"Bafoussam RH" }
    ];

    const requests = [
      { id:"RQ-2201", hospital:"Limbe Regional Hospital", blood:"O-", units:3, component:"RBC", status:"Pending", requestedAt:"2025-09-02 08:25" },
      { id:"RQ-2202", hospital:"Garoua Regional Hospital", blood:"A+", units:2, component:"PLT", status:"Pending", requestedAt:"2025-09-02 07:40" },
      { id:"RQ-2197", hospital:"Bertoua District Hospital", blood:"AB+", units:1, component:"FFP", status:"Queued", requestedAt:"2025-09-01 16:02" }
    ];

    const logs = [
      { actor:"Admin", action:"Created user account for Lab Tech", at:"2025-09-02 09:05", ip:"10.0.0.21" },
      { actor:"LabTech-02", action:"Recorded donation DN-10022", at:"2025-09-01 13:20", ip:"10.0.0.42" },
      { actor:"System", action:"Auto-flagged 5 units expiring in 3 days", at:"2025-09-01 08:00", ip:"-" }
    ];

    const staff = [
      { id:"ST-001", name:"Dr. Thérèse Mbarga", role:"Admin", phone:"+237 6 70 00 00", email:"therese@hospital.cm", region:"Centre" },
      { id:"ST-047", name:"Jean-Paul Ndongo", role:"Lab Technician", phone:"+237 6 72 34 56", email:"j.ndongo@hospital.cm", region:"Littoral" },
      { id:"ST-103", name:"Mireille N.", role:"Nurse", phone:"+237 6 69 11 22", email:"mireille@hospital.cm", region:"West" }
    ];

    // --- Helpers ---
    function statusBadge(status){
      const map={Pending:'<span class="badge rounded-pill text-bg-warning">Pending</span>',Queued:'<span class="badge rounded-pill text-bg-primary">Queued</span>',Fulfilled:'<span class="badge rounded-pill text-bg-success">Fulfilled</span>',Rejected:'<span class="badge rounded-pill text-bg-danger">Rejected</span>'};
      return map[status] || `<span class="badge rounded-pill text-bg-secondary">${status}</span>`;
    }

    function isCompatible(requestType, donorType){
      const universalDonor = donorType === 'O-';
      const universalRecipient = requestType === 'AB+';
      if (universalRecipient) return true;
      if (universalDonor) return true;
      if (requestType === donorType) return true;
      if (requestType.endsWith('+') && donorType.endsWith('+')) return requestType[0]===donorType[0];
      return false;
    }

    // --- Populate selects ---
    const neededSel = document.getElementById('selectNeeded');
    bloodTypes.forEach(bt=>{
      const o=document.createElement('option'); o.value=o.textContent=bt; neededSel.appendChild(o);
    });
    neededSel.value='O-';

    const regionSel = document.getElementById('facilityRegion');
    const newUserRegion = document.getElementById('newUserRegion');
    cmRegions.forEach(r=>{
      [regionSel,newUserRegion].forEach(sel=>{ const o=document.createElement('option'); o.textContent=r; sel.appendChild(o.cloneNode(true)); });
    });
    regionSel.value='Littoral'; newUserRegion.value='Littoral';

    // --- KPI counts ---
    document.getElementById('kpi-stock').textContent = stock.reduce((a,b)=>a+b,0);
    document.getElementById('kpi-requests').textContent = requests.filter(r=>r.status!=='Fulfilled').length;

    // --- Tables ---
    const reqTbody = document.getElementById('requestsBody');
    reqTbody.innerHTML = requests.map(r=>`
      <tr>
        <td class="fw-semibold">${r.id}</td>
        <td>${r.hospital}</td>
        <td>
          <span class="badge text-bg-danger">${r.blood}</span>
          <span class="badge text-bg-light border ms-1">${r.component}</span>
        </td>
        <td>${r.units}</td>
        <td>${statusBadge(r.status)}</td>
        <td class="text-end">
          <button class="btn btn-sm btn-outline-secondary me-1">Assign</button>
          <button class="btn btn-sm btn-danger">Fulfil</button>
        </td>
      </tr>`).join('');

    const donTbody = document.getElementById('donationsBody');
    donTbody.innerHTML = donations.map(d=>`
      <tr>
        <td class="fw-semibold">${d.id}</td>
        <td>${d.donor}</td>
        <td><span class="badge text-bg-danger">${d.blood}</span></td>
        <td>${d.units}</td>
        <td>${d.date}</td>
        <td>${d.site}</td>
      </tr>`).join('');

    const logsList = document.getElementById('logsList');
    logsList.innerHTML = logs.map(l=>`
      <div class="list-group-item">
        <div class="d-flex gap-2 align-items-start">
          <span class="badge text-bg-danger"><i class="bi bi-activity"></i></span>
          <div>
            <div class="fw-semibold">${l.action}</div>
            <div class="small text-muted">${l.at} • by ${l.actor} • IP ${l.ip}</div>
          </div>
        </div>
      </div>`).join('');

    // Staff table + search
    const staffBody = document.getElementById('staffBody');
    const staffSearch = document.getElementById('staffSearch');
    function renderStaff(rows){
      staffBody.innerHTML = rows.map(s=>`
        <tr>
          <td class="fw-semibold">${s.id}</td>
          <td>${s.name}</td>
          <td>${s.role}</td>
          <td>${s.phone}</td>
          <td>${s.email}</td>
          <td>${s.region}</td>
          <td class="text-end">
            <div class="btn-group">
              <button class="btn btn-sm btn-outline-secondary">Actions</button>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"></button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Reset Password</a></li>
                <li><a class="dropdown-item" href="#">Change Role</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#">Deactivate</a></li>
              </ul>
            </div>
          </td>
        </tr>`).join('');
    }
    renderStaff(staff);
    staffSearch.addEventListener('input', e=>{
      const q = e.target.value.toLowerCase();
      renderStaff(staff.filter(s=> s.name.toLowerCase().includes(q) || s.role.toLowerCase().includes(q)));
    });

    // --- Compatibility Grid ---
    const compatGrid = document.getElementById('compatGrid');
    function renderCompat(need){
      document.getElementById('needTag').textContent = need;
      compatGrid.innerHTML = bloodTypes.map(bt=>{
        const ok = isCompatible(need, bt);
        return `<div class="col-3">
          <div class="p-2 rounded compat-tile ${ok? 'compat-ok':''} text-center">
            <div class="compat-bt">${bt}</div>
            <div class="small text-muted">${ok? '<i class="bi bi-check-circle"></i>':''}</div>
          </div>
        </div>`;
      }).join('');
    }
    renderCompat('O-');
    neededSel.addEventListener('change', e=> renderCompat(e.target.value));

    // --- Charts ---
    const ctxStock = document.getElementById('chartStock');
    new Chart(ctxStock,{ type:'bar', data:{ labels:bloodTypes, datasets:[{ label:'Units', data:stock, backgroundColor:'rgba(220,38,38,.8)', borderRadius:8 }]}, options:{ plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true } } }});

    const ctxMix = document.getElementById('chartMix');
    new Chart(ctxMix,{ type:'doughnut', data:{ labels:['Red Cells','Plasma','Platelets','Cryo'], datasets:[{ data:mix, backgroundColor:['#ef4444','#fb7185','#f59e0b','#dc2626'] }] }, options:{ plugins:{ legend:{ position:'bottom' } } }});

    // --- Form validation (Bootstrap) ---
    (function(){
      const forms=document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form=>{
        form.addEventListener('submit', e=>{
          if(!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
          form.classList.add('was-validated');
        }, false);
      })
    })();

    // --- Announcement handler (demo) ---
    document.getElementById('sendAnnouncement').addEventListener('click', ()=>{
      const aud = document.getElementById('announceAudience').value;
      const ch = document.getElementById('announceChannel').value;
      const subj = document.getElementById('announceSubject').value || '(No subject)';
      const urgent = document.getElementById('announceUrgent').checked ? 'URGENT ' : '';
      const msg = document.getElementById('announceMessage').value || '';
      alert(`${urgent}${subj}\nAudience: ${aud} | Channel: ${ch}\n\n${msg}`);
    });
  </script>
</body>
</html>
