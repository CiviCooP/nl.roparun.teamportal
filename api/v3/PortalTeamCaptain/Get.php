<?php

/**
 * PortalTeamCaptain.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_portal_team_captain_Get_spec(&$spec) {

}

/**
 * RoparunTeamCaptain.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_captain_Get($params) {
	$captains = new CRM_Teamportal_Api_Captains();
	$returnValues = $captains->getTeamCaptains();
	return civicrm_api3_create_success($returnValues, $params, 'RoparunTeamCaptain', 'get');
}