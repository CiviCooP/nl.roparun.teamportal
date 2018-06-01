<?php
use CRM_Teamportal_ExtensionUtil as E;

/**
 * PortalTeamInfo.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_portal_team_info_Get_spec(&$spec) {  
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
  $spec['name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Team name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['teamnr'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Team nr'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['start_location'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Start location'),
    'type' => CRM_Utils_Type::T_STRING,
    'pseudoconstant' => array(
      'optionGroupName' => 'start_locations'
    ),
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
  $spec['website'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Website'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['facebook'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Facebook'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['googleplus'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Google Plus'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['instagram'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Instagram'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['linkedin'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Linkedin'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['myspace'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Myspace'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['pinterest'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Pinterest'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['snapchat'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Snapchat'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['tumblr'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Tumblr'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['twitter'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Twitter'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vine'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vine'),
    'type' => CRM_Utils_Type::T_STRING,
  );
}

/**
 * PortalTeamInfo.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_info_Get($params) {
  $config = CRM_Teamportal_Config::singleton();
  $websiteConfig = CRM_Generic_WebsiteTypeConfig::singleton();
  $event_id = CRM_Generic_CurrentEvent::getCurrentRoparunEventId();
  if (isset($params['event_id'])) {
    $event_id = $params['event_id'];
  }
    
  $teamSql = "SELECT civicrm_contact.id, 
             civicrm_contact.display_name,
             `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getTeamNrCustomFieldColumnName()}` AS `team_nr`,
             `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getTeamNameCustomFieldColumnName()}` AS `team_name`,
             `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getStartLocationCustomFieldColumnName()}` AS `start_location`,
             civicrm_address.city as city,
             civicrm_country.name as country,
             website.url as website,
             facebook.url as facebook,
             googleplus.url as googleplus,
             instagram.url as instagram,
             linkedin.url as linkedin,
             myspace.url as myspace,
             pinterest.url as pinterest,
             snapchat.url as snapchat,
             tumblr.url as tumblr,
             twitter.url as twitter,
             vine.url as vine
             FROM civicrm_contact 
             INNER JOIN civicrm_participant ON civicrm_participant.contact_id = civicrm_contact.id 
             INNER JOIN civicrm_participant_status_type ON civicrm_participant.status_id = civicrm_participant_status_type.id
             LEFT JOIN civicrm_address ON civicrm_address.contact_id = civicrm_contact.id AND civicrm_address.location_type_id = %1
             LEFT JOIN civicrm_country ON civicrm_country.id = civicrm_address.country_id
             LEFT JOIN `{$config->getTeamDataCustomGroupTableName()}` ON `{$config->getTeamDataCustomGroupTableName()}`.entity_id = civicrm_participant.id
             LEFT JOIN civicrm_website website ON website.contact_id = civicrm_contact.id and website.website_type_id = {$websiteConfig->getWebsiteWebsiteTypeId()}
             LEFT JOIN civicrm_website facebook ON facebook.contact_id = civicrm_contact.id and facebook.website_type_id = {$websiteConfig->getFacebookWebsiteTypeId()}
             LEFT JOIN civicrm_website googleplus ON googleplus.contact_id = civicrm_contact.id and googleplus.website_type_id = {$websiteConfig->getGooglePlusWebsiteTypeId()}
             LEFT JOIN civicrm_website instagram ON instagram.contact_id = civicrm_contact.id and instagram.website_type_id = {$websiteConfig->getInstagramWebsiteTypeId()}
             LEFT JOIN civicrm_website linkedin ON linkedin.contact_id = civicrm_contact.id and linkedin.website_type_id = {$websiteConfig->getLinkedInWebsiteTypeId()}
             LEFT JOIN civicrm_website myspace ON myspace.contact_id = civicrm_contact.id and myspace.website_type_id = {$websiteConfig->getMySpaceWebsiteTypeId()}
             LEFT JOIN civicrm_website pinterest ON pinterest.contact_id = civicrm_contact.id and pinterest.website_type_id = {$websiteConfig->getPinterestWebsiteTypeId()}
             LEFT JOIN civicrm_website snapchat ON snapchat.contact_id = civicrm_contact.id and snapchat.website_type_id = {$websiteConfig->getSnapChatWebsiteTypeId()}
             LEFT JOIN civicrm_website tumblr ON tumblr.contact_id = civicrm_contact.id and tumblr.website_type_id = {$websiteConfig->getTumblrWebsiteTypeId()}
             LEFT JOIN civicrm_website twitter ON twitter.contact_id = civicrm_contact.id and twitter.website_type_id = {$websiteConfig->getTwitterWebsiteTypeId()}
             LEFT JOIN civicrm_website vine ON vine.contact_id = civicrm_contact.id and vine.website_type_id = {$websiteConfig->getVineWebsiteTypeId()}
             WHERE civicrm_participant.status_id IN (".implode(',', $config->getActiveParticipantStatusIds()).") 
             AND civicrm_participant.event_id = %2 AND civicrm_participant.role_id = %3 
             AND civicrm_contact.id = %4
             ORDER BY team_nr, team_name";
  $teamParams[1] = array($config->getVestingsplaatsLocationTypeId(), 'Integer');
  $teamParams[2] = array($event_id, 'Integer');
  $teamParams[3] = array($config->getTeamParticipantRoleId(), 'Integer');
  $teamParams[4] = array($params['team_id'], 'Integer');
  $teamDao = CRM_Core_DAO::executeQuery($teamSql, $teamParams);
  while($teamDao->fetch()) {
    $team = array();
    $team['id'] = $teamDao->id;
    $team['event_id'] = $roparun_event_id;
    $team['name'] = $teamDao->team_name;
    $team['teamnr'] = $teamDao->team_nr;
    $team['start_location'] = $teamDao->start_location;
    $team['city'] = $teamDao->city;
    $team['country'] = $teamDao->country;
    $team['website'] = $teamDao->website;
    $team['facebook'] = $teamDao->facebook;
    $team['googleplus'] = $teamDao->googleplus;
    $team['instagram'] = $teamDao->instagram;
    $team['linkedin'] = $teamDao->linkedin;
    $team['myspace'] = $teamDao->myspace;
    $team['pinterest'] = $teamDao->pinterest;
    $team['snapchat'] = $teamDao->snapchat;
    $team['tumblr'] = $teamDao->tumblr;
    $team['twitter'] = $teamDao->twitter;
    $team['vine'] = $teamDao->vine;
    $team['event_id'] = $event_id;
    
    $teams[$teamDao->id] = $team;
  }
  
  return civicrm_api3_create_success($teams, $params, 'PortalTeamInfo', 'Get');
  
}