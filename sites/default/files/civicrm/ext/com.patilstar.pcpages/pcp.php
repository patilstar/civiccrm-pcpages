<?php

require_once 'pcp.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function pcp_civicrm_config(&$config) {
  _pcp_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function pcp_civicrm_xmlMenu(&$files) {
  _pcp_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function pcp_civicrm_install() {
  _pcp_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function pcp_civicrm_uninstall() {
  _pcp_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function pcp_civicrm_enable() {
  _pcp_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function pcp_civicrm_disable() {
  _pcp_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function pcp_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _pcp_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function pcp_civicrm_managed(&$entities) {
  _pcp_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function pcp_civicrm_caseTypes(&$caseTypes) {
  _pcp_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function pcp_civicrm_angularModules(&$angularModules) {
_pcp_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function pcp_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _pcp_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function pcp_civicrm_preProcess($formName, &$form) {

} // */



/**
 * Implements civitest_civicrm_tabs.
 *
 * @param $tabs
 * @param $contactID
 */
function pcp_civicrm_tabs( &$tabs, $contactID )
{

  $query = "
    SELECT * FROM civicrm_pcp pcp
    WHERE pcp.is_active = 1
    AND pcp.contact_id = %1
    ORDER BY page_type, page_id";

  $params = [
      1 => [$contactID, 'Integer']
  ];

  $pcpInfoDao = CRM_Core_DAO::executeQuery($query, $params);

  $count_pcp = $pcpInfoDao->fetch() ? count($pcpInfoDao) : 0;

  //URL to go to when contact clicks
  $url = CRM_Utils_System::url( 'civicrm/contact/view/pcps',"reset=1&snippet=1&force=1&cid=$contactID" );

  $tabs[] = [
      'id'      => 'pcps',
      'url'     => $url,
      'title'   => "Personal Campaign Pages",
      'count'   => $count_pcp,
      'weight'  => 300
  ];

}




function pcp_civicrm_tabset($tabsetName, &$tabs, $context) {
//  //check if the tab set is Event manage
//  if ($tabsetName == 'civicrm/event/manage') {
//    if (!empty($context)) {
//      $eventID = $context['event_id'];
//      $url = CRM_Utils_System::url( 'civicrm/event/manage/volunteer',
//          "reset=1&snippet=5&force=1&id=$eventID&action=update&component=event" );
//      //add a new Volunteer tab along with url
//      $tab['volunteer'] = array(
//          'title' => ts('Volunteers'),
//          'link' => $url,
//          'valid' => 1,
//          'active' => 1,
//          'current' => false,
//      );
//    }
//    else {
//      $tab['volunteer'] = array(
//          'title' => ts('Volunteers'),
//          'url' => 'civicrm/event/manage/volunteer',
//      );
//    }
//    //Insert this tab into position 4
//    $tabs = array_merge(
//        array_slice($tabs, 0, 4),
//        $tab,
//        array_slice($tabs, 4)
//    );
//  }
//
//  //check if the tabset is Contribution Page
//  if ($tabsetName == 'civicrm/admin/contribute') {
//    if (!empty($context['contribution_page_id'])) {
//      $contribID = $context['contribution_page_id'];
//      $url = CRM_Utils_System::url( 'civicrm/admin/contribute/newtab',
//          "reset=1&snippet=5&force=1&id=$contribID&action=update&component=contribution" );
//      //add a new Volunteer tab along with url
//      $tab['newTab'] = array(
//          'title' => ts('newTab'),
//          'link' => $url,
//          'valid' => 1,
//          'active' => 1,
//          'current' => false,
//      );
//    }
//    if (!empty($context['urlString']) && !empty($context['urlParams'])) {
//      $tab[] = array(
//          'title' => ts('newTab'),
//          'name' => ts('newTab'),
//          'url' => $context['urlString'] . 'newtab',
//          'qs' => $context['urlParams'],
//          'uniqueName' => 'newtab',
//      );
//    }
//    //Insert this tab into position 4
//    $tabs = array_merge(
//        array_slice($tabs, 0, 4),
//        $tab,
//        array_slice($tabs, 4)
//    );
//  }
//
//  //check if the tabset is Contact Summary Page
//  if ($tabsetName == 'civicrm/contact/view') {
//    // unset the contribition tab, i.e. remove it from the page
//    unset( $tabs[1] );
//    $contactId = $context['contact_id'];
//    // let's add a new "contribution" tab with a different name and put it last
//    // this is just a demo, in the real world, you would create a url which would
//    // return an html snippet etc.
//    $url = CRM_Utils_System::url( 'civicrm/contact/view/contribution',
//        "reset=1&snippet=1&force=1&cid=$contactID" );
//    // $url should return in 4.4 and prior an HTML snippet e.g. '<div><p>....';
//    // in 4.5 and higher this needs to be encoded in json. E.g. json_encode(array('content' => <html form snippet as previously provided>));
//    // or CRM_Core_Page_AJAX::returnJsonResponse($content) where $content is the html code
//    // in the first cases you need to echo the return and then exit, if you use CRM_Core_Page method you do not need to worry about this.
//    $tabs[] = array( 'id'    => 'mySupercoolTab',
//        'url'   => $url,
//        'title' => 'Contribution Tab Renamed',
//        'weight' => 300,
//    );
//  }
}



function pcp_civicrm_links( $op, $objectName, $objectId, &$links, &$mask, &$values ) {
  $myLinks = array();
  switch ($objectName) {
    case 'Contact':
      switch ($op) {
        case 'view.contact.activity':
          // Adds a link to the main tab.
//          $links[] = array(
//              'name' => ts('My Module Actions'),
//              'url' => 'mymodule/civicrm/actions/%%myObjId%%',
//              'title' => 'New Thing',
//          );
//          $values['myObjId'] = $objectId;
          break;

        case 'contact.selector.row':
          // Add a similar thing when a contact appears in a row
//          $links[] = array(
//              'name' => ts('My Module'),
//              'url' => 'mymodule/civicrm/actions/%%myObjId%%',
//              'title' => 'New Thing',
//              'qs' => 'reset=1&tid=%%thingId%%',
//          );
//          $values['myObjId'] = $objectId;
//          $values['thingId'] = 'mything';
          break;

        case 'create.new.shorcuts':
          // add link to create new profile
//          $links[] = array(
//              'url'   => '/civicrm/admin/uf/group?action=add&reset=1',
//              'name' => ts('New Profile'), // old extensions using 'title' will still work
//          );
          break;
      }
  }
  return $myLinks;
}


/**
 * Just for debug purpose - will delete this later
 * @param $variable
 */
function dd($variable){
  echo '<pre>' . var_dump($variable) . '</pre>';
  exit;
}
