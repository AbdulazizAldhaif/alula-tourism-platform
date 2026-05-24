# 🚀 Installation Guide

Quick steps to get the project running on your local machine.

## Prerequisites

- **XAMPP** (Apache + MySQL + PHP)
  Download: https://www.apachefriends.org/

## Setup Steps

### 1. Install XAMPP
Install XAMPP and start both **Apache** and **MySQL** from the Control Panel.

### 2. Place Project in htdocs
Copy the `alula-vision2030` folder into:
- Windows: `C:\xampp\htdocs\`
- macOS: `/Applications/XAMPP/htdocs/`

### 3. Create the Database
1. Open browser → `http://localhost/phpmyadmin`
2. Click **Import** tab
3. Choose file → select `database/alula_db.sql`
4. Click **Go**

### 4. Run the Project
Open browser → `http://localhost/alula-vision2030/index.html`

## Troubleshooting

**❌ "Connection failed" error**
→ Make sure MySQL service is running in XAMPP.

**❌ "Page not found" / 404**
→ Double-check the folder is inside `htdocs` and Apache is running.

**❌ Forms don't submit**
→ Check that you're accessing the site via `http://localhost/...`, not by opening the HTML file directly.

**❌ Arabic text appears as ???**
→ The database is configured for UTF-8 in the SQL file. Make sure your import preserved this.

## Default Database Credentials

| Setting | Value |
| --- | --- |
| Host | localhost |
| Username | root |
| Password | (empty) |
| Database | alula_db |

> ⚠️ These are XAMPP defaults. Edit `php/db_connect.php` if you change them.
