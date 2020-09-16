#   Doctor Appointment Web Application Design

This is a project for EE4717 Web Application Design

##  Project Details

- You may choose the family clinic or dentist clinic. 
- Your web site should allow patient to browse the background of the doctors and make appointment. 
- Patient registration is needed. When booking an appointment with the doctor, the doctor’s schedule must be shown and the booking is allowed when the doctor is free and available.
- Once an appointment is made, an email notification will be sent to the patient. 
- Both doctor and patient can also reschedule the appointment. 

##  Developing

All scripts are configured to run and initialize database & populate it with neccessary *dummy* data. It's based on the `sql` folders.

### Initializing dummy datas

```bash
php scripts/hard_reset_sql_tables.php
php scripts/init_sql_tables.php
php scripts/populate_sql_tables.php
```

##  Testing

```bash
php tests/test_all.php
```
