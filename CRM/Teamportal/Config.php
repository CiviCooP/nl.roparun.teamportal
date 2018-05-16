<?php

class CRM_Teamportal_Config {
  
  private static $singleton;
  
  private $genericConfig;
  
  private $_teamMemberDataCustomGroupId;
  private $_teamMemberDataCustomGroupTableName;
  private $_memberOfTeamCustomFieldId;
  private $_memberOfTeamCustomFieldColumnName;
  private $_teamRoleCustomFieldId;
  private $_teamRoleCustomFieldColumnName;
  private $_activeParticipantStatusIds = array();
  
  private function __construct() {
    $this->genericConfig = CRM_Generic_Config::singleton();
    
    $this->loadCustomGroups();
    
    $participantStatuses = civicrm_api3('ParticipantStatusType', 'get', array('is_active' => 1, 'class' => array('IN' => array("Positive")), 'options' => array('limit' => 0)));
    foreach($participantStatuses['values'] as $participantStatus) {
      $this->_activeParticipantStatusIds[] = $participantStatus['id'];
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
   * Getter for the column name of the custom field team_name.
   */
  public function getTeamNameCustomFieldColumnName() {
    return $this->genericConfig->getTeamNameCustomFieldColumnName();
  }
  
  /**
   * Getter for the custom group id of custom group team_member_data.
   */
  public function getTeamMemberDataCustomGroupId() {
    return $this->_teamMemberDataCustomGroupId;
  }
  
  /**
   * Getter for the table name of the custom group team_member_data.
   */
  public function getTeamMemberDataCustomGroupTableName() {
    return $this->_teamMemberDataCustomGroupTableName;
  }
  
  /**
   * Getter for the custom field id of the custom field team_member_of_team.
   */
  public function getMemberOfTeamCustomFieldId() {
    return $this->_memberOfTeamCustomFieldId;
  }
  
  /**
   * Getter for the column name of the custom field team_member_of_team.
   */
  public function getMemberOfTeamCustomFieldColumnName() {
    return $this->_memberOfTeamCustomFieldColumnName;
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
   * Returns an array with status ids for active participant statuses.
   */
  public function getActiveParticipantStatusIds() {
    return $this->_activeParticipantStatusIds;
  }
  
  private function loadCustomGroups() {    
    try {
      $_teamMemberCustomGroup = civicrm_api3('CustomGroup', 'getsingle', array('name' => 'team_member_data'));
      $this->_teamMemberDataCustomGroupId = $_teamMemberCustomGroup['id'];
      $this->_teamMemberDataCustomGroupTableName = $_teamMemberCustomGroup['table_name'];
    } catch (Exception $ex) {
      throw new Exception('Could not find custom group for Team Member Data');
    }
    try {
      $_memberOfTeamCustomField = civicrm_api3('CustomField', 'getsingle', array('name' => 'team_member_of_team', 'custom_group_id' => $this->_teamMemberDataCustomGroupId));
      $this->_memberOfTeamCustomFieldColumnName = $_memberOfTeamCustomField['column_name'];
      $this->_memberOfTeamCustomFieldId = $_memberOfTeamCustomField['id'];
    } catch (Exception $ex) {
      throw new Exception('Could not find custom field Member of Team');
    }
    try {
      $_teamRoleCustomField = civicrm_api3('CustomField', 'getsingle', array('name' => 'team_role', 'custom_group_id' => $this->_teamMemberDataCustomGroupId));
      $this->_teamRoleCustomFieldColumnName = $_teamRoleCustomField['column_name'];
      $this->_teamRoleCustomFieldId = $_teamRoleCustomField['id'];
    } catch (Exception $ex) {
      throw new Exception('Could not find custom field Team role');
    }
  }
  
}
