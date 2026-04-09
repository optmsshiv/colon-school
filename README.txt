================================================================
COLONEL'S SAINIK VIDYALAYA — DEPLOYMENT GUIDE
================================================================
Website built by OPTMS Tech
================================================================

FOLDER STRUCTURE
----------------
colonels_sainik_vidyalaya/
│
├── index.html                ← Public website (NO admin inside)
├── 404.html
├── .htaccess
├── robots.txt
├── sitemap.xml
│
├── admin/                    ← SEPARATE ADMIN PANEL (new!)
│   ├── index.html            ← Admin login + full CMS
│   └── .htaccess             ← Admin folder security
│
└── assets/
    ├── css/main.css
    ├── js/main.js
    └── images/
        ├── favicon.svg
        └── school_image.png


================================================================
ACCESSING THE ADMIN PANEL
================================================================
URL: https://www.yourdomain.in/admin/
     OR: https://www.yourdomain.in/admin/index.html

Default Login:
  Username: admin
  Password: admin123

⚠️  IMPORTANT: Change the password immediately after first login!
    Admin Panel → Change Password (left sidebar)

The admin panel is completely separate from the public website.
Visitors cannot see or access it.

A tiny ⚙ icon in the bottom-right corner of the website is the
only way to reach the admin panel (invisible to most visitors).


================================================================
DATA STORAGE
================================================================
All CMS data is stored in the browser's localStorage under the
key: csv_cms_data

Since the admin panel and public site share the same domain,
localStorage is shared between them automatically.

The admin login session uses sessionStorage (clears on tab close).
Admin password is stored in localStorage under: csv_admin_credentials


================================================================
HOW TO UPLOAD TO BLUEHOST
================================================================
1. Log in to Bluehost → cPanel → File Manager
2. Navigate to public_html/
3. Upload ALL files including the admin/ folder
4. Make sure .htaccess files are uploaded (enable "Show Hidden Files")
5. Visit https://yourdomain.in/ for the website
6. Visit https://yourdomain.in/admin/ for the admin panel

================================================================
SUPPORT
================================================================
Built & maintained by OPTMS Tech
================================================================
