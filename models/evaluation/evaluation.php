<?php


class evaluation extends Model 
{

	public static $_table = "AUTH_Evaluations";
	public static $_id_column = "id";

	/** ================= Manager ================ **/
	function assignEvaluation($creatorID, $formID) {
	}

	function allOwnedForms($managerID) {
		$forms = "";
		return $forms;
	}

	/** ================= Participant ================ **/
	function EvaluationsTodo($userID, $status='') {

	}

	function evaluationQuestions($evaluation_id) {

	}

	//evaluations todo
	//projects (archived and in progress)
	//fill out evaluation for an evaluatable
	//submit evaluation
	//view everyone / particular user
	//sort results
	//view particular forms
	//

	//construct evaluations (components, forms, assignment)
		//control what fields are viewable
	
	/** Results **/
	function evaluationResults($form_id, $user_id) {

	}
}