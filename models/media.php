<?php
require_once('../dev.php');

require_once(dirname(__FILE__) . '/../libraries/Idiorm/idiorm.php');
require_once(dirname(__FILE__) . '/../libraries/Paris/paris.php');
include_once(dirname(__FILE__) . '/../libraries/constant.php');

ORM::configure('mysql:host=localhost;dbname=mainejournal');
ORM::configure('username', 'root');
ORM::configure('password', '');

DEFINE("USER_ID", 2);

/**
 *	Media model object
 *
 *	A Media object represents a single row in the REPO_Media table, along with
 *	all associated data derived from its relations.
 *
 *	Information retrieved through relations:
 *	- permissions: specified based on the requesting user. Return value corresponds
 *	  to an enumerable value as specified in 'constants.php'.
 *
 * 	@package Models
 */
class Media extends Model
{
	public static $_table = "REPO_Media";
	public static $_id_column = "media_id";

	private static function begin() {
		$orm = Model::factory('Media')->table_alias('media');

		// Add permissions and group tables
		$orm->left_outer_join('REPO_Media_access_map', array('media.media_id', '=', 'permission.media_id'), 'permission');

		return $orm;
	}

	private function hasPermission($permission) {
		switch ($permissionType) {
			case 'view':
				//User is owner or user in group with permissions
				$this->join('AUTH_Group_user_map', array('permission.group_id', '=', 'group.group_id'), 'group')
					->where('group.user_id', $requesterID);
			break;
			case 'edit':

			break;
			case 'delete':

			break;
			default:
				// No permission with that name!
			break;
		}
		return $orm->where('permission.access_type', $permission);
	}

	// An array of media objects owned by a particular user
	// Note that this does not include binary data
	public static function userMedia($ownerID)
	{ 
		return Media::begin()->where('creator_user_id', $ownerID)->find_many();
	}

	// Binary data for a particular media item
	public function mediaData($mediaID)
	{
		$object = Media::begin()->hasPermission('view')->find_one($mediaID);
		// @TODO: Read binary data from server
		// @TODO: Add to object
		return $object;
	}

	// Publically available media
	public function publicMedia()
	{

	}
	
}

$objects = Media::userMedia(2);

foreach ($objects as $object) {
print_r($object);
	print $object->title;	
	print $object->access_type;
}




