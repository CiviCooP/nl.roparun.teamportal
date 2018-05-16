<?php

class CRM_Teamportal_Api_Captains {
		
	public function captains($event_id = null, $role="Teamcaptain") {
		$roparun_event_id = $event_id;
		if (empty($roparun_event_id)) {
			$roparun_event_id = CRM_Generic_CurrentEvent::getCurrentRoparunEventId();
		}
		return $this->getTeamCaptains($roparun_event_id, $role);
	}
	
	protected function getTeamCaptains($event_id, $role="Teamcaptain") {
		$config = CRM_Teamportal_Config::singleton();
		$campaign_id = CRM_Generic_CurrentEvent::getRoparunCampaignId($event_id);
		
		$captainSql = "
			SELECT 
			`civicrm_contact`.`id`,
			`civicrm_participant`.`id` as `participant_id`, 
			`civicrm_participant`.`event_id` as `event_id`,
			`civicrm_contact`.`display_name` as `display_name`,
			`civicrm_contact`.`first_name`,
			`civicrm_contact`.`middle_name`,
			`civicrm_contact`.`last_name`, 
			`civicrm_address`.`city` as `city`,
			`civicrm_email`.`email` as `email`,
			`team_member_data`.`{$config->getTeamRoleCustomFieldColumnName()}` as `role`,
			`team_member_data`.`{$config->getMemberOfTeamCustomFieldColumnName()}` as `team_id`,
			`{$config->getTeamDataCustomGroupTableName()}`.`{$config->getTeamNrCustomFieldColumnName()}` AS `team_nr`,
		  `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getTeamNameCustomFieldColumnName()}` AS `team_name`
			FROM civicrm_contact
			INNER JOIN civicrm_participant ON civicrm_contact.id = civicrm_participant.contact_id
			INNER JOIN {$config->getTeamMemberDataCustomGroupTableName()} team_member_data ON team_member_data.entity_id = civicrm_participant.id
			INNER JOIN civicrm_participant team_participant ON team_participant.contact_id = `team_member_data`.`{$config->getMemberOfTeamCustomFieldColumnName()}` 
			LEFT JOIN `{$config->getTeamDataCustomGroupTableName()}` ON `{$config->getTeamDataCustomGroupTableName()}`.entity_id = team_participant.id
			LEFT JOIN civicrm_address ON civicrm_address.contact_id = civicrm_contact.id AND civicrm_address.is_primary = 1
			LEFT JOIN civicrm_email ON civicrm_email.contact_id = civicrm_contact.id AND civicrm_email.is_primary = 1
			WHERE team_member_data.{$config->getTeamRoleCustomFieldColumnName()} = %1
			AND civicrm_participant.event_id = %2 AND team_participant.event_id = %2
			AND civicrm_participant.status_id IN (".implode(", ", $config->getActiveParticipantStatusIds()).")
			ORDER BY civicrm_contact.display_name	
		";
		$params[1] = array($role, 'String');
		$params[2] = array($event_id, 'Integer');
		
		$captains = array();
		$captainsDAO = CRM_Core_DAO::executeQuery($captainSql, $params);
		
		while ($captainsDAO->fetch()) {
			$captain = array();
			$captain['contact_id'] = $captainsDAO->id;
			$captain['participant_id'] = $captainsDAO->participant_id;
			$captain['event_id'] = $captainsDAO->event_id;
			$contact['first_name'] = $captainsDAO->first_name;
			$contact['middle_name'] = $captainsDAO->middle_name;
			$contact['last_name'] = $captainsDAO->last_name;
			$captain['name'] = $captainsDAO->display_name;
			$captain['city'] = $captainsDAO->city;
			$captain['role'] = $captainsDAO->role;
			$captain['email'] = $captainsDAO->email;
			$captain['team_id'] = $captainsDAO->team_id;
			$captain['team'] = $captainsDAO->team_name;
			$captain['teamnr'] = $captainsDAO->team_nr;
			$captains[] = $captain;
		}
		return $captains;
	}
	
}
