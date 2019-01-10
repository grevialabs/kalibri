Install Reques in Vendor
-----------------------------
Add this line of code to withFacades() function on /vendor/laravel/lumen-framework/src/Application.php file

class_alias('Illuminate\Support\Facades\Request', 'Request');