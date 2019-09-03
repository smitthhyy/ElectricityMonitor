var sqlite3 = require('sqlite3').verbose();
var db = new sqlite3.Database('/var/www/ElectricityMonitor/database.sqlite');
// var db = new sqlite3.Database('C:/Users/trevo/Dropbox (IoTSD)/workspace/ElectricityMonitor/database.sqlite');
db.serialize(function() {
    db.run("DROP TABLE IF EXISTS hs110");
    db.run("DROP TABLE IF EXISTS hs110_details");
    db.run("DROP TABLE IF EXISTS infeed");
    db.run("CREATE TABLE hs110 ( mac VARCHAR(12), timestamp UNSIGNED BIG INT NOT NULL, voltage_mv INTEGER, current_ma INTEGER, power_mw INTEGER, total_wh INTEGER )");
    db.run("CREATE TABLE hs110_details (mac VARCHAR(12) UNIQUE NOT NULL, alias VARCHAR(80) NOT NULL, ip VARCHAR(15) NOT NULL, port INT NOT NULL, online TINYINT DEFAULT 0)");
    db.run("CREATE TABLE infeed (timestamp UNSIGNED BIG INT UNIQUE NOT NULL, phase1 INTEGER, phase2 INTEGER, phase3 INTEGER, total INTEGER)");
});
db.close();
console.log("Done");
