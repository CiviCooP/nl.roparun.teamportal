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
  $spec['phone_during_event'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Phone number during event'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['billing_contact_id'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing Contact ID'),
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['billing_contact_name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing Contact Name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['billing_name'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing Name'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['billing_supplemental_address'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing Supplemental Address'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['billing_street_address'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing Street Address'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['billing_postal_code'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing Postal Code'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['billing_city'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing City'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['billing_country'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Billing Country'),
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
  $spec['instagram'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Instagram'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['twitter'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Twitter'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['average_speed'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Average speed'),
    'type' => CRM_Utils_Type::T_FLOAT,
  );

  $spec['vehicle_1_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 1 Type'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_1_brand'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 1 Brand'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_1_make'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 1 Make'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_1_registration_nr'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 1 Registration Number'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_1_trailer_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 1 Trailer Type'),
    'type' => CRM_Utils_Type::T_STRING,
  );

  $spec['vehicle_2_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 2 Type'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_2_brand'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 2 Brand'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_2_make'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 2 Make'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_2_registration_nr'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 2 Registration Number'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_2_trailer_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 2 Trailer Type'),
    'type' => CRM_Utils_Type::T_STRING,
  );

  $spec['vehicle_3_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 3 Type'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_3_brand'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 3 Brand'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_3_make'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 3 Make'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_3_registration_nr'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 3 Registration Number'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_3_trailer_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 3 Trailer Type'),
    'type' => CRM_Utils_Type::T_STRING,
  );

  $spec['vehicle_4_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 4 Type'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_4_brand'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 4 Brand'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_4_make'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 4 Make'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_4_registration_nr'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 4 Registration Number'),
    'type' => CRM_Utils_Type::T_STRING,
  );
  $spec['vehicle_4_trailer_type'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Vehicle 4 Trailer Type'),
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
  $countries = CRM_Core_PseudoConstant::country();
  $vehicleTypes = CRM_Core_OptionGroup::values('vehicle_types');
  $vehicleTrailerTypes = CRM_Core_OptionGroup::values('vehicle_trailer_types');
  $vehicle1 = CRM_Generic_VehicleConfig::instance(1);
  $vehicle2 = CRM_Generic_VehicleConfig::instance(2);
  $vehicle3 = CRM_Generic_VehicleConfig::instance(3);
  $vehicle4 = CRM_Generic_VehicleConfig::instance(4);
    
  $teamSql = "SELECT civicrm_contact.id, 
             civicrm_contact.display_name,
             `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getTeamNrCustomFieldColumnName()}` AS `team_nr`,
             `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getTeamNameCustomFieldColumnName()}` AS `team_name`,
             `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getStartLocationCustomFieldColumnName()}` AS `start_location`,
             `{$config->getTeamDataCustomGroupTableName()}`.`{$config->getAverageSpeedCustomFieldColumnName()}` AS `average_speed`,
             civicrm_address.city as city,
             civicrm_address.country_id as country_id,
             billing_address.master_id as billing_master_id,
             billing_address.name as billing_name,
             billing_address.supplemental_address_1 as billing_supplemental_address,
             billing_address.street_address as billing_street_address,
             billing_address.postal_code as billing_postal_code,
             billing_address.city as billing_city,
             billing_address.country_id as billing_country_id,
             website.url as website,
             facebook.url as facebook,
             instagram.url as instagram,
             twitter.url as twitter,
             phone.phone as phone_during_event,
             `vehicle1`.`{$vehicle1->getTypeColumnName()}` as `vehicle_1_type`,
             `vehicle1`.`{$vehicle1->getBrandColumnName()}` as `vehicle_1_brand`,
             `vehicle1`.`{$vehicle1->getMakeColumnName()}` as `vehicle_1_make`,
             `vehicle1`.`{$vehicle1->getRegistrationNrColumnName()}` as `vehicle_1_registration_nr`,
             `vehicle1`.`{$vehicle1->getTrailerTypeColumnName()}` as `vehicle_1_trailer_type`,  
             
             `vehicle2`.`{$vehicle2->getTypeColumnName()}` as `vehicle_2_type`,
             `vehicle2`.`{$vehicle2->getBrandColumnName()}` as `vehicle_2_brand`,
             `vehicle2`.`{$vehicle2->getMakeColumnName()}` as `vehicle_2_make`,
             `vehicle2`.`{$vehicle2->getRegistrationNrColumnName()}` as `vehicle_2_registration_nr`,
             `vehicle2`.`{$vehicle2->getTrailerTypeColumnName()}` as `vehicle_2_trailer_type`,
             
             `vehicle3`.`{$vehicle3->getTypeColumnName()}` as `vehicle_3_type`,
             `vehicle3`.`{$vehicle3->getBrandColumnName()}` as `vehicle_3_brand`,
             `vehicle3`.`{$vehicle3->getMakeColumnName()}` as `vehicle_3_make`,
             `vehicle3`.`{$vehicle3->getRegistrationNrColumnName()}` as `vehicle_3_registration_nr`,
             `vehicle3`.`{$vehicle3->getTrailerTypeColumnName()}` as `vehicle_3_trailer_type`,
             
             `vehicle4`.`{$vehicle4->getTypeColumnName()}` as `vehicle_4_type`,
             `vehicle4`.`{$vehicle4->getBrandColumnName()}` as `vehicle_4_brand`,
             `vehicle4`.`{$vehicle4->getMakeColumnName()}` as `vehicle_4_make`,
             `vehicle4`.`{$vehicle4->getRegistrationNrColumnName()}` as `vehicle_4_registration_nr`,
             `vehicle4`.`{$vehicle4->getTrailerTypeColumnName()}` as `vehicle_4_trailer_type`           
             FROM civicrm_contact 
             INNER JOIN civicrm_participant ON civicrm_participant.contact_id = civicrm_contact.id 
             INNER JOIN civicrm_participant_status_type ON civicrm_participant.status_id = civicrm_participant_status_type.id
             LEFT JOIN civicrm_address ON civicrm_address.contact_id = civicrm_contact.id AND civicrm_address.location_type_id = %1
             LEFT JOIN civicrm_address billing_address ON billing_address.contact_id = civicrm_contact.id AND billing_address.location_type_id = %2
             LEFT JOIN `{$config->getTeamDataCustomGroupTableName()}` ON `{$config->getTeamDataCustomGroupTableName()}`.entity_id = civicrm_participant.id
             LEFT JOIN civicrm_website website ON website.contact_id = civicrm_contact.id and website.website_type_id = {$websiteConfig->getWebsiteWebsiteTypeId()}
             LEFT JOIN civicrm_website facebook ON facebook.contact_id = civicrm_contact.id and facebook.website_type_id = {$websiteConfig->getFacebookWebsiteTypeId()}
             LEFT JOIN civicrm_website instagram ON instagram.contact_id = civicrm_contact.id and instagram.website_type_id = {$websiteConfig->getInstagramWebsiteTypeId()}
             LEFT JOIN civicrm_website twitter ON twitter.contact_id = civicrm_contact.id and twitter.website_type_id = {$websiteConfig->getTwitterWebsiteTypeId()}
             LEFT JOIN civicrm_phone phone ON phone.contact_id = civicrm_contact.id AND phone.phone_type_id = {$config->getDuringEventPhoneTypeId()}
             LEFT JOIN `{$vehicle1->getTableName()}` `vehicle1` ON `vehicle1`.`entity_id` = civicrm_participant.id
             LEFT JOIN `{$vehicle2->getTableName()}` `vehicle2` ON `vehicle2`.`entity_id` = civicrm_participant.id
             LEFT JOIN `{$vehicle3->getTableName()}` `vehicle3` ON `vehicle3`.`entity_id` = civicrm_participant.id
             LEFT JOIN `{$vehicle4->getTableName()}` `vehicle4` ON `vehicle4`.`entity_id` = civicrm_participant.id
             WHERE civicrm_participant.status_id IN (".implode(',', $config->getActiveParticipantStatusIds()).") 
             AND civicrm_participant.event_id = %3 AND civicrm_participant.role_id = %4 
             AND civicrm_contact.id = %5
             ORDER BY team_nr, team_name";
  $teamParams[1] = array($config->getVestingsplaatsLocationTypeId(), 'Integer');
  $teamParams[2] = array($config->getBillingLocationTypeId(), 'Integer');
  $teamParams[3] = array($event_id, 'Integer');
  $teamParams[4] = array($config->getTeamParticipantRoleId(), 'Integer');
  $teamParams[5] = array($params['team_id'], 'Integer');
  $teamDao = CRM_Core_DAO::executeQuery($teamSql, $teamParams);
  while($teamDao->fetch()) {
    $country = '';
    if ($teamDao->country_id) {
      $country = $countries[$teamDao->country_id];
    }
    $billing_country = '';
    if ($teamDao->billing_country_id) {
      $billing_country = $countries[$teamDao->billing_country_id];
    }

    $team = array();
    $team['id'] = $teamDao->id;
    $team['event_id'] = $event_id;
    $team['name'] = $teamDao->team_name;
    $team['teamnr'] = $teamDao->team_nr;
    $team['start_location'] = $teamDao->start_location;
    if ($teamDao->average_speed ) {
      $team['average_speed'] = (float) $teamDao->average_speed;
    }
    $team['city'] = $teamDao->city;
    $team['country'] = $country;
    $team['website'] = $teamDao->website;
    $team['facebook'] = $teamDao->facebook;
    $team['instagram'] = $teamDao->instagram;
    $team['twitter'] = $teamDao->twitter;
    $team['phone_during_event'] = $teamDao->phone_during_event;
    $team['event_id'] = $event_id;

    $team['vehicle_1_type'] = isset($vehicleTypes[$teamDao->vehicle_1_type]) ? $vehicleTypes[$teamDao->vehicle_1_type] : '';
    $team['vehicle_1_brand'] = $teamDao->vehicle_1_brand;
    $team['vehicle_1_make'] = $teamDao->vehicle_1_make;
    $team['vehicle_1_registration_nr'] = $teamDao->vehicle_1_registration_nr;
    $team['vehicle_1_trailer_type'] = isset($vehicleTrailerTypes[$teamDao->vehicle_1_trailer_type]) ? $vehicleTrailerTypes[$teamDao->vehicle_1_trailer_type] : '';

    $team['vehicle_2_type'] = isset($vehicleTypes[$teamDao->vehicle_2_type]) ? $vehicleTypes[$teamDao->vehicle_2_type] : '';
    $team['vehicle_2_brand'] = $teamDao->vehicle_2_brand;
    $team['vehicle_2_make'] = $teamDao->vehicle_2_make;
    $team['vehicle_2_registration_nr'] = $teamDao->vehicle_2_registration_nr;
    $team['vehicle_2_trailer_type'] = isset($vehicleTrailerTypes[$teamDao->vehicle_2_trailer_type]) ? $vehicleTrailerTypes[$teamDao->vehicle_2_trailer_type] : '';

    $team['vehicle_3_type'] = isset($vehicleTypes[$teamDao->vehicle_3_type]) ? $vehicleTypes[$teamDao->vehicle_3_type] : '';
    $team['vehicle_3_brand'] = $teamDao->vehicle_3_brand;
    $team['vehicle_3_make'] = $teamDao->vehicle_3_make;
    $team['vehicle_3_registration_nr'] = $teamDao->vehicle_3_registration_nr;
    $team['vehicle_3_trailer_type'] = isset($vehicleTrailerTypes[$teamDao->vehicle_3_trailer_type]) ? $vehicleTrailerTypes[$teamDao->vehicle_3_trailer_type] : '';

    $team['vehicle_4_type'] = isset($vehicleTypes[$teamDao->vehicle_4_type]) ? $vehicleTypes[$teamDao->vehicle_4_type] : '';
    $team['vehicle_4_brand'] = $teamDao->vehicle_4_brand;
    $team['vehicle_4_make'] = $teamDao->vehicle_4_make;
    $team['vehicle_4_registration_nr'] = $teamDao->vehicle_4_registration_nr;
    $team['vehicle_4_trailer_type'] = isset($vehicleTrailerTypes[$teamDao->vehicle_4_trailer_type]) ? $vehicleTrailerTypes[$teamDao->vehicle_4_trailer_type] : '';

    if ($teamDao->billing_master_id) {
      $team['billing_master_name'] = '';
      $team['billing_name'] = '';
      $team['billing_supplemental_address'] = '';
      $team['billing_street_address'] = '';
      $team['billing_postal_code'] = '';
      $team['billing_city'] = '';
      $team['billing_country'] = '';
      try {
        $billing_address = civicrm_api3('Address', 'getsingle', array('id' => $teamDao->billing_master_id));
        $team['billing_contact_id'] = $billing_address['contact_id'];
        $team['billing_contact_name'] = civicrm_api3('Contact', 'getvalue', array('return' => 'display_name', 'id' => $billing_address['contact_id']));
        $team['billing_name'] = $billing_address['name'];
        $team['billing_supplemental_address'] = $billing_address['supplemental_address_1'];
        $team['billing_street_address'] = $billing_address['street_address'];
        $team['billing_postal_code'] = $billing_address['postal_code'];
        $team['billing_city'] = $billing_address['city'];
        if (isset($billing_address['country_id'])) {
          $billing_country = $countries[$billing_address['country_id']];
        }
        $team['billing_country'] = $billing_country;
      } catch (\Exception $e) {
        // Do nothing
      }
    } else {
      $team['billing_contact_id'] = '';
      $team['billing_contact_name'] = '';
      $team['billing_name'] = $teamDao->billing_name;
      $team['billing_supplemental_address'] = $teamDao->billing_supplemental_address;
      $team['billing_street_address'] = $teamDao->billing_street_address;
      $team['billing_postal_code'] = $teamDao->billing_postal_code;
      $team['billing_city'] = $teamDao->billing_city;
      $team['billing_country'] = $billing_country;
    }
    $teams[$teamDao->id] = $team;
  }
  
  return civicrm_api3_create_success($teams, $params, 'PortalTeamInfo', 'Get');
  
}