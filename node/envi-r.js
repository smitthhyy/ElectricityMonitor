const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');
const port = new SerialPort('/dev/ttyS1', { baudRate: 57600 });
// const sqlite3 = require('sqlite3').verbose();
const mysql = require('mysql');
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
    connection = mysql.createConnection({
        host     : 'localhost',
        port     : 3307,
        user     : 'elecricitymonitor',
        password : 'elecricitymonitor',
        database : 'elecricitymonitor'
    });

    let sql = "INSERT INTO infeed (timestamp, phase_1, phase_2, phase_3, total, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ??, ??)";
    let now = moment(new Date()).format("YYYY-MM-DD HH:mm:ss");
    let inserts = [
        Math.floor(Date.now() / 1000),
        object.phase1,
        object.phase2,
        object.phase3,
        object.total,
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
