// ===================== DATA =====================
const defaultData = {
  school: { name: "Colonel's Sainik Vidyalaya", tagline: '"Cradle For Excellence"', desc: "A premier institution blending Sainik discipline with modern CBSE education — nurturing character, academic brilliance, and leadership from Nursery to Class VIII.", est: "2026", seats: "500+", founder: "Dr. Anamika Kumar (W/o Col. Shishir Kumar)", affil: "CBSE, Delhi", heroImg: "assets/images/school_image.png", campusTitle: "Grand Campus — Madhepura, Bihar" },
  contact: { address: "Colonel's Sainik Vidyalaya, Madhepura, Bihar, India", phone: "+91 XXXXX XXXXX", email: "info@colonelssainikvidyalaya.in", website: "www.colonelssainikvidyalaya.in", hours: "Monday to Saturday · 9:00 AM – 4:00 PM" },
  ticker: ["🎖️ Admissions Open for 2026–27", "📚 CBSE Curriculum · Nursery to Class VIII", "🏠 Day Scholar · Day Boarder · Full Boarder Available", "⭐ Cradle For Excellence — Colonel's Sainik Vidyalaya, Madhepura", "🏆 Founding Batch 2026 — Limited Seats · Apply Now"],
  gallery: [
    { url: "", caption: "Annual Sports Day", cat: "Sports" },
    { url: "", caption: "Science Exhibition", cat: "Academics" },
    { url: "", caption: "Republic Day Parade", cat: "Sainik Training" },
    { url: "", caption: "Campus View", cat: "Campus" }
  ],
  levels: [
    { name: "Pre-Primary", range: "Nursery · LKG · UKG", subjects: "Play-Based Activity Learning\nHindi & English Language\nBasic Numeracy & Literacy\nArt, Craft & Music\nPhysical Development\nSocial & Emotional Skills" },
    { name: "Primary", range: "Class I to Class V", subjects: "English, Hindi & Sanskrit\nMathematics (CBSE)\nEnvironmental Science\nSocial Studies & GK\nComputer Fundamentals\nPhysical Education & Art" },
    { name: "Upper Primary", range: "Class VI to Class VIII", subjects: "English, Hindi & 3rd Language\nMathematics (Advanced CBSE)\nScience (Physics/Chem/Bio)\nSocial Science (CBSE)\nComputer Science\nMoral & Value Education" }
  ],
  cocu: [
    { ico: "⚽", name: "Sports & Athletics" }, { ico: "🎨", name: "Fine Arts" }, { ico: "🎭", name: "Drama & Elocution" },
    { ico: "🎵", name: "Music & Dance" }, { ico: "💻", name: "Digital Literacy" }, { ico: "🎖️", name: "Sainik Drill & Parade" },
    { ico: "📖", name: "Library & Reading" }, { ico: "🌱", name: "Eco Club" }
  ],
  facilities: [
    { ico: "🔬", name: "Science Laboratories", desc: "Fully-equipped Physics, Chemistry, and Biology labs enabling hands-on experimentation.", tags: "Physics,Chemistry,Biology" },
    { ico: "💻", name: "Computer Lab", desc: "Modern lab with high-speed internet, updated software, and experienced instructors.", tags: "High-Speed Net,Modern PCs" },
    { ico: "📚", name: "Library & Resource Centre", desc: "Thousands of books, periodicals, and reference materials fostering a love of reading.", tags: "Books,Periodicals,Digital" },
    { ico: "⚽", name: "Sports Complex", desc: "Expansive grounds with cricket, football, athletics, basketball, and indoor games.", tags: "Cricket,Football,Athletics" },
    { ico: "🏠", name: "Residential Hostel", desc: "Comfortable, safe, supervised boarding with hygienic rooms and 24/7 security.", tags: "Boys Hostel,Girls Hostel,Security" },
    { ico: "🍽️", name: "Dining Hall", desc: "Hygienic, nutritious, and balanced meals in a clean, spacious dining hall.", tags: "Nutritious,Hygienic Kitchen" },
    { ico: "🎨", name: "Art & Activity Rooms", desc: "Dedicated spaces for fine arts, music, dance, and creative activities.", tags: "Art Studio,Music,Dance" },
    { ico: "🏥", name: "Medical Centre", desc: "On-campus medical facility with qualified nursing staff.", tags: "First Aid,Sick Bay" },
    { ico: "🚌", name: "Transport Service", desc: "Safe and reliable school bus service covering major routes in and around Madhepura.", tags: "GPS Tracked,Safe Routes" }
  ],
  admCats: [
    { ico: "☀️", name: "Day Scholar", desc: "Regular school hours — morning to afternoon. Students return home daily with full access to all academic programs.", range: "Nursery to Class VIII" },
    { ico: "🌆", name: "Day Boarder", desc: "Extended program — students stay for supervised study, dinner, and enrichment activities until evening.", range: "Nursery to Class VIII" },
    { ico: "🏠", name: "Full Boarder", desc: "Complete residential program with accommodation, all meals, 24/7 supervision, Sainik drill, and a structured daily routine.", range: "Class I to Class VIII" }
  ],
  admSession: "2026–27 Session",
  admLastDate: "May 31, 2026",
  admDates: [
    { label: "Admissions Open", value: "April 2026" },
    { label: "Last Date to Apply", value: "May 31, 2026" },
    { label: "Interaction Sessions", value: "June 2026" },
    { label: "Results Announced", value: "July 2026" },
    { label: "Fee Submission", value: "July 2026" },
    { label: "Classes Commence", value: "August 2026" }
  ],
  admDocs: [
    { doc: "Birth Certificate", req: "Mandatory" },
    { doc: "Previous School Report", req: "If applicable" },
    { doc: "Aadhaar Card (Child)", req: "Mandatory" },
    { doc: "Parent's ID Proof", req: "Mandatory" },
    { doc: "Residence Proof", req: "Mandatory" },
    { doc: "Passport Photos (4 nos.)", req: "Mandatory" },
    { doc: "Transfer Certificate", req: "If applicable" }
  ],
  notices: [
    { ico: "📢", type: "gold", title: "Admissions Open 2026–27", desc: "We are pleased to announce admissions for the 2026–27 academic session are now open for all three programs.", date: "April 2026" },
    { ico: "📅", type: "blue", title: "Annual Sports Day", desc: "Annual Sports Day will be held on the school grounds. All students are required to participate.", date: "March 2026" },
    { ico: "⚠️", type: "red", title: "Fee Payment Reminder", desc: "Parents are requested to clear all pending fee dues before the end of this month.", date: "February 2026" }
  ],
  news: [
    { title: "Admissions Open for 2026–27 Academic Year", category: "Admissions", color: "var(--navy)", catColor: "var(--navy)", desc: "We are pleased to announce admissions for the 2026–27 session are now open for all three programs.", date: "April 2026" },
    { title: "Grand Campus Inauguration Planned for 2026", category: "Milestone", color: "#1a7a1a", catColor: "#1a6b1a", desc: "The magnificent new campus of Colonel's Sainik Vidyalaya is set to welcome its very first batch of students.", date: "March 2026" },
    { title: "CBSE Affiliation Process Actively Underway", category: "Notice", color: "var(--gold)", catColor: "var(--gold)", desc: "The school is actively pursuing full CBSE affiliation, ensuring all students receive a nationally recognized education.", date: "February 2026" }
  ]
};

// Load data
let D = JSON.parse(localStorage.getItem('csv_cms_data') || 'null') || defaultData;

// ===================== NAVIGATION =====================
function goPage(id) {
  document.querySelectorAll('.pp').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.p-links a').forEach(a => a.classList.remove('active'));
  const page = document.getElementById('pp-' + id);
  if (page) page.classList.add('active');
  const nav = document.getElementById('pnav-' + id);
  if (nav) nav.classList.add('active');
  // Reset apply form if going to apply page
  if (id === 'apply') {
    const fw = document.getElementById('apply-form-wrap');
    const sw = document.getElementById('apply-success-wrap');
    if (fw) fw.style.display = 'block';
    if (sw) sw.style.display = 'none';
    // Sync session label
    const sl = document.getElementById('apply-session-lbl');
    if (sl) sl.textContent = D.admSession || '2026–27 Session';
    // Sync help phone
    const hp = document.getElementById('apply-help-phone');
    if (hp) hp.innerHTML = 'Call us at <strong>' + (D.contact.phone || '+91 XXXXX XXXXX') + '</strong> or visit our campus. Our admissions team is available Mon–Sat, 9AM–4PM.';
  }
  window.scrollTo({ top: 0, behavior: 'smooth' });
  setTimeout(initReveal, 200);
}
function goAdmin() {
  window.location.href = 'admin/index.html';
}
function goPublic() {
  window.location.href = 'index.html';
}
function showPanel(id) {
  document.querySelectorAll('.adm-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.adm-nav-item').forEach(n => n.classList.remove('active'));
  const panel = document.getElementById('panel-' + id);
  if (panel) panel.classList.add('active');
  if (typeof event !== 'undefined' && event && event.currentTarget) event.currentTarget.classList.add('active');
  const titles = { dashboard: 'Dashboard', 'school-info': 'School Information', gallery: 'Gallery', academics: 'Academics', facilities: 'Facilities', admissions: 'Admissions', notices: 'Notices & Circulars', news: 'News & Events', 'contact-info': 'Contact Information', enquiries: 'Enquiry Inbox', applications: 'Online Applications' };
  document.getElementById('adm-title').textContent = titles[id] || id;
  renderAdminPanel(id);
}
function switchTab(el, targetId) {
  el.parentElement.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  const parent = el.closest('.adm-panel');
  parent.querySelectorAll('[id^="acad-"],[id^="adm-"]').forEach(d => {
    if (d.classList.contains('tabs')) return;
    d.style.display = 'none';
  });
  document.getElementById(targetId).style.display = 'block';
}

