<?php

class CRM_Teamportal_Config {
  
  private static $singleton;
  
  private $genericConfig;
  
  private $_teamRoleCustomFieldId;
  private $_teamRoleCustomFieldColumnName;
  private $_activeParticipantStatusIds = array();
  private $_orderActivityTypeId;
  
  private function __construct() {
    $this->genericConfig = CRM_Generic_Config::singleton();
    
    $this->loadCustomGroups();
    
    $participantStatuses = civicrm_api3('ParticipantStatusType', 'get', array('is_active' => 1, 'class' => array('IN' => array("Positive")), 'options' => array('limit' => 0)));
    foreach($participantStatuses['values'] as $participantStatus) {
      $this->_activeParticipantStatusIds[] = $participantStatus['id'];
    }

    try {
      $this->_orderActivityTypeId = civicrm_api3('OptionValue', 'getvalue', array('return' => 'value', 'name' => 'order', 'option_group_id' => 'activity_type'));
    } catch (Exception $e) {
      throw new Exception('Could not find order activity type');
    }
  }
  
  /**
   * @return CRM_Teamportal_Config
   */
  public static function singleton() {
    if (!self::$singleton) {
      self:: $singleton = new CRM_Teamportal_Config();
    }
    return self::$singleton;
  }

  /**
   * Getter for the phone type during event.
   *
   * @return int
   */
  public function getDuringEventPhoneTypeId() {
    return $this->genericConfig->getDuringEventPhoneTypeId();
  }
  
  /**
   * Getter for the id of the custom group team_data.
   */
  public function getTeamDataCustomGroupId() {
    return $this->genericConfig->getTeamDataCustomGroupId();
  }
  
  /**
   * Getter for the table name of the custom group team_data.
   */
  public function getTeamDataCustomGroupTableName() {
    return $this->genericConfig->getTeamDataCustomGroupTableName();
  }
  
  /**
   * Getter for the id of the custom field team_nr.
   */
  public function getTeamNrCustomFieldId() {
    return $this->genericConfig->getTeamNrCustomFieldId();
  }
  
  /**
   * Getter for the column name of the custom field team_nr.
   */
  public function getTeamNrCustomFieldColumnName() {
    return $this->genericConfig->getTeamNrCustomFieldColumnName();
  }
  
  /**
   * Getter for the id of the custom field team_name.
   */
  public function getTeamNameCustomFieldId() {
    return $this->genericConfig->getTeamNameCustomFieldId();
  }
  
  /**
   * Getter for the id of the custom field start_location.
   */
  public function getStartLocationCustomFieldId() {
    return $this->genericConfig->getStartLocationCustomFieldId();
  }
  
  /**
   * Getter for the column name of the custom field start_location.
   */
  public function getStartLocationCustomFieldColumnName() {
    return $this->genericConfig->getStartLocationCustomFieldColumnName();
  }
  
  /**
   * Getter for the column name of the custom field team_name.
   */
  public function getTeamNameCustomFieldColumnName() {
    return $this->genericConfig->getTeamNameCustomFieldColumnName();
  }
  
  /**
   * Getter for the custom group id of custom group team_member_data.
   */
  public function getTeamMemberDataCustomGroupId() {
    return $this->genericConfig->getTeamMemberDataCustomGroupId();
  }
  
  /**
   * Getter for the table name of the custom group team_member_data.
   */
  public function getTeamMemberDataCustomGroupTableName() {
    return $this->genericConfig->getTeamMemberDataCustomGroupTableName();
  }
  
  /**
   * Getter for the custom field id of the custom field team_member_of_team.
   */
  public function getMemberOfTeamCustomFieldId() {
    return $this->genericConfig->getMemberOfTeamCustomFieldId();
  }
  
  /**
   * Getter for the column name of the custom field team_member_of_team.
   */
  public function getMemberOfTeamCustomFieldColumnName() {
    return $this->genericConfig->getMemberOfTeamCustomFieldColumnName();
  }
  
  /**
   * Getter for the custom field id of the custom field team_role.
   */
  public function getTeamRoleCustomFieldId() {
    return $this->_teamRoleCustomFieldId;
  }
  
  /**
   * Getter for the column name of the custom field team_role.
   */
  public function getTeamRoleCustomFieldColumnName() {
    return $this->_teamRoleCustomFieldColumnName;
  }
  
  /**
   * Getter for the id fo the custom field website.
   */
  public function getShowOnWebsiteCustomFieldId() {
    return $this->genericConfig->getShowOnWebsiteCustomFieldId();
  }
  
  /**
   * Getter for the column name of the custom field website.
   */
  public function getShowOnWebsiteCustomFieldColumnName() {
    return $this->genericConfig->getShowOnWebsiteCustomFieldColumnName();
  }

  
  /**
   * Returns an array with status ids for active participant statuses.
   */
  public function getActiveParticipantStatusIds() {
    return $this->_activeParticipantStatusIds;
  }
  
  /**
   * Getter for vestigingsplaats location type id.
   */
  public function getVestingsplaatsLocationTypeId() {
    return $this->genericConfig->getVestingsplaatsLocationTypeId();
  }
  
  /**
   * Getter for role id of team.
   */
  public function getTeamParticipantRoleId() {
    return $this->genericConfig->getTeamParticipantRoleId();
  }

  /**
   * Getter for the id of the custom group teamcaptain_teamportal
   */
  public function getTeamcaptainCustomGroupId() {
    return $this->genericConfig->getTeamcaptainCustomGroupId();
  }

  /**
   * Getter for the id of the custom group teamcaptain_teamportal
   */
  public function getTeamcaptainCustomGroupTableName() {
    return $this->genericConfig->getTeamcaptainCustomGroupTableName();
  }

  /**
   * Getter for the id of the custom field teamcaptain_teamportal_access.
   */
  public function getTeamcaptainTeamportalAccessCustomFieldId() {
    return $this->genericConfig->getTeamcaptainTeamportalAccessCustomFieldId();
  }

  /**
   * Getter for the column name of the custom field teamcaptain_teamportal_access.
   */
  public function getTeamcaptainTeamportalAccessCustomFieldColumnName() {
    return $this->genericConfig->getTeamcaptainTeamportalAccessCustomFieldColumnName();
  }

  /**
   * Getter for the relationship type id.
   */
  public function getTeamCaptainRelationshipTypeId() {
    return $this->genericConfig->getTeamCaptainRelationshipTypeId();
  }

  /**
   * Getter for the billing location type id.
   *
   * @return int
   */
  public function getBillingLocationTypeId() {
    return $this->genericConfig->getBillingLocationTypeId();
  }

  /**
   * Getter for the order activity type id.
   *
   * @return int
   */
  public function getOrderActivityTypeId() {
    return $this->_orderActivityTypeId;
  }
  
  private function loadCustomGroups() {    
    try {
      $_teamRoleCustomField = civicrm_api3('CustomField', 'getsingle', array('name' => 'team_role', 'custom_group_id' => $this->genericConfig->getTeamMemberDataCustomGroupId()));
      $this->_teamRoleCustomFieldColumnName = $_teamRoleCustomField['column_name'];
      $this->_teamRoleCustomFieldId = $_teamRoleCustomField['id'];
    } catch (Exception $ex) {
      throw new Exception('Could not find custom field Team role');
    }
  }
  
}
