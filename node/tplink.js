const moment = require('moment');
const { Client } = require('tplink-smarthome-api');
const util = require('util');
// let sqlite3 = require('sqlite3').verbose();
const mysql = require('mysql');

const client = new Client();

let saveDevice = function (device, state) {
    connection = mysql.createConnection({
        host     : 'localhost',
        port     : 3306,
        user     : 'elecricitymonitor',
        password : 'elecricitymonitor',
        database : 'elecricitymonitor'
    });
    let now = moment(new Date()).format("YYYY-MM-DD HH:mm:ss");

    connection.beginTransaction(function(err) {
        if (err) {throw err;}
        let sql = "INSERT into tplink_devices (mac, alias, ip, port, online, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
        let inserts = [
            device.macNormalized.toLowerCase(),
            Math.floor(Date.now() / 1000),
            state.voltage_mv,
            state.current_ma,
            state.power_mw,
            state.total_wh,
            now,
            now
        ];
        sql = mysql.format(sql, inserts);
        connection.query(sql,{}, function (error, results, fields) {
            if (error) {
                let sql2 = "UPDATE tplink_devices SET alias = ??, ip = ??, port = ?, online = ?, updated_at = ??, updated_by = ? WHERE mac = ??";
                let inserts2 = [
                    Math.floor(Date.now() / 1000),
                    state.voltage_mv,
                    state.current_ma,
                    state.power_mw,
                    state.total_wh,
                    now,
                    1,
                    device.macNormalized.toLowerCase(),
                ];
                connection.query(sql,{}, function (error, results, fields) {
                    if (error) {
                        return connection.rollback(function() {
                            throw error;
                        });
                    } else {
                        console.log("Updated " + results.affectedRows + " rows");
                    }
                });
            } else {
                console.log(results.insertId);
            }
        });
    });
};

let saveMetrics = function (device, state) {
    connection = mysql.createConnection({
        host     : 'localhost',
        port     : 3306,
        user     : 'elecricitymonitor',
        password : 'elecricitymonitor',
        database : 'elecricitymonitor'
    });

    let sql = "INSERT INTO tplinks (mac, timestamp, voltage_mv, current_ma, power_mw, total_wh, created_at, updated_at) VALUES (??, ?, ?, ?, ?, ?, ??, ??)";
    let now = moment(new Date()).format("YYYY-MM-DD HH:mm:ss");
    let inserts = [
        device.macNormalized.toLowerCase(),
        Math.floor(Date.now() / 1000),
        state.voltage_mv,
        state.current_ma,
        state.power_mw,
        state.total_wh,
        now,
        now
    ];
    sql = mysql.format(sql, inserts);

    connection.query(sql,{}, function (error, results, fields) {
        if (error) throw error;
        console.log(results.insertId);
    });

    connection.end(function(err) {
        if (error) throw error;
    });
};

let logEvent = function (eventName, device, state) {
    const stateString = (state != null ? util.inspect(state) : '');

    if (eventName === "emeter-realtime-update") {
        console.log(`${(new Date()).toISOString()} ${eventName} ${device.model} ${device.alias} ${device.host}:${device.port} ${state.power}`);
        saveMetrics(device, state);
    }
    else if ((eventName === "device-online") || (eventName === "device-new")){
        console.log(`${(new Date()).toISOString()} ${eventName} ${device.model} ${device.alias} ${device.host}:${device.port}`);
        saveDevice(device, 1);
    }
    else if (eventName === "device-offline") {
        console.log(`${(new Date()).toISOString()} ${eventName} ${device.model} ${device.alias} ${device.host}:${device.port}`);
        saveDevice(device, 0);
    }
    else {
        console.log("ALERT **** Did not save record as did not know what sort of event it is");
        console.log(`${(new Date()).toISOString()} ${eventName} ${device.model} ${device.alias} ${device.host}:${device.port} ${stateString}`);
    }
};

// Client events `device-*` also have `bulb-*` and `plug-*` counterparts.
// Use those if you want only events for those types and not all devices.
client.on('device-new', (device) => {
    logEvent('device-new', device);
    device.startPolling(6000);

    // Device (Common) Events
    device.on('emeter-realtime-update', (emeterRealtime) => { logEvent('emeter-realtime-update', device, emeterRealtime); });
});
client.on('device-online', (device) => { logEvent('device-online', device); });
client.on('device-offline', (device) => { logEvent('device-offline', device); });

console.log('Starting Device Discovery');
console.log(client.startDiscovery());


// https://www.npmjs.com/package/tplink-smarthome-api
// https://github.com/plasticrake/tplink-smarthome-api/blob/master/API.md

// 192.168.0.35 printers 66ff7b01e290
// 192.168.0.84 bed 68ff7b01e6ed
// 192.168.0.96 kitchen fridge 66ff7b01e645
// 192.168.0.99 office workbench 66ff7601e648
// 192.168.0.108 fridge d80d17ce507c
// 192.168.0.109 aaron bed 68ff7b01e2da
