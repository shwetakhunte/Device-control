# Device Control - Yii2 Web Application

This is a PHP web application built using the Yii2 framework for collecting and monitoring device information using a public API and ping utility.

## Features

- Add devices via IP address using a simple form
- Fetch device details from external API: `https://api.incolumitas.com/`
- Store device info in a MySQL database
- Run ping commands on devices and store the results
- View detailed information for each device
- Dashboard with AJAX to display:
  - Total device count
  - Total successful pings
  - Total failed pings

---

## Technologies

- PHP
- Yii2 (Basic Template)
- Bootstrap (for styling)
- jQuery (for AJAX dashboard)
- MySQL

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/shwetakhunte/Device-control.git
   cd Device-control


http://localhost:8080/index.php/device/fetch-form
http://localhost:8080/index.php/device/index
http://localhost:8080/index.php/device/dashboard