// ===================== SAVE =====================
function saveAll() {
  // Gather school info
  const fields = ['name', 'tagline', 'desc', 'est', 'seats', 'founder', 'affil', 'heroImg'];
  fields.forEach(f => {
    const el = document.getElementById('si-' + f);
    if (el) D.school[f] = el.value;
  });
  const ct = ['address', 'phone', 'email', 'website', 'hours'];
  ct.forEach(f => { const el = document.getElementById('ci-' + f); if (el) D.contact[f] = el.value; });
  const sess = document.getElementById('adm-session');
  const ld = document.getElementById('adm-lastdate');
  if (sess) D.admSession = sess.value;
  if (ld) D.admLastDate = ld.value;
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  showToast('✅ All changes saved successfully!', 'success');
  const si = document.getElementById('save-indicator');
  si.style.display = 'block';
  setTimeout(() => si.style.display = 'none', 3000);
  renderPublic();
  updateDashboard();
}

// ===================== TOAST =====================
function showToast(msg, type = 'success') {
  const t = document.getElementById('toast');
  document.getElementById('toast-msg').textContent = msg;
  t.className = 'toast show ' + type;
  setTimeout(() => t.classList.remove('show'), 3000);
}

// ===================== MODAL =====================
function openModal(type, editIdx = -1) {
  const mb = document.getElementById('modal-bg');
  const mc = document.getElementById('modal-content');
  let html = '';
  if (type === 'notice') {
    const item = editIdx >= 0 ? D.notices[editIdx] : { ico: '📢', type: 'gold', title: '', desc: '', date: '' };
    html = `<h3>${editIdx >= 0 ? 'Edit' : 'Add'} Notice</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Icon / Emoji</label><input id="m-ico" value="${item.ico}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Type (color: red/blue/green/gold)</label>
    <select id="m-type"><option value="red" ${item.type === 'red' ? 'selected' : ''}>🔴 Red (Urgent)</option><option value="blue" ${item.type === 'blue' ? 'selected' : ''}>🔵 Blue (Event)</option><option value="green" ${item.type === 'green' ? 'selected' : ''}>🟢 Green (Success)</option><option value="gold" ${item.type === 'gold' ? 'selected' : ''}>🟡 Gold (Announcement)</option></select></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Title</label><input id="m-title" value="${item.title}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Description</label><textarea id="m-desc">${item.desc}</textarea></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Date</label><input id="m-date" value="${item.date}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('notice',${editIdx})">Save</button>
    </div>`;
  } else if (type === 'news') {
    const item = editIdx >= 0 ? D.news[editIdx] : { title: '', category: '', color: 'var(--navy)', catColor: 'var(--navy)', desc: '', date: '' };
    html = `<h3>${editIdx >= 0 ? 'Edit' : 'Add'} News Item</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Title</label><input id="m-title" value="${item.title}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Category</label><input id="m-cat" value="${item.category}" placeholder="e.g. Admissions, Events, Milestone"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Description</label><textarea id="m-desc">${item.desc}</textarea></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Date</label><input id="m-date" value="${item.date}" placeholder="April 2026"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('news',${editIdx})">Save</button>
    </div>`;
  } else if (type === 'facility') {
    const item = editIdx >= 0 ? D.facilities[editIdx] : { ico: '🏛️', name: '', desc: '', tags: '' };
    html = `<h3>${editIdx >= 0 ? 'Edit' : 'Add'} Facility</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Icon (emoji)</label><input id="m-ico" value="${item.ico}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Facility Name</label><input id="m-name" value="${item.name}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Description</label><textarea id="m-desc">${item.desc}</textarea></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Tags (comma separated)</label><input id="m-tags" value="${item.tags}" placeholder="Tag1,Tag2,Tag3"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('facility',${editIdx})">Save</button>
    </div>`;
  } else if (type === 'acad-level') {
    const item = editIdx >= 0 ? D.levels[editIdx] : { name: '', range: '', subjects: '' };
    html = `<h3>${editIdx >= 0 ? 'Edit' : 'Add'} Program Level</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Level Name</label><input id="m-name" value="${item.name}" placeholder="e.g. Primary"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Class Range</label><input id="m-range" value="${item.range}" placeholder="e.g. Class I to Class V"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Subjects (one per line)</label><textarea id="m-subjects" style="min-height:120px;">${item.subjects}</textarea></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('acad-level',${editIdx})">Save</button>
    </div>`;
  } else if (type === 'cocu') {
    const item = editIdx >= 0 ? D.cocu[editIdx] : { ico: '🎭', name: '' };
    html = `<h3>${editIdx >= 0 ? 'Edit' : 'Add'} Co-Curricular Activity</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Icon (emoji)</label><input id="m-ico" value="${item.ico}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Activity Name</label><input id="m-name" value="${item.name}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('cocu',${editIdx})">Save</button>
    </div>`;
  } else if (type === 'adm-date') {
    const item = editIdx >= 0 ? D.admDates[editIdx] : { label: '', value: '' };
    html = `<h3>${editIdx >= 0 ? 'Edit' : 'Add'} Important Date</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Label</label><input id="m-label" value="${item.label}" placeholder="e.g. Last Date to Apply"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Date / Value</label><input id="m-value" value="${item.value}" placeholder="e.g. May 31, 2026"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('adm-date',${editIdx})">Save</button>
    </div>`;
  } else if (type === 'adm-doc') {
    const item = editIdx >= 0 ? D.admDocs[editIdx] : { doc: '', req: 'Mandatory' };
    html = `<h3>${editIdx >= 0 ? 'Edit' : 'Add'} Required Document</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Document Name</label><input id="m-doc" value="${item.doc}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Requirement</label>
    <select id="m-req"><option value="Mandatory" ${item.req === 'Mandatory' ? 'selected' : ''}>Mandatory</option><option value="If applicable" ${item.req === 'If applicable' ? 'selected' : ''}>If applicable</option><option value="Optional" ${item.req === 'Optional' ? 'selected' : ''}>Optional</option></select></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('adm-doc',${editIdx})">Save</button>
    </div>`;
  }
  mc.innerHTML = html;
  mb.classList.add('open');
}
function closeModal() { document.getElementById('modal-bg').classList.remove('open'); }
document.getElementById('modal-bg').onclick = function (e) { if (e.target === this) closeModal(); }

function saveModal(type, editIdx) {
  if (type === 'notice') {
    const item = { ico: v('m-ico'), type: v('m-type'), title: v('m-title'), desc: v('m-desc'), date: v('m-date') };
    if (editIdx >= 0) D.notices[editIdx] = item; else D.notices.unshift(item);
  } else if (type === 'news') {
    const item = { title: v('m-title'), category: v('m-cat'), color: 'var(--navy)', catColor: 'var(--navy)', desc: v('m-desc'), date: v('m-date') };
    if (editIdx >= 0) D.news[editIdx] = item; else D.news.unshift(item);
  } else if (type === 'facility') {
    const item = { ico: v('m-ico'), name: v('m-name'), desc: v('m-desc'), tags: v('m-tags') };
    if (editIdx >= 0) D.facilities[editIdx] = item; else D.facilities.push(item);
  } else if (type === 'acad-level') {
    const item = { name: v('m-name'), range: v('m-range'), subjects: v('m-subjects') };
    if (editIdx >= 0) D.levels[editIdx] = item; else D.levels.push(item);
  } else if (type === 'cocu') {
    const item = { ico: v('m-ico'), name: v('m-name') };
    if (editIdx >= 0) D.cocu[editIdx] = item; else D.cocu.push(item);
  } else if (type === 'adm-date') {
    const item = { label: v('m-label'), value: v('m-value') };
    if (editIdx >= 0) D.admDates[editIdx] = item; else D.admDates.push(item);
  } else if (type === 'adm-doc') {
    const item = { doc: v('m-doc'), req: v('m-req') };
    if (editIdx >= 0) D.admDocs[editIdx] = item; else D.admDocs.push(item);
  }
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  closeModal();
  showToast('Saved!', 'success');
  renderAdmin();
}
function v(id) { const el = document.getElementById(id); return el ? el.value : ''; }

function deleteItem(arr, idx) {
  arr.splice(idx, 1);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  showToast('Deleted', 'success');
  renderAdmin();
}

// ===================== GALLERY =====================
function addGalleryItem() {
  const url = v('gal-url'), cap = v('gal-cap'), cat = v('gal-cat');
  D.gallery.push({ url, caption: cap, cat });
  document.getElementById('gal-url').value = '';
  document.getElementById('gal-cap').value = '';
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  showToast('Image added!', 'success');
  renderAdmin();
}

// ===================== TICKER =====================
function addTickerItem() {
  const val = v('new-ticker').trim();
  if (!val) return;
  D.ticker.push(val);
  document.getElementById('new-ticker').value = '';
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  showToast('Ticker message added!');
  renderAdminPanel('school-info');
  renderPublicTicker();
}

