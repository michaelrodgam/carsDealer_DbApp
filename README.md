#Car Dealer Database Application.

This is an academic project, part of the "Building Database Applications in PHP" course from University of Michigan, available on Coursera. I will get a certification when I finish this project.

I'm using XAMP (Windows, Apache web server, MySQL database manager and PHP) to build this app.





[Specifications from the professor Chuck about the project]

(...) The changes to index.php are new wording and pointing to autos.php to test for login bypass.

Specifications for the Login Screen
Much of the login.php is reused and extended from the previous assignment [Course 1 Week 8 - Building Web
Applications in PHP, Rock Paper Scissors]. The salt and hash computation and most of the error checking comes
across unchanged. The password continues to be 'php123'.

The login screen needs to have some error checking on its input data. If either the name or the password field
is blank, you should display a message of the form:

Email and password are required

Note that we are using "email" and not "user name" to log in in this assignment.

If the password is non-blank and incorrect, you should put up a message of the form:

Incorrect password

For this assignment, you must add one new validation to make sure that the login name contains an at-sign (@)
and issue an error in that case:

Email must have an at-sign (@)

If the incoming password, properly hashed matches the stored stored_hash value, the user's browser is
redirected to the autos.php page with the user's name as a GET parameter using:

header("Location: autos.php?name=".urlencode($_POST['who']));

You must also use the error_log() function to issue the following message when the user fails login due to a
bad password showing the computed hash of the password plus the salt:

error_log("Login fail ".$_POST['who']." $check");

When the login succeeds (i.e. the hash matches) issue the following log message:

error_log("Login success ".$_POST['who']);

Make sure to find your error log and find those error messages as they come out:

[11-Feb-2016 15:52:03 Europe/Berlin] Login success csev@autos.com

[11-Feb-2016 15:52:13 Europe/Berlin] Login fail csev@autos.com 047398bd0e0171f4954760f5f542121a

Specifications for the Auto Database Screen
In order to protect the database from being modified without the user properly logging in, the autos.php must
first check the $_GET variable to see if the user's name is set and if the user's name is not present, the
autos.php must stop immediately using the PHP die() function:

die("Name parameter missing");

To test, navigate to autos.php manually without logging in - it should fail with "Name parameter missing".

If the user is logged in, they should be presented with a screen that allows them to append a new make,
mileage and year for an automobile. The list of all automobiles entered will be shown below the form. If there
are no automobiles in the database, none need be shown.

If the Logout button is pressed the user should be redirected back to the index.php page using:

header('Location: index.php');

When the "Add" button is pressed, you need to do some input validation.

The mileage and year need to be integers. If is suggested that you use the PHP function is_numeric() to
determine if the $_POST data is numeric. If either field is not nummeric, you must put up the following
message:

Mileage and year must be numeric

Also if the make is empty (i.e. it has less than 1 character in the string) you need to put out a message as
follows:

Make is required

Note that only one of the error messages need to come out regardless of how many errors the user makes in
their input data. Once you detect one error in the input data, you can stop checking for further errors.

If the user has pressed the "Add" button and the data passes validation, you can add the automobile to the
database using an INSERT statement.
When you successfully add data to your database, you need to put out a green "success message:

Record inserted

Once there are records in the database they should be shown below the form to add a new entry.