# Apollo Capitals

**Apollo Capitals** is a CRM (Customer Relationship Management). It provides comprehensive management of user roles, customer data, tasks, appointments, and user activities. Built with robust technologies like PHP, Laravel, and MySQL, Apollo Capitals offers features, including role-based access control and multi-factor authentication (MFA), ensuring a secure and user-friendly experience.

## Table of Contents

1. Features
2. Technologies Used
3. Installation Guide
4. Usage Guide
5. Security
6. Contributing
7. Known Issues
8. License
9. Contact Information

## Features

- **User Role Management:** Admins can create new users, assign roles (Admin, Account Manager, User), and manage permissions with ease.
- **Customer Management:** All roles (Admins, Users, Account Managers) can create and view customer profiles, allowing efficient customer relationship management.
- **Task Management:** Admins can assign tasks to users with detailed descriptions, while Users and Account Managers can manage their own tasks, including creation, editing, updating, and deletion.
- **Appointment Scheduling:** Users can schedule appointments for themselves or customers, with the ability to view and manage all appointments based on their roles.
- **Activity Logs:** Admins have the capability to monitor all user activities, while Users and Account Managers can review their own actions.
- **Multi-Factor Authentication (MFA):** Secure your account with email-based OTP (One-Time Password) for 2FA (Two-Factor Authentication). OTPs expire in 1 minute, ensuring timely and secure access.
- **Password Management:** Enforces password updates every 30 days for all users. New users receive an email notification with credentials and are prompted to update their password upon first login in the profile section.
- **Automated Notifications:** Users receive email notifications for key actions, such as password expiry reminders and new user account creation with credential details.

## Technologies Used

- **Backend:** PHP, Laravel 10
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Role & Permission Management:** Laravel Spatie

## Installation Guide

Follow these steps to set up Apollo Capitals on your local machine:

1. **Clone the Repository:**


   git clone https://github.com/suryaDheeraj0/apollo-capitals.git
   cd apollo-capitals
 

2. **Install Dependencies:**

   Ensure you have Composer installed, then run:


   composer install
  

3. **Configure Environment Variables:**

   Copy `.env.example` to `.env` and configure your environment variables, particularly for database and mail settings:

   cp .env.example .env


   Update your database settings in `.env`:


   DB_CONNECTION= "{{database}}"
   DB_HOST= "{{127.0.0.1}}"
   DB_PORT= "{{3306}}"
   DB_DATABASE= your_database
   DB_USERNAME= your_username
   DB_PASSWORD= your_password
 

   Set up your mail configuration (using Gmail as an example):


   MAIL_MAILER= {{smtp}}
   MAIL_HOST= {{smtp.gmail.com}}
   MAIL_PORT= {{587}}
   MAIL_USERNAME= your_gmail_username
   MAIL_PASSWORD= your_gmail_password
   MAIL_ENCRYPTION= tls
   MAIL_FROM_ADDRESS= your_email@example.com
   MAIL_FROM_NAME= "${APP_NAME}"


4. **Run Migrations and Seed the Database:**


   php artisan migrate --seed
 

5. **Install Laravel Breeze and Spatie Permissions:**


   composer require laravel/breeze --dev
   php artisan breeze:install
   npm install && npm run dev
   composer require spatie/laravel-permission
   php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
   php artisan migrate
   

6. **Start the Application:**

   To run the application locally, execute:

  
   php artisan serve
 

   Additionally, start the job queue and scheduler:

  
   php artisan queue:work
   php artisan schedule:work
 

## Usage Guide

1. **Admin Role:**
   - Create and manage user accounts.
   - Assign roles and permissions.
   - Manage customers, tasks, appointments, and view all user activity logs.

2. **User & Account Manager Roles:**
   - Create and view customer profiles.
   - Manage personal tasks and appointments.
   - Access personal activity logs.

## Security

- **Password Expiry:** Users must update their password every 30 days. Automatic email reminders are sent to users whose passwords are nearing expiration.
- **Two-Factor Authentication:** Secure login with OTP-based MFA, enhancing account security.

## Contributing

We welcome contributions from the community! If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/my-feature`).
3. Commit your changes (`git commit -am 'Add my feature'`).
4. Push to the branch (`git push origin feature/my-feature`).
5. Create a new Pull Request.

## Known Issues

Currently, there are no known bugs or issues. If you encounter any problems, please report them on our [GitHub Issues](https://github.com/suryaDheeraj0/apollo-capitals/issues) page.


## Contact Information

For any questions, feedback, or suggestions, please contact us at:

- **Email:** 
Venkateshkalamata93@gmail.com,
suryadheeraj7@gmail.com

Thank you for using Apollo Capitals!
Feel free to modify the content to better suit your preferences!