// ===================== RENDER PUBLIC =====================
function renderPublic() {
  const s = D.school, c = D.contact;
  // School name & info
  setText('p-school-name-nav', s.name);
  setText('ft-school-name', s.name);
  // Hero
  const h1 = document.getElementById('h-school-name');
  if (h1) { const parts = s.name.split(' '); const last = parts.pop(); h1.innerHTML = parts.join(' ') + '<br><em>' + last + '</em>'; }
  setText('h-tagline', s.tagline);
  setText('h-desc', s.desc);
  setText('h-est', s.est);
  setText('h-students', s.seats);
  setText('h-founder', `Founder: ${s.founder}`);
  setText('h-campus-title', s.campusTitle || 'Grand Campus — Madhepura, Bihar');
  // Hero image
  const hiw = document.getElementById('hero-img-wrap');
  if (hiw) {
    const imgPath = s.heroImg || 'assets/images/school_image.png';
    const existingImg = hiw.querySelector('img');
    if (existingImg) {
      existingImg.src = imgPath;
    } else {
      hiw.innerHTML = `<img src="${imgPath}" alt="Campus" style="width:100%;display:block;object-fit:cover;max-height:360px;" onerror="this.style.display='none'">`;
    }
  }
  // Contact
  setText('ct-address', c.address);
  setText('ct-phone', c.phone);
  setText('ct-email', c.email);
  setText('ct-hours', c.hours);
  setText('ct-website', c.website);
  setText('ft-addr', '📍 ' + c.address);
  setText('ft-ph', '📞 ' + c.phone);
  setText('ft-em', '📧 ' + c.email);
  // Ticker
  renderPublicTicker();
  // News
  renderPublicNews();
  // Notices
  renderPublicNotices();
  // Academics
  renderPublicAcademics();
  // Gallery
  renderPublicGallery();
  // Facilities
  renderPublicFacilities();
  // Admissions
  renderPublicAdmissions();
  // Home extras
  renderHomeAdmDates();
  // About page
  const abtEst = document.getElementById('abt-est');
  if (abtEst) abtEst.textContent = D.school.est || '2026';
  const abtSeats = document.getElementById('abt-seats');
  if (abtSeats) abtSeats.textContent = D.school.seats || '500+';
  const abtBadge = document.getElementById('abt-est-badge');
  if (abtBadge) abtBadge.textContent = D.school.est || '2026';
  const ldr = document.getElementById('leader-founder-name');
  if (ldr) ldr.textContent = D.school.founder || 'Dr. Anamika Kumar';
  renderFounderInfo();
  renderHomeSeats();
  setTimeout(initReveal, 100);
}
function setText(id, val) { const el = document.getElementById(id); if (el) el.textContent = val || ''; }
function renderPublicTicker() {
  const t = document.getElementById('ticker-track');
  if (!t) return;
  const fallback = ["🎖️ Admissions Open for 2026–27", "📚 CBSE Curriculum · Nursery to Class VIII", "🏠 Day Scholar · Day Boarder · Full Boarder Available", "⭐ Cradle For Excellence — Colonel's Sainik Vidyalaya", "🏆 Founding Batch 2026 — Limited Seats · Apply Now"];
  const src = (D.ticker && D.ticker.length) ? D.ticker : fallback;
  const msgs = [...src, ...src, ...src];
  t.innerHTML = msgs.map(m => `<span>${m}</span><span class="sep">◆</span>`).join('');
}
function renderPublicNews() {
  const g = document.getElementById('news-grid-home');
  if (!g) return;
  const colors = ['linear-gradient(90deg,var(--navy),var(--navy-mid))', 'linear-gradient(90deg,#1a7a1a,#4caf50)', 'linear-gradient(90deg,var(--gold),var(--gold-mid))'];
  g.innerHTML = D.news.slice(0, 3).map((n, i) => `
    <div class="card">
      <div class="news-acc" style="background:${colors[i % 3]};"></div>
      <div class="news-body">
        <span class="news-cat" style="color:${n.catColor || 'var(--navy)'};">🔖 ${n.category}</span>
        <h3>${n.title}</h3>
        <p>${n.desc}</p>
        <div class="news-meta">📅 ${n.date}</div>
      </div>
    </div>`).join('');
}
function renderPublicNotices() {
  const l = document.getElementById('pub-notices-list');
  if (!l) return;
  if (!D.notices.length) { l.innerHTML = '<p style="color:var(--light);text-align:center;padding:40px;">No notices at the moment.</p>'; return; }
  l.innerHTML = D.notices.map(n => `
    <div class="notice-item">
      <div class="notice-ico ${n.type}">${n.ico}</div>
      <div class="notice-content">
        <h4>${n.title}</h4>
        <p>${n.desc}</p>
        <div class="notice-date">📅 ${n.date}</div>
      </div>
    </div>`).join('');
}
function renderPublicAcademics() {
  const lg = document.getElementById('pub-levels-g');
  if (lg) lg.innerHTML = D.levels.map(l => `
    <div class="card">
      <div class="lvl-hd"><h3>${l.name}</h3><p>${l.range}</p></div>
      <div class="lvl-bd"><ul>${l.subjects.split('\n').filter(s => s.trim()).map(s => `<li>${s.trim()}</li>`).join('')}</ul></div>
    </div>`).join('');
  const cg = document.getElementById('pub-cocu-grid');
  if (cg) cg.innerHTML = D.cocu.map(c => `
    <div class="cocu-c"><div class="ico">${c.ico}</div><h4>${c.name}</h4></div>`).join('');
}
function renderPublicGallery() {
  const g = document.getElementById('pub-gallery-grid');
  if (!g) return;
  if (!D.gallery.length) { g.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--light);">No gallery images yet. Admin can add images.</div>'; return; }
  g.innerHTML = D.gallery.map((item, i) => `
    <div class="gallery-item" onclick="openLightbox('${item.url}')">
      ${item.url ? `<img src="${item.url}" alt="${item.caption}" onerror="this.parentElement.innerHTML='<div class=gallery-item-placeholder><span>🖼️</span>${item.caption}</div>'">` :
      `<div class="gallery-item-placeholder"><span>🖼️</span>${item.caption || 'Image ' + i}</div>`}
      <div class="gallery-overlay"><span class="gallery-caption">${item.caption}</span></div>
    </div>`).join('');
}
function renderPublicFacilities() {
  const g = document.getElementById('pub-fac-g');
  if (!g) return;
  g.innerHTML = D.facilities.map(f => `
    <div class="card">
      <div class="fac-ico-wrap">${f.ico}</div>
      <div class="fac-bd">
        <h3>${f.name}</h3>
        <p>${f.desc}</p>
        <div class="fac-tags">${(f.tags || '').split(',').filter(t => t.trim()).map(t => `<span class="ftag">${t.trim()}</span>`).join('')}</div>
      </div>
    </div>`).join('');
}
function renderPublicAdmissions() {
  const sl = document.getElementById('adm-session-label');
  if (sl) sl.textContent = D.admSession || '2026–27 Session';
  const cats = document.getElementById('pub-adm-cats');
  if (cats) cats.innerHTML = D.admCats.map(c => `
    <div class="card adm-c">
      <div class="ico">${c.ico}</div>
      <h3>${c.name}</h3>
      <p>${c.desc}</p>
      <div class="tag"><span class="prog-tag">${c.range}</span></div>
    </div>`).join('');
  const steps = document.getElementById('pub-adm-steps');
  if (steps) steps.innerHTML = ['Enquiry', 'Application', 'Interaction', 'Selection', 'Enrollment'].map((s, i) => `
    <div class="step"><div class="step-ball">${i + 1}</div><h4>${s}</h4></div>`).join('');
  const docs = document.getElementById('pub-adm-docs');
  if (docs) docs.innerHTML = `
    <div class="info-bx"><h3>📋 Required Documents</h3>
    <table class="info-tbl">${D.admDocs.map(d => `<tr><td>${d.doc}</td><td>${d.req}</td></tr>`).join('')}</table></div>
    <div class="info-bx"><h3>📅 Important Dates</h3>
    <table class="info-tbl">${D.admDates.map(d => `<tr><td>${d.label}</td><td>${d.value}</td></tr>`).join('')}</table></div>`;
}

