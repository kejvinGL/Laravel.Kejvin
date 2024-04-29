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

    "accepted" => "Ky :attribute duhet të pranohet.",
    "active_url" => "Ky :attribute nuk është një URL valid.",
    "after" => "Ky :attribute duhet të jetë një datë pas :date.",
    "alpha" => "Ky :attribute mund të përmbajë vetëm shkronja.",
    "alpha_dash" => "Ky :attribute mund të përmbajë vetëm shkronja, numra dhe viza.",
    "alpha_num" => "Ky :attribute mund të përmbajë vetëm shkronja dhe numra.",
    "array" => "Ky :attribute duhet të jetë një varg.",
    "before" => "Ky :attribute duhet të jetë një datë para :date.",
    "between" => [
        "numeric" => "Ky :attribute duhet të jetë midis :min dhe :max.",
        "file" => "Ky :attribute duhet të jetë midis :min dhe :max kilobajtë.",
        "string" => "Ky :attribute duhet të jetë midis :min dhe :max karaktere.",
        "array" => "Ky :attribute duhet të ketë midis :min dhe :max elemente.",
    ],
    "boolean" => "Fusha :attribute duhet të jetë e vërtetë ose e gabuar.",
    "confirmed" => "Konfirmimi i :attribute nuk përputhet.",
    "date" => "Ky :attribute nuk është një datë e vlefshme.",
    "date_format" => "Ky :attribute nuk përputhet me formatin :format.",
    "different" => "Ky :attribute dhe :other duhet të jenë të ndryshme.",
    "digits" => "Ky :attribute duhet të ketë :digits shifra.",
    "digits_between" => "Ky :attribute duhet të jetë midis :min dhe :max shifra.",
    "email" => "Ky :attribute duhet të jetë një adresë email-i e vlefshme.",
    "filled" => "Fusha :attribute është e detyrueshme.",
    "exists" => "Zgjedhja e :attribute është e pavlefshme.",
    "image" => "Ky :attribute duhet të jetë një imazh.",
    "in" => "Zgjedhja e :attribute është e pavlefshme.",
    "integer" => "Ky :attribute duhet të jetë një numër i plotë.",
    "ip" => "Ky :attribute duhet të jetë një adresë IP e vlefshme.",
    "max" => [
        "numeric" => "Ky :attribute nuk duhet të jetë më e madhe se :max.",
        "file" => "Ky :attribute nuk duhet të jetë më e madhe se :max kilobajtë.",
        "string" => "Ky :attribute nuk duhet të jetë më e madhe se :max karaktere.",
        "array" => "Ky :attribute nuk duhet të ketë më shumë se :max elemente.",
    ],
    "mimes" => "Ky :attribute duhet të jetë një skedar i tipit: :values.",
    "min" => [
        "numeric" => "Ky :attribute duhet të jetë së paku :min.",
        "file" => "Ky :attribute duhet të jetë së paku :min kilobajtë.",
        "string" => "Ky :attribute duhet të ketë së paku :min karaktere.",
        "array" => "Ky :attribute duhet të ketë së paku :min elemente.",
    ],
    "not_in" => "Zgjedhja e :attribute është e pavlefshme.",
    "numeric" => "Ky :attribute duhet të jetë një numër.",
    "regex" => "Formati i :attribute është i pavlefshëm.",
    "required" => "Fusha :attribute është e detyrueshme.",
    "required_if" => "Fusha :attribute është e detyrueshme kur :other është :value.",
    "required_with" => "Fusha :attribute është e detyrueshme kur :values është prezent.",
    "required_with_all" => "Fusha :attribute është e detyrueshme kur :values janë prezent.",
    "required_without" => "Fusha :attribute është e detyrueshme kur :values nuk është prezent.",
    "required_without_all" => "Fusha :attribute është e detyrueshme kur asnjë nga :values nuk është prezent.",
    "same" => "Ky :attribute dhe :other duhet të përputhen.",
    "size" => [
        "numeric" => "Ky :attribute duhet të jetë :size.",
        "file" => "Ky :attribute duhet të jetë :size kilobajtë.",
        "string" => "Ky :attribute duhet të jetë :size karaktere.",
        "array" => "Ky :attribute duhet të përmbajë :size elemente.",
    ],
    "unique" => "Ky :attribute është marrë tashmë.",
    "url" => "Formati i :attribute është i pavlefshëm.",
    "timezone" => "Ky :attribute duhet të jetë një zonë e vlefshme.",


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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
