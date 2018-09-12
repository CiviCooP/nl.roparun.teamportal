<?php

class CRM_Teamportal_Api_Captains {

  /**
   * Returns a list with the teamcaptain(s) for a certain team.
   *
   * Set $is_active to 1 to filter currently active team captains
   * Set $is_active to 0 to filter inactive team captain(s)
   * Set $is_active to null for no filter on active/inactive
   *
   * @param int $team_id
   * @param null|0|1 $is_active
   * @param array $options
   * @return array
   * @throws \Exception
   */
  public static function getTeamCaptains($team_id, $is_active=null, $options=array()) {
    $config = CRM_Teamportal_Config::singleton();
    $event_id = CRM_Generic_CurrentEvent::getCurrentRoparunEventId();

    $limit = "";
    if (isset($options['limit']) && $options['limit'] > 0 && isset($options['offset'])) {
      $limit = "LIMIT ".CRM_Utils_Type::escape($options['offset'], 'Integer', TRUE).", ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
    } elseif (isset($options['limit']) && $options['limit'] > 0) {
      $limit = "LIMIT ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
    }

    $activeWhereClause = "";
    if ($is_active === 1) {
      $activeWhereClause = " 
        AND `civicrm_relationship`.`is_active` = 1 
			  AND (`civicrm_relationship`.`start_date` IS NULL OR `civicrm_relationship`.`start_date` <= CURRENT_DATE()) 
			  AND (`civicrm_relationship`.`end_date` IS NULL OR `civicrm_relationship`.`end_date` >= CURRENT_DATE())";
    } elseif ($is_active === 0) {
      $activeWhereClause = " 
        AND (
          `civicrm_relationship`.`is_active` = 0 
          OR (
            `civicrm_relationship`.`is_active`= 1 
			      AND (`civicrm_relationship`.`start_date` IS NULL OR `civicrm_relationship`.`start_date` > CURRENT_DATE())
			      AND (`civicrm_relationship`.`end_date` IS NULL OR `civicrm_relationship`.`end_date` < CURRENT_DATE())
          )
        ) ";
    }

    $captainSql = "
			SELECT 
			DISTINCT `civicrm_relationship`.`id` as `id`,
			`civicrm_contact`.`id` as `contact_id`,
			`civicrm_contact`.`display_name` as `display_name`,
			`civicrm_contact`.`first_name`,
			`civicrm_contact`.`middle_name`,
			`civicrm_contact`.`last_name`,
			`civicrm_address`.`street_address` as `street_address`,
			`civicrm_address`.`postal_code` as `postal_code`, 
			`civicrm_address`.`city` as `city`,
			`civicrm_address`.`country_id` as `country_id`,
			`civicrm_email`.`email` as `email`,
			`civicrm_phone`.`phone` as `phone`,
			`team`.`id` as `team_id`,
			`team`.`display_name` as `team_name`,
			`team_portal`.`{$config->getTeamcaptainTeamportalAccessCustomFieldColumnName()}` as `login`,
			`civicrm_relationship`.`start_date` as `start_date`,
			`civicrm_relationship`.`end_date` as `end_date`,
			`civicrm_relationship`.`is_active` as `is_active`,
      `team_member_data`.`{$config->getTeamRoleCustomFieldColumnName()}` as `role`,
      `team_member_data`.`{$config->getShowOnWebsiteCustomFieldColumnName()}` as `show_on_website`
			FROM `civicrm_contact`
			INNER JOIN `civicrm_relationship` ON `civicrm_relationship`.`contact_id_a` = `civicrm_contact`.`id`
			LEFT JOIN `{$config->getTeamcaptainCustomGroupTableName()}` `team_portal` ON `team_portal`.`entity_id` = `civicrm_relationship`.`id` 
			INNER JOIN `civicrm_contact` `team` ON `civicrm_relationship`.`contact_id_b` = `team`.`id`
			LEFT JOIN `civicrm_address` ON `civicrm_address`.`contact_id` = `civicrm_contact`.`id` AND `civicrm_address`.`is_primary` = 1
			LEFT JOIN `civicrm_email` ON `civicrm_email`.`contact_id` = `civicrm_contact`.`id` AND `civicrm_email`.`is_primary` = 1
			LEFT JOIN civicrm_phone ON civicrm_phone.contact_id = civicrm_contact.id AND civicrm_phone.is_primary = 1
			LEFT JOIN civicrm_participant ON civicrm_contact.id = civicrm_participant.contact_id
      LEFT JOIN {$config->getTeamMemberDataCustomGroupTableName()} team_member_data ON team_member_data.entity_id = civicrm_participant.id
			WHERE  `civicrm_relationship`.`relationship_type_id` = %1
			AND `civicrm_relationship`.`contact_id_b` = %2
			AND `civicrm_contact`.`is_deleted` = '0'
			AND (`civicrm_participant`.`id` IS NULL OR `civicrm_participant`.`event_id` = %3)
			{$activeWhereClause}
			ORDER BY civicrm_contact.display_name	
			{$limit}
		";
    $params[1] = array($config->getTeamCaptainRelationshipTypeId(), 'Integer');
    $params[2] = array($team_id, 'Integer');
    $params[3] = array($event_id, 'Integer');

    $captains = array();
    $captainsDAO = CRM_Core_DAO::executeQuery($captainSql, $params);

    $countries = CRM_Core_PseudoConstant::country();

    while ($captainsDAO->fetch()) {
      $country = '';
      if ($captainsDAO->country_id) {
        $country = $countries[$captainsDAO->country_id];
      }
      $teamMember['country'] = $country;

      $captain = array();
      $captain['id'] = $captainsDAO->id;
      $captain['contact_id'] = $captainsDAO->contact_id;
      $contact['first_name'] = $captainsDAO->first_name;
      $contact['middle_name'] = $captainsDAO->middle_name;
      $contact['last_name'] = $captainsDAO->last_name;
      $captain['display_name'] = $captainsDAO->display_name;
      $captain['address'] = $captainsDAO->street_address;
      $captain['postal_code'] = $captainsDAO->postal_code;
      $captain['city'] = $captainsDAO->city;
      $captain['country'] = $country;
      $captain['phone'] = $captainsDAO->phone;
      $captain['email'] = $captainsDAO->email;
      $captain['team_id'] = $captainsDAO->team_id;
      $captain['team'] = $captainsDAO->team_name;
      $captain['login'] = $captainsDAO->login;
      $captain['start_date'] = CRM_Utils_Date::mysqlToIso(CRM_Utils_Date::processDate($captainsDAO->start_date, NULL, FALSE, 'Ymd'));
      $captain['end_date'] = CRM_Utils_Date::mysqlToIso(CRM_Utils_Date::processDate($captainsDAO->end_date, NULL, FALSE, 'Ymd'));
      $captain['is_active'] = $captainsDAO->is_active;
      $captain['role'] = $captainsDAO->role;
      $captain['show_on_website'] = $captainsDAO->show_on_website;
      $captain['donations_enabled'] = $captainsDAO->donations_enabled;

      $captains[] = $captain;
    }
    return $captains;
  }

