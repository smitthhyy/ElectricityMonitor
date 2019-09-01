const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');
const port = new SerialPort('/dev/ttyS1', { baudRate: 57600 });

var parseString = require('xml2js').parseString;

let buffer = '';
port.on('data', function(data) {
    buffer += data.toString();
    if ( (buffer.trim().startsWith('<msg>')) && (buffer.trim().endsWith('</msg>')) ) {
        parseString(buffer, function (err, result) {
            updateSensor('main-elec', result);
        });
        buffer = '';
    }
});

var updateSensor = function(id, object) {
    watts = parseInt(object.msg.ch1[0].watts[0], 10) + parseInt(object.msg.ch2[0].watts[0], 10) + parseInt(object.msg.ch3[0].watts[0], 10);
    console.log("phase1: " + parseInt(result['msg']['ch1'][0]['watts'][0], 10).toString() + " + phase2: " + parseInt(result['msg']['ch2'][0]['watts'][0], 10).toString() + " + phase3: " + parseInt(result['msg']['ch3'][0]['watts'][0], 10).toString());
    dataQueue.push({ id: id, value: watts, date: new Date().getTime() });
};

var dataQueue = [];
setImmediate(function mainLoop() {
    for (var i = 0; i < dataQueue.length; i++) {
        var data = dataQueue[i];
        console.log('Updating sensor [' + data.id + ', ' + data.date + '] with value: ' + data.value);
    }
    dataQueue = [];
    setTimeout(mainLoop, 6000);
});

