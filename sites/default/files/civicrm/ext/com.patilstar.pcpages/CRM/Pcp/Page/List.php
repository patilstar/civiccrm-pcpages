<?php

require_once 'CRM/Core/Page.php';

class CRM_Pcp_Page_List extends CRM_Core_Page
{

    protected function makePages($pages){

        $pcpStatus = CRM_Contribute_PseudoConstant::pcpStatus();

        if($pages['count'])
        {
            foreach($pages['values'] as $key => $page)
            {
                #and amount contributed
                $no_contributions = $page["api.ContributionSoft.get"]['count'];

                if($no_contributions){

                    //contributions
                    $contributions = $page["api.ContributionSoft.get"]['values'];

                    //amount raised
                    $amount_raised = array_sum(array_column($contributions, 'amount'));

                    //add amount raised to array
                    $pages['values'][$key]['amount_raised'] = CRM_Utils_Money::format($amount_raised, $page['currency']);

                    //format goal_amount
                    $pages['values'][$key]['goal_amount']   = CRM_Utils_Money::format($page['goal_amount'], $page['currency']);

                    //no of contributions
                    $pages['values'][$key]['no_contributions'] = $no_contributions;
                }

                //contribution page
                $contribution_page = CRM_Utils_Array::first($page["api.ContributionPage.get"]['values']);
                if($contribution_page){
                    $pages['values'][$key]['contribution_page_title'] = $contribution_page['title'];
                }

                //add status
                $pages['values'][$key]['status'] = $pcpStatus[$page['status_id']];
            }
        }

        return $pages;
    }


    public function run()
    {
        // Set the page-title dynamically
        CRM_Utils_System::setTitle(ts('List'));

        //Get current contact id
        $contact_id = CRM_Utils_Request::retrieve('cid', 'Positive', $this);

        //Params
        $params = array(
            'contact_id'                  => $contact_id,
            'api.ContributionSoft.get'    => [
                'pcp_id' => '$value.id'
            ],
            'api.ContributionPage.get'    => [
                'id' => '$value.page_id'
            ]
        );

        //Make call to API
        $pages = [];
        $exceptionError = [];

        try {

            $pages = civicrm_api3('PCP', 'get', $params);

            $pages = $this->makePages($pages);

        } catch (CiviCRM_API3_Exception $e) {
            $exceptionError = $e;
        }

        $this->assign('pages', $pages);
        $this->assign('exceptionError', $exceptionError);

        parent::run();
    }
}
