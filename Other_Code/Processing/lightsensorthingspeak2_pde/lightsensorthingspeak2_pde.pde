/**
 * Tests the thinkspeak channel by sending any numeric 
 * keypress using the specified APIKEY and FIELD
 */

import processing.serial.*;
import processing.net.*;
import http.requests.*;

//CONFIGURATION
int PORTNUM = 0; //port number of your arduino
//END CONFIGURATION

Serial arduino;
Client c;
String data;
int number,field; //read from arduino

void setup() {
  size(600, 400);

  //setup the serial port
  // List all the available serial ports:
  println(Serial.list()[PORTNUM]);
  //Init the Serial object
  arduino = new Serial(this, Serial.list()[PORTNUM], 9600);
}

void draw() {
  background(50);
  fill(255);
  text("Data Processor", 10, 20);

  //if we have a new line from our arduino, then send it to the server
  String ln;
  if( (ln = arduino.readStringUntil('\n')) != null) {
    try {
        field = new Integer(trim(ln));
        ln = arduino.readStringUntil('\n');
        number = new Integer(trim(ln));
        if (field < 10 && number>100) {
          println("Writing " + number + " to field " + field);
          sendNumber(number,field);
        }
    }
    catch(Exception ex) {
  
    }
  }
}

void sendNumber(int num, int field) {
  PostRequest post = new PostRequest("http://iotmcar.azurewebsites.net/slot.php?slot="+field+"&state="+num);
  println("field"+ field);
  post.send();
  println("Reponse Content-Length Header: " + post.getHeader("Content-Length"));
  //azurePost(number,field);
}

//void azurePost(int num, int field) {
//  String po;
//  PostRequest post2 = new PostRequest("https://iotmcare.azure-mobile.net/tables/datastore");
//  post2.addHeader("X-ZUMO-APPLICATION", "DIxyzBoGouxqPaojoTezZFWtiVsdxF24");
//  post2.addData("slot", Integer.toString(field));
//  if (num==404) po = "Free";
//  else po = "Parked";
//  post2.addData("value", po);
//  post2.send();
//  println("Reponse 2 Content-Length Header: " + post2.getHeader("Content-Length"));
//}