// ===================== RENDER ADMIN =====================
function renderAdmin() {
  renderAdminPanel(document.querySelector('.adm-panel.active')?.id?.replace('panel-', '') || 'dashboard');
}
function renderAdminPanel(id) {
  if (id === 'dashboard') updateDashboard();
  else if (id === 'school-info') renderSchoolInfoPanel();
  else if (id === 'gallery') renderGalleryPanel();
  else if (id === 'academics') renderAcademicsPanel();
  else if (id === 'facilities') renderFacilitiesPanel();
  else if (id === 'admissions') renderAdmissionsPanel();
  else if (id === 'notices') renderNoticesPanel();
  else if (id === 'news') renderNewsPanel();
  else if (id === 'contact-info') renderContactPanel();
  else if (id === 'enquiries') renderEnquiriesPanel();
  else if (id === 'applications') renderApplicationsPanel();
}
function updateDashboard() {
  if (!D.enquiries) D.enquiries = [];
  if (!D.applications) D.applications = [];
  setText('d-gallery', D.gallery.length);
  setText('d-notices', D.notices.length);
  setText('d-news', D.news.length);
  setText('d-facilities', D.facilities.length);
  setText('d-enquiries', D.enquiries.length);
  setText('d-applications', D.applications.length);
  updateInboxBadges();
}
function renderSchoolInfoPanel() {
  const s = D.school;
  setVal('si-name', s.name); setVal('si-tagline', s.tagline); setVal('si-desc', s.desc);
  setVal('si-est', s.est); setVal('si-seats', s.seats); setVal('si-founder', s.founder);
  setVal('si-affil', s.affil); setVal('si-hero-img', s.heroImg || '');
  const tl = document.getElementById('ticker-items-list');
  if (tl) tl.innerHTML = D.ticker.map((t, i) => `
    <div class="item-row">
      <div class="item-row-ico">📢</div>
      <div class="item-row-info"><h4>${t}</h4></div>
      <div class="item-row-actions">
        <button class="btn-del" onclick="D.ticker.splice(${i},1);localStorage.setItem('csv_cms_data',JSON.stringify(D));renderAdminPanel('school-info');renderPublicTicker();showToast('Deleted')">✕</button>
      </div>
    </div>`).join('');
}
function setVal(id, val) { const el = document.getElementById(id); if (el) el.value = val || ''; }
function renderGalleryPanel() {
  const count = document.getElementById('gal-count');
  if (count) count.textContent = D.gallery.length;
  const grid = document.getElementById('gal-admin-grid');
  if (!grid) return;
  grid.innerHTML = D.gallery.map((item, i) => `
    <div class="gal-thumb">
      ${item.url ? `<img src="${item.url}" alt="${item.caption}" onerror="this.style.display='none'">` :
      `<div class="gal-thumb-placeholder"><span>🖼️</span>${item.caption || 'Image'}</div>`}
      <div class="gal-thumb-overlay">
        <button class="gal-del-btn" onclick="deleteItem(D.gallery,${i});renderGalleryPanel();renderPublicGallery();">Delete</button>
      </div>
    </div>`).join('') + `<div class="gal-thumb" style="cursor:default;"><div class="gal-thumb-placeholder">
      <span>➕</span><p style="font-size:11px;">Use the form above to add images</p></div></div>`;
}
function renderAcademicsPanel() {
  const ll = document.getElementById('acad-levels-list');
  if (ll) ll.innerHTML = D.levels.map((l, i) => `
    <div class="item-row">
      <div class="item-row-ico">📚</div>
      <div class="item-row-info"><h4>${l.name}</h4><p>${l.range}</p></div>
      <div class="item-row-actions">
        <button class="btn-edit" onclick="openModal('acad-level',${i})">Edit</button>
        <button class="btn-del" onclick="deleteItem(D.levels,${i});renderAcademicsPanel()">✕</button>
      </div>
    </div>`).join('');
  const cl = document.getElementById('cocu-list');
  if (cl) cl.innerHTML = D.cocu.map((c, i) => `
    <div class="item-row">
      <div class="item-row-ico">${c.ico}</div>
      <div class="item-row-info"><h4>${c.name}</h4></div>
      <div class="item-row-actions">
        <button class="btn-edit" onclick="openModal('cocu',${i})">Edit</button>
        <button class="btn-del" onclick="deleteItem(D.cocu,${i});renderAcademicsPanel()">✕</button>
      </div>
    </div>`).join('');
}
function renderFacilitiesPanel() {
  const fl = document.getElementById('fac-admin-list');
  if (!fl) return;
  fl.innerHTML = D.facilities.map((f, i) => `
    <div class="item-row">
      <div class="item-row-ico">${f.ico}</div>
      <div class="item-row-info"><h4>${f.name}</h4><p>${f.desc.substring(0, 60)}...</p></div>
      <div class="item-row-actions">
        <button class="btn-edit" onclick="openModal('facility',${i})">Edit</button>
        <button class="btn-del" onclick="deleteItem(D.facilities,${i});renderFacilitiesPanel();renderPublicFacilities()">✕</button>
      </div>
    </div>`).join('');
}
function renderAdmissionsPanel() {
  setVal('adm-session', D.admSession);
  setVal('adm-lastdate', D.admLastDate);
  const cl = document.getElementById('adm-cats-list');
  if (cl) cl.innerHTML = D.admCats.map((c, i) => `
    <div class="item-row">
      <div class="item-row-ico">${c.ico}</div>
      <div class="item-row-info"><h4>${c.name}</h4><p>${c.range}</p></div>
      <div class="item-row-actions"><button class="btn-edit" onclick="openAdmCatModal(${i})">Edit</button></div>
    </div>`).join('');
  const dl = document.getElementById('adm-dates-list');
  if (dl) dl.innerHTML = D.admDates.map((d, i) => `
    <div class="item-row">
      <div class="item-row-ico">📅</div>
      <div class="item-row-info"><h4>${d.label}</h4><p>${d.value}</p></div>
      <div class="item-row-actions">
        <button class="btn-edit" onclick="openModal('adm-date',${i})">Edit</button>
        <button class="btn-del" onclick="deleteItem(D.admDates,${i});renderAdmissionsPanel()">✕</button>
      </div>
    </div>`).join('');
  const docl = document.getElementById('adm-docs-list');
  if (docl) docl.innerHTML = D.admDocs.map((d, i) => `
    <div class="item-row">
      <div class="item-row-ico">📋</div>
      <div class="item-row-info"><h4>${d.doc}</h4><p>${d.req}</p></div>
      <div class="item-row-actions">
        <button class="btn-edit" onclick="openModal('adm-doc',${i})">Edit</button>
        <button class="btn-del" onclick="deleteItem(D.admDocs,${i});renderAdmissionsPanel()">✕</button>
      </div>
    </div>`).join('');
}
function openAdmCatModal(i) {
  const item = D.admCats[i];
  const mc = document.getElementById('modal-content');
  mc.innerHTML = `<h3>Edit Admission Category</h3>
  <div class="form-group" style="margin-bottom:14px;"><label>Icon</label><input id="m-ico" value="${item.ico}"></div>
  <div class="form-group" style="margin-bottom:14px;"><label>Name</label><input id="m-name" value="${item.name}"></div>
  <div class="form-group" style="margin-bottom:14px;"><label>Description</label><textarea id="m-desc">${item.desc}</textarea></div>
  <div class="form-group" style="margin-bottom:14px;"><label>Class Range</label><input id="m-range" value="${item.range}"></div>
  <div class="modal-footer">
    <button class="btn-cancel" onclick="closeModal()">Cancel</button>
    <button class="btn-save" onclick="D.admCats[${i}]={ico:v('m-ico'),name:v('m-name'),desc:v('m-desc'),range:v('m-range')};localStorage.setItem('csv_cms_data',JSON.stringify(D));closeModal();showToast('Saved!');renderAdmissionsPanel();">Save</button>
  </div>`;
  document.getElementById('modal-bg').classList.add('open');
}
function renderNoticesPanel() {
  const nl = document.getElementById('notices-admin-list');
  if (!nl) return;
  nl.innerHTML = D.notices.map((n, i) => `
    <div class="item-row">
      <div class="item-row-ico ${n.type}">${n.ico}</div>
      <div class="item-row-info"><h4>${n.title}</h4><p>${n.date}</p></div>
      <div class="item-row-actions">
        <button class="btn-edit" onclick="openModal('notice',${i})">Edit</button>
        <button class="btn-del" onclick="deleteItem(D.notices,${i});renderNoticesPanel();renderPublicNotices()">✕</button>
      </div>
    </div>`).join('');
}
function renderNewsPanel() {
  const nl = document.getElementById('news-admin-list');
  if (!nl) return;
  nl.innerHTML = D.news.map((n, i) => `
    <div class="item-row">
      <div class="item-row-ico">📰</div>
      <div class="item-row-info"><h4>${n.title}</h4><p>${n.category} · ${n.date}</p></div>
      <div class="item-row-actions">
        <button class="btn-edit" onclick="openModal('news',${i})">Edit</button>
        <button class="btn-del" onclick="deleteItem(D.news,${i});renderNewsPanel();renderPublicNews()">✕</button>
      </div>
    </div>`).join('');
}
function renderContactPanel() {
  const c = D.contact;
  setVal('ci-address', c.address); setVal('ci-phone', c.phone);
  setVal('ci-email', c.email); setVal('ci-website', c.website); setVal('ci-hours', c.hours);
}

// ===================== LIGHTBOX =====================
function openLightbox(url) { if (!url) return; document.getElementById('lightbox-img').src = url; document.getElementById('lightbox').classList.add('open'); }
function closeLightbox() { document.getElementById('lightbox').classList.remove('open'); }

// ===================== MOBILE NAV =====================
function toggleMobNav() {
  const btn = document.getElementById('mob-menu-btn');
  const drawer = document.getElementById('mob-nav-drawer');
  btn.classList.toggle('open');
  drawer.classList.toggle('open');
}
function closeMobNav() {
  document.getElementById('mob-menu-btn').classList.remove('open');
  document.getElementById('mob-nav-drawer').classList.remove('open');
}

