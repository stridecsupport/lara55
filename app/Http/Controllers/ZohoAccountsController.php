<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use zcrmsdk\crm\setup\org\ZCRMOrganization;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\crm\setup\users\ZCRMProfile;
use zcrmsdk\crm\setup\users\ZCRMRole;
use zcrmsdk\crm\setup\users\ZCRMUser;
use zcrmsdk\crm\crud\ZCRMOrgTax;

//use zcrmsdk\oauth\ZohoOAuth;
use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\crud\ZCRMModule;

use App\ZohoAccounts;
use DB;

class ZohoAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	
    public function index()
    {
		$zohoaccounts = ZohoAccounts::all();
        return view('zohoaccounts.index', compact('zohoaccounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function generateAccessToken() {
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
		
		$refresh_token = "1000.2e13ef4f2edf82c32760911a474d8100.6b3f7e78f4022e1872b67b0f2b07ae54";
		
		$accessToken2 = $refresh_token;
		$oAuthClient = ZohoOAuth::getClientInstance();
		$refreshToken = $accessToken2;
		$userIdentifier = "balamurugan.sk@gmail.com";
		$oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken, $userIdentifier);
	}
	
	public function syncZohoAccounts() {
				
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
			
			return redirect('zohoaccounts');
		}
		catch(ZCRMException $e)
		{
			echo $e->getMessage();
			echo $e->getExceptionCode();
			echo $e->getCode();
		}		
	}	
	
	public function truncateZohoAccounts() {
		DB::table('accounts')->delete();
		return redirect('zohoaccounts');
	}
}
