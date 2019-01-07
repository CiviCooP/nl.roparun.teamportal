<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

namespace Civi\Teamportal\FormProcessor\Type;

use \Civi\FormProcessor\Type\AbstractType;
use \Civi\FormProcessor\Type\OptionListInterface;

use CRM_Teamportal_ExtensionUtil as E;

class TeamLeden extends AbstractType implements OptionListInterface {

  public function __construct() {
    parent::__construct('teamportal_type_teamleden', E::ts('Teamleden'));
  }


  public function validateValue($value, $allValues=array()) {
    if (\CRM_Utils_Type::validate($value, 'Integer', false) === NULL) {
      return false;
    }

    $teamLeden = $this->getOptions();
    if (!isset($teamLeden[$value])) {
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
    $team_members = civicrm_api3('PortalTeamMember', 'Get', array('team_id' => $team_id, 'options' => array('limit' => 0)));
    $return = array();
    foreach($team_members['values'] as $team_member) {
      if ($team_member['is_team_captain']) {
        continue;
      }
      $return[$team_member['id']] = $team_member['display_name'];
    }
    return $return;
  }

}