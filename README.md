# Learnypy Repository Setup

This repository contains code for a project that requires a MySQL database. Follow these steps to set up and run the project using XAMPP.

## Prerequisites

Before you begin, make sure you have the following installed:

1. [XAMPP](https://www.apachefriends.org/index.html) - A web server package that includes Apache, MySQL, PHP, and more.

## Setup Instructions

1. **Create a MySQL Database:**

   - Open XAMPP Control Panel.
   - Start the Apache and MySQL services.
   - Open a web browser and visit http://localhost/phpmyadmin/.
   - Click on "Databases" in the top navigation menu.
   - Create a new database named `learnypy`.

2. **Import SQL File:**

   - Locate the SQL file supplied with this repository (e.g., `learnypy.sql`).
   - Open phpMyAdmin in your web browser.
   - Select the `learnypy` database from the left-hand sidebar.
   - Click the "Import" tab.
   - Click the "Choose File" button and select the SQL file.
   - Click the "Go" button to import the SQL data into the database.

3. **Clone the Repository:**

   - Clone this repository to your local machine using Git or download and extract the ZIP archive.

4. **Copy Files to XAMPP:**

   - Copy the contents of this repository to your XAMPP `htdocs` directory. This directory is typically located at `C:\xampp\htdocs` on Windows or `/opt/lampp/htdocs` on Linux.

5. **Run the Repository:**

   - Open a web browser.
   - Access the repository by entering the following URL in your browser's address bar:

     ```
     http://localhost/your-repository-folder-name/
     ```

   Replace `your-repository-folder-name` with the actual name of the folder containing the repository files.

6. **Interact with the Application:**

   - You should now be able to interact with the application in your web browser.

## Troubleshooting

If you encounter any issues during setup or while running the application, refer to the error messages and logs for further information. Feel free to reach out for assistance if needed.
Email id: alfeysuny@gmail.com
Happy coding!
