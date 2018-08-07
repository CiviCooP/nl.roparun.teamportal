<?php

/**
 * PortalTeamOrder.Getoptions API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_order_Getoptions($params) {
  $fieldName = _civicrm_api3_api_resolve_alias('PortalTeamOrder', $params['field']);

  $options = array();
  switch ($fieldName) {
    case 'status_id':
      $_options = civicrm_api3('OptionValue', 'get', array('option_group_id' => 'activity_status', 'is_active' => 1, 'options' => array('limit' => 0)));
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
  return civicrm_api3_create_success($options, $params, 'PortalTeamOrder', 'getoptions');
}