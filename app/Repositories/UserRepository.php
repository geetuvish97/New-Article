<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
class UserRepository extends BaseRepository
{
    /**
    * @return void
    */
    public function __construct(){
        $this->serviceName = "User";
    }

    /**
    * @return User instance
    */
    public function user()
    {
        return new User;
    }

    /**
    * Get Details of particular id User.
    * @param $id
    * @return User details
    */
    public function getUserByID($id)
    {
        return $this->user()->find($id);
    }
    /**
    * Create User using given request.
    * @param object $request
    * @param $roleId
    * @return User details
    */
    public function signupUser(Request $request)
    {
        $fieldDataArray['name'] = $request->name;
        $fieldDataArray['email'] = $request->email;
        $fieldDataArray['mobile'] = $request->mobile;
        $fieldDataArray['password'] = bcrypt($request->password);
        return $this->user()->create($fieldDataArray);
    }

    /**
    * Delete UserFcmToken using given deviceId.
    * @param $deviceId
    * @return UserFcmToken delete status
    */
    public function deleteUserFcmToken($deviceId)
    {
        $userFcmToken = $this->userFcmToken()->where('device_id', $deviceId)->delete();
        return $userFcmToken;
    }

    public function getUserName($string)
    {
        $string = strtolower($string);
        $new_string = $string;
        $check = $this->user()->where('username', $new_string)->first();
        $i = 1;
        while($check){
            $new_string = $string.'_'.$i;
            $check = $this->user()->where('username', $new_string)->first();
            $i++;
        }
        return $new_string;
    }

    /**
    * Update User Details using given uuid.
    * @param $uuid
    * @return User
    */
    public function updateUser(Request $request, $uuid)
    {
        $user =  $this->user()->where('uuid', $uuid)->first();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->zip_code = $request->zip_code;
        $user->language = $request->language;
        if($request->profile){
            $user->profile = $request->profile;
        }
        $user->save();
        return $this->getUserByUuid($uuid);

    }

    /**
    * Update User Employment Details using given user_uuid.
    * @param $user_uuid
    * @return User
    */
    public function userEmploymentDetail(Request $request, $user_uuid){
        $userDetails = $this->userDetail()->updateorCreate([
            'user_uuid' => $user_uuid,
        ],
        [
            'employment_type' => $request->employment_type,
            'designation' => $request->designation,
            'company_name' => $request->company_name,
            'annual_income' => $request->annual_income,
            'website' => $request->website
        ]);
        return $this->getUserByUuid($user_uuid);
    }

    /**
    * Update User Otp By mobile .
    * @param $mobile
    * @return User
    */
    public function updateUserOtpByMobile($mobile){
        $otp = getUID('users', 'otp', 3, 3, 'numbers');
        $now = now();
        $update = $this->user()->where('mobile', $mobile)->update([
            'otp' => $otp,
            'otp_expired_at' => $now->addMinutes(config('custom.otp_expire_time'))
        ]);
        return $this->user()->where('mobile', $mobile)->first();
    }

    /**
    * Update User Name using given uuid.
    * @param $uuid
    * @return User
    */
    public function updateUserNameByUuid(Request $request, $uuid){
        $user = $this->user()->where('uuid', $uuid)->first();
        $user->username = $request->username;
        $user->save();
        return $user;
    }

