# 🎓 Student Project Showcase Website

A **PHP & MySQL-based platform** where students can upload, view, and interact with academic projects.  
Includes features like **likes**, **comments**, **3D interactive visuals** on the home page, and a responsive **creator contact page** to connect with project owners.

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
🔍 Search & filter projects by Owner, Title, and Topic  
🖼 **3D Images & Models on Home Page** for an engaging and modern look (using Three.js or similar libraries)

---

## 🛠 Technologies Used
- **PHP** – Backend & server-side processing  
- **MySQL** – Database  
- **HTML5** – Structure  
- **CSS3** – Styling & responsive layout  
- **JavaScript** – Interactive features (likes, 3D models, dynamic search)  
- **Three.js** (or similar) – For displaying interactive 3D models/images on the home page  
- **Font Awesome** – Icons

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
1. Students **create accounts** and upload projects.  
2. Visitors can **browse**, **like**, and **comment** on projects.  
3. **3D interactive visuals** on the home page make the browsing experience modern and engaging.  
4. Creator contact form allows sending **direct messages** to the project author.  
5. Authors can see messages in their **profile inbox page**.  
6. All messages are stored in the database for review.  
7. If the user is **not logged in**, they **cannot** like, comment, or send messages to authors.
