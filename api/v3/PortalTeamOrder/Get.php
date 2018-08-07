<?php
/**
 * @author Jaap Jansma <jaap.jansma@civicoop.org>
 * @license AGPL-3.0
 */

use CRM_Teamportal_ExtensionUtil as E;

/**
 * PortalTeamOrder.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_portal_team_order_Get_spec(&$spec) {
  $spec['team_id'] = [
    'api.required' => TRUE,
    'api.return' => TRUE,
    'api.filter' => TRUE,
    'title' => 'Contact ID of the team',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['status_id'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => true,
    'title' => 'Status ID',
    'type' => CRM_Utils_Type::T_INT,
    'pseudoconstant' => array(
      'optionGroupName' => 'activity_status',
    ),
  );
  $spec['id'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => TRUE,
    'title' => E::ts('Contact ID'),
    'type' => CRM_Utils_Type::T_INT,
  );
  $spec['date'] = array(
    'api.required' => false,
    'api.return' => true,
    'api.filter' => false,
    'title' => E::ts('Date'),
    'type' => CRM_Utils_Type::T_DATE,
  );

  $spec['dames_shirt_xs'] = [
    'api.aliases' => ['dames_shirt_xs'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Dames Shirt (XS)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['dames_shirt_s'] = [
    'api.aliases' => ['dames_shirt_s'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Dames Shirt (S)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['dames_shirt_m'] = [
    'api.aliases' => ['dames_shirt_m'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Dames Shirt (M)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['dames_shirt_l'] = [
    'api.aliases' => ['dames_shirt_l'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Dames Shirt (L)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['dames_shirt_xl'] = [
    'api.aliases' => ['dames_shirt_xl'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Dames Shirt (XL)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['dames_shirt_xxl'] = [
    'api.aliases' => ['dames_shirt_xxl'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Dames Shirt (XXL)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['dames_shirt_xxxl'] = [
    'api.aliases' => ['dames_shirt_xxxl'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Dames Shirt (XXXL)',
    'type' => CRM_Utils_Type::T_INT,
  ];

  $spec['heren_shirt_xs'] = [
    'api.aliases' => ['heren_shirt_xs'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Heren Shirt (XS)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['heren_shirt_s'] = [
    'api.aliases' => ['heren_shirt_s'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Heren Shirt (S)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['heren_shirt_m'] = [
    'api.aliases' => ['heren_shirt_m'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Heren Shirt (M)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['heren_shirt_l'] = [
    'api.aliases' => ['heren_shirt_l'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Heren Shirt (L)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['heren_shirt_xl'] = [
    'api.aliases' => ['heren_shirt_xl'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Heren Shirt (XL)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['heren_shirt_xxl'] = [
    'api.aliases' => ['heren_shirt_xxl'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Heren Shirt (XXL)',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['heren_shirt_xxxl'] = [
    'api.aliases' => ['heren_shirt_xxxl'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Heren Shirt (XXXL)',
    'type' => CRM_Utils_Type::T_INT,
  ];


  $spec['medailles'] = [
    'api.aliases' => ['medailles'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Medailles',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['pastamaaltijden'] = [
    'api.aliases' => ['pastamaaltijden'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Pastamaaltijden',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['overnachten_startlocatie'] = [
    'api.aliases' => ['overnachten_startlocatie'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Overnachten Startlocatie',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['overnachten_startlocatie_bbq'] = [
    'api.aliases' => ['overnachten_startlocatie_bbq'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Overnachten Startlocatie: BBQ Pakketten',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['overnachten_startlocatie_brood'] = [
    'api.aliases' => ['overnachten_startlocatie_brood'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Overnachten Startlocatie: Broden',
    'type' => CRM_Utils_Type::T_INT,
  ];
  $spec['entreekaarten_slotavond'] = [
    'api.aliases' => ['entreekaarten_slotavond'],
    'api.required' => FALSE,
    'api.return' => TRUE,
    'api.filter' => FALSE,
    'title' => 'Entreekaarten Slotavond',
    'type' => CRM_Utils_Type::T_INT,
  ];
}

/**
 * PortalTeamOrder.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_portal_team_order_Get($params) {
  $config = CRM_Teamportal_Config::singleton();
  $event_id = CRM_Generic_CurrentEvent::getCurrentRoparunEventId();
  $campaign_id = CRM_Generic_CurrentEvent::getRoparunCampaignId($event_id);
  $team_id = $params['team_id'];

  $target_record_type_id = civicrm_api3('OptionValue', 'getvalue', array('return' => 'value', 'name' => 'Activity Targets', 'option_group_id' => 'activity_contacts'));

  $options = _civicrm_api3_get_options_from_params($params);
  $limit = "";
  if (isset($options['limit']) && $options['limit'] > 0 && isset($options['offset'])) {
    $limit = "LIMIT ".CRM_Utils_Type::escape($options['offset'], 'Integer', TRUE).", ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
  } elseif (isset($options['limit']) && $options['limit'] > 0) {
    $limit = "LIMIT ".CRM_Utils_Type::escape($options['limit'], 'Integer', TRUE);
  }

  $sort = "activity_date_time DESC";
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

  $whereClauses[] = "a.is_current_revision = 1 AND a.is_deleted = 0";
  $whereClauses[] = "a.activity_type_id = %2";
  $whereClauses[] = "ac.contact_id = %3";
  $whereClauses[] = "a.campaign_id = %4";
  if (isset($params['status_id'])) {
    if (!is_array($params['status_id'])) {
      $params['status_id'] = array('=' => $params['status_id']);
    }
    $whereClauses[] = CRM_Core_DAO::createSQLFilter("a.status_id", $params['status_id']);
  }
  $where = implode(" AND ", $whereClauses);

  $sql = "SELECT a.id, a.status_id, a.activity_date_time, team_order.*  
  FROM civicrm_activity a
  INNER JOIN civicrm_activity_contact ac ON ac.activity_id = a.id AND ac.record_type_id = %1
  INNER JOIN civicrm_value_roparun_order team_order ON team_order.entity_id = a.id 
  WHERE {$where}  
  ORDER BY {$sort}
  {$limit}";

  $sqlParams[1] = array($target_record_type_id, 'Integer');
  $sqlParams[2] = array($config->getOrderActivityTypeId(), 'Integer');
  $sqlParams[3] = array($team_id, 'Integer');
  $sqlParams[4] = array($campaign_id, 'Integer');

  $dao = CRM_Core_DAO::executeQuery($sql, $sqlParams);
  $return = array();
  while ($dao->fetch()) {
    $row = array();
    $row['id'] = $dao->id;
    $row['status_id'] = $dao->status_id;
    $row['date'] = CRM_Utils_Date::mysqlToIso(CRM_Utils_Date::processDate($dao->activity_date_time, NULL, FALSE, 'Ymd'));

    $row['dames_shirt_xs'] = $dao->dames_shirt_xs;
    $row['dames_shirt_s'] = $dao->dames_shirt_s;
    $row['dames_shirt_m'] = $dao->dames_shirt_m;
    $row['dames_shirt_l'] = $dao->dames_shirt_l;
    $row['dames_shirt_xl'] = $dao->dames_shirt_xl;
    $row['dames_shirt_xxl'] = $dao->dames_shirt_xxl;
    $row['dames_shirt_xxxl'] = $dao->dames_shirt_xxxl;
    $row['heren_shirt_xs'] = $dao->heren_shirt_xs;
    $row['heren_shirt_s'] = $dao->heren_shirt_s;
    $row['heren_shirt_m'] = $dao->heren_shirt_m;
    $row['heren_shirt_l'] = $dao->heren_shirt_l;
    $row['heren_shirt_xl'] = $dao->heren_shirt_xl;
    $row['heren_shirt_xxl'] = $dao->heren_shirt_xxl;
    $row['heren_shirt_xxxl'] = $dao->heren_shirt_xxxl;
    $row['medailles'] = $dao->medailles;
    $row['pastamaaltijden'] = $dao->pastamaaltijden;
    $row['overnachten_startlocatie'] = $dao->overnachten_startlocatie;
    $row['overnachten_startlocatie_bbq'] = $dao->overnachten_startlocatie_bbq;
    $row['overnachten_startlocatie_brood'] = $dao->overnachten_startlocatie_brood;
    $row['entreekaarten_slotavond'] = $dao->entreekaarten_slotavond;

    $return[] = $row;
  }

  return civicrm_api3_create_success($return, $params, 'PortalTeamOrder', 'Get');
}