// ===================== SUBMIT ENQUIRY (CONTACT PAGE) =====================
function submitForm(btn) {
  const parent = btn.closest('.ct-form') || btn.closest('section');
  const inputs = parent ? parent.querySelectorAll('input,select,textarea') : [];
  const name = (inputs[0] && inputs[0].value) || '';
  const phone = (inputs[1] && inputs[1].value) || '';
  const email = (inputs[2] && inputs[2].value) || '';
  const cls = (inputs[3] && inputs[3].value) || '';
  const admt = (inputs[4] && inputs[4].value) || '';
  const msg = (inputs[5] && inputs[5].value) || '';
  if (!name || !phone) { showToast('Please fill required fields', 'error'); return; }
  const enq = { id: 'ENQ-' + Date.now().toString().slice(-6), name, phone, email, cls, admt, msg, date: new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }), time: new Date().toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit' }), status: 'New', read: false, type: 'General Enquiry' };
  if (!D.enquiries) D.enquiries = [];
  D.enquiries.unshift(enq);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  updateInboxBadges();
  const ok = document.getElementById('form-ok');
  if (ok) { ok.style.display = 'block'; }
  btn.disabled = true;
  btn.textContent = '✅ Submitted';
  inputs.forEach(i => { i.value = ''; });
}

// ===================== ONLINE APPLICATION =====================
function generateToken() {
  return 'CSV-' + new Date().getFullYear() + '-' + Math.floor(1000 + Math.random() * 9000);
}
function submitApplication() {
  const sname = document.getElementById('af-sname').value.trim();
  const dob = document.getElementById('af-dob').value;
  const gender = document.getElementById('af-gender').value;
  const cls = document.getElementById('af-class').value;
  const type = document.getElementById('af-type').value;
  const fname = document.getElementById('af-fname').value.trim();
  const mname = document.getElementById('af-mname').value.trim();
  const phone = document.getElementById('af-phone').value.trim();
  const email = document.getElementById('af-email').value.trim();
  const address = document.getElementById('af-address').value.trim();
  if (!sname || !cls || !type || !fname || !phone || !address) {
    showToast('Please fill all required fields (*)', 'error'); return;
  }
  const token = generateToken();
  const app = {
    token, sname, dob, gender, cls, type, fname, mname, phone, email, address,
    prevschool: document.getElementById('af-prevschool').value,
    lastclass: document.getElementById('af-lastclass').value,
    occ: document.getElementById('af-occ').value,
    income: document.getElementById('af-income').value,
    source: document.getElementById('af-source').value,
    msg: document.getElementById('af-msg').value,
    status: 'Pending',
    date: new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }),
    time: new Date().toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit' }),
    read: false,
    timeline: [
      { label: 'Application Submitted', desc: 'Your application has been received.', done: true, date: new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }) },
      { label: 'Under Review', desc: 'Admissions team is reviewing your application.', done: false, date: '' },
      { label: 'Interaction Scheduled', desc: 'You will be called for interaction/assessment.', done: false, date: '' },
      { label: 'Decision', desc: 'Final admission decision communicated.', done: false, date: '' },
      { label: 'Enrollment', desc: 'Complete fee payment and enrollment formalities.', done: false, date: '' }
    ]
  };
  if (!D.applications) D.applications = [];
  D.applications.unshift(app);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  updateInboxBadges();
  document.getElementById('app-token-display').textContent = token;
  document.getElementById('apply-form-wrap').style.display = 'none';
  document.getElementById('apply-success-wrap').style.display = 'block';
  showToast('Application submitted! Token: ' + token, 'success');
}

// ===================== TRACK APPLICATION =====================
function trackApplication() {
  const raw = document.getElementById('track-token-input').value.trim().toUpperCase();
  if (!raw) { showToast('Please enter your token', 'error'); return; }
  if (!D.applications) D.applications = [];
  const app = D.applications.find(a => a.token === raw);
  document.getElementById('track-result').style.display = 'none';
  document.getElementById('track-notfound').style.display = 'none';
  if (!app) { document.getElementById('track-notfound').style.display = 'block'; return; }
  // Populate result
  setText('tr-name', app.sname + ' (' + app.cls + ')');
  setText('tr-token', 'Token: ' + app.token);
  setText('tr-class', app.cls);
  setText('tr-type', app.type);
  setText('tr-parent', app.fname + (app.mname ? ' & ' + app.mname : ''));
  setText('tr-date', app.date);
  const pill = document.getElementById('tr-status-pill');
  const statusClass = { Pending: 'pending', 'Under Review': 'review', Shortlisted: 'shortlisted', Rejected: 'rejected' };
  pill.textContent = app.status;
  pill.className = 'status-pill ' + (statusClass[app.status] || 'pending');
  // Timeline
  const tl = app.timeline || [];
  const tlHtml = tl.map((t, i) => {
    const isDone = t.done;
    const isActive = !isDone && (i === 0 || (tl[i - 1] && tl[i - 1].done));
    const cls = isDone ? 'done' : isActive ? 'active' : 'pending';
    return `<div class="tl-item">
      <div class="tl-dot ${cls}">${isDone ? '✓' : i + 1}</div>
      <div class="tl-item-info">
        <h5>${t.label}</h5>
        <p>${t.desc}${t.date ? ' · ' + t.date : ''}</p>
      </div>
    </div>`;
  }).join('');
  document.getElementById('tr-timeline').innerHTML = tlHtml;
  document.getElementById('track-result').style.display = 'block';
}

// ===================== ENQUIRY INBOX =====================
function renderEnquiriesPanel() {
  if (!D.enquiries) D.enquiries = [];
  const list = document.getElementById('enq-list-items');
  if (!list) return;
  const count = document.getElementById('enq-list-count');
  if (count) count.textContent = D.enquiries.length;
  if (!D.enquiries.length) {
    list.innerHTML = '<div style="padding:32px 20px;text-align:center;color:var(--light);font-size:13px;">No enquiries yet.</div>';
    return;
  }
  list.innerHTML = D.enquiries.map((e, i) => `
    <div class="inbox-item ${e.read ? '' : 'unread'}" onclick="openEnquiry(${i})" id="enq-item-${i}">
      <h5>${e.name}</h5>
      <p>${e.type || 'Enquiry'} · ${e.date}</p>
    </div>`).join('');
}
function openEnquiry(i) {
  if (!D.enquiries[i]) return;
  const e = D.enquiries[i];
  e.read = true;
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  updateInboxBadges();
  document.querySelectorAll('.inbox-item').forEach(el => el.classList.remove('active'));
  const item = document.getElementById('enq-item-' + i);
  if (item) { item.classList.add('active'); item.classList.remove('unread'); }
  const pane = document.getElementById('enq-detail-pane');
  if (!pane) return;
  pane.innerHTML = `
    <div class="inbox-detail-header">
      <div>
        <h3>${e.name}</h3>
        <p style="font-size:12px;color:var(--light);margin-top:3px;">Received ${e.date} at ${e.time || ''}</p>
      </div>
      <span class="enq-type-tag">${e.type || 'General'}</span>
    </div>
    <div class="inbox-detail-meta">
      <div class="inbox-meta-item"><span>Phone</span><strong>${e.phone || '—'}</strong></div>
      <div class="inbox-meta-item"><span>Email</span><strong>${e.email || '—'}</strong></div>
      <div class="inbox-meta-item"><span>Class Interested</span><strong>${e.cls || '—'}</strong></div>
      <div class="inbox-meta-item"><span>Admission Type</span><strong>${e.admt || '—'}</strong></div>
    </div>
    <div class="inbox-msg-box">${e.msg || '(No message provided)'}</div>
    <div class="inbox-actions">
      <select class="inbox-status-select" onchange="updateEnqStatus(${i},this.value)">
        <option ${e.status === 'New' ? 'selected' : ''}>New</option>
        <option ${e.status === 'In Progress' ? 'selected' : ''}>In Progress</option>
        <option ${e.status === 'Resolved' ? 'selected' : ''}>Resolved</option>
      </select>
      <button class="btn-del" onclick="deleteEnquiry(${i})">🗑 Delete</button>
    </div>`;
}
function updateEnqStatus(i, val) {
  if (!D.enquiries[i]) return;
  D.enquiries[i].status = val;
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  showToast('Status updated');
}
function deleteEnquiry(i) {
  D.enquiries.splice(i, 1);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  renderEnquiriesPanel();
  document.getElementById('enq-detail-pane').innerHTML = '<div class="inbox-empty-state"><span>📭</span><p>Select an enquiry to view</p></div>';
  showToast('Deleted');
}

