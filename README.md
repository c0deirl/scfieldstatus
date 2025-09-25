# Soccer Field Status App

## Description
A simple web application to report the status of a soccer field online. Features a PIN-protected admin dashboard to update the field status.

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
  
## File Structure
- index.php: Main page
- admin/dashboard.php: Admin dashboard
- admin/login.php: Login page
- admin/logout.php: Logout script
- status_data.json: Configuration data

## License
MIT License
