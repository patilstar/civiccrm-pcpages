





        <div id="contact-summary" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
            {if (isset($hookContentPlacement) and ($hookContentPlacement neq 3)) or empty($hookContentPlacement)}

            {if !empty($hookContent) and isset($hookContentPlacement) and $hookContentPlacement eq 2}
            {include file="CRM/Contact/Page/View/SummaryHook.tpl"}
            {/if}

            <div class="contactTopBar contact_panel">
                <div class="contactCardLeft">
                    {crmRegion name="contact-basic-info-left"}
                    <div class="crm-summary-contactinfo-block">
                        <div class="crm-summary-block" id="contactinfo-block">
                            {include file="CRM/Contact/Page/Inline/ContactInfo.tpl"}
                        </div>
                    </div>
                    {/crmRegion}
                </div> <!-- end of left side -->
                <div class="contactCardRight">
                    {crmRegion name="contact-basic-info-right"}
                    {if !empty($imageURL)}
                    <div id="crm-contact-thumbnail">
                        {include file="CRM/Contact/Page/ContactImage.tpl"}
                    </div>
                    {/if}
                    <div class="{if !empty($imageURL)} float-left{/if}">
                        <div class="crm-clear crm-summary-block">
                            <div class="crm-summary-row">
                                <div class="crm-label" id="tagLink">
                                    <a href="{crmURL p='civicrm/contact/view' q="reset=1&cid=$contactId&selectedChild=tag"}"
                                       title="{ts}Edit Tags{/ts}">{ts}Tags{/ts}</a>
                                </div>
                                <div class="crm-content" id="tags">{$contactTag}</div>
                            </div>
                            <div class="crm-summary-row">
                                <div class="crm-label">{ts}Contact Type{/ts}</div>
                                <div class="crm-content crm-contact_type_label">
                                    {if isset($contact_type_label)}{$contact_type_label}{/if}
                                </div>
                            </div>
                            <div class="crm-summary-row">
                                <div class="crm-label">
                                    {ts}Contact ID{/ts}{if !empty($userRecordUrl)} / {ts}User ID{/ts}{/if}
                                </div>
                                <div class="crm-content">
                                    <span class="crm-contact-contact_id">{$contactId}</span>
                                    {if !empty($userRecordUrl)}
                          <span class="crm-contact-user_record_id">
                            &nbsp;/&nbsp;<a title="View user record" class="user-record-link"
                                            href="{$userRecordUrl}">{$userRecordId}</a>
                          </span>
                                    {/if}
                                </div>
                            </div>
                            <div class="crm-summary-row">
                                <div class="crm-label">{ts}External ID{/ts}</div>
                                <div class="crm-content crm-contact_external_identifier_label">
                                    {if isset($external_identifier)}{$external_identifier}{/if}
                                </div>
                            </div>
                        </div>
                    </div>
                    {/crmRegion}
                </div>
                <!-- end of right side -->
            </div>
            <div class="contact_details">
                <div class="contact_panel">
                    <div class="contactCardLeft">
                        {crmRegion name="contact-details-left"}
                        <div >
                            {if $showEmail}
                            <div class="crm-summary-email-block crm-summary-block" id="email-block">
                                {include file="CRM/Contact/Page/Inline/Email.tpl"}
                            </div>
                            {/if}
                            {if $showWebsite}
                            <div class="crm-summary-website-block crm-summary-block" id="website-block">
                                {include file="CRM/Contact/Page/Inline/Website.tpl"}
                            </div>
                            {/if}
                        </div>
                        {/crmRegion}
                    </div><!-- #contactCardLeft -->

                    <div class="contactCardRight">
                        {crmRegion name="contact-details-right"}
                        <div>
                            {if $showPhone}
                            <div class="crm-summary-phone-block crm-summary-block" id="phone-block">
                                {include file="CRM/Contact/Page/Inline/Phone.tpl"}
                            </div>
                            {/if}
                            {if $showIM}
                            <div class="crm-summary-im-block crm-summary-block" id="im-block">
                                {include file="CRM/Contact/Page/Inline/IM.tpl"}
                            </div>
                            {/if}
                            {if $showOpenID}
                            <div class="crm-summary-openid-block crm-summary-block" id="openid-block">
                                {include file="CRM/Contact/Page/Inline/OpenID.tpl"}
                            </div>
                            {/if}
                        </div>
                        {/crmRegion}
                    </div><!-- #contactCardRight -->

                    <div class="clear"></div>
                </div><!-- #contact_panel -->
                {if $showAddress}
                <div class="contact_panel">
                    {assign var='locationIndex' value=1}
                    {if $address}
                    {foreach from=$address item=add key=locationIndex}
                    <div class="{if $locationIndex is odd}contactCardLeft{else}contactCardRight{/if} crm-address_{$locationIndex} crm-address-block crm-summary-block">
                        {include file="CRM/Contact/Page/Inline/Address.tpl"}
                    </div>
                    {/foreach}
                    {assign var='locationIndex' value=$locationIndex+1}
                    {/if}
                    {* add new link *}
                    {if $permission EQ 'edit'}
                    {assign var='add' value=0}
                    <div class="{if $locationIndex is odd}contactCardLeft{else}contactCardRight{/if} crm-address-block crm-summary-block">
                        {include file="CRM/Contact/Page/Inline/Address.tpl"}
                    </div>
                    {/if}

                </div> <!-- end of contact panel -->
                {/if}
                <div class="contact_panel">
                    {if $showCommunicationPreferences}
                    <div class="contactCardLeft">
                        <div class="crm-summary-comm-pref-block">
                            <div class="crm-summary-block" id="communication-pref-block" >
                                {include file="CRM/Contact/Page/Inline/CommunicationPreferences.tpl"}
                            </div>
                        </div>
                    </div> <!-- contactCardLeft -->
                    {/if}
                    {if $contact_type eq 'Individual' AND $showDemographics}
                    <div class="contactCardRight">
                        <div class="crm-summary-demographic-block">
                            <div class="crm-summary-block" id="demographic-block">
                                {include file="CRM/Contact/Page/Inline/Demographics.tpl"}
                            </div>
                        </div>
                    </div> <!-- contactCardRight -->
                    {/if}
                    <div class="clear"></div>
                    <div class="separator"></div>
                </div> <!-- contact panel -->
            </div><!--contact_details-->

            {if $showCustomData}
            <div id="customFields">
                <div class="contact_panel">
                    <div class="contactCardLeft">
                        {include file="CRM/Contact/Page/View/CustomDataView.tpl" side='1'}
                    </div><!--contactCardLeft-->
                    <div class="contactCardRight">
                        {include file="CRM/Contact/Page/View/CustomDataView.tpl" side='0'}
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
            {/if}

            {if !empty($hookContent) and isset($hookContentPlacement) and $hookContentPlacement eq 1}
            {include file="CRM/Contact/Page/View/SummaryHook.tpl"}
            {/if}
            {else}
            {include file="CRM/Contact/Page/View/SummaryHook.tpl"}
            {/if}
        </div>
        <div class="clear"></div>
