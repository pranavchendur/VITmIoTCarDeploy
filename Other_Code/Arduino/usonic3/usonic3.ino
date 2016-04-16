
#include "Ultrasonic.h"
Ultrasonic ultrasonic(6,7);
const int led1 = 13;

long microsec1 = 0;
float distance1 = 0;

int status1;


void setup () {
Serial.begin(9600); 

pinMode(led1,OUTPUT);
}

void loop () {
microsec1 = ultrasonic.timing(); 
distance1 = ultrasonic.convert(microsec1, Ultrasonic::CM); 

if (distance1 > 30) {
  digitalWrite(led1,HIGH);
  status1 = 404;
}
else {
  digitalWrite(led1,LOW);
  status1 = 200;
}
  
Serial.println("3");
Serial.println(status1);
//Serial.print(distance1);
//Serial.println(" cm");
delay(1000);
}

