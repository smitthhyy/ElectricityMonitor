var sqlite3 = require('sqlite3').verbose();
var db = new sqlite3.Database('/var/lib/cloud9/elecmon/db.sqlite');

db.serialize(function() {
    db.run("CREATE TABLE hs110 (mac VARCHAR(12), timestamp UNSIGNED BIG INT UNIQUE NOT NULL, voltage_mv INTEGER, current_ma INTEGER, power_mw INTEGER, total_wh INTEGER)");
    db.run("CREATE TABLE hs110_details (mac VARCHAR(12) UNIQUE NOT NULL, alias VARCHAR(80), ip VARCHAR(15), port INT, online TINYINT");
});
db.close();
