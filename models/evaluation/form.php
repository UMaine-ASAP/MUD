<?php


class evaluation_form extends Model 
{

	public static $_table = "AUTH_Evaluations";
	public static $_id_column = "form_id";

	function createForm($formData) {
		$id = 2;

		return $id;
	}

	function deleteForm($formID) {

	}

	function editForm($formID, $values) {
	}

	function addComponentToForm($componentID, $formID) {
		return;
	}


}