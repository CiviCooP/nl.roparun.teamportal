<?php

class CRM_Teamportal_Api_Captains {
	
	public function getTeamCaptains() {
		$config = CRM_Teamportal_Config::singleton();
		
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
			ORDER BY civicrm_contact.display_name	
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
