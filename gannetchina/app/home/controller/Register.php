<?php
namespace app\home\controller;

use think\Db;
use think\captcha\Captcha;
use think\Validate;

class Register extends Base
{

    public function index()
    {
		var_dump('nnn');
	    if(session('uhid')){ //已经登录时直接跳到首页
	        $this->redirect(__ROOT__."/");
	    }else{
			return $this->view->fetch('user:register');
	    }
	}
	//验证码
	public function verify()
    {
		var_dump('nnn');
        if (session('uhid')) {
            $this->redirect(__ROOT__."/");
        }
		ob_end_clean();
		$verify = new Captcha (config('verify'));
		return $verify->entry('reg');
    }

    public function runregister()
    {
var_dump('nnn');exit;
		include_once('./LXCRM/init.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $country = $_POST['countryId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneCountryCode = $_POST['phoneCountryCode'];
    $phoneAreaCode = $_POST['phoneAreaCode'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $groupName = $_POST['tradingPlatformGroupName'];

    try {
        $countryId = new guid();
        $countryId = $country;

        $ownerUserId = new guid();
        $ownerUserId = $config['ownerUserId'];

        $demoAccountRegistrationRequest = new DemoAccountRegistrationRequest();
        $demoAccountRegistrationRequest->TradingPlatformId = $config['tradingPlatforms']['DEMO']['id'];
        $demoAccountRegistrationRequest->GroupName = $groupName;
        $demoAccountRegistrationRequest->CountryId = $countryId;
        $demoAccountRegistrationRequest->FirstName = $firstName;
        $demoAccountRegistrationRequest->LastName = $lastName;
        $demoAccountRegistrationRequest->PhoneCountryCode = $phoneCountryCode;
        $demoAccountRegistrationRequest->PhoneAreaCode = $phoneAreaCode;
        $demoAccountRegistrationRequest->PhoneNumber = $phoneNumber;
        $demoAccountRegistrationRequest->Email = $email;
        $demoAccountRegistrationRequest->Password = $password;

        $demoAccountRegistrationRequest->LoggedInAccountId = '00000000-0000-0000-0000-000000000000';
        $demoAccountRegistrationRequest->PlaceOfBirth = '';

        $demoAccountRegistrationRequest->AdditionalInfo = new DynamicAttributeInfo();
        $demoAccountRegistrationRequest->EnvironmentInfo = new EnvironmentInfo();
        $demoAccountRegistrationRequest->MarketingInfo = new MarketingInfo();

        $registerDemoAccount = new RegisterDemoAccount();

        $registerDemoAccount->ownerUserId = $ownerUserId;
        $registerDemoAccount->organizationName = $config['organization'];
        $registerDemoAccount->businessUnitName = $config['businessUnitName'];
        $registerDemoAccount->demoAccountRegistrationRequest = $demoAccountRegistrationRequest;

        $leverateCrm = getCrm($config);

        $registerDemoAccountResponse = $leverateCrm->RegisterDemoAccount($registerDemoAccount);
        $result = $registerDemoAccountResponse->RegisterDemoAccountResult;

        $ResultInfo = $result->Result;

        $result = $result->AccountId;
        $success = $ResultInfo->Code;
        $message = $ResultInfo->Message;

    } catch (Exception $e) {
        echo  '<div style="color:#ffffff;">Caught exception: '.  $e. "\n</div>";
        echo '<pre>';
        echo "Request headers:\n";
        print_r($leverateCrm->soapClient->__getLastResponseHeaders());
        echo "Request Body:\n";
        print_r($leverateCrm->soapClient->__getLastRequest());
        echo "Response headers:\n";
        print_r($leverateCrm->soapClient->__getLastResponseHeaders());
        echo "Body:\n";
        print_r($leverateCrm->soapClient->__getLastResponse());
        echo '</pre>';
        exit;
    }

} else {
    $result = null;
    $success = 'Success';
    $message = null;
}
try {
    $gc = new GetCountries();
    $gc->businessUnitName = $config['businessUnitName'];
    $gc->organizationName = $config['organization'];
    $gc->ownerUserId = $config['ownerUserId'];

    $leverateCrm = getCrm($config);

    $CountriesResponse = new GetCountriesResponse();
    $CountriesResponse = $leverateCrm->GetCountries($gc);
    $countries = $CountriesResponse->GetCountriesResult;

    $gp = new GetTradingPlatformGroups();
    $gp->businessUnitName = $config['businessUnitName'];
    $gp->organizationName = $config['organization'];
    $gp->ownerUserId = $config['ownerUserId'];
    $gp->tradingPlatformId = $config['tradingPlatforms']['DEMO']['id'];

    $response = new GetTradingPlatformGroupsResponse();
    $response = $leverateCrm->GetTradingPlatformGroups($gp);

    $groups = $response->GetTradingPlatformGroupsResult;


} catch (Exception $e) {
    print  'Caught exception: '.  $e. "\n";
    exit;
}

		}
	//激活
    public function active()
    {
		$hash=input('hash','');
		if(empty($hash)){
			$this->error(lang('pwd reset hash incorrect'));
		}
		$users_model=Db::name("member_list");
		$find_user=$users_model->where(array("user_activation_key"=>$hash))->find();
		if($find_user){
			$result=$users_model->where(array("user_activation_key"=>$hash))->update(array("user_activation_key"=>"","user_status"=>1));
			if($result){
				$find_user['user_status']=1;
				//更新字段
				$data = array(
					'last_login_time' => time(),
					'last_login_ip' => request()->ip(),
				);
				$find_user['last_login_time']=$data['last_login_time'];
				$find_user['last_login_ip']=$data['last_login_ip'];
				$users_model->where(array('member_list_id'=>$find_user["member_list_id"]))->update($data);
				session('uhid',$find_user['member_list_id']);
				session('user',$find_user);
				$this->success(lang('active success'),url('home/Index/index'));
			}else{
				$this->error(lang('active failed'),url("home/Login/index"));
			}
		}else{
			$this->error(lang('pwd reset hash incorrect'),url("home/Login/index"));
		}
	}
}