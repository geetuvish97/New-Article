<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',

    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',

    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other should be same.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

    'invalid_data' => 'Invalid data',
    'jwt_auth' => 'Jwt token invalid',
    'jwt_payload_factory' => 'Jwt token payload invalid',
    'jwt_blacklisted' => 'Jwt token blacklisted',
    'jwt_expired' => 'Jwt token expired',
    'jwt_could_not_parsed' => 'Jwt token not parsed',

    /**Custom validation messages */
    'fname' => 'The fname field is required.',
    'lname' => 'The lname field is required.',
    'email_required' => 'The email field is required.',
    'email' => 'The :attribute must be a valid email address.',
    'email_unique' => 'This email already exists.',
    'mobile' => 'The mobile field is required.',
    'mobile_unique' => 'This mobile number already exists.',
    'gender_in' => 'The selected gender is invalid.',
    'hash' => 'The hash field is required.',
    'hash_exists' => 'The selected hash is invalid.',
    'password' => 'The password is required.',
    'password_min' => 'The password must be at least 6 characters.',
    'email_username_mobile' => 'The email username mobile field is required.',
    'email_exist' => 'The selected email is invalid.',
    'username' => 'The username field is required.',
    'username_exist' => 'The selected username is invalid.',
    'mobile_exist' => 'The selected mobile is invalid.',
    'uuid' => 'The uuid is required.',
    'uuid_exist' => 'The selected uuid is invalid.',
    'employment_type' => 'The employment type field is required.',
    'designation' => 'The designation field is required.',
    'company_name' => 'The company name field is required.',
    'annual_income' => 'The annual income field is required.',
    'id' => 'The id field is required.',
    'id_exist' => 'The selected id is invalid.',
    'username_unique' => 'This username already exists.',
    "min_price" => "The min price must be a number.",
    "max_price" => "The max price must be a number.",
    "is_off_plan_condition" => "The selected is off plan condition is invalid.",
    "is_ready_condition" => "The selected is ready condition is invalid.",
    "is_residential_type" => "The selected is residential type is invalid.",
    "is_commercial_type" => "The selected is commercial type is invalid.",
    "min_bedrooms" => "The min bedrooms must be a number.",
    "max_bedrooms" => "The max bedrooms must be a number.",
    "min_bathrooms" => "The min bathrooms must be a number.",
    "max_bathrooms" => "The max bathrooms must be a number.",
    "is_fully_furnished" => "The selected is fully furnished is invalid.",
    "is_semi_furnished" => "The selected is semi furnished is invalid.",
    "is_unfurnished" => "The selected is unfurnished is invalid.",
    "is_builder" => "The selected is builder is invalid.",
    "search_json" => "The search json field is required.",
    "title" => "The title field is required.",
    "is_notification_on_required" => "The title field is required.",
    "is_notification_on" => "The is notification on field must be true or false.",
    "notification_frequency" => "The notification frequency field is required when is notification on is true.",
    'otp_exists' => 'OTP is invalid.',
    'otp' => 'OTP is required.',

];