// ===================== APPLICATIONS PANEL =====================
function renderApplicationsPanel() {
  if (!D.applications) D.applications = [];
  const filter = (document.getElementById('app-filter')?.value) || 'all';
  const apps = filter === 'all' ? D.applications : D.applications.filter(a => a.status === filter);
  const list = document.getElementById('app-list');
  if (!list) return;
  if (!apps.length) {
    list.innerHTML = '<div style="text-align:center;padding:40px;color:var(--light);font-size:13.5px;">No applications ' + (filter === 'all' ? 'yet' : 'with status "' + filter + '"') + '.</div>';
    return;
  }
  const statusColor = { Pending: '#fef9ec;color:#92400e', 'Under Review': '#eff6ff;color:#1d4ed8', Shortlisted: '#f0fdf4;color:#166534', Rejected: '#fef2f2;color:#991b1b' };
  list.innerHTML = apps.map((a, _i) => {
    const i = D.applications.indexOf(a);
    const sc = statusColor[a.status] || statusColor['Pending'];
    return `<div class="item-row" style="margin-bottom:12px;">
      <div class="item-row-ico">📝</div>
      <div class="item-row-info">
        <h4>${a.sname} <span style="font-size:11px;font-weight:400;color:var(--light);">· ${a.token}</span></h4>
        <p>Class ${a.cls} · ${a.type} · ${a.fname} · ${a.phone} · ${a.date}</p>
      </div>
      <div style="display:flex;gap:8px;align-items:center;flex-shrink:0;">
        <span style="background:${sc};padding:3px 11px;border-radius:100px;font-size:11px;font-weight:700;">${a.status}</span>
        <select onchange="updateAppStatus(${i},this.value)" style="border:1.5px solid var(--border);border-radius:7px;padding:5px 9px;font-size:12px;font-family:'DM Sans',sans-serif;outline:none;cursor:pointer;">
          <option ${a.status === 'Pending' ? 'selected' : ''}>Pending</option>
          <option ${a.status === 'Under Review' ? 'selected' : ''}>Under Review</option>
          <option ${a.status === 'Shortlisted' ? 'selected' : ''}>Shortlisted</option>
          <option ${a.status === 'Rejected' ? 'selected' : ''}>Rejected</option>
        </select>
        <button class="btn-edit" onclick="viewAppDetail(${i})">View</button>
        <button class="btn-del" onclick="deleteApplication(${i})">✕</button>
      </div>
    </div>`;
  }).join('');
}
function updateAppStatus(i, val) {
  if (!D.applications[i]) return;
  D.applications[i].status = val;
  // Update timeline
  const tl = D.applications[i].timeline;
  if (tl) {
    if (val === 'Under Review' && tl[1]) { tl[1].done = true; tl[1].date = new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }); }
    if (val === 'Shortlisted' && tl[2]) { tl[1].done = true; tl[2].done = true; tl[2].date = new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }); }
  }
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  renderApplicationsPanel();
  showToast('Status updated to: ' + val);
}
function deleteApplication(i) {
  D.applications.splice(i, 1);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  renderApplicationsPanel();
  updateInboxBadges();
  showToast('Application deleted');
}
function viewAppDetail(i) {
  const a = D.applications[i];
  if (!a) return;
  const mc = document.getElementById('modal-content');
  mc.innerHTML = `<h3>📋 Application — ${a.token}</h3>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:18px;">
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Student</span><br><strong>${a.sname}</strong></div>
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Class / Type</span><br><strong>${a.cls} · ${a.type}</strong></div>
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Father</span><br><strong>${a.fname}</strong></div>
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Mother</span><br><strong>${a.mname || '—'}</strong></div>
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Phone</span><br><strong>${a.phone}</strong></div>
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Email</span><br><strong>${a.email || '—'}</strong></div>
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Date of Birth</span><br><strong>${a.dob || '—'}</strong></div>
    <div><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Applied On</span><br><strong>${a.date}</strong></div>
    <div style="grid-column:1/-1;"><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Address</span><br><strong>${a.address}</strong></div>
    <div style="grid-column:1/-1;"><span style="font-size:11px;color:var(--light);text-transform:uppercase;letter-spacing:.7px;">Message</span><br><span style="font-size:13px;color:var(--mid);">${a.msg || '—'}</span></div>
  </div>
  <div class="modal-footer"><button class="btn-cancel" onclick="closeModal()">Close</button></div>`;
  document.getElementById('modal-bg').classList.add('open');
}

// ===================== INBOX BADGES =====================
function updateInboxBadges() {
  if (!D.enquiries) D.enquiries = [];
  if (!D.applications) D.applications = [];
  const unreadEnq = D.enquiries.filter(e => !e.read).length;
  const enqBadge = document.getElementById('enq-badge');
  if (enqBadge) { if (unreadEnq > 0) { enqBadge.textContent = unreadEnq; enqBadge.style.display = 'inline'; } else { enqBadge.style.display = 'none'; } }
  const totalApps = D.applications.length;
  const appBadge = document.getElementById('app-badge');
  if (appBadge) { if (totalApps > 0) { appBadge.textContent = totalApps; appBadge.style.display = 'inline'; } else { appBadge.style.display = 'none'; } }
}

// ===================== FLOATING BUTTONS =====================
function openWhatsApp() {
  const phone = (D.contact.phone || '').replace(/\D/g, '');
  const msg = encodeURIComponent('Hello! I am interested in admission at Colonel\'s Sainik Vidyalaya. Please share more details.');
  const url = phone && phone.length >= 10
    ? `https://wa.me/${phone.startsWith('91') ? phone : '91' + phone}?text=${msg}`
    : `https://wa.me/?text=${msg}`;
  window.open(url, '_blank');
}
function callSchool() {
  const phone = (D.contact.phone || '').replace(/\D/g, '');
  if (phone && phone.length >= 10) { window.location.href = 'tel:+' + (phone.startsWith('91') ? phone : '91' + phone); }
  else { showToast('Phone number not configured yet', 'error'); }
}

// ===================== AI CHATBOT =====================
let chatOpen = false;
let chatHistory = [];
let chatTyping = false;

// School context injected into every AI call
function buildSystemPrompt() {
  const s = D.school || {};
  const c = D.contact || {};
  const cats = (D.admCats || []).map(a => a.name).join(', ');
  const programs = (D.levels || []).map(l => l.name + ' (' + l.range + ')').join('; ');
  const facilities = (D.facilities || []).map(f => f.name).join(', ');
  const cocu = (D.cocu || []).map(x => x.name).join(', ');
  return `You are a friendly, knowledgeable admissions assistant for ${s.name || "Colonel's Sainik Vidyalaya"}, a CBSE school in Madhepura, Bihar, India. The school motto is "${s.tagline || 'Cradle For Excellence'}". You help parents and students with questions about admissions, academics, facilities, fees, and school life.

Key facts:
- Founded: ${s.est || '2026'} by ${s.founder || 'Dr. Anamika Kumar (W/o Col. Shishir Kumar)'}
- Affiliation: ${s.affil || 'CBSE Board'}
- Total seats: ${s.seats || '500+'}
- Address: ${c.address || 'Madhepura, Bihar, India'}
- Phone/WhatsApp: ${c.phone || '+91 XXXXX XXXXX'}
- Email: ${c.email || 'info@colonelssainikvidyalaya.in'}
- Office hours: ${c.hours || 'Monday to Saturday, 9:00 AM – 4:00 PM'}
- Admission types available: Day Scholar, Day Boarder, Full Boarder
- Admission categories: ${cats || 'Pre-Primary, Primary, Upper Primary'}
- Academic programs: ${programs || 'Nursery to Class VIII'}
- Facilities: ${facilities || 'Smart Classrooms, Library, Sports Ground, Hostel'}
- Co-curricular activities: ${cocu || 'NCC, Music, Sports, Arts, Debate'}
- Current admission session: ${D.admSession || '2026-27'}
- Important: The school blends Sainik (military) discipline with modern CBSE education

Tone: Warm, helpful, professional. Keep answers concise (2-4 sentences). If asked about fees, say fees vary by program and admission type and suggest calling or visiting. Always end with an encouraging note and offer to help with anything else. If you don't know something specific, say to contact the school directly. Do not make up specific fee amounts.`;
}

function toggleChat() {
  chatOpen = !chatOpen;
  const win = document.getElementById('chatbot-window');
  if (chatOpen) {
    win.classList.add('open');
    if (chatHistory.length === 0) initChat();
    setTimeout(() => document.getElementById('chat-input')?.focus(), 350);
  } else {
    win.classList.remove('open');
  }
}

function initChat() {
  const msgs = document.getElementById('chat-messages');
  if (!msgs) return;
  msgs.innerHTML = '';
  addBotMessage(`Namaste! 🙏 I'm the **CSV Assistant** for **${D.school?.name || "Colonel's Sainik Vidyalaya"}**.\n\nHow can I help you today? You can ask me about admissions, classes, facilities, hostel, or anything else about our school!`);
}

function addBotMessage(text) {
  const msgs = document.getElementById('chat-messages');
  if (!msgs) return;
  // Remove typing indicator if present
  const typing = msgs.querySelector('.chat-typing');
  if (typing) typing.remove();
  const div = document.createElement('div');
  div.className = 'chat-msg bot';
  // Bold markdown **text**
  div.innerHTML = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\n/g, '<br>');
  msgs.appendChild(div);
  msgs.scrollTop = msgs.scrollHeight;
  chatHistory.push({ role: 'assistant', content: text.replace(/\*\*(.*?)\*\*/g, '$1') });
}

function addUserMessage(text) {
  const msgs = document.getElementById('chat-messages');
  if (!msgs) return;
  const div = document.createElement('div');
  div.className = 'chat-msg user';
  div.textContent = text;
  msgs.appendChild(div);
  msgs.scrollTop = msgs.scrollHeight;
  chatHistory.push({ role: 'user', content: text });
}

function showTyping() {
  const msgs = document.getElementById('chat-messages');
  if (!msgs) return;
  const div = document.createElement('div');
  div.className = 'chat-typing';
  div.innerHTML = '<span></span><span></span><span></span>';
  msgs.appendChild(div);
  msgs.scrollTop = msgs.scrollHeight;
}

async function sendChatMessage() {
  const input = document.getElementById('chat-input');
  const text = input?.value?.trim();
  if (!text || chatTyping) return;
  input.value = '';
  // Hide quick buttons after first interaction
  const qbtns = document.getElementById('chat-quick-btns');
  if (qbtns) qbtns.style.display = 'none';
  addUserMessage(text);
  await getAIResponse(text);
}

