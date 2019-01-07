<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

namespace Civi\Teamportal\FormProcessor\Type;

use \Civi\FormProcessor\Type\AbstractType;
use \Civi\FormProcessor\Type\OptionListInterface;

use CRM_Teamportal_ExtensionUtil as E;

class TeamCaptainAddress extends AbstractType implements OptionListInterface {

  public function __construct() {
    parent::__construct('teamportal_type_teamcaptainaddress', E::ts('Team captain address'));
  }


  public function validateValue($value, $allValues=array()) {
    if (\CRM_Utils_Type::validate($value, 'Integer', false) === NULL) {
      return false;
    }
    return true;
  }

  /**
   * Returns the type number from CRM_Utils_Type
   */
  public function getCrmType() {
    return \CRM_Utils_Type::T_INT;
  }

  public function getOptions($params) {
    $team_id = $params['team_id'];
    if (!$team_id) {
      return array();
    }

    $teamCaptains = civicrm_api3('PortalTeamCaptain', 'get', array('team_id' => $team_id, 'is_active' => 1));
    $return = array();
    foreach($teamCaptains['values'] as $teamCaptain) {
      $address_elements = array();
      $address_elements[] = $teamCaptain['display_name'];
      $address_elements[] = $teamCaptain['address'];
      $address_elements[] = $teamCaptain['postal_code'];
      $address_elements[] = $teamCaptain['city'];
      $address_elements[] = $teamCaptain['country'];
      $return[$teamCaptain['contact_id']] = implode(", ", $address_elements);
    }
    return $return;
  }

}