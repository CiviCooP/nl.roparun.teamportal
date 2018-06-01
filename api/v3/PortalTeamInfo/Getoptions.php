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
function civicrm_api3_portal_team_member_Getoptions($params) {
  $fieldName = _civicrm_api3_api_resolve_alias('PortalTeamMember', $params['field']);
  
  $options = array();
  switch ($fieldName) {
    case 'start_location':
      $_options = civicrm_api3('OptionValue', 'get', array('option_group_id' => 'start_locations', 'is_active' => 1, 'options' => array('limit' => 0)));
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
  return civicrm_api3_create_success($options, $params, 'PortalTeamInfo', 'getoptions');
}