  /**
   * Returns a list with team captains who are allowed to login
   * into the team portal.
   *
   * The team portal retrieves this data to create active users from it
   *
   * @param array $options
   * @return array
   */
	public static function getPortalUsers($options=array()) {
		$config = CRM_Teamportal_Config::singleton();

    $limit = "";
    if (isset($options['limit']) && $options['limit'] > 0 && isset($options['offset'])) {
      $limit = "LIMIT ".CRM_Utils_Type::escape($options['offset'], 'Integer', TRUE).", ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
    } elseif (isset($options['limit']) && $options['limit'] > 0) {
      $limit = "LIMIT ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
    }
		
		$captainSql = "
			SELECT 
			`civicrm_contact`.`id`,
			`civicrm_contact`.`display_name` as `display_name`,
			`civicrm_contact`.`first_name`,
			`civicrm_contact`.`middle_name`,
			`civicrm_contact`.`last_name`, 
			`civicrm_address`.`city` as `city`,
			`civicrm_email`.`email` as `email`,
			`team`.`id` as `team_id`,
			`team`.`display_name` as `team_name`
			FROM `civicrm_contact`
			INNER JOIN `civicrm_relationship` ON `civicrm_relationship`.`contact_id_a` = `civicrm_contact`.`id`
			INNER JOIN `{$config->getTeamcaptainCustomGroupTableName()}` `team_portal` ON `team_portal`.`entity_id` = `civicrm_relationship`.`id` 
			INNER JOIN `civicrm_contact` `team` ON `civicrm_relationship`.`contact_id_b` = `team`.`id`
			LEFT JOIN `civicrm_address` ON `civicrm_address`.`contact_id` = `civicrm_contact`.`id` AND `civicrm_address`.`is_primary` = 1
			LEFT JOIN `civicrm_email` ON `civicrm_email`.`contact_id` = `civicrm_contact`.`id` AND `civicrm_email`.`is_primary` = 1
			WHERE `civicrm_relationship`.`is_active` = 1 
			AND (`civicrm_relationship`.`start_date` IS NULL OR `civicrm_relationship`.`start_date` <= CURRENT_DATE()) 
			AND (`civicrm_relationship`.`end_date` IS NULL OR `civicrm_relationship`.`end_date` >= CURRENT_DATE())
			AND `civicrm_relationship`.`relationship_type_id` = %1
			AND `team_portal`.`{$config->getTeamcaptainTeamportalAccessCustomFieldColumnName()}` = '1'
			AND `civicrm_contact`.`is_deleted` = '0'
			ORDER BY civicrm_contact.display_name	
			{$limit}
		";
		$params[1] = array($config->getTeamCaptainRelationshipTypeId(), 'Integer');

		$captains = array();
		$captainsDAO = CRM_Core_DAO::executeQuery($captainSql, $params);
		
		while ($captainsDAO->fetch()) {
			$captain = array();
			$captain['contact_id'] = $captainsDAO->id;
			$contact['first_name'] = $captainsDAO->first_name;
			$contact['middle_name'] = $captainsDAO->middle_name;
			$contact['last_name'] = $captainsDAO->last_name;
			$captain['name'] = $captainsDAO->display_name;
			$captain['city'] = $captainsDAO->city;
			$captain['email'] = $captainsDAO->email;
			$captain['team_id'] = $captainsDAO->team_id;
			$captain['team'] = $captainsDAO->team_name;
			$captains[] = $captain;
		}
		return $captains;
	}
	
}
