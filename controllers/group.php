<?php

require_once('libraries/Idiorm/idiorm.php');
require_once('libraries/Paris/paris.php');
require_once('libraries/constant.php');
require_once('models/group.php');

/**
 * Group controller.
 *
 * @package Controllers
 */
class GroupController
{
	/**
	 *	Creates a group and adds it to the database.
	 *	User must be logged in with correct privileges.
	 *
	 *		@param string name is the name of the group	(2^16 character max,
	 *			to accomodate names of 255 character Portfolios, etc. appended to)
	 *		@param string description is the description of the group (2^16 character max)
	 *		@param bool private is true if the group is not globally visible, false otherwise
	 *
	 *	@return the Group object if creation was successful, otherwise false
	 */
	static function createGroup($name, $description, $private)
	{
		//We don't currently check for creation privileges, just to make sure that the user is logged in
		if (!$user = AuthenticationController::get_current_user())
		{
			return false;
		}

		if (!$newGroup = Model::factory('Group')->create())
		{
			return false;
		}

		if (!is_null($name))	{ $newGroup->name = $name; }
		if (!is_null($private))	{ $newGroup->private = $private; }

		$newGroup->owner_user_id = $user->user_id;
		$newGroup->description = $description;

		if (!$newGroup->save())
		{
			$newGroup->delete();	// we assume this succeeds, else garbage collects in DB
			return false;
		}

		return $newGroup;
	}

	/**
	 *	Deletes a group with the specified ID.
	 *
	 *	Calling user must have ownership permissions on the Group.
	 *
	 *	@param int id is the ID of the group to delete
	 *
	 *	@return true if deletion was successful, otherwise false
	 */
	static function deleteGroup($id)
	{
		if (!$user = AuthenticationController::get_current_user())
		{
			return false;
		}

		if (!$toDelete = GroupController::getGroup($id))
		{
			return false;
		}

		if ($user->user_id === $toDelete->owner_user_id)
		{
			return $toDelete->delete();
		}

		return false;
	}

	/**
	 * 	Gets a Group object for the purpose of viewing
	 *
	 * 	@param	int		$id		The identifier of the requested Group object.
	 *
	 * 	@return	object|bool		The Group object if successful, false otherwise.
	 */
	static function viewGroup($id)
	{
		if (!$group = GroupController::getGroup($id))
		{
			return false;
		}

		//TODO: Check for viewing permissions
		// $group->permissions

		return $group;
	}

	/**
	 * Gets a Group object with the specified ID.
	 *		@param int id is the ID of the group to look for
	 *
	 *	@return the Group object if one was found, otherwise false
	 */
	private static function getGroup($id)
	{
		return Model::factory('Group')->find_one($id);
	}

	/**
	 * Edits a Group object with the specified ID.
	 *		@param string|null name is the new name of the group
	 *		@param string|null description is the description of the group
	 *		@param bool|null global specifies whether or not the group is global
	 *		@param int|null owner is the owner of the group (still not sure what this corresponds to)
	 *		@param int|null type is the new type of the group
	 *
	 *	@return true if the update was successful, otherwise false
	 */
	static function editGroup($id, $name = NULL, $description = NULL, $global = NULL, $owner = NULL, $type = NULL)
	{
		if (!$groupToUpdate = self::getGroup($id))
		{
			return false;
		}

		//we bring $user into the function's scope so that we can later check permissions
		if (!$user = AuthenticationController::get_current_user())
		{
			return false;
		}

		//TODO: Check for editing permissions
		// $groupToUpdate->permissions

		if (!is_null($name))		{ $groupToUpdate->name = $name; }
		if (!is_null($description))	{ $groupToUpdate->description = $description; }
		if (!is_null($global))		{ $groupToUpdate->global = $global; }
		if (!is_null($owner))		{ $groupToUpdate->owner = $owner; }
		if (!is_null($type))		{ $groupToUpdate->type = $type; }

		return $groupToUpdate->save();
	}
}

?>
