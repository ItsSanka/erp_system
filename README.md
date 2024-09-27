
# ERP System - Customer and Item Management

This project is a simple ERP system built using PHP and MySQL that allows you to manage customers and items. It includes features for inserting, updating, deleting, and searching records, as well as generating reports for invoices. The frontend is built using Bootstrap to ensure a responsive and user-friendly interface.

## Features

1. **Customer Management**
   - Add new customers.
   - View all customers.
   - Update and delete customers.
   - Search for customers by name or contact number.

2. **Item Management**
   - Add new items.
   - View all items.
   - Update and delete items.
   - Search for items by name or code.

3. **Invoice Reports**
   - Generate invoice reports based on a date range.
   - View details of invoices and their corresponding customers and items.
   
## Assumptions

- The ERP system will be hosted in a local environment using `localhost`.
- The MySQL database is pre-configured and accessible at `localhost`.
- Basic user authentication and role management is not included in this version.
- No complex business logic such as stock management or real-time updates is considered for this system.
- Date inputs are used for selecting the range in generating reports.
- PHP’s `mysqli` is used for database interaction, assuming no usage of an ORM like Eloquent.
  
## Requirements

- **PHP** >= 7.0
- **MySQL** >= 5.7
- **Apache** or any other server capable of serving PHP (XAMPP, WAMP, etc.)
- **Composer** (Optional, if you're using any dependencies via Composer)
- **Bootstrap** for styling (included via CDN)
- **PHPMyAdmin** for easier database management (optional)

## Database Setup

1. Import the provided SQL file (`erp_system.sql`) into your MySQL database:
   - You can do this through PHPMyAdmin or using the MySQL command line:
     ```bash
     mysql -u root -p erp_system < erp_system.sql
     ```
   - This will create the `customers`, `items`, `invoices`, and `invoice_items` tables.
  
2. Update the `includes/database.php` file to match your local MySQL settings:
   ```php
   <?php
   $conn = new mysqli('localhost', 'root', '', 'erp_system');
   
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```

## Project Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/ItsSanka/erp_system.git
   ```

2. **Navigate to the project directory**:
   ```bash
   cd erp_system
   ```

3. **Set up the database connection**:
   - Modify the database connection settings in `includes/database.php` as per your local environment.

4. **Serve the project**:
   If using XAMPP or WAMP, place the project folder inside the `htdocs` directory. Then, start your Apache and MySQL services. Access the project by navigating to:
   ```
   http://localhost/erp_system
   ```

5. **Import the database**:
   Use PHPMyAdmin or the MySQL command line to import the `database.sql` file to create the necessary tables.

6. **Access the System**:
   - To view **Customers**: 
     ```
     http://localhost/erp-system/customers/index.php
     ```
   - To view **Items**:
     ```
     http://localhost/erp-system/items/index.php
     ```
   - To view **Invoice Reports**:
     ```
     http://localhost/erp-system/reports/invoice_report.php
     ```

## Folder Structure

- `includes/`: Contains the reusable components like the database connection and the navbar.
- `css/`: Contains the CSS files for styling the project.
- `customers/`: Contains files related to customer management.
- `items/`: Contains files related to item management.
- `reports/`: Contains the report generation files.
  
## How to Use

### Customer Management

- To add a customer, navigate to the **Customers** page and click on the "Add New Customer" button.
- To update a customer, click on the "Update" button next to the customer's details.
- To delete a customer, click the "Delete" button and confirm the action.
- To search for a customer, use the search bar at the top of the **Customers List** page.

### Item Management

- To add an item, navigate to the **Items** page and click on the "Add New Item" button.
- To update an item, click on the "Update" button next to the item's details.
- To delete an item, click the "Delete" button and confirm the action.
- To search for an item, use the search bar at the top of the **Items List** page.

### Invoice Reports

- To generate an invoice report, go to the **Reports** page, select a date range, and click on "Generate Report".
  
## Troubleshooting

- Ensure your Apache and MySQL services are running.
- Check your database credentials in `includes/database.php` if you're facing database connection issues.
- If you're getting errors during report generation, verify that there are records in the `invoices` and `invoice_items` tables.