function sendQuick(text) {
  const input = document.getElementById('chat-input');
  if (input) input.value = '';
  const qbtns = document.getElementById('chat-quick-btns');
  if (qbtns) qbtns.style.display = 'none';
  addUserMessage(text);
  getAIResponse(text);
}

async function getAIResponse(userMsg) {
  if (chatTyping) return;
  chatTyping = true;
  showTyping();
  // Build messages array for API (last 10 turns for context)
  const recentHistory = chatHistory.slice(-10);
  // Make sure last message is the user's current one
  const messages = [...recentHistory];
  try {
    const resp = await fetch('https://api.anthropic.com/v1/messages', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        model: 'claude-sonnet-4-20250514',
        max_tokens: 400,
        system: buildSystemPrompt(),
        messages: messages.map(m => ({ role: m.role, content: m.content }))
      })
    });
    const data = await resp.json();
    const reply = (data.content && data.content[0] && data.content[0].text) || "I'm sorry, I couldn't process that. Please try again or contact us directly.";
    addBotMessage(reply);
  } catch (err) {
    // Fallback to rule-based if API fails
    const msgs = document.getElementById('chat-messages');
    const typing = msgs?.querySelector('.chat-typing');
    if (typing) typing.remove();
    const reply = getFallbackResponse(userMsg);
    addBotMessage(reply);
  }
  chatTyping = false;
}

// Rule-based fallback (no API needed)
function getFallbackResponse(msg) {
  const m = msg.toLowerCase();
  const s = D.school || {};
  const c = D.contact || {};
  if (m.includes('fee') || m.includes('cost') || m.includes('charge') || m.includes('price')) {
    return `Fees at ${s.name || 'our school'} vary based on the program (Day Scholar, Day Boarder, or Full Boarder) and class. For the exact fee structure, please **call us at ${c.phone || '+91 XXXXX XXXXX'}** or visit the campus. We'll be happy to share full details!`;
  }
  if (m.includes('apply') || m.includes('admission') || m.includes('enroll')) {
    return `You can apply online by clicking **"Apply"** in the navigation menu! Fill in the student and parent details, submit, and you'll receive a unique token to track your application. Admissions are currently open for the **${D.admSession || '2026-27'}** session. 🎓`;
  }
  if (m.includes('class') || m.includes('grade') || m.includes('standard')) {
    const levels = (D.levels || []).map(l => l.name).join(', ') || 'Nursery to Class VIII';
    return `We offer classes from **Nursery to Class VIII** under the CBSE curriculum. Programs include: ${levels}. Each level has a dedicated, experienced faculty team. Would you like to know more about a specific class?`;
  }
  if (m.includes('hostel') || m.includes('boarding') || m.includes('board')) {
    return `${s.name || 'Our school'} offers **Full Boarder** and **Day Boarder** options alongside Day Scholar. The hostel provides a safe, disciplined residential environment with meals, supervision, and activities. For hostel availability and charges, please contact us at **${c.phone || '+91 XXXXX XXXXX'}**.`;
  }
  if (m.includes('facilit') || m.includes('infrastruc') || m.includes('lab') || m.includes('sport')) {
    const fac = (D.facilities || []).map(f => f.name).join(', ') || 'Smart Classrooms, Library, Sports Ground, Science Labs';
    return `Our campus features world-class facilities including: **${fac}**. Every facility is designed to support holistic development — academics, sports, arts, and character building. 🏛️`;
  }
  if (m.includes('contact') || m.includes('address') || m.includes('phone') || m.includes('email') || m.includes('location')) {
    return `You can reach us at:\n📍 **${c.address || 'Madhepura, Bihar, India'}**\n📞 **${c.phone || '+91 XXXXX XXXXX'}**\n📧 **${c.email || 'info@colonelssainikvidyalaya.in'}**\n🕐 ${c.hours || 'Monday to Saturday, 9AM – 4PM'}`;
  }
  if (m.includes('cbse') || m.includes('curriculum') || m.includes('board')) {
    return `${s.name || 'Colonel\'s Sainik Vidyalaya'} follows the **CBSE curriculum** — India's most recognised national board. This ensures students are well-prepared for competitive exams and have opportunities across the country. 📚`;
  }
  if (m.includes('transport') || m.includes('bus') || m.includes('pickup')) {
    return `For transport and bus route details, please contact our office directly at **${c.phone || '+91 XXXXX XXXXX'}**. Our staff will share the available routes and timings for your area.`;
  }
  return `Thank you for your question! For the most accurate information, please **call us at ${c.phone || '+91 XXXXX XXXXX'}** or **visit our campus** — our admissions team will be happy to help. You can also use the **Contact Us** page to send an enquiry. Is there anything else I can help with? 😊`;
}

// ===================== SCROLL REVEAL =====================
function initReveal() {
  const els = document.querySelectorAll('.reveal');
  if (!els.length) return;
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.12 });
  els.forEach(el => obs.observe(el));
}

// ===================== HOME PAGE RENDER EXTRAS =====================
function renderHomeAdmDates() {
  const el = document.getElementById('home-adm-dates');
  if (!el) return;
  const dates = D.admDates && D.admDates.length ? D.admDates : [
    { label: 'Application Opens', value: 'April 2026' },
    { label: 'Last Date to Apply', value: D.admLastDate || 'May 31, 2026' },
    { label: 'Campus Interaction', value: 'June 2026' },
    { label: 'Result Declaration', value: 'June 15, 2026' },
    { label: 'Session Begins', value: 'July 1, 2026' }
  ];
  el.innerHTML = dates.slice(0, 5).map(d => `<div class="adm-date-row"><span>${d.label}</span><strong>${d.value}</strong></div>`).join('');
}
function renderFounderInfo() {
  const s = D.school || {};
  const fn = document.getElementById('founder-badge-name');
  const fs = document.getElementById('founder-sig-name');
  if (fn) fn.textContent = s.founder || 'Dr. Anamika Kumar';
  if (fs) fs.textContent = s.founder || 'Dr. Anamika Kumar';
}
function renderHomeSeats() {
  const el = document.getElementById('cnt-seats');
  if (el) el.textContent = (D.school && D.school.seats) ? D.school.seats : '500+';
}

// ===================== MODAL SYSTEM =====================
function openModal(type, idx) {
  const mc = document.getElementById('modal-content');
  if (!mc) return;
  let html = '';
  if (type === 'acad-level') {
    const item = idx !== undefined ? D.levels[idx] : { name: '', range: '', subjects: '' };
    html = `<h3>${idx !== undefined ? 'Edit' : 'Add'} Program Level</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Level Name</label><input id="m-name" value="${item.name || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Class Range</label><input id="m-range" value="${item.range || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Subjects (one per line)</label><textarea id="m-subjects" rows="6">${item.subjects || ''}</textarea></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('acad-level',${idx})">Save</button>
    </div>`;
  } else if (type === 'cocu') {
    const item = idx !== undefined ? D.cocu[idx] : { ico: '🎯', name: '' };
    html = `<h3>${idx !== undefined ? 'Edit' : 'Add'} Activity</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Icon (emoji)</label><input id="m-ico" value="${item.ico || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Activity Name</label><input id="m-name" value="${item.name || ''}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('cocu',${idx})">Save</button>
    </div>`;
  } else if (type === 'facility') {
    const item = idx !== undefined ? D.facilities[idx] : { ico: '🏛️', name: '', desc: '', tags: '' };
    html = `<h3>${idx !== undefined ? 'Edit' : 'Add'} Facility</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Icon</label><input id="m-ico" value="${item.ico || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Name</label><input id="m-name" value="${item.name || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Description</label><textarea id="m-desc">${item.desc || ''}</textarea></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Tags (comma separated)</label><input id="m-tags" value="${item.tags || ''}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('facility',${idx})">Save</button>
    </div>`;
  } else if (type === 'notice') {
    const item = idx !== undefined ? D.notices[idx] : { ico: '📢', type: 'info', title: '', desc: '', date: '' };
    html = `<h3>${idx !== undefined ? 'Edit' : 'Add'} Notice</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Icon</label><input id="m-ico" value="${item.ico || '📢'}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Type</label>
      <select id="m-type"><option value="info" ${item.type === 'info' ? 'selected' : ''}>Info</option><option value="urgent" ${item.type === 'urgent' ? 'selected' : ''}>Urgent</option><option value="event" ${item.type === 'event' ? 'selected' : ''}>Event</option></select></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Title</label><input id="m-name" value="${item.title || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Description</label><textarea id="m-desc">${item.desc || ''}</textarea></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Date</label><input id="m-date" value="${item.date || ''}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('notice',${idx})">Save</button>
    </div>`;
  } else if (type === 'news') {
    const item = idx !== undefined ? D.news[idx] : { title: '', category: '', desc: '', date: '' };
    html = `<h3>${idx !== undefined ? 'Edit' : 'Add'} News Item</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Title</label><input id="m-name" value="${item.title || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Category</label><input id="m-cat" value="${item.category || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Description</label><textarea id="m-desc">${item.desc || ''}</textarea></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Date</label><input id="m-date" value="${item.date || ''}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('news',${idx})">Save</button>
    </div>`;
  } else if (type === 'adm-date') {
    const item = idx !== undefined ? D.admDates[idx] : { label: '', value: '' };
    html = `<h3>${idx !== undefined ? 'Edit' : 'Add'} Important Date</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Label</label><input id="m-name" value="${item.label || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Date / Value</label><input id="m-date" value="${item.value || ''}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('adm-date',${idx})">Save</button>
    </div>`;
  } else if (type === 'adm-doc') {
    const item = idx !== undefined ? D.admDocs[idx] : { doc: '', req: '' };
    html = `<h3>${idx !== undefined ? 'Edit' : 'Add'} Required Document</h3>
    <div class="form-group" style="margin-bottom:14px;"><label>Document Name</label><input id="m-name" value="${item.doc || ''}"></div>
    <div class="form-group" style="margin-bottom:14px;"><label>Required / Optional</label><input id="m-req" value="${item.req || 'Required'}"></div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="saveModal('adm-doc',${idx})">Save</button>
    </div>`;
  }
  mc.innerHTML = html;
  document.getElementById('modal-bg').classList.add('open');
}

