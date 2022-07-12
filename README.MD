# SETUP

1. Create a database name called 'tms' on your phpMyAdmin UI.
2. on the the database created, go to the import tab and import tms.sql file. This file can be found in `DATABASE FILE ` folder.
3. On the config/config.php file, change the dbname to 'tms' :
   ```php
   define('dbname', 'tms');
   ```
4. run the application on the browser

### May 28, 2022

- I added a properties table to the tms database,
- I created the sql query for inserting data collected from the register property form into the properties table. This was done inside of the partials/properties.php file.

- I added extra fields to the register properties form which was found in partials/tenant.php extra-fields was for collecting the rent starting and ending datetime.

### MAY 30, 2022

### FEATURES COMPLETED SO FAR

- I added a feature that allows the super-admin to register other users and assign different roles to them. The roles currently available are super_admin and sub_admin. ✅

- The login and logout date and time of every sub_admin can be seen by the super admin.✅

- A sub-admin or agent can create or add new properties. ✅

#### 31st MAY, 2022

- Changed UI for the admin dashboard.✅
- An admin can add a tenant and also assign a property.✅

### 1st MAY, 2022

- I added a new table called complaints, This is were complaints made by tenants will be stored and the responses made by the sub-admins will also be stored here.
  This table can be found in DATABASE FILE/complaints.sql file. To add this to your database, you just need to import the complaints.sql file into your `tms` database.

### 2ND MAY, 2022

- A tenant can make a complaint and the complaint can be seen by the sub admin and a response can be given back to the tenant who made a complaint.
- The response to those complaints can be seen by the tenant who made the complaint.

## NOTE

The previous tms database created needs to be dropped/deleted entirely and a new database with same name tms needs to be created and the sql file located in DATABASE FILE folder needs to be added. This is because changes has been made to the entire database.

## CORRECTIONS TO BE IMPLEMENTED

1. Change the sub admin to agent ✅
2. The properties created by the super admin should be shown to the public on the website's home page. The properties that will be displayed will be the properties that are not yet occupied. ✅
3. Properties should be assigned to agents.✅
4. Agents should only see properties assigned to them. ✅
5. A person should be able to apply for rent for a particular property they like. ✅
6. An agent should be able to accept/decline an application from potential tenants. ✅
7. If an agent accepts an application the applicant is assigned that property and he/she becomes the tenant.✅
8. if an agent rejects or declines the application that applicant's details will be deleted.✅
