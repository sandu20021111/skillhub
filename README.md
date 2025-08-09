# 🎓 Student Project Showcase Website

A PHP & MySQL-based platform where students can upload, view, and interact with academic projects.  
Includes features like **likes**, **comments**, and a responsive **creator contact page** to connect with project owners.

---

## 🚀 Features
📂 Project listings with images and descriptions  
📤 File upload or link preview for projects
👍 Like system with real-time like count updates  
💬 Comment system for project discussions  
📬 Contact form and creator contact form to send messages to project authors  
📱 Responsive design for mobile and desktop  
🛡️ Secure input handling and database interaction  
🎨 Clean UI styled with custom CSS 
🔍 Search & filter projects by Owner, Title and Topic

---

## 🛠 Technologies Used
- **PHP** (Backend & server-side processing)  
- **MySQL** (Database)  
- **HTML5** (Structure)  
- **CSS3** (Styling, responsive layout)  
- **JavaScript** (Interactive features like likes)  
- **Font Awesome** (Icons)  

---

## 📋 Database Tables
**Core Tables**:
- `users` – Stores user profiles  
- `projects` – Stores uploaded project details  
- `comments` – Stores comments on projects  
- `likes` – Stores likes per project  
- `messages` – For private messaging between users  
- `contact_messages` – Stores contact form submissions

---

## 📂 How It Works
- Students create accounts and upload projects.
- Visitors can browse, like, and comment on projects.
- Creator contact form allows sending direct masseges for author of the project.
- Authors can see the message in thier profile inbox page.
- All messages are stored in the database for review.
- If user is not logged in user can't like, comment or send messages to authors
