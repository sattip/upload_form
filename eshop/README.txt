/////////////////////////////////////////////////////////////////
//
//OVERVIEW:
//
//BASED on PlainCart from http://www.phpwebcommerce.com/plaincart.
//
//Etomised by Cris D. 2008/02/02 for Etomite V 0.6.1.4
//
//USE: Provides a complete on-line shop including categories, paypal, admin reports, order tracking and FULLY integrated to //use in your Etomite site so that you can take advantage of Etomites' Awesome templating ability.
//
//Once you have configured all the files and set the shop up, all you will need to do is call [!shop_controller.php!] in the //page where you want your shp to show. 
//
/////////////////////////////////////////////////////////////////
SHOP CONFIGURATION:

1) Extract the plaincart.zip to the correct folder in your site installation.
2) Create the database and tables
3) CREATE the page in your etomite installation where your shop will show. (yes, it only uses one page)!
4) Configure the config.php file
5) Open the snippet files and save into the snippet library
6) Configure the shop_controller snippet
7) Log into the shop admin
8) Processing orders & Paypal testing

###################  STEP 1  ##############################################
1)Extract the plaincart.zip to the correct folder in your site installation.
The folder should look like :

[etomite installation]/plaincart/

ie place the folder plaincart in the same folder as your etomite index.php file.  You an change the location of these files but will need to change the paths of many of the include files.




##################  STEP 2  ###############################################
2) Create the database and tables

Create the database/table to hold the shop data.

Although this shop is well integrated into etomite, it's data functions are completely separate from etomite's.
It is for this reason, you can use an completely separate database from your etomite installation for this shop, or if you like, you can use the etomite installation database.

Import the sql file: etomite_plaincart_SQL.sql file in phpMyAdmin and it will create all the tables required.


//////////////////////////////////////////////////////////////
//  CAUTION: If you have tables with the same names as:///////
//////////////////////////////////////////////////////////////

tbl_cart
tbl_category
tbl_currency
tbl_order
tbl_order_item
tbl_product
tbl_shop_config
tbl_user

They may be deleted and overwritten!


####################  STEP 3  #############################################
3) CREATE the page in your etomite installation where your shop will show. (yes, it only uses one page)!
This page will need to be "uncached", must be published and must not be authenticated (unless you only want registered members to see it).  Take not of the URL, this will depend on whether you have Friendly URLs turned on or off.  You will need this URL later...


####################  STEP 4  #############################################
4) Configure the config.php file
Open the file plaincart/library/config.php with a text editor

Configure the following variables
// database connection config
$dbHost = 'localhost';//or http url
$dbUser = 'root'; //username
$dbPass = 'yourdatabasepassword';
$dbName = 'databasename';

// these are the directories where we will store all
// category and product images
define('CATEGORY_IMAGE_DIR', 'images/category/');//I have NOT tested having this outside the plaincart installation!
define('PRODUCT_IMAGE_DIR',  'images/product/');//I have NOT tested having this outside the plaincart installation!
//also set other image properties controlling width, height etc here.

//load the various paypal variables for external files to access
//These are sent off to paypal from the include/paypal.inc.php file

define('PAYPAL_BUSINESSNAME', 'aaa@bbb.ccc.dd');//must be your paypal account email
define('PAYPAL_SITE_URL', 'http://www.domain.com');
define('PAYPAL_IMAGE_URL',"");
define('PAYPAL_SUCCESS_URL', "http://www.domain.com/index.php?id=69&nav=success");//The page where your shop will be shown
define('PAYPAL_CANCEL_URL', "http://www.domain.com/index.php?id=69&nav=error");//The page where your shop will be shown
define('PAYPAL_NOTIFY_URL',"plaincart/include/paypal/ipn.php");
define('PAYPAL_RETURN_METHOD',"2");//1=GET 2=POST --> Use post since we will need the return values to check if order is valid
define('PAYPAL_CURRENCY_CODE',"USD");//['USD,GBP,JPY,CAD,EUR']               
define('PAYPAL_LC',"US"); 

Save all the changes to the config.php file and close it.


#####################  STEP 5  ##########################################
5) Open the snippet files and save into the snippet library
Each of the files in the plaincart/snippets folder will need to be opened with a text editor (suggest notepad with wordwrap turned OFF).
Copy and paste each of them as a new snippet, calling the the same names as at the top if the file.
eg "shop_controller.php"

There are 11 snippets:
shop_cart.php
shop_categoryList.php
shop_controller.php
shop_checkoutConfirmation.php
shop_error.php
shop_miniCart.php
shop_paypal_payment.php
shop_paypal.ipn
shop_productDetail.php
shop_productList.php
shop_shippingAndPaymentInfo.php
shop_success.php

Now you might be starting to panic about now, but don't worry, you will only need to call ONE snippet in your page:

[!shop_controller.php!]

If you have difficulty opening the shop_paypal.ipn file because of the extension, open it with notepad.

Open the CHUNKS folder and you can copy and paste the shop_plaincart.css into your chunk library and call it into your template if you wish.


####################  STEP 6  ##########################################
6) Configure the shop_controller snippet

There are a few variables to make the shop your own in this snippet... you can set:

// Stops the script being sent to paypal  set to true to turn on sandbox mode.  Default is off.
$sandbox=isset($sandbox)? $sandbox:false;// [true || false] default:false;

//How many categories per row in your shop front?
$categoriesPerRow=isset($categoriesPerRow) ? $categoriesPerRow : 3;//default 3.

//How many products per row when browsing by category?
$productsPerRow  = isset($productsPerRow)  ? $productsPerRow: 2;//default 2.

//How many products per page when browsing by category?
$productsPerPage = isset($productsPerPage) ? $productsPerPage: 4;//default 4.


################## STEP 7  #############################################
7) Log into the shop admin

I have intentionally kept this shop with a separate admin log-in script for a few reasons:
With the soon-to be released 0.6.1.5 and hopefully soon cocoon, and all the talk in the forums about authentication, I did not want to spend hours integrating it with an obsolete codebase.  Also, Etomite has some limitations with roles and group permissions, so it is not easy to limit access to some areas, so a separate username and authentication may prove beneficial. Also, as I don't really need this code (I only wanted to integrate the cart but got carried away), I didn't see a point in doing excessive work and put my other paid projects on hold... So if you want integrated authentication, feel free to start writing...:)

Now to log into admin, you will need to point your browser to the plaincart/admin/index.php file.

The default username is admin and the default password is password.  It is highly recommended that you change this once your site is live.

Once you log in you will be able to view, add, edit delete categories, products, set stock levels, view orders, customer memos and other things admin likes to do...

I have also included a link to this admin log-in page which shows up at the top of the shop if you have the authenticate_visitor snippet installed on your site and you have logged in, otherwise it is hidden from view for the public.


##################  STEP 8  ###########################################
8) Processing orders & Paypal Testing

One of the variables mentioned in STEP 6 of this README is $sandbox.  I'm going to explain more about this here.
The guy who wrote this original plaincart package was kind enough to set up a sandbox account with paypal  He provided a business address, URL, email, username and password all to test his original shop.  I don't feel right giving out his details from a hybrid of his work but if you want to set up the sandbox with his details, you can view them in the original package at http://www.phpwebcommerce.com/plaincart.  However, it is fairly easy to set up your own account with paypal (and lets face it, if you are up to step 8 you are probably serious about doing this, so lets get you hooked up.  You will need to register for an account and use the email, and set the config.php file to use the 

define('PAYPAL_URL',"https://www.sandbox.paypal.com/cgi-bin/webscr"); 

Once you are sure it is working, you can use the proper url:

define('PAYPAL_URL',"https://www.paypal.com/cgi-bin/webscr");

to send orders off in earnest.

Now if you want to test your shop before you set up your sandbox account, if you set $sandbox=1 in the snippet variables, it will pretend to send the order off and show you a success message without actually sending ANYTHING off (even to the paypal sandbox).  When you want to test your paypal sandbox account, you must set $sandbox=false; in the snippet config.  This will let sandbox AND real orders be posted out.

Once a paypal order is sent off, paypal sends a confirmation post back to your shop page with 'action=ipn'.  Here the order is confirmed if payment was received and the order status is changed to "paid" in the orders table.

Receive email notifiation:  This can be done in 2 ways: 
  1) Set the admin/shopconfig to 'yes' (I want to receive email notification of orders sent).  This will send a notification of there is a cash order OR a paypal order.
  2) The shop_paypal.ipn snippet (at the bottom) automatically sends an email of a successfully paid order for PAYPAL ONLY.

IPN Error Logging: If you want to see if a paypal order was successfully verified of an attempt at fraudlent attempts or errors, all the info paypal posts to your site is stored in a file in the root of your site called '.ipn_results.log'.
You can turn this log off by setting $this->ipn_log = true;  to $this->ipn_log = false; in the shop_paypal.ipn snippet.


Now, if you want to send other methods of payment off, you will see in the shop_config.php snippet that all the paypal stuff is retrieved through $etomite->runSnippet();   This means that if you added other methids of payment to the confirm_order snippet, you could test for them in the shop_config and action them in a similar way to the paypal process without changing heaps of code either within the shop or your etomite site.

################  DISCLAIMER  ########################################
Good luck, and don't forget... This is provided FREE OF CHARGE with NO WARRANTIES for PERFORMANCE in REAL WORD SHOPS, I have not really tested it completely and definately not in a working commercial environment.  If you do choose to do so, you take ALL the RISK!

Cheers,

Cris D.