    /**
    * Create user preferences.
    * @param $request
    * @return array $data
    */
    public function updateUserPreferences(Request $request)
    {
        $preferenceData = [];
        $dataValueKeys = [
            'user_uuid' => 'user_uuid',
            'min_price' => 'min_price',
            'max_price' => 'max_price',
            'min_area_in_sqft' => 'min_area_in_sqft',
            'max_area_in_sqft' => 'max_area_in_sqft',
            'is_off_plan_condition' => 'is_off_plan_condition',
            'is_ready_condition' => 'is_ready_condition',
            'is_residential_type' => 'is_residential_type',
            'is_commercial_type' => 'is_commercial_type',
            'min_bedrooms' => 'min_bedrooms',
            'max_bedrooms' => 'max_bedrooms',
            'min_bathrooms' => 'min_bathrooms',
            'max_bathrooms' => 'max_bathrooms',
            'is_fully_furnished' => 'is_fully_furnished',
            'is_semi_furnished' => 'is_semi_furnished',
            'is_unfurnished' => 'is_unfurnished',
            'is_builder' => 'is_builder',
            'is_sms_notification' => 'is_sms_notification',
            'is_email_notification' => 'is_email_notification',
            'is_whatsapp_notification' => 'is_whatsapp_notification'
        ];
        foreach($dataValueKeys as $key => $value){
            if(isset($request->$value)){
                $preferenceData[$key] = $request->$value;
            }
        }
        /** Create user preferences property type. */
        if(isset($request->property_types)){
            $propertyTypes = array_filter($request->property_types);
            $this->userPropertyTypePreference()->where('user_uuid', $request->user_uuid)->delete();
            $insertDataArray = [];
            foreach($propertyTypes as $type){
                $insertDataArray[] = [
                    'user_uuid' => $request->user_uuid,
                    'property_type_slug' => $type,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            $this->userPropertyTypePreference()->insert($insertDataArray);
        }
        /** Create user preferences location. */
        if(isset($request->locations)){
            $locations = array_filter($request->locations);
            $this->userLocationPreference()->where('user_uuid', $request->user_uuid)->delete();
            $insertDataArray = [];
            foreach($locations as $location){
                $insertDataArray[] = [
                    'user_uuid' => $request->user_uuid,
                    'location_id' => $location,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            $this->userLocationPreference()->insert($insertDataArray);
        }
        /**User preferences */
        $userPreference = $this->userPreference()->updateOrCreate(['user_uuid' => $request->user_uuid], $preferenceData);
        $data['user_preferences'] = $userPreference ? $userPreference : null;
        $data['user_location_preferences'] =  $this->userLocationPreference()->where('user_uuid', $request->user_uuid)->get();
        $data['user_property_type_preferences'] = $this->userPropertyTypePreference()->where('user_uuid', $request->user_uuid)->get();
        return $data;
    }

    /**
    * Delete user property type preferences.
    * @param $request, $id
    * @return UserPreference
    */
    public function deletePropertyType(Request $request, $id)
    {
        return $this->userPropertyTypePreference()->where('user_uuid', $request->user_uuid)->where('id', $id)->update(['deleted_at' => now()]);
    }

    /**
    * Delete user location preferences.
    * @param $request
    * @return UserPreference
    */
    public function deleteLocation(Request $request, $id)
    {
        return $this->userLocationPreference()->where('user_uuid', $request->user_uuid)->where('id', $id)->update(['deleted_at' => now()]);
    }

    /**
    * Update User EmailVerificationToken By Email.
    * @param $request
    * @return User
    */
    public function updateUserEmailVerificationTokenByEmail($email){
        $userData = $this->getUserByEmail($email);
        $userData->email_verification_token = getUID('users', 'email_verification_token', 16);
        $userData->save();
        return $userData;
    }

    /**
    * Update User EmailVerificationToken By Email.
    * @param $request
    * @return User
    */
    public function verifyOtp(Request $request){
        $userData = $this->getUserByMobile($request->mobile);
        $userData->mobile_verified_at = Carbon::now();
        $userData->save();
        return $userData;
    }
    /**
    * User preferences pre requisite
    * @param $request
    * @re
    * */
    public function preferencesPreRequisite()
    {
       $data = [];
       $data['property_types'] = $this->propertyType()->select('id', 'slug', 'title')->get();
       $data['locations'] = $this->location()->select('id', 'name')->get();
       $data['income_ranges'] = $this->incomeRange()->select('id', 'title', 'min', 'max', 'currency')->get();
       return $data;
    }

    /**
    * User preferences get detail by uuid
    * @param $request
    * @re
    * */
    public function getUserPreferencesByUuid($uuid)
    {
        return $this->user()->with('userPreferences', 'userPropertyTypePreferences','userLocationPreferences')->where('uuid', $uuid)->first();
    }
    /**
    * Check auth user password
    * @param $request
    * @return UserPreference
    */
    public function checkUserPassword(Request $request)
    {
        $user =  $this->user()->where('uuid', $request->user_uuid)->first();
        if(\Hash::check($request->current_password, $user->password)){
            return true;
        }else{
            return false;
        }

    }

   /**
    * Update user password
    * @param $request
    * @return User
    */
    public function userChangePassword(Request $request){
        return $this->user()->where('uuid', $request->user_uuid)->update(['password' => bcrypt($request->new_password)]);
    }

    /**
    * User pre requisite
    * @param $request
    * @re
    * */
    public function userPreRequisite()
    {
        $data = [];
        $data['languages'] = $this->language()->select('id', 'title')->get();
        $data['cities'] = $this->location()->where('location_type', 'CITY')->select('id', 'name')->get();
        return $data;
    }
    /**
    * Get all active users
    * @param $request
    * @return User
    */
    public function getAllActiveUsers(){
        return $this->user()->whereNotNull('email_verified_at')->with(['userPreferences', 'userPropertyTypePreferences', 'userLocationPreferences'])->get();
    }
    /**
    * Add User Login Activity
    * @param $user_uuid
    * @return object
    */
    public function addUserLoginActivity($user_uuid){
        $count = $this->userLoginActivity()->where('user_uuid', $user_uuid)->count();
        if($count>=3){
            $userLoginActivity = $this->userLoginActivity()->where('user_uuid', $user_uuid)->first();
            $userLoginActivity->delete();
        }
        return $this->userLoginActivity()->create([
            'user_uuid' => $user_uuid
        ]);
    }
}
