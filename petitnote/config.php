<?php
/*Setting items*/

/*------Required setting items-----*/

//Be sure to change the admin password.
$admin_pass = "adminpass";

//Please change the second password.
// Password to double check that you are an admin when posting or deleting with admin privileges.
// You don't have to remember it because it's handled internally.
//The second password cannot be the same as the admin password.
$second_pass = "mGeL5dhpQ8e9ugd";

// name of this board
$boardname = "Petit Note";

// home page (return destination from the bulletin board)
$home = "./"; //relative path, absolute path, URL any

// maximum number of threads that can be stored
// 500 threads minimum.
$max_log = 1000;

// Up to the installation destination URL `/`.
$root_url = "http://example.com/oekaki/";

// require name
// None: Posting an empty name when false makes it "anonymous".
// yes: true no: false

$name_input_required = true;
// $name_input_required = false;

// Limit the number of characters in the body. (unit byte)
$max_com=1000;

/*-----This is the end of the required setting items. -----*/

/* SNS linkage */

// use tweet button
// Display the URL of the thread and a link to tweet the content.
// use: true not use: false

$use_sns_button = true;
// $use_sns_button = false;

/* Switch template */
// up to the template directory `/` initial value "basic/"
$skindir="basic/";

/* message board description */

// You can enter it directly in the template, but you can also enter it here.
// If the description is one line ["Description 1"]
// If the description is 3 lines ["Description 1", "Description 1", "Description 3"]
// Enclose the characters in double quotes and separate them with commas.
// Use [] if no description is needed.

// $descriptions = ["This is a drawing board that allows you to draw on your iPad or smartphone. "];
$descriptions = ["You can draw from PC, iPad or smartphone.","Enjoy drawing."];

/* email notification */

// Notify posts by email
// yes: true no: false

// $send_email = true;
$send_email = false;

// Email address to notify that there was a post
$to_mail = "example@example.com";

/* anti spam */
//Reject if text does not contain Japanese
//Reject: true Do not reject: false

// $use_japanesefilter = true;
$use_japanesefilter=false;

//Reject if this string exists
// If not set, use [].
$badstring = ["example.example.com","Unsolicited ads"];

//URLs to deny
$badurl = ["example.com","www.example.com"];

//unusable name
$badname = ["brand","mail order","sale","review"];

// Reject if both A and B exist
$badstr_A = ["Cheap","Low Price","Copy","Quality Focus","Large Inventory"];
$badstr_B = ["Chanel","Supreme","Balenciaga","Brand"];

// hostname to reject
$badhost =["example.com","example.org"];

/*Settings by Purpose of Use*/

//Use PaintBBS NEO 
// yes: true no: false
$use_paintbbs_neo= true;
// $use_paintbbs_neo= false;

// Use ChickenPaint
// yes: true no: false
$use_chickenpaint= true;
// $use_chickenpaint= false;

//Use Klecks
// yes: true no: false
$use_klecs= true;
// $use_klecs= false;


// allow writing URLs in the body
// to filter spam that writes a URL: false
// Admins can write URLs in the body regardless of the setting.
// yes: true no: false

// $allow_comments_url = true;
$allow_comments_url = false;

// Autolink the URL
// Markdown notation can also be used. [link text](https://example.com/)
// yes: true no: false

$use_autolink = true;
// $use_autolink = false;

// Use the input form on the top page
// No: If False, only draw buttons are visible.
// yes: true no: false

$use_top_form = true;
// $use_top_form = false;

// use image upload function
//If you are logged in with administrator post mode (diary), you can upload files even if you set it to not use.
// use: true not use: false

$use_upload = true;
// $use_upload = false;

// use image upload in reply form
//If you are logged in in admin posting mode (diary mode), you can draw pictures and upload photo files even if you set it to not use.

// use: true not use: false

$use_res_upload = true;
// $use_res_upload = false;

// Whether to allow comment-only posts on new posts.
// None: false, an image is required when creating a new thread.
// yes: true no: false

// $allow_comments_only = true;
$allow_comments_only = false;

// use diary mode
// Yes: if true, new thread creation is restricted to admins only.
// yes: true no: false

// $use_diary = true;
$use_diary = false;

// Only admins can reply
// Yes: true if only admins can reply.
//When used with diary mode, all entries are admin-only posts.

// $only_admin_can_reply = true;
$only_admin_can_reply = false;

// set this entire board as NSFW content
// Yes: If set to true, the image will be blurred until the confirm button is pressed.
// yes: true no: false

// $set_nsfw = true;
$set_nsfw = false;

// Sensitive content settings

// Set sensitive content for each article
// Yes: Set to true to set sensitive content warnings. Blur images of sensitive content.
// yes: true no: false

// $mark_sensitive_image = true;
$mark_sensitive_image = false;

// don't change post date when editing
// Settings when you do not want to change the date for diary purposes, etc.
// Yes: If set to true, editing will not change the post date. Normally none: false .
// yes: true no: false

// $do_not_change_posts_time = true;
$do_not_change_posts_time = false;

// all sage
// yes: set to true to prevent thread position from changing on replies. All will be treated as sage.
// initial value false

//$sage_all = true;
$sage_all = false;

// Add admin mark to posts by admin.
// yes: yes, add admin mark to admin posts.
//If you log in admin mode or if the passwords match, you are considered an admin.
// yes: true no: false

$verified_adminpost = true;
// $verified_adminpost = false;

// Display images of the previous and next threads on the screen below the thread Yes: true No: false
// yes: true no: false

$view_other_works = true;
// $view_other_works = false;


// show latest release version and link on admin page
// yes: true no: false

$latest_var = true;
// $latest_var = false;

/* display result */

//Number of threads to display on one page

$pagedef = 10;

// Number of replies that can be posted in one thread

$max_res = 100;

// number of reply to display in one thread
// Display all when reply screen.

$display=5;

// number of items displayed per page in catalog mode
// Set it in multiples of 6 to fit nicely on the screen.

$catalog_pagedef = 24;

/* image related */

//Maximum size of images that can be posted (kb)

$max_kb = 2048;

//Specify the maximum width and height of the image that can be posted in px.
// Only uploaded images are scaled down. Set the maximum drawing size in another item.
$max_px = 1024;

// Maximum size of width and height that can be drawn

$pmax_w = 800;//width
$pmax_h = 800;//height

// Maximum size of width and height of the image displayed when the thread is parent

$max_w = 800;//width
$max_h = 800;//height

// maximum size of width and height  of the image displayed when replying thread
$res_max_w = 300;//width
$res_max_h = 300;//height

// create a thumbnail if it exceeds the maximum width and height to display
// yes: true no: false

$use_thumb = true;
// $use_thumb = false;

/* secret word setting */

// Require a secret word in posts
// Yes: true requires a secret word for posts.
// Yes: true No: false

// $use_aikotoba = true;
$use_aikotoba=false;

// require a secret word to view the message board
// Yes: true No: false
// Yes: true requires a secret word to view all content on the board.

// $aikotoba_required_to_view=true;
$aikotoba_required_to_view=false;

// Secret word
// Secret answer to enter when either or both of the secret word setting above are true.
// Change as needed.
$aikotoba = "secret";

/* safety */

//Reject if admin password is wrong for her 5 times in a row
// yes: true no: false
// yes: true for more security, but if the login page is locked it will take more effort to unlock it.

// $check_password_input_error_count = true;
$check_password_input_error_count = false;

// Access via ftp etc.
// Remove the `template/errorlog/error.log`
// and you should be able to login again.
// This file contains the IP addresses of clients who entered an incorrect admin password.


/*Advanced Setting*/

// days in days before automatically closing old threads
// prevent spamming old threads
// For example, the default setting of 180 prevents users from replying to threads that were created half a year ago.
// 0 for unlimited days.

$elapsed_days=180;

// reject all posts
// Set this if the administrator is away for a long time or wants to display only.
// Yes: true, disallow all posts. Initial value false.
// yes: true no: false

// $deny_all_posts = true;
$deny_all_posts = false;


// default value of timezone is "asia/tokyo"
// Please change it according to your living area.

date_default_timezone_set("asia/tokyo");

// Deny display in iframe: true Allow: false
// "Deny: true" is highly recommended to avoid security risks.

$x_frame_options_deny=true;
// $x_frame_options_deny=false;

/* Message for notification mail */

define("NOTICE_MAIL_IMG", "Picture");
define("NOTICE_MAIL_THUMBNAIL", "Thumbnail");
define("NOTICE_MAIL_URL", "Fixed link");
define("NOTICE_MAIL_REPLY", " Notification: There is a new reply to a post.");
define("NOTICE_MAIL_NEWPOST", " Notification: There is a new post");

/* usually don't change */

// Encrypt the $pwd of the paint screen

define("CRYPT_PASS","v25Xc9nZ82a5JPT");//Crypt key initial value
define("CRYPT_METHOD","aes-128-cbc");
define("CRYPT_IV","T3pkYxNyjN7Wz3pu");//16 single-byte alphanumeric characters

/* Do not change this part */

// temporary
define("TEMP_DIR","temp/");
//log
define("LOG_DIR","log/");
//image
define("IMG_DIR","src/");
//thumbnail
define("THUMB_DIR","thumbnail/");
