<?php

/**
 * PortalTeamMember.Getcount API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_member_Getcount($params) {
  $teamMembersDao = _civicrm_api3_portal_team_member_Get_queryDao(true, $params);
  $count = 0;
  if ($teamMembersDao->fetch()) {
     $count = $teamMembersDao->total;
  }
  return array(
    'result' => $count,
    'is_error' => 0,
  );
}