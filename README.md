# TAIMI
Easy-to-use time and task tracking for all kinds of projects!
TAIMI (Samoan for *Time*) is a simple web app to manage various projects for one or more 
different customers or clients. 

##Current features
+ Enter tasks and assign a status of accomplishment (*open*, *in progress*, *paused* and *done*)  
+ Prioritize every job so you always know what the next step is
+ Add all your clients and link a task to the corresponding customer. This way you
never forget what you're spending your time (and money!) for
+ Keep track of the working time and what you've been doing
+ Quickly get an overview of the working time of the last important periods (today, yesterday, 
current week and month, last month etc.)

![alt text](https://github.com/ElKroketto/Taimi/blob/master/static/img/screenshot.png "Screenshot projects summary")

> TAIMI is based on open source-projects and **licensed under MIT** so you're free and welcome to 
use the project as a base for your custom features. Furthermore I'll be more than happy to respond
to your ideas concerning TAIMI!

##Setup
Quick and easy! You need a web server supporting PHP and a SQL-database, e.g. MySQL or PostgreSQL. 

1. Create an empty database and copy/paste the database hostname, name, user and password into dao/DB_config.php
2. Change the variable $updateScheme in index.php to *TRUE*
3. Upload everything to your webserver and open up the TAIMI-directory in your web browser
4. All necessary database tables are created automatically. Edit index.php again and change the
value of $updateScheme back to *FALSE* 
5. Upload index.php and follow the instructions on the login-page on how to create a new username and password.
6. DONE!
