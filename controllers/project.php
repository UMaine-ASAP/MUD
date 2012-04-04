<?php

require_once('libraries/Idiorm/idiorm.php');
require_once('libraries/Paris/paris.php');
require_once('libraries/constant.php');

class ProjectController
{
	/**
	 *	Create a new Project object with the specified creator_id, name, abstract, description, and privacy.
	 *		@param int creator_user_id is the ID of the user creating the project
	 *		@param string name is the name of the project
	 *		@param string abstract is the abstract of the project
	 *		@param string description is the description of the project
	 *		@param bool privacy is the privacy of the project
	 *
	 *	@return the created Project object if successful, false otherwise.
	 */
	static function createProject($name, $abstract, $description, $privacy)
	{
		// Check for creation privileges

		if (!$project = Model::factory('Project')->create())
		{
			return false;
		}

		$project->creator_user_id = USER_ID;	// Check for calling USER ID
		$project->name = $name;
		$project->abstract = $abstract;
		$project->description = $description;
		$project->private = $privacy;

		if (!$project->save())
		{
			$project->delete();
			return false;
		}

		return $project;
	}

	/**
	 *	Edit a specific project, if the current user has permissions.
	 * 		@param int id is the ID of the project being edited
	 *		@param string abstract is the abstract of the project. The abstract will not be changed if an empty string is passed.
	 *		@param string is the description of the project. The description will not be changed if an empty string is passed
	 *		@param bool privacy is the project's privacy (TRUE for private, FALSE for public)
	 *
	 *	@return true if the project was successfully edited, false otherwise
	 */
	static function editProject($id, $abstract, $description, $privacy)
	{
		$project = self::getProject($id);

		if (!$project)
		{
			return false;
		}

		// Check for editing permissions

		if (!is_null($abstract))	{ $project->abstract = $abstract; }
		if (!is_null($description))	{ $project->description = $description;	}
		if (!is_null($privacy))		{ $project->privacy = $privacy; }

		return $project->save();
	}

	/**
	 * Deletes a specific project that the user owns.
	 *		@param int id is the ID of the project to delete
	 *
	 *	@return true if the project was successfully deleted, otherwise false
	 */
	static function deleteProject($id)
	{
		$project = self::getProject($id);

		if (!$project)
		{
			return false;
		}

		// Check for deletion permissions

		return $project->delete();
	}

	/**
	 * Returns a Project for viewing by the caller.
	 * Checks that caller has viewing permissions for the Project.
	 * 		@param int id is the ID of the project to view.
	 *
	 * @return The Project object if successful, false otherwise.
	 */
	static function viewProject($id)
	{
		$project = self::getProject($id);
		
		if (!$project)
		{
			return false;
		}

		// Check for viewing permissions
		
		return $project;
	}


	/**
	 * Retrieve a specific Project object.
	 *		@param int id is the ID of the project to retrieve.
	 *
	 * @return the Project object requested if found, otherwise false
	 */
	private static function getProject($id)
	{
		return Model::factory('Project')->find_one($id);
	}
}

?>
