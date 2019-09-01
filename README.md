#Trevor's Electricity Monitor
2nd Sep 2019 update - initial development, not a complete application yet - check back later.
##Description
Monitor electricity useage in my home using a number of technologies including:
- CurrentCost Envi-R 3 phase mains monitor
- TPLink HS110 Smart WiFi Plug with Energy Monitoring
- Sengled LED lights
- Some custom hardware based on ESP32 and ESP8266 devices
##Installation
1. Install from the Git repository
2. composer install
3. npm install
4. create empty file in application root using touch and naming it electricity-monitor-db.sqlite
5. cp .env.example .env
6. edit .env file
7. php artisan key:generate
7. php artisan migrate --seed
