<?php

require_once(__DIR__ . '/../libraries/Idiorm/idiorm.php');
require_once(__DIR__ . '/../libraries/Paris/paris.php');

class ProjectMediaMap extends Model
{
	public static $_table = 'REPO_Project_media_map';
	public static $_id_column = 'id';

	public function project()
	{
		return Model::factory('Project')->where('proj_id', $this->proj_id)->find_one();
	}

	public function media()
	{
		return Model::factory('Media')->where('media_id', $this->media_id)->find_one();
	}
}

class SectionAccessMap extends Model
{
	public static $_table = 'REPO_Section_access_map';
	public static $_id_column = 'id';

	public function section()
	{
		return Model::factory('Section')->where('section_id', $this->section_id)->find_one();
	}

	public function group()
	{
		return Model::factory('Group')->where('group_id', $this->group_id)->find_one();
	}
}

class PortfolioProjectMap extends Model
{
	public static $_table = 'REPO_Portfolio_project_map';
	public static $_id_column = 'id';

	public function portfolio()
	{
		return Model::factory('Portfolio')->where('port_id', $this->port_id)->find_one();
	}

	public function project()
	{
		return Model::factory('Project')->where('proj_id', $this->proj_id)->find_one();
	}
}

class AssignmentAccessMap extends Model
{
	public static $_table = 'REPO_Assignment_access_map';
	public static $_id_column = 'id';
}

class PortfolioAccessMap extends Model
{
	public static $_table = 'REPO_Portfolio_access_map';
	public static $_id_column = 'id';
}

class MediaAccessMap extends Model
{
	public static $_table = 'REPO_Media_access_map';
	public static $_id_column = 'id';
}

class ProjectAccessMap extends Model
{
	public static $_table = 'REPO_Project_access_map';
	public static $_id_column = 'id';
}

// class GroupUserRoleMap extends Model
// {
// 	public static $_table = 'AUTH_Group_user_role_map';
// 	public static $_id_column = 'id';
// }

class GroupUserMap extends Model
{
	public static $_table = 'AUTH_Group_user_map';
	public static $_id_column = 'id';
}

?>