function closeModal() {
  document.getElementById('modal-bg').classList.remove('open');
}

function v(id) { const el = document.getElementById(id); return el ? el.value.trim() : ''; }

function saveModal(type, idx) {
  if (type === 'acad-level') {
    const item = { name: v('m-name'), range: v('m-range'), subjects: document.getElementById('m-subjects')?.value || '' };
    if (idx !== undefined) D.levels[idx] = item; else D.levels.push(item);
    renderAcademicsPanel(); renderPublicAcademics();
  } else if (type === 'cocu') {
    const item = { ico: v('m-ico'), name: v('m-name') };
    if (idx !== undefined) D.cocu[idx] = item; else D.cocu.push(item);
    renderAcademicsPanel(); renderPublicAcademics();
  } else if (type === 'facility') {
    const item = { ico: v('m-ico'), name: v('m-name'), desc: v('m-desc'), tags: v('m-tags') };
    if (idx !== undefined) D.facilities[idx] = item; else D.facilities.push(item);
    renderFacilitiesPanel(); renderPublicFacilities();
  } else if (type === 'notice') {
    const item = { ico: v('m-ico'), type: v('m-type'), title: v('m-name'), desc: v('m-desc'), date: v('m-date') };
    if (idx !== undefined) D.notices[idx] = item; else D.notices.push(item);
    renderNoticesPanel(); renderPublicNotices();
  } else if (type === 'news') {
    const item = { title: v('m-name'), category: v('m-cat'), desc: v('m-desc'), date: v('m-date') };
    if (idx !== undefined) D.news[idx] = item; else D.news.push(item);
    renderNewsPanel(); renderPublicNews();
  } else if (type === 'adm-date') {
    const item = { label: v('m-name'), value: v('m-date') };
    if (idx !== undefined) D.admDates[idx] = item; else D.admDates.push(item);
    renderAdmissionsPanel();
  } else if (type === 'adm-doc') {
    const item = { doc: v('m-name'), req: v('m-req') };
    if (idx !== undefined) D.admDocs[idx] = item; else D.admDocs.push(item);
    renderAdmissionsPanel();
  }
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  closeModal();
  showToast('Saved successfully!');
}

function deleteItem(arr, idx) {
  arr.splice(idx, 1);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  showToast('Deleted');
}

// ===================== GALLERY ADD =====================
function addGalleryItem() {
  const url = document.getElementById('gal-url')?.value.trim();
  const cap = document.getElementById('gal-cap')?.value.trim() || 'Gallery Image';
  const cat = document.getElementById('gal-cat')?.value || 'Campus';
  if (!url) { showToast('Please enter an image URL', 'error'); return; }
  D.gallery.push({ url, caption: cap, cat });
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  document.getElementById('gal-url').value = '';
  document.getElementById('gal-cap').value = '';
  renderGalleryPanel();
  renderPublicGallery();
  showToast('Image added!');
}

// ===================== TICKER ADD =====================
function addTickerItem() {
  const val = document.getElementById('new-ticker')?.value.trim();
  if (!val) { showToast('Please enter a message', 'error'); return; }
  D.ticker.push(val);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  document.getElementById('new-ticker').value = '';
  renderSchoolInfoPanel();
  renderPublicTicker();
  showToast('Ticker message added!');
}

// ===================== SAVE ALL =====================
function saveAll() {
  // School info
  const si = document.getElementById('si-name');
  if (si) {
    D.school.name = v('si-name') || D.school.name;
    D.school.tagline = v('si-tagline') || D.school.tagline;
    D.school.desc = document.getElementById('si-desc')?.value.trim() || D.school.desc;
    D.school.est = v('si-est') || D.school.est;
    D.school.seats = v('si-seats') || D.school.seats;
    D.school.founder = v('si-founder') || D.school.founder;
    D.school.affil = v('si-affil') || D.school.affil;
    D.school.heroImg = v('si-hero-img') || 'assets/images/school_image.png';
  }
  // Admissions
  D.admSession = v('adm-session') || D.admSession;
  D.admLastDate = v('adm-lastdate') || D.admLastDate;
  // Contact
  const ci = document.getElementById('ci-address');
  if (ci) {
    D.contact.address = v('ci-address') || D.contact.address;
    D.contact.phone = v('ci-phone') || D.contact.phone;
    D.contact.email = v('ci-email') || D.contact.email;
    D.contact.website = v('ci-website') || D.contact.website;
    D.contact.hours = v('ci-hours') || D.contact.hours;
  }
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  renderPublic();
  const ind = document.getElementById('save-indicator');
  if (ind) { ind.textContent = '✅ All changes saved'; ind.style.color = 'var(--green)'; }
  showToast('✅ All changes saved!');
}

// ===================== SHOW TOAST =====================
function showToast(msg, type) {
  const t = document.getElementById('toast');
  const tm = document.getElementById('toast-msg');
  if (!t || !tm) return;
  tm.textContent = msg;
  t.style.background = type === 'error' ? '#dc2626' : '#16a34a';
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3000);
}

// ===================== APPLICATIONS DETAIL VIEW =====================
function viewAppDetail(i) {
  const app = D.applications[i];
  if (!app) return;
  app.read = true;
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  const mc = document.getElementById('modal-content');
  if (!mc) return;
  mc.innerHTML = `
    <div style="max-width:560px;">
      <h3 style="font-family:'Cinzel',serif;color:var(--navy);margin-bottom:4px;">${app.sname}</h3>
      <p style="font-size:12px;color:var(--light);margin-bottom:20px;">Token: ${app.token} · Submitted ${app.date}</p>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px;">
        <div style="background:var(--off);border-radius:8px;padding:12px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;">Class</div><div style="font-weight:700;color:var(--navy);">${app.cls}</div></div>
        <div style="background:var(--off);border-radius:8px;padding:12px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;">Type</div><div style="font-weight:700;color:var(--navy);">${app.type}</div></div>
        <div style="background:var(--off);border-radius:8px;padding:12px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;">Father</div><div style="font-weight:700;color:var(--navy);">${app.fname}</div></div>
        <div style="background:var(--off);border-radius:8px;padding:12px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;">Mother</div><div style="font-weight:700;color:var(--navy);">${app.mname || '—'}</div></div>
        <div style="background:var(--off);border-radius:8px;padding:12px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;">Phone</div><div style="font-weight:700;color:var(--navy);">${app.phone}</div></div>
        <div style="background:var(--off);border-radius:8px;padding:12px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;">Email</div><div style="font-weight:700;color:var(--navy);">${app.email || '—'}</div></div>
      </div>
      <div style="background:var(--off);border-radius:8px;padding:12px;margin-bottom:16px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Address</div><div style="font-size:13.5px;color:var(--mid);">${app.address}</div></div>
      ${app.msg ? `<div style="background:var(--off);border-radius:8px;padding:12px;margin-bottom:16px;"><div style="font-size:10px;color:var(--light);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Message</div><div style="font-size:13.5px;color:var(--mid);">${app.msg}</div></div>` : ''}
      <div class="modal-footer"><button class="btn-cancel" onclick="closeModal()">Close</button></div>
    </div>`;
  document.getElementById('modal-bg').classList.add('open');
}

function updateAppStatus(i, val) {
  if (!D.applications[i]) return;
  D.applications[i].status = val;
  if (D.applications[i].timeline) {
    const tl = D.applications[i].timeline;
    if (val === 'Under Review' && tl[1]) { tl[1].done = true; tl[1].date = new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }); }
    if (val === 'Shortlisted' && tl[2]) { tl[2].done = true; tl[2].date = new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' }); }
  }
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  showToast('Status updated');
  updateInboxBadges();
}

function deleteApplication(i) {
  if (!confirm('Delete this application?')) return;
  D.applications.splice(i, 1);
  localStorage.setItem('csv_cms_data', JSON.stringify(D));
  renderApplicationsPanel();
  showToast('Application deleted');
}

// ===================== INIT =====================
document.addEventListener('DOMContentLoaded', function () {
  // Load saved data or use defaults
  try {
    const saved = localStorage.getItem('csv_cms_data');
    if (saved) { const parsed = JSON.parse(saved); Object.assign(D, parsed); }
  } catch (e) { console.warn('Could not load saved data:', e); }

  // Start on public view
  const publicView = document.getElementById('public-view');
  const adminView = document.getElementById('admin-view');
  if (publicView) publicView.classList.add('active');
  if (adminView) adminView.classList.remove('active');

  renderPublic();
  initReveal();
  initChat();
});