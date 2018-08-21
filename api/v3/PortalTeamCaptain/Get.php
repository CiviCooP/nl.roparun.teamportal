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
function _civicrm_api3_portal_team_captain_Get_spec(&$spec) {
  $spec['id'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Relationship ID'),
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['team_id'] = array(
    'api.aliases' => array('id'),
    'api.required' => true,
    'api.return' => true,
    'api.filter' => true,
    'title' => 'Contact ID of the team',
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['is_active'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => true,
    'title' => E::ts('Is active'),
    'type' => CRM_Utils_Type::T_BOOLEAN,
  );
  $spec['start_date'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Start Date'),
    'type' => CRM_Utils_Type::T_DATE,
  );
  $spec['end_date'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('End Date'),
    'type' => CRM_Utils_Type::T_DATE,
  );
  $spec['login'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Has login'),
    'type' => CRM_Utils_Type::T_BOOLEAN,
  );
  $spec['contact_id'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Contact ID'),
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['display_name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Display name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['first_name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('First name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['middle_name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Middle name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['last_name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Last name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['address'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Address'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['postal_code'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Postal code'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['city'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('City'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['country'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Country'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['phone'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Phone'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['email'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Email'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['team_id'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Team ID'),
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['team_name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Team name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['role'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => true,
    'title' => E::ts('Role'),
    'type' => CRM_Utils_Type::T_STRING,
    'pseudoconstant' => array(
      'optionGroupName' => 'team_roles',
    ),
  );
  $spec['show_on_website'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Show on website'),
    'type' => CRM_Utils_Type::T_STRING,
    'pseudoconstant' => array(
      'optionGroupName' => 'show_participant_on_website',
    ),
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
function civicrm_api3_portal_team_captain_Get($params) {
  $filterIsActive = null;
  if (isset($params['is_active'])) {
    $filterIsActive = $params['is_active'] ? 1 : 0;
  }
  $returnValues = CRM_Teamportal_Api_Captains::getTeamCaptains($params['team_id'], $filterIsActive);
  return civicrm_api3_create_success($returnValues, $params, 'RoparunTeamCaptain', 'get');
}