# Soccer Field Status App

## Description
A simple web application to report the status of a soccer field online. Features a PIN-protected admin dashboard to update the field status.
## Screenshots  

<img width="1349" height="859" alt="Screenshot 2025-09-25 102251" src="https://github.com/user-attachments/assets/3a715d98-ff55-472d-b3f4-ea81e676249d" />


## Features
- PIN login system (PIN can be set in status_data.json)
- Customizable field names and page titles
- Easy status updates via admin dashboard

## Getting Started
1. Clone or download the repository.
2. Upload to your web host, you should probably use a subdomain if possible, but the app will work as its own page, you just have to rename it to something like "status.php".  
4. Access the app at your preferred URL

## Admin Access
- Navigate to (your URL)/admin/login.php
- Default PIN is 1234 (editable in status_data.json)

## Customization
- Edit `status_data.json` to change:
  - "pin": "new_pin_here"
  - "field_1": "OPEN" or "CLOSED"
  - "field_2": "OPEN" or "CLOSED"
  - These are the initial states, once you log into the admin panel and change them, they will be dynamically adjusted.  

- Edit `index.php` to change:
  - Line 11 - Site Title
  - Line 179-189 - Field Addresses (if two)
  - Line 194 & 198 - Field Titles  

- Edit `/admin/dashboard.php` to change:
  - Line 272 - Dashboard Title
  - Line 279 & 282 - Field Titles
  - Line 290 & 297 - Field Titles  
  
## File Structure
- index.php: Main page
- admin/dashboard.php: Admin dashboard
- admin/login.php: Login page
- admin/logout.php: Logout script
- status_data.json: Configuration data

## License
MIT License
