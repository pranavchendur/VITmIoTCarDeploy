#include "Ultrasonic.h"
Ultrasonic ultrasonic(6,7);
Ultrasonic ultrasonic2(4,3);

const int led1 = 13;
const int led2 = 10;

long microsec1 = 0;
float distance1 = 0;

int status1,status2;

long microsec2 = 0;
float distance2 = 0;

void setup () {
Serial.begin(9600); 

pinMode(led1,OUTPUT);
pinMode(led2,OUTPUT);
}

void loop () {
microsec1 = ultrasonic.timing(); 
distance1 = ultrasonic.convert(microsec1, Ultrasonic::CM); 

microsec2 = ultrasonic2.timing(); 
distance2 = ultrasonic2.convert(microsec2, Ultrasonic::CM); 

if (distance1 > 30) {
  digitalWrite(led1,HIGH);
  status1 = 404;
}
else {
  digitalWrite(led1,LOW);
  status1 = 200;
}

if(distance2 > 30){
  digitalWrite(led2,HIGH);
  status2 = 404;
}
else {
  digitalWrite(led2,LOW);
  status2 = 200;
}
  
Serial.println("1");
Serial.println(status1);
//Serial.print(distance1);
//Serial.println(" cm");
Serial.println("2");
Serial.println(status2);
//Serial.print(distance2);
//Serial.println(" cm");
delay(1000);
}
