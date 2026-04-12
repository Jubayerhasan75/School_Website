# 🏫 Shishu Bidya Niketon - School Management System

A complete, dynamic, and responsive web-based school management system designed to streamline daily administrative tasks and showcase school information beautifully.

## ✨ Key Features

* **Secure Admin Dashboard:** A centralized and protected control panel for administrators.
* **Student Management:** Easily add, edit, delete, and filter student records by their respective classes.
* **Teacher Management:** Maintain comprehensive teacher profiles including images, contact info, and academic qualifications.
* **Dynamic Notice Board:** Publish, edit, and manage urgent school notices that reflect instantly on the homepage.
* **Interactive Image Slider:** A custom-built JavaScript slider for the homepage header to showcase school highlights.
* **Gallery & Events:** Dynamically manage and display class parties and cultural events.
* **Messaging System:** A built-in contact form allowing visitors/parents to send messages directly to the admin panel.
* **Auto Directory Management:** System automatically creates necessary image folders if they don't exist during file uploads.

## 🛠️ Technologies Used

* **Frontend:** HTML5, Tailwind CSS, Vanilla JavaScript (Slider logic, DOM manipulation, Client-side redirects)
* **Backend:** PHP (Procedural architecture with session management)
* **Database:** MySQL (Relational database management)
* **Security:** SQL Injection prevention (`mysqli_real_escape_string`), Secure Session Handling.

## 🚀 Installation Guide (Localhost)

1. Clone this repository to your local machine:
   ```bash
   git clone [https://github.com/Jubayerhasan75/School_Website.git](https://github.com/Jubayerhasan75/School_Website.git)

2. Move the extracted project folder to your local server directory (e.g., C:\xampp\htdocs\).

3. Start Apache and MySQL from your XAMPP Control Panel.

4. Open your browser and navigate to http://localhost/phpmyadmin/.

5. Create a new database named shishu_bidya.

6. Import the provided .sql database backup file into this newly created database.

7. Configure the database connection in config/db.php if necessary.

8. Access the project via: http://localhost/Your_Folder_Name

📄 License
This project is licensed under the MIT License.
