# 📚 Ebook Management System (PHP & MySQL Project)

This is a web-based Ebook Management System developed using PHP and MySQL. It allows admins to manage books, competitions, and orders, while users can register, place orders, and participate in competitions.

---

## ⚙️ Technologies Used

- PHP  
- MySQL  
- HTML / CSS / JavaScript  
- Bootstrap  
- DataTables  

---

## 👨‍💼 Admin Features

- Add / Manage Books  
- Add / Manage Competitions  
- Manage Orders & Confirm Payments  
- View Submissions and Award Prizes  
- Upload Documents with Payment Access Control  
- View Registered Users  
- Email Notifications on Orders and Payments

### 📊 Admin Dashboard  
![Admin Dashboard](/pic.png/adminDashboard.PNG)

### 📚 Manage Books  
![Manage Books](/pic.png/manageBooks.PNG)

### 📝 Add Competition  
![Add Competition](/pic.png/addCompetition.PNG)

### 📄 Book Info  
![Book Info](/pic.png/bookInfo.PNG)

### 📦 Order Details  
![Order Details](/pic.png/orderDetails.PNG)

---

## 👩‍🎓 User Features

- User Registration & Login  
- Search and View Books  
- Add Books to Cart  
- Place Orders  
- Participate in Competitions  
- Submit Essays / Documents  
- View Prizes and Competition Results  
- Download Paid PDFs  
- Track Orders by Status

### 🖥 User Dashboard  
![User Dashboard](/pic.png/userdashboard.PNG)

### 🛒 Add to Cart  
![Add to Cart](/pic.png/addtocart.PNG)

### 🧾 Checkout Page  
![Checkout](/pic.png/checkoout.PNG)

### 🏆 Competitions  
![Competitions](/pic.png/Competitions.PNG)

### 🔐 Sign In  
![Sign In](/pic.png/sigin.PNG)

---

## 🏠 Front Page

![Front Page](/pic.png/front.PNG)

![Library View](/pic.png/library.PNG)

---

## 🚀 How to Run the Project?

1. **Download or Clone the Repository**  
   `git clone https://github.com/Sehrish-Deen/EbookManagementSystem.git`

2. **Import the Database**  
   - Create a database `ebook_db` in phpMyAdmin  
   - Import the provided SQL file (`ebook_db.sql`)

3. **Update Database Connection**  
   Open `config.php` and set your DB credentials:
   ```php
   $conn = mysqli_connect("localhost", "root", "", "ebook_db");
