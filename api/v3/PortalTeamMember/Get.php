<?php
use CRM_Teamportal_ExtensionUtil as E;

/**
 * PortalTeamMember.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_portal_team_member_Get_spec(&$spec) {  
  $spec['team_id'] = array(
    'api.aliases' => array('id'),
    'api.required' => true,
    'api.return' => true,
    'api.filter' => true,
    'title' => 'Contact ID of the team',
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['event_id'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => true,
    'title' => 'Event ID',
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['id'] = array(
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
  $spec['is_team_captain'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => true,
    'title' => E::ts('Is Team Captain'),
    'type' => CRM_Utils_Type::T_BOOLEAN,
  );
  $spec['is_active'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => true,
    'title' => E::ts('Is active'),
    'type' => CRM_Utils_Type::T_BOOLEAN,
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
 * PortalTeamMember.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_member_Get($params) {
  $config = CRM_Teamportal_Config::singleton();
  $event_id = CRM_Generic_CurrentEvent::getCurrentRoparunEventId();
  if (isset($params['event_id'])) {
    $event_id = $params['event_id'];
  }
  
  if (!isset($params['team_id'])) {
    return civicrm_api3_create_error(E::ts('Team ID is required'));
  }
  $team_id = $params['team_id'];
  
  $countries = CRM_Core_PseudoConstant::country();
  
  $teamMembersDao = _civicrm_api3_portal_team_member_Get_queryDao(false, $params);
  while ($teamMembersDao->fetch()) {
    $active = true;
    if (!in_array($teamMembersDao->status_id, $config->getActiveParticipantStatusIds())) {
      $active = false;
    }
    
    $teamMember = array();
    $teamMember['id'] = $teamMembersDao->id;
    $teamMember['team_id'] = $team_id;
    $teamMember['is_active'] = $active;
    $teamMember['is_team_captain'] = $teamMembersDao->is_team_captain;
    $teamMember['event_id'] = $event_id;
    $teamMember['display_name'] = $teamMembersDao->display_name;
    $teamMember['phone'] = $teamMembersDao->phone;
    $teamMember['email'] = $teamMembersDao->email;
    
    $teamMember['address'] = $teamMembersDao->street_address;
    $teamMember['postal_code'] = $teamMembersDao->postal_code;
    $teamMember['city'] = $teamMembersDao->city;
    
    $country = '';
    if ($teamMembersDao->country_id) {
      $country = $countries[$teamMembersDao->country_id];
    }
    $teamMember['country'] = $country;
    
    $teamMember['role'] = $teamMembersDao->role;
    $teamMember['show_on_website'] = $teamMembersDao->show_on_website;
    $teamMember['donations_enabled'] = $teamMembersDao->donations_enabled;
    $teamMembers[] = $teamMember;
  }
  
  return civicrm_api3_create_success($teamMembers, $params, 'PortalTeamMember', 'Get');
}

function _civicrm_api3_portal_team_member_Get_queryDao($count, $params) {
  $config = CRM_Teamportal_Config::singleton();
  $sqlParams = array();
  $sqlParamCount = 1;

  if (!isset($params['event_id'])) {
    $current_event_id = CRM_Generic_CurrentEvent::getCurrentRoparunEventId();
    $params['event_id'] = array('=' => $current_event_id);
  }
  
  if (!isset($params['team_id'])) {
    return civicrm_api3_create_error(E::ts('Team ID is required'));
  }
  
  $options = _civicrm_api3_get_options_from_params($params);
  $limit = "";
  if (isset($options['limit']) && $options['limit'] > 0 && isset($options['offset'])) {
    $limit = "LIMIT ".CRM_Utils_Type::escape($options['offset'], 'Integer', TRUE).", ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
  } elseif (isset($options['limit']) && $options['limit'] > 0) {
    $limit = "LIMIT ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
  }
  
  $sort = "display_name ASC";
  if (isset($options['sort'])) {
    $sort_fields = explode(",", $options['sort']);
    foreach($sort_fields as $idx => $field) {
      $field = trim($field);
      if (strtoupper(substr($field, -3)) != 'ASC' && strtoupper(substr($field, -4)) != 'DESC') {
        $field .= ' ASC';
      }
      $sort_fields[$idx] = $field;
    }
    $sort = implode(", ", $sort_fields);
  }
  
  $select = "civicrm_contact.id,
    civicrm_contact.display_name, 
    civicrm_contact.first_name,
    civicrm_contact.middle_name,
    civicrm_contact.last_name,
    civicrm_address.street_address,
    civicrm_address.postal_code, 
    civicrm_address.city,
    civicrm_address.country_id,
    civicrm_phone.phone,
    civicrm_email.email,
    team_member_data.{$config->getTeamRoleCustomFieldColumnName()} as role,
    team_member_data.{$config->getShowOnWebsiteCustomFieldColumnName()} as show_on_website,
    civicrm_participant.status_id as status_id,
    (CASE
      WHEN civicrm_relationship.id IS NOT NULL THEN 1
      ELSE 0 
    END) AS is_team_captain
    ";
  
  $whereClauses = array();
  $whereClauses[] = "civicrm_contact.is_deleted = '0'";
  if (isset($params['is_active']) && $params['is_active']) {
    $whereClauses[] = "civicrm_participant.status_id IN (".implode(", ", $config->getActiveParticipantStatusIds()).")";
  } elseif (isset($params['is_active']) && !$params['is_active']) {
    $whereClauses[] = "civicrm_participant.status_id NOT IN (".implode(", ", $config->getActiveParticipantStatusIds()).")";
  }
  
  if (isset($params['event_id'])) {
    if (!is_array($params['event_id'])) {
      $params['event_id'] = array('=' => $params['event_id']);
    }
    $whereClauses[] = CRM_Core_DAO::createSQLFilter("civicrm_participant.event_id", $params['event_id']);
  }
  
  if (isset($params['team_id'])) {
    if (!is_array($params['team_id'])) {
      $params['team_id'] = array('=' => $params['team_id']);
    }
    $whereClauses[] = CRM_Core_DAO::createSQLFilter("team_member_data.{$config->getMemberOfTeamCustomFieldColumnName()}", $params['team_id']);
  }

  if (isset($params['is_team_captain'])) {
    if ($params['is_team_captain']) {
      $whereClauses[] = "civicrm_relationship.id IS NOT NULL";
    } else {
      $whereClauses[] = "civicrm_relationship.id IS NULL";
    }
  }
  
  if (isset($params['role'])) {
    if (!is_array($params['role'])) {
      $params['role'] = array('=' => $params['role']);
    }
    $whereClauses[] = CRM_Core_DAO::createSQLFilter("team_member_data.{$config->getTeamRoleCustomFieldColumnName()}", $params['role']);
  }
  $where = implode(" AND ", $whereClauses);
      
  if ($count) {
    $select = "COUNT(*) as total";
    $limit = "";
  }
  $teamMemberSql = "
    SELECT DISTINCT 
    {$select}
    FROM civicrm_contact
    INNER JOIN civicrm_participant ON civicrm_contact.id = civicrm_participant.contact_id
    INNER JOIN {$config->getTeamMemberDataCustomGroupTableName()} team_member_data ON team_member_data.entity_id = civicrm_participant.id
    LEFT JOIN civicrm_address ON civicrm_address.contact_id = civicrm_contact.id AND civicrm_address.is_primary = 1
    LEFT JOIN civicrm_phone ON civicrm_phone.contact_id = civicrm_contact.id AND civicrm_phone.is_primary = 1
    LEFT JOIN civicrm_email ON civicrm_email.contact_id = civicrm_contact.id AND civicrm_email.is_primary = 1
    LEFT JOIN civicrm_relationship ON civicrm_relationship.contact_id_a = civicrm_contact.id 
      AND civicrm_relationship.relationship_type_id = %{$sqlParamCount} 
      AND civicrm_relationship.is_active = 1 
      AND (civicrm_relationship.start_date IS NULL OR civicrm_relationship.start_date <= CURRENT_DATE()) 
      AND (civicrm_relationship.end_date IS NULL OR civicrm_relationship.end_date >= CURRENT_DATE())
      AND civicrm_relationship.contact_id_b = team_member_data.{$config->getMemberOfTeamCustomFieldColumnName()}
    WHERE {$where}
    ORDER BY {$sort}
    {$limit}
  ";
  $sqlParams[$sqlParamCount] = array($config->getTeamCaptainRelationshipTypeId(), 'Integer');
  $sqlParamCount++;
  return CRM_Core_DAO::executeQuery($teamMemberSql, $sqlParams);
}
