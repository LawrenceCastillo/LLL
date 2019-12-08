# LLL
matchmaking application
(for educational purposes)

Application Stack (LAMP)
CSS<br>
HTML<br>
PHP<br>
MySQLi<br>
MariaDB<br>
Apache<br>
Raspbian<br>
Raspberry Pi<br>

The original iteration of this app ran on a Pi 4; with static IP 
and port forwarding, I deployed it over the web for a brief period 
of time. 

The app proposes to set individuals up on blind dates; no pictures 
are to be exchanged (and in some cases, real names may be omitted)
while the algorithm deployed is borrowed from Gretchen Rubin's book
"The Four Tendencies." After users answer a brief quiz, their type 
is derived and a match is automatically generated. They are then 
invited to make contact with that person within 24 hours; once the
time has elapsed, the match disappears-- 2 key points to this app
are that: 1) user profiles are not public, and only accessible if a 
match is created; and 2) only one match may be created at a time.
