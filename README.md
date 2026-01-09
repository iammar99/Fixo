# Fixo - Service Provider Platform

**Course:** IT-513 Web Development  
**Instructor:** Qamar Nawaz  
**Team Members:** Wahab, Awais, Ammar

---

## 📋 Project Overview

Fixo is a comprehensive web-based service marketplace that connects service providers (mechanics, technicians, plumbers, electricians, etc.) with clients who need their services. The platform streamlines the entire service booking lifecycle from request to completion through an intuitive, user-friendly interface.

## 🎯 Core Features

### For Clients
- **Easy Booking System** - Submit service requests with detailed problem descriptions
- **Real-time Tracking** - Visual timeline showing booking progress (Pending → Accepted → In Progress → Completed)
- **Provider Management** - View provider details, contact information, and ratings
- **Booking Controls** - Cancel pending bookings or delete completed ones
- **Rating System** - Rate providers after service completion with a 5-star system

### For Service Providers
- **Booking Dashboard** - Manage all incoming service requests in one place
- **Status Management** - Accept/reject bookings and update job progress
- **Client Information** - Access client contact details and problem descriptions
- **Availability Tracking** - Automatic status updates based on active bookings

## 🛠️ Technology Stack

- **Frontend:** HTML5, Tailwind CSS, JavaScript
- **Backend:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Architecture:** MVC-inspired structure with session-based authentication

## 📊 Database Structure

The system uses three core tables:

**1. providers** - Service provider accounts and profiles  
**2. clients** - Customer accounts and information  
**3. bookings** - Service requests and status tracking

Key features:
- Foreign key relationships with CASCADE delete
- ENUM fields for controlled status values
- Automatic timestamp tracking
- Rating system with decimal precision

## 📁 Project Structure

```
Fixo/
├───Config
├───includes
│   ├───components
│   └───db
├───Proccessing_pages
│   ├───Admin
│   ├───Booking
│   ├───Dashboard
│   ├───Login
│   ├───Logout
│   ├───Profile
│   └───Registeration
├───Styles
└───vendor
    ├───composer
    └───phpmailer
        └───phpmailer
            ├───language
            └───src
```

## 🔄 Booking Workflow

1. **Client submits booking** with problem type and description
2. **Provider receives notification** and can accept/reject
3. **Status updates** as provider works on the job
4. **Completion** triggers rating opportunity for client
5. **History maintained** for both parties

## 🎨 Key Design Highlights

- **Responsive Design** - Works seamlessly on desktop, tablet, and mobile
- **Color-coded Status Badges** - Quick visual identification of booking states
- **Interactive Timeline** - Step-by-step progress visualization
- **Modal Windows** - Clean UI for contact info and confirmations
- **Professional Color Scheme** - Orange primary theme with complementary accents

## 🔐 Security Features

- PDO prepared statements prevent SQL injection
- Session-based authentication system
- Input validation and sanitization
- Password hashing for user credentials
- Role-based access control (Client/Provider/Admin)

## 🎓 Learning Outcomes

This project demonstrates proficiency in:
- Full-stack web development with PHP and MySQL
- Database design and relationship management
- Session management and user authentication
- Responsive UI development with Tailwind CSS
- Real-time status tracking systems
- CRUD operations and data validation

## 👥 Team Contributions
<table>
    <tbody>
        <tr>
            <td align="center">
                <a href="https://github.com/wahaabb">
                    <img src="https://avatars.githubusercontent.com/wahaabb" width="100px;" style="border-radius:50%;" alt="Abdul Wahab"/>
                    <br />
                    <sub><b>Abdul Wahab</b></sub>
                    <br />
                    <sub>UI Designer</sub>
                </a> 
            </td>
            <td align="center">
                <a href="https://github.com/sheikhawais7">
                    <img src="https://avatars.githubusercontent.com/sheikhawais7" width="100px;" style="border-radius:50%;" alt="Awais Mehboob"/>
                    <br />
                    <sub><b>Awais Mehboob</b></sub>
                    <br />
                    <sub>Frontend Developer</sub>
                </a> 
            </td>
            <td align="center">
                <a href="https://github.com/iammar99">
                    <img src="https://avatars.githubusercontent.com/iammar99" width="100px;" style="border-radius:50%;" alt="Ammar"/>
                    <br />
                    <sub><b>Ammar</b></sub>
                    <br />
                    <sub>Backend Developer</sub>
                </a> 
            </td>
        </tr> 
    </tbody>
</table>

## 📝 License

This project is developed for educational purposes as part of the IT-513 Web Development course.

## 🙏 Acknowledgments

Special thanks to **Qamar Nawaz** for guidance throughout this project and the Web Development course.

---

**Note:** This is a student project created for learning purposes. For production deployment, additional security measures and features would be recommended.