const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');
const port = new SerialPort('/dev/ttyS1', { baudRate: 57600 });
const { Client } = require('tplink-smarthome-api');
const util = require('util');
const sqlite3 = require('sqlite3').verbose();
const parseString = require('xml2js').parseString;

let buffer = '';

port.on('data', function(data) {
    buffer += data.toString();
    if ( (buffer.trim().startsWith('<msg>')) && (buffer.trim().endsWith('</msg>')) && (buffer.trim().includes('<watts>')) ) {
        parseString(buffer, function (err, result) {
            updateSensor('main-elec', result);
        });
        buffer = '';
    }
    if (!buffer.trim().startsWith('<msg>')) {
        console.log("Unrecognized starting: " + buffer);
        buffer = '';
    }
});

let flattenDataObject = function(dataObject) {
    newObject = {
        "src":dataObject['msg']['src'][0],
        "dsb":dataObject['msg']['dsb'],
        "time":dataObject['msg']['time'],
        "sensor":dataObject['msg']['sensor'],
        "id":dataObject['msg']['id'],
        "type":dataObject['msg']['id'],
        "phase1":dataObject['msg']['ch1'][0]['watts'][0],
        "phase2":dataObject['msg']['ch2'][0]['watts'][0],
        "phase3":dataObject['msg']['ch3'][0]['watts'][0]
    };
    return newObject;
};

let updateSensor = function(id, object) {
    object = flattenDataObject(object);
    // console.log(object);
    watts = parseInt(object.phase1, 10) + parseInt(object.phase2, 10) + parseInt(object.phase3, 10);
    console.log("watts = " + watts.toString() + " phase1: " + parseInt(object.phase1, 10).toString() + " + phase2: " + parseInt(object.phase2, 10).toString() + " + phase3: " + parseInt(object.phase3, 10).toString());
    saveToDB(object);
};

let saveToDB = function(object) {
    let db = new sqlite3.Database('/var/lib/cloud9/elecmon/db.sqlite');
    let stmt = db.prepare("INSERT INTO infeed VALUES (?, ?, ?, ?, ?)");
    stmt.run(
        Math.floor(Date.now() / 1000),
        object.phase1,
        object.phase2,
        object.phase3,
        object.total
    );
    stmt.finalize();
    db.close();
};

const client = new Client();

let saveDevice = function (device, state) {
    let db = new sqlite3.Database('/var/www/ElectricityMonitor/database.sqlite');
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
    let db = new sqlite3.Database('/var/www/ElectricityMonitor/database.sqlite');
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

