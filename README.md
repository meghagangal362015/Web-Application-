# Artisan Jewelry by Megha - Company Website

A complete company website built with HTML, CSS, and PHP for a web development lab assignment.

## Company: Artisan Jewelry by Megha

**Artisan Jewelry by Megha** is a handmade jewelry and accessories brand founded by Megha, who has had a lifelong passion for jewelry since childhood. We create necklaces, earrings, bracelets, rings, and hair accessories using quality materials and artisan techniques. Custom orders and wholesale partnerships are available.

---

## File Structure (Folder Layout)

```
company-website/
│
├── index.html          # Home (Main page)
├── about.html          # About (Company description)
├── products.html       # Products/Services
├── news.html           # News (Latest company news)
├── contact.php         # Contacts (reads from data/contacts.txt)
├── login.php           # Admin login (session-based authentication)
├── secure.php          # Protected admin page (user listing)
├── logout.php          # Logout (destroys session)
├── generate_password_hash.php  # CLI: generates auth config
├── setup_auth.php      # Web: one-time auth setup (visit in browser)
├── config/
│   └── auth_config.php # Password hash (created by setup)
├── README.md           # This file - project documentation
│
├── css/
│   └── style.css       # Main stylesheet for the entire site
│
└── data/
    └── contacts.txt    # Contact information (read by contact.php)
```

---

## Technical Requirements Met

- [x] HTML pages for all sections (Home, About, Products, News)
- [x] CSS file for styling (css/style.css)
- [x] PHP Contact page that reads from a text file
- [x] Contact information stored in data/contacts.txt

---

## Administrator Section (Secure Login)

**Credentials:** admin / Admin123!

**Setup (first time):** Visit `setup_auth.php` in your browser (e.g., `http://localhost/setup_auth.php`) to create the auth config. Or run `php generate_password_hash.php` from the project directory.

**Fallback (no config):** admin / password

- **login.php** – Login form (User ID + Password, POST method)
- **secure.php** – Protected page with user list (Mary Smith, John Wang, Alex Bington, Sarah Johnson, David Lee)
- **logout.php** – Destroys session, redirects to login

---

## How the PHP Contact Page Works

The `contact.php` file:

1. **Defines the file path** – Uses `__DIR__ . '/data/contacts.txt'` to locate the contacts file
2. **Checks file existence** – Uses `file_exists()` before reading
3. **Checks readability** – Uses `is_readable()` for permission validation
4. **Reads the file** – Uses `file_get_contents()` to load the text
5. **Sanitizes output** – Uses `htmlspecialchars()` to prevent XSS
6. **Displays content** – Outputs the content inside a `<pre>` tag for formatting

---

## Beginner-Friendly Tools for Development & Hosting

### Development (Creating/Editing the Site)

---

## Uploading to Hostinger

1. Log into Hostinger hPanel
2. Open Files → File Manager
3. Go to `public_html`
4. Upload all files keeping the same structure (css/, data/, etc.)
5. Visit your domain to view the site

---



- The Contacts page uses PHP to read from `data/contacts.txt` dynamically
