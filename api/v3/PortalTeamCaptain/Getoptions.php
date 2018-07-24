<?php

/**
 * PortalTeamMember.Getoptions API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_captain_Getoptions($params) {
  $fieldName = _civicrm_api3_api_resolve_alias('PortalTeamCaptain', $params['field']);
  
  $options = array();
  switch ($fieldName) {
    case 'role':
      $_options = civicrm_api3('OptionValue', 'get', array('option_group_id' => 'team_roles', 'is_active' => 1, 'options' => array('limit' => 0)));
      foreach($_options['values'] as $option) {
        $options[$option['value']] = $option['label'];
      }
      break;
    case 'donations_enabled':
      $_options = civicrm_api3('OptionValue', 'get', array('option_group_id' => 'participant_donation_state', 'is_active' => 1, 'options' => array('limit' => 0)));
      foreach($_options['values'] as $option) {
        $options[$option['value']] = $option['label'];
      }
      break;
    case 'show_on_website':
      $_options = civicrm_api3('OptionValue', 'get', array('option_group_id' => 'show_participant_on_website', 'is_active' => 1, 'options' => array('limit' => 0)));
      foreach($_options['values'] as $option) {
        $options[$option['value']] = $option['label'];
      }
      break;
    default:
      return civicrm_api3_create_error("The field '{$fieldName}' has no associated option list.");
      break;  
  }
  if (!empty($params['sequential'])) {
    $options = CRM_Utils_Array::makeNonAssociative($options);
  }
  return civicrm_api3_create_success($options, $params, 'PortalTeamMember', 'getoptions');
}