# Aklat-taan: Learning Space Reservation System (LIS 162 Implementation)

**Submitted by:** Jade Odulio (2020-01455)  
**Course:** LIS 162: Systems Implementation  
**Date:** December 2025

---

## Project Overview

This repository contains the source code and implementation details for the **Aklat-taan Learning Space Reservation System**. 

This project was developed in partial fulfillment of the requirements for the course **LIS 162 (Systems Implementation)** at the University of the Philippines Diliman. It serves as a fully functional **proof of concept** derived from the Systems Analysis and Design study conducted in the prerequisite course, **LIS 161**.

### Context & Background
The University of the Philippines Diliman Main Library currently utilizes a digital system known as *Aklat-taan* to manage facility reservations. In the previous phase of this study (LIS 161), an in-depth analysis of the existing system revealed specific usability bottlenecks, such as vague resource selection and the inability for users to cancel their own bookings. **This LIS 162 implementation re-engineers the core application to address these specific findings, proving that a more detailed, user-centric workflow is technically feasible.**

---

### Latest Update (v2.01)
**Enhanced Administrative Control:** We have introduced a fully privileged **Administrator Role** with complete CRUD (Create, Read, Update, Delete) capabilities across all system tables. This update allows for unrestricted management of users, schedules, resources, and reservation records directly from the unified dashboard.

https://github.com/user-attachments/assets/9007380f-d35c-4949-99b4-a78641ef5b3c

---

## Key Features & Usability Improvements

Based on the LIS 161 recommendations, this implementation features:

* **Detailed Resource Selection:** A new booking interface that allows users to select specific inventory items (e.g., "Discussion Room A", "Table 5") linked to specific library sections.
* **Specification/Remarks Field:** An added input mechanism for users to specify details (e.g., "Need power outlet"), eliminating the need for pre-booking "reference interview" emails.
* **Self-Service Cancellation:** A "Cancel" feature allowing students to retract pending requests immediately, updating the database in real-time.

---

## Technical Stack

* **Framework:** Laravel 12.x
* **Language:** PHP 8.5
* **Database:** MySQL (Relational Schema)
* **Frontend:** Blade Templates, Tailwind CSS, Vite
* **Authentication:** Laravel Breeze / Custom Role Management

---

## Installation & Setup

To run this project locally for testing or grading purposes:

1.  **Clone the Repository**
    ```bash
    git clone [https://github.com/your-username/aklat-taan-lis162.git](https://github.com/your-username/aklat-taan-lis162.git)
    cd aklat-taan-lis162
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Configuration**
    Copy the example environment file and configure your MySQL database credentials.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Setup**
    Run the migrations to create the table structure (Users, UserTypes, Schedules, Sections, Resources, Reservations).
    ```bash
    php artisan migrate --seed
    ```
    *Note: The seeder will populate the database with default Admin, Librarian, and Student accounts.*

5.  **Run the Application**
    ```bash
    npm run build
    php artisan serve
    ```
    Access the system at `http://localhost:8000`.

---

## User Roles & Capabilities

### Student (Client)
* Log in via unified portal.
* View available library sections.
* Book specific resources with optional remarks.
* Cancel pending reservations via the "My Bookings" dashboard.

### Librarian
* View incoming reservation requests filtered by their assigned Section.
* Approve or Decline requests (triggering status updates).
* Mark transactions as "Checked In" or "No Show".

### Administrator
* **Full CRUD Access:** Create, Read, Update, and Delete records across all tables (Users, Schedules, User Types, etc.).
* **User Management:** Add users and assign User Types.
* **System Config:** Add new Library Sections, Resources, and Timeslots (Schedules).
* **Oversight:** Soft-delete reservation records for maintenance.

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
