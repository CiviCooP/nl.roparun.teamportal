<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

use CRM_Teamportal_ExtensionUtil as E;

/**
 * PortalTeamCaptain.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_portal_team_captain_Getcount_spec(&$spec) {
  $spec['team_id'] = array(
    'api.aliases' => array('id'),
    'api.required' => true,
    'api.return' => false,
    'api.filter' => true,
    'title' => 'Contact ID of the team',
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['is_active'] = array(
    'api.required' => false,
    'api.return' => false,
    'api.filter' => true,
    'title' => E::ts('Is active'),
    'type' => CRM_Utils_Type::T_BOOLEAN,
  );
}

/**
 * PortalTeamCaptain.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_captain_Getcount($params) {
  $filterIsActive = null;
  if (isset($params['is_active'])) {
    $filterIsActive = $params['is_active'] ? 1 : 0;
  }
  $returnValues = CRM_Teamportal_Api_Captains::getTeamCaptains($params['team_id'], $filterIsActive, array());

  return array(
    'result' => count($returnValues),
    'is_error' => 0,
  );
}