# AlUla Vision 2030 — Tourism Platform

A full-stack web application designed to promote **AlUla**, one of Saudi Arabia's premier cultural and historical destinations. This project was developed to align with the pillars of Saudi Vision 2030: **Tourism Growth**, **Culture & Heritage Promotion**, and **Digital Transformation**.

*Developed as a comprehensive project for the IS337 Application Development course at Imam Mohammad Ibn Saud Islamic University (IMSIU).*

---

## 🚀 Key Features

* **Interactive Exploration:** Discover the historical and natural landmarks of AlUla with dynamic UI elements.
* **Authentication & Authorization:** Secure user registration and login system with session management.
* **Tour Booking System:** Authenticated users can securely book guided tours.
* **AI-Powered Chatbot:** Integrated bilingual (Arabic/English) JavaScript chatbot for personalized user recommendations.
* **User Feedback & Reviews:** A live database-driven system for visitors to submit and view reviews.
* **Bilingual Support:** Full interface toggle between Arabic (RTL) and English.

---

## 💻 Tech Stack

| Layer | Technology |
| --- | --- |
| **Frontend** | HTML5, CSS3, Vanilla JavaScript |
| **Backend** | PHP |
| **Database** | MySQL |
| **Architecture** | Client-Server Model |

---

## 📂 Project Structure

```text
/alula-vision2030/
├── index.html        (Home)
├── about.html        (About Us + JS Slideshow)
├── tourism.html      (AlUla destinations UI)
├── gallery.html      (Photos & Videos gallery)
├── chatbot.html      (AI assistant integration)
├── register.php      (Self-validating Sign up)
├── login.php         (Self-validating Sign in)
├── booking.php       (Tour booking — registered users only)
├── feedback.php      (User feedback + live list from DB)
├── logout.php        (Session destruction)
├── css/              (Global and page-specific stylesheets)
├── js/               (Client-side logic and Chatbot)
├── php/              (Database connection, shared headers/footers)
├── database/         (MySQL schema / alula_db.sql)
├── images/           (Static assets)
└── videos/           (Media assets)

```

---

## 🛠️ How to Run Locally

1. Install an environment like **XAMPP** (Apache + MySQL + PHP).
2. Clone this repository and place the folder inside your `xampp/htdocs/` directory.
3. Open **phpMyAdmin** and create a new database named `alula_db`.
4. Import the `database/alula_db.sql` file to establish the schema.
5. Start **Apache** and **MySQL** from the XAMPP Control Panel.
6. Navigate to `http://localhost/alula-vision2030/` in your web browser.

---

## 👨‍💻 Developer

**Abdulaziz Aldhaif**
*Full-Stack Developer*
Solely responsible for the end-to-end development of this project, including UI/UX design, PHP backend architecture, MySQL database design, and AI chatbot integration.
