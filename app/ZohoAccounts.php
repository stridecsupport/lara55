<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use zcrmsdk\crm\setup\org\ZCRMOrganization;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;

use DB;

class ZohoAccounts extends Model
{   
	protected $table = 'accounts';
	
	public function getZohoAccounts() {	

		$configuration = array(
		"client_id" => env('CLIENT_ID'),
		"client_secret" => env('CLIENT_SECRET'),
		"redirect_uri" => env('RETURN_URI'),
		"accounts_url" => env('ACCOUNT_URL'),
		"currentUserEmail" => env('CURRENT_USER_EMAIL'),
		"apiBaseUrl" => env('API_BASE_URL'),
		"token_persistence_path" => env('TOKEN_PERSISTENCE_PATH')
		);

		ZCRMRestClient::initialize($configuration);
						
		try{
			$accountsList = ZCRMRestClient::getInstance()->getModuleInstance("Accounts");
			$records = $accountsList->getRecords();
			$accounts = $records->getData();
			
			DB::table('accounts')->delete();
			
			foreach($accounts as $account) {				
				$entityId = $account->getEntityId();				
				
				$zohoaccount = $account->getData();
				
				$zohoaccounts = new ZohoAccounts;								
				$zohoaccounts->accountName = $zohoaccount['Account_Name'];
				$zohoaccounts->website = $zohoaccount['Website'];
				$zohoaccounts->phoneNumber = $zohoaccount['Phone'];
				$zohoaccounts->address = $zohoaccount['Billing_Street'];
				$zohoaccounts->city = $zohoaccount['Billing_City'];
				$zohoaccounts->state = $zohoaccount['Billing_State'];
				$zohoaccounts->country = $zohoaccount['Billing_Country'];
				$zohoaccounts->postalCode = $zohoaccount['Billing_Code'];	

				$contactsList = ZCRMRestClient::getInstance()->getModuleInstance("Contacts");
				$contactData = $contactsList->searchRecordsByCriteria("(Mailing_Street:equals:".$zohoaccount['Billing_Street'].")");				
				$contacts = $contactData->getData();
				foreach($contacts as $contact) {
					$zohocontact = $contact->getData();
					$zohoaccounts->fullName = $zohocontact['Full_Name'];
					$zohoaccounts->email = $zohocontact['Email'];					
				}
				$zohoaccounts->save();				
			}
			
		}
		catch(ZCRMException $e)
		{
			echo $e->getMessage();
			echo $e->getExceptionCode();
			echo $e->getCode();
		}
	}
}
