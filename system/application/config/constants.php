<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
 |---------------------------------------------------------------------------------------------------
 |requestmanager constants
 |---------------------------------------------------------------------------------------------------
 */

/*define('CATEGORY_1','District 2, Registered');
define('CATEGORY_2','District 2, Not registered');
define('CATEGORY_3','QC Resident, Not District 2');
define('CATEGORY_4','Outside QC');

define('SEX_1','male');
define('SEX_2','female');

define('STATUS_1','New');
define('STATUS_2','Rejected');
define('STATUS_3','Pending');
define('STATUS_4','Complete');*/

function array_get($key,$index=NULL) {
  $req_constants = array (
    'CATEGORY_1'=>'District 2, Registered',
    'CATEGORY_2'=>'District 2, Not registered',
    'CATEGORY_3'=>'QC Resident, Not District 2',
    'CATEGORY_4'=>'Outside QC',
    'SEX_1'=>'male',
    'SEX_2'=>'female',
    'STATUS_1'=>'New',
    'STATUS_2'=>'Rejected',
    'STATUS_3'=>'Pending',
    'STATUS_4'=>'Complete'
  );
  return is_null($index) ? $req_constants[$key] : $req_constants[$key."_".$index] ;
}

/*define('STATUS_NEW',1);
define('STATUS_NEW',2);
define('STATUS_NEW',2);
define('STATUS_NEW',2);*/


/* End of file constants.php */
/* Location: ./system/application/config/constants.php */