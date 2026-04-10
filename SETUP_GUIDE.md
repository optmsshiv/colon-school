# Gallery Admin Panel — Setup Guide
# Colonel's Sainik Vidyalaya · OPTMS Tech

## 📁 Files in this package

```
gallery-admin/
├── gallery_db_setup.sql          ← Run this in phpMyAdmin first
├── gallery-api.php               ← Copy to site root (next to index.html)
├── gallery-integration-patch.js ← Add to index.html (after main.js)
└── admin/
    ├── index.php                 ← Main gallery dashboard
    ├── login.php                 ← Admin login page
    ├── logout.php                ← Logout handler
    ├── actions.php               ← AJAX handler (upload/edit/delete)
    ├── uploads/
    │   ├── .htaccess             ← Security: blocks PHP in uploads
    │   └── gallery/              ← Images stored here (auto-created)
    └── includes/
        └── config.php            ← ⚠️ Edit DB credentials here
```

---

## 🚀 STEP 1 — Create MySQL Database (phpMyAdmin)

1. Open **phpMyAdmin** on your cPanel
2. Create a new database: e.g. `csv_school`
3. Create a DB user and grant ALL PRIVILEGES on that database
4. Go to the **SQL** tab and paste + run `gallery_db_setup.sql`
5. You should see tables: `gallery_images`, `admin_users`, `gallery_categories`

---

## ⚙️ STEP 2 — Configure Database Credentials

Open `admin/includes/config.php` and update:

```php
define('DB_HOST',   'localhost');
define('DB_USER',   'your_cpanel_db_user');    // e.g. mysite_csvadmin
define('DB_PASS',   'your_db_password');
define('DB_NAME',   'csv_school');             // must match what you created
```

Also update:
```php
define('SITE_URL', 'https://www.colonelssainikvidyalaya.in');
```

---

## 📂 STEP 3 — Upload Files via cPanel File Manager

Upload these to your `public_html/` directory:

```
public_html/
├── index.html          ← Already exists (your school website)
├── main.js             ← Already exists
├── main.css            ← Already exists
├── gallery-api.php     ← NEW: upload this
├── gallery-integration-patch.js  ← NEW: upload this
└── admin/
    ├── index.php
    ├── login.php
    ├── logout.php
    ├── actions.php
    ├── uploads/
    │   └── .htaccess   ← Important security file
    └── includes/
        └── config.php
```

---

## 🔐 STEP 4 — Set Folder Permissions

In cPanel File Manager, set permissions:
- `admin/uploads/` → **755**
- `admin/uploads/gallery/` → **755** (auto-created on first upload)

---

## 📝 STEP 5 — Connect Gallery to Website

Add this ONE line to your `index.html`, just before `</body>`:

```html
<script src="gallery-integration-patch.js"></script>
```

So the bottom of index.html looks like:
```html
  <script src="assets/js/main.js"></script>
  <script src="gallery-integration-patch.js"></script>    ← ADD THIS
</body>
```

---

## 🔑 STEP 6 — First Login

1. Visit: `https://yoursite.in/admin/login.php`
2. Login with:
   - Username: `admin`
   - Password: `Admin@CSV2026`
3. **Change the password immediately** (via phpMyAdmin → admin_users table → update password_hash)

To generate a new password hash, run this PHP anywhere:
```php
echo password_hash('YourNewPassword', PASSWORD_BCRYPT);
```
Then update the `password_hash` column in phpMyAdmin.

---

## 🎓 How to Upload Gallery Images

1. Go to `yoursite.in/admin/`
2. Drag & drop images onto the upload zone (or click to browse)
3. Set: Caption · Category · Sort Order
4. Click **Upload Images**
5. Images appear in the public gallery instantly!

---

## 📋 Features

✅ Drag & drop multi-image upload  
✅ Auto thumbnail generation (GD)  
✅ Caption, category, sort order per image  
✅ Show/Hide images without deleting  
✅ Bulk delete / show / hide  
✅ Edit any image's details  
✅ Category filter on admin and public gallery  
✅ Pagination (20 per page)  
✅ Secure: session auth, MIME validation, no PHP in uploads  
✅ Public API endpoint for live gallery on website  

---

## 🆘 Troubleshooting

| Problem | Fix |
|---|---|
| "Database Connection Failed" | Check DB_USER, DB_PASS, DB_NAME in config.php |
| Images not saving | Check `admin/uploads/` has chmod 755 |
| Login not working | Re-run `gallery_db_setup.sql` to reset admin user |
| Thumbnails not generating | Hosting may not have GD — set `MAKE_THUMBS = false` in config.php |
| Gallery shows "No images" on site | Check gallery-api.php is in site root and gallery-integration-patch.js is included in index.html |

---

Built by **OPTMS Tech** · Madhepura, Bihar
