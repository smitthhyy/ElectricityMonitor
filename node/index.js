const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');
const port = new SerialPort('/dev/ttyS1', { baudRate: 57600 });

let buffer = '';
port.on('data', function(data) {
    buffer += data.toString();
    if (buffer.trim().endsWith('</msg>')) {
        var match = /<watts>(\d*?)<\/watts>/gm.exec(buffer.toString());
        if (match) {
            updateSensor('main-elec', parseInt(match[1]));
        }
        buffer = '';
    }
});

/**
 * Update a sensor.
 *
 * @param id Sensor ID
 * @param value Sensor value
 */
var updateSensor = function(id, value) {
    dataQueue.push({ id: id, value: value, date: new Date().getTime() });
};

/**
 * Main update loop.
 */
var dataQueue = [];
setImmediate(function mainLoop() {
    for (var i = 0; i < dataQueue.length; i++) {
        var data = dataQueue[i];
        console.log('Updating sensor [' + data.id + ', ' + data.date + '] with value: ' + data.value);
    }
    dataQueue = [];
    setTimeout(mainLoop, 6000);
});
