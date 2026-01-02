# MyTicketSystem  
Centralized Ticket Management System

---

## Overview

MyTicketSystem is a centralized web-based ticket management system built with **PHP and MySQL**.  
It provides a single platform for managing user access and handling tickets in a controlled and organized way.

The system is intended for **internal team use** to submit, view, and manage tickets using role-based access.

---

## Purpose

The purpose of this system is to centralize ticket handling and user access into one controlled application.  
All tickets are created, stored, and accessed through the same system to ensure consistency, visibility, and accountability across the team.

---

## Objectives

- Centralize ticket creation and storage  
- Control access using defined user roles  
- Secure the system using authentication and sessions  
- Provide a clear workflow for ticket submission and review  
- Allow consistent setup and use by all team members  

---

## User Roles

- **Admin** – Oversees system access and tickets  
- **Staff** – Handles and reviews tickets  
- **Member** – Submits and views tickets  

---

## Features

- User registration and login  
- Secure session-based authentication  
- Role-based dashboards  
- Ticket creation and listing  
- Centralized database storage  
- Protected pages (login required)  
- Logout and session termination  

---

## Technology Stack

- PHP  
- MySQL (phpMyAdmin)  
- HTML / CSS  
- Apache (XAMPP)  
- Git / GitHub  

---

## Project Structure

MyTicketSystem/
├── includes/
│ ├── admin.php
│ ├── auth.php
│ ├── dashboard.php
│ ├── db.php
│ ├── member.php
│ ├── nav.php
│ ├── staff.php
│ └── tickets.php
├── index.php
├── login.php
├── signup.php
├── logout.php
├── style.css
└── README.md

## Database Setup

**Database name:**
ticketsystem

yaml
Copy code

**Tables used:**
- `users`
- `tickets`

---

## Setup Instructions

### 1. Prerequisites
- XAMPP installed
- Web browser

---

### 2. Install the Project
1. Clone or download the repository  
2. Move the project folder to:
C:\xampp2\htdocs\MyTicketSystem

yaml
Copy code

3. Start **Apache** and **MySQL** in XAMPP  

---

### 3. Database Configuration
1. Open:
http://localhost/phpmyadmin

markdown
Copy code
2. Create database:
ticketsystem

yaml
Copy code
3. Create tables:
- `users`
- `tickets`

---

### 4. Database Connection
Update `includes/db.php`:
host: localhost
user: root
password: (empty)
database: ticketsystem

yaml
Copy code

---

## Running the System

Open a browser and go to:
http://localhost/MyTicketSystem

yaml
Copy code

---

## System Flow

1. User signs up  
2. User logs in  
3. Session is created  
4. User is redirected based on role  
5. User creates or views tickets  
6. Logout ends the session  

---

## First-Time Use Notes

- New users must sign up before logging in  
- User roles (Admin / Staff / Member) are assigned in the database  
- At least one Admin user should be created for system oversight  

---

## Usage Notes

- Users must be logged in to access the system  
- Pages are protected by authentication checks  
- Tickets are stored centrally in the database  

---

## Known Limitations

- Ticket status updates are not yet implemented  
- Tickets are not assigned to specific staff members  
- Email notifications are not enabled  
- The system is intended for internal use only  

---

## Troubleshooting

- If a database error appears, confirm MySQL is running in XAMPP  
- If login fails, verify the user exists in the `users` table  
- If access is denied, confirm the user role is correct  
- Clear browser cache if styles do not update  

---

## Validation Checklist

- Login works  
- Signup works  
- Role-based access works  
- Ticket creation works  
- Unauthorized access is blocked  
- Logout clears session  
---

## Deployment Options (Cloud-Based, Low Cost, Closed Access)

This system is intended for closed, private nonprofit use (not public access).
The following deployment options are recommended based on cost, security, and scalability.

### Option 1: Oracle Cloud Free Tier (Recommended – Zero Cost)
- Always-free cloud compute and storage (within limits)
- Suitable for PHP + MySQL applications
- No time-limited trial
- Supports HTTPS, firewall rules, and private access
- Best choice for zero ongoing hosting cost

### Option 2: Low-Cost VPS (Most Stable)
- Providers: DigitalOcean, AWS Lightsail, Vultr
- Typical cost: $5–$12 per month
- Predictable pricing and easier long-term maintenance
- Good performance for ~10K users
- Supports secure, closed-based deployment

### Option 3: Cloudflare Access + Cloud Backend (Security-Focused)
- Adds Zero Trust access control
- Only approved users can reach the application
- Works with Oracle Cloud or low-cost VPS backend
- Recommended if stricter access control is required

Free shared hosting solutions are not recommended for long-term or sensitive nonprofit operations.

---
## License
Internal team use only.