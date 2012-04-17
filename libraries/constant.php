<?php
/**
 * Library of global constants in the system.
 *
 * @package Constants
 */

/******************************************
 ****** TEST USER ID 				 ******
 ****** DEVELOPMENT ENVIRONMENT ONLY ******
 *****************************************/
DEFINE("USER_ID", 2);



/**
 * Permission types.
 * Constant mapping of integer values to standard permission names.
 * Permissions constitute a heirarchy, whereby each permission also grants all permissions
 * below it (i.e. EDIT privilege also grants READ and SUBMIT to the User/Group)
 */
/**
 * OWNER
 * Has overarching total permission of an object (including deletion).
 */
DEFINE("OWNER",	1);
/**
 * WRITE
 * Has ability to write to or add to an object (i.e. can add to a Portfolio).
 */
DEFINE("WRITE", 2);
/**
 * EDIT
 * Has the ability to write to an object's properties, but not add additional objects
 * (i.e. cannot add to Portfolio, Group, etc. but can modify name, etc.).
 */
DEFINE("EDIT", 	3);
/**
 * READ
 * Has the ability to read an object's values only.
 */
DEFINE("READ",	4);
/**
 * SUBMIT
 * Has the ability to submit resources as sub-resources (i.e. submit a Project/Portfolio to a Portfolio)
 */
DEFINE("SUBMIT", 5);


/**
 * Project types.
 */
DEFINE("ARTICLE", 1);
DEFINE("GALLERY", 2);

?>
