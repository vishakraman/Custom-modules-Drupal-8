This module contains
--------------------

1. Webform Yaml code to import on your site. (Please find the webform.yml file and copy the code and import it manually on your webform).

2. When the user submits the webform, it fetches the values from the hook_form_alter() in the .module file (in your case please add the form id correctly) and updates the veeva id and destination link in the db, and generate a random deeplink or url. 

3. When the user visits the newly generated URL, they are redirected to the destination link which is submitted in the webform field. This functionality is achieved using the Event subscribers.

4. There is also link to display all the submitted webform values in a table where the user performs the CRUD operations (/referrallinks). We also have two forms, one to update and other one to delete. The CRUD operations code are copied from the (https://www.valuebound.com/resources/blog/how-to-create-custom-form-crud-create-delete-update-operations-drupal-8) and modified accordingly. 

