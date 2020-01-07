# Trevor's Electricity Monitor
### 8th Jan 2020 update
Initial development, **not a complete application yet** (but getting close now) - check back later.
Working on an issue with datatables and the search function breaking when making changes to parts of the code.
## Description
Monitor electricity useage in my home using a number of technologies including:
- CurrentCost Envi-R 3 phase mains monitor
- TPLink HS110 Smart WiFi Plug with Energy Monitoring
- Sengled LED lights
- Some custom hardware based on ESP32 and ESP8266 devices
## Installation
1. Install from the Git repository
2. composer install
3. npm install
4. create empty file in application root using touch and naming it electricity-monitor-db.sqlite
5. cp .env.example .env
6. edit .env file
7. php artisan key:generate
8. php artisan migrate --seed

The initial username:password are admin@admin.com:password
