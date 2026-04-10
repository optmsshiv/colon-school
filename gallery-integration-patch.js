/**
 * ═══════════════════════════════════════════════════════════════
 *  GALLERY INTEGRATION PATCH — Colonel's Sainik Vidyalaya
 *  File: gallery-integration-patch.js
 *
 *  ADD THIS to your existing main.js (or include as a separate
 *  <script> tag AFTER main.js in index.html).
 *
 *  This replaces the localStorage-based gallery rendering with
 *  live data fetched from the MySQL database via gallery-api.php.
 * ═══════════════════════════════════════════════════════════════
 */

/**
 * Fetch gallery images from the DB API and render the public gallery.
 * Replaces the existing renderPublicGallery() function.
 */
async function renderPublicGallery() {
  const grid = document.getElementById('pub-gallery-grid');
  if (!grid) return;

  // Show loading state
  grid.innerHTML = `
    <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#64748b;">
      <div style="font-size:32px;margin-bottom:12px;">⏳</div>
      <p>Loading gallery…</p>
    </div>`;

  try {
    const res  = await fetch('/gallery-api.php');
    const data = await res.json();

    if (!data.success || !data.images.length) {
      grid.innerHTML = `
        <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#64748b;">
          <div style="font-size:42px;margin-bottom:14px;">🖼️</div>
          <p>No gallery images yet.</p>
        </div>`;
      return;
    }

    // Group by category
    const byCategory = {};
    data.images.forEach(img => {
      if (!byCategory[img.cat]) byCategory[img.cat] = [];
      byCategory[img.cat].push(img);
    });

    let html = '';

    // Category filter tabs (optional UI)
    const cats = Object.keys(byCategory);
    if (cats.length > 1) {
      html += `<div style="grid-column:1/-1;display:flex;gap:10px;flex-wrap:wrap;margin-bottom:8px;">
        <button class="gal-filter-btn active" onclick="filterGallery('all',this)" style="padding:7px 18px;border-radius:20px;border:none;background:#0f2057;color:#fff;font-size:13px;font-weight:600;cursor:pointer;">All</button>`;
      cats.forEach(cat => {
        html += `<button class="gal-filter-btn" onclick="filterGallery('${cat}',this)"
          style="padding:7px 18px;border-radius:20px;border:1.5px solid #c7d2e7;background:#fff;color:#0f2057;font-size:13px;font-weight:600;cursor:pointer;">${cat}</button>`;
      });
      html += '</div>';
    }

    // Render all images
    data.images.forEach(img => {
      html += `
        <div class="gallery-item" data-cat="${img.cat}" onclick="openLightbox('${img.url}')">
          <img src="${img.thumb}"
               alt="${img.caption}"
               loading="lazy"
               onerror="this.src='${img.url}'"
               style="width:100%;height:220px;object-fit:cover;display:block;">
          <div class="gallery-overlay">
            <span class="gallery-caption">${img.caption}</span>
          </div>
        </div>`;
    });

    grid.innerHTML = html;

  } catch (err) {
    console.error('Gallery load error:', err);
    grid.innerHTML = `
      <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#dc2626;">
        <p>⚠️ Could not load gallery. Please try again.</p>
      </div>`;
  }
}

/** Filter gallery by category (client-side, no refetch) */
function filterGallery(cat, btn) {
  const items = document.querySelectorAll('#pub-gallery-grid .gallery-item');
  items.forEach(item => {
    item.style.display = (cat === 'all' || item.dataset.cat === cat) ? '' : 'none';
  });
  // Update active tab style
  document.querySelectorAll('.gal-filter-btn').forEach(b => {
    b.style.background = '#fff';
    b.style.color = '#0f2057';
    b.style.border = '1.5px solid #c7d2e7';
  });
  if (btn) {
    btn.style.background = '#0f2057';
    btn.style.color = '#fff';
    btn.style.border = 'none';
  }
}

// Auto-run when gallery page is shown
// If your goPage() function exists, hook into it:
const _origGoPage = typeof goPage === 'function' ? goPage : null;
if (_origGoPage) {
  window.goPage = function(page, ...args) {
    _origGoPage(page, ...args);
    if (page === 'gallery') {
      // Small delay to ensure DOM is ready
      setTimeout(renderPublicGallery, 50);
    }
  };
}
