const { Client } = require('tplink-smarthome-api');
const util = require('util');
let sqlite3 = require('sqlite3').verbose();

const client = new Client();

let saveDevice = function (device, state) {
    let db = new sqlite3.Database('/var/lib/cloud9/elecmon/db.sqlite');
    let stmt = db.prepare("REPLACE INTO hs110_details VALUES (?, ?, ?, ?, ?)");
    stmt.run(
        device.macNormalized.toLowerCase(),
        device.alias,
        device.host,
        device.port,
        state
    );
    stmt.finalize();
    db.close();
};

let saveMetrics = function (device, state) {
    let db = new sqlite3.Database('/var/lib/cloud9/elecmon/db.sqlite');
    let stmt = db.prepare("INSERT INTO hs110 VALUES (?, ?, ?, ?, ?, ?)");
    stmt.run(
        device.macNormalized.toLowerCase(),
        Math.floor(Date.now() / 1000),
        state.voltage_mv,
        state.current_ma,
        state.power_mw,
        state.total_wh
    );
    stmt.finalize();
    db.close();
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
client.startDiscovery();


// https://www.npmjs.com/package/tplink-smarthome-api
// https://github.com/plasticrake/tplink-smarthome-api/blob/master/API.md

// 192.168.0.35 printers 66ff7b01e290
// 192.168.0.84 bed 68ff7b01e6ed
// 192.168.0.96 kitchen fridge 66ff7b01e645
// 192.168.0.99 office workbench 66ff7601e648
// 192.168.0.108 fridge d80d17ce507c
// 192.168.0.109 aaron bed 68ff7b01e2da
