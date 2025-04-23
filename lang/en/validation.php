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

    'accepted' => 'A(z) :attribute mező elfogadása szükséges.',
    'accepted_if' => 'A(z) :attribute mező elfogadása szükséges, amikor a(z) :other értéke :value.',
    'active_url' => 'A(z) :attribute mező érvényes URL-t kell tartalmazzon.',
    'after' => 'A(z) :attribute mezőnek a :date utáni dátumot kell tartalmaznia.',
    'after_or_equal' => 'A(z) :attribute mezőnek a :date dátummal egyenlő vagy utána kell lennie.',
    'alpha' => 'A(z) :attribute mezőnek csak betűket kell tartalmaznia.',
    'alpha_dash' => 'A(z) :attribute mezőnek csak betűket, számokat, kötőjeleket és aláhúzásjeleket kell tartalmaznia.',
    'alpha_num' => 'A(z) :attribute mezőnek csak betűket és számokat kell tartalmaznia.',
    'array' => 'A(z) :attribute mezőnek tömbnek kell lennie.',
    'ascii' => 'A(z) :attribute mezőnek csak egybájtos alfanumerikus karaktereket és szimbólumokat kell tartalmaznia.',
    'before' => 'A(z) :attribute mezőnek a :date előtti dátumot kell tartalmaznia.',
    'before_or_equal' => 'A(z) :attribute mezőnek a :date dátummal egyenlő vagy előtte kell lennie.',
    'between' => [
        'array' => 'A(z) :attribute mezőnek :min és :max elem között kell lennie.',
        'file' => 'A(z) :attribute mezőnek :min és :max kilobájt között kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek :min és :max között kell lennie.',
        'string' => 'A(z) :attribute mezőnek :min és :max karakter között kell lennie.',
    ],
    'boolean' => 'A(z) :attribute mezőnek igaznak vagy hamisnak kell lennie.',
    'can' => 'A(z) :attribute mező egy nem engedélyezett értéket tartalmaz.',
    'confirmed' => 'A(z) :attribute mező megerősítése nem egyezik.',
    'contains' => 'A(z) :attribute mező hiányzó értéket tartalmaz.',
    'current_password' => 'A jelszó helytelen.',
    'date' => 'A(z) :attribute mezőnek érvényes dátumnak kell lennie.',
    'date_equals' => 'A(z) :attribute mezőnek egyenlő dátumnak kell lennie :date.',
    'date_format' => 'A(z) :attribute mezőnek a :format formátumban kell lennie.',
    'decimal' => 'A(z) :attribute mezőnek :decimal tizedesjegyet kell tartalmaznia.',
    'declined' => 'A(z) :attribute mezőt vissza kell utasítani.',
    'declined_if' => 'A(z) :attribute mezőt vissza kell utasítani, amikor a(z) :other értéke :value.',
    'different' => 'A(z) :attribute mezőnek és a(z) :other mezőnek különbözőnek kell lennie.',
    'digits' => 'A(z) :attribute mezőnek :digits számjegyet kell tartalmaznia.',
    'digits_between' => 'A(z) :attribute mezőnek :min és :max számjegy között kell lennie.',
    'dimensions' => 'A(z) :attribute mező érvénytelen kép mérettel rendelkezik.',
    'distinct' => 'A(z) :attribute mezőben duplikált érték található.',
    'doesnt_end_with' => 'A(z) :attribute mezőnek nem kell az alábbiakkal végződnie: :values.',
    'doesnt_start_with' => 'A(z) :attribute mezőnek nem kell az alábbiakkal kezdődnie: :values.',
    'email' => 'A(z) :attribute mezőnek érvényes e-mail címet kell tartalmaznia.',
    'ends_with' => 'A(z) :attribute mezőnek az alábbiak egyikével kell végződnie: :values.',
    'enum' => 'A kiválasztott :attribute érvénytelen.',
    'exists' => 'A kiválasztott :attribute érvénytelen.',
    'extensions' => 'A(z) :attribute mezőnek az alábbi kiterjesztésekkel kell rendelkeznie: :values.',
    'file' => 'A(z) :attribute mezőnek fájlnak kell lennie.',
    'filled' => 'A(z) :attribute mezőnek értéket kell tartalmaznia.',
    'gt' => [
        'array' => 'A(z) :attribute mezőnek több mint :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek nagyobbnak kell lennie :value kilobájt-nál.',
        'numeric' => 'A(z) :attribute mezőnek nagyobbnak kell lennie :value.',
        'string' => 'A(z) :attribute mezőnek nagyobbnak kell lennie :value karakter-nél.',
    ],
    'gte' => [
        'array' => 'A(z) :attribute mezőnek legalább :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek legalább :value kilobájt-nak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek legalább :value-nak kell lennie.',
        'string' => 'A(z) :attribute mezőnek legalább :value karakter-t kell tartalmaznia.',
    ],
    'hex_color' => 'A(z) :attribute mezőnek érvényes hexadecimális színnek kell lennie.',
    'image' => 'A(z) :attribute mezőnek képként kell szerepelnie.',
    'in' => 'A kiválasztott :attribute érvénytelen.',
    'in_array' => 'A(z) :attribute mezőnek szerepelnie kell :other.',
    'integer' => 'A(z) :attribute mezőnek egész számnak kell lennie.',
    'ip' => 'A(z) :attribute mezőnek érvényes IP-címnek kell lennie.',
    'ipv4' => 'A(z) :attribute mezőnek érvényes IPv4-címnek kell lennie.',
    'ipv6' => 'A(z) :attribute mezőnek érvényes IPv6-címnek kell lennie.',
    'json' => 'A(z) :attribute mezőnek érvényes JSON sztringnek kell lennie.',
    'list' => 'A(z) :attribute mezőnek listának kell lennie.',
    'lowercase' => 'A(z) :attribute mezőnek kisbetűsnek kell lennie.',
    'lt' => [
        'array' => 'A(z) :attribute mezőnek kevesebb mint :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek kevesebb mint :value kilobájt-nak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek kevesebbnek kell lennie :value.',
        'string' => 'A(z) :attribute mezőnek kevesebbnek kell lennie :value karakter-nél.',
    ],
    'lte' => [
        'array' => 'A(z) :attribute mezőnek legfeljebb :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek legfeljebb :value kilobájt-nak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek legfeljebb :value-nak kell lennie.',
        'string' => 'A(z) :attribute mezőnek legfeljebb :value karakter-t kell tartalmaznia.',
    ],
    'mac_address' => 'A(z) :attribute mezőnek érvényes MAC-címnek kell lennie.',
    'max' => [
        'array' => 'A(z) :attribute mezőnek nem lehet több mint :max elem.',
        'file' => 'A(z) :attribute mezőnek nem lehet több mint :max kilobájt.',
        'numeric' => 'A(z) :attribute mezőnek nem lehet több mint :max.',
        'string' => 'A(z) :attribute mezőnek nem lehet több mint :max karakter.',
    ],
    'max_digits' => 'A(z) :attribute mezőnek nem lehet több mint :max számjegye.',
    'mimes' => 'A(z) :attribute mezőnek az alábbi típusú fájlnak kell lennie: :values.',
    'mimetypes' => 'A(z) :attribute mezőnek az alábbi típusú fájlnak kell lennie: :values.',
    'min' => [
        'array' => 'A(z) :attribute mezőnek legalább :min elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek legalább :min kilobájt-nak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek legalább :min-nak kell lennie.',
        'string' => 'A(z) :attribute mezőnek legalább :min karakter-t kell tartalmaznia.',
    ],
    'min_digits' => 'A(z) :attribute mezőnek legalább :min számjegyet kell tartalmaznia.',
    'missing' => 'A(z) :attribute mezőnek hiányoznia kell.',
    'missing_if' => 'A(z) :attribute mezőnek hiányoznia kell, amikor a(z) :other értéke :value.',
    'missing_unless' => 'A(z) :attribute mezőnek hiányoznia kell, kivéve, ha a(z) :other értéke :value.',
    'missing_with' => 'A(z) :attribute mezőnek hiányoznia kell, amikor a(z) :values jelen van.',
    'missing_with_all' => 'A(z) :attribute mezőnek hiányoznia kell, amikor a(z) :values mind jelen van.',
    'multiple_of' => 'A(z) :attribute mezőnek :value többszöröseinek kell lennie.',
    'not_in' => 'A kiválasztott :attribute érvénytelen.',
    'not_regex' => 'A(z) :attribute mező formátuma érvénytelen.',
    'numeric' => 'A(z) :attribute mezőnek számnak kell lennie.',
    'password' => [
        'letters' => 'A(z) :attribute mezőnek legalább egy betűt kell tartalmaznia.',
        'mixed' => 'A(z) :attribute mezőnek legalább egy nagy- és egy kisbetűt kell tartalmaznia.',
        'numbers' => 'A(z) :attribute mezőnek legalább egy számot kell tartalmaznia.',
        'symbols' => 'A(z) :attribute mezőnek legalább egy szimbólumot kell tartalmaznia.',
        'uncompromised' => 'A megadott :attribute szerepelt egy adatlopásban. Kérlek válassz másikat.',
    ],
    'present' => 'A(z) :attribute mezőnek jelen kell lennie.',
    'present_if' => 'A(z) :attribute mezőnek jelen kell lennie, amikor a(z) :other értéke :value.',
    'present_unless' => 'A(z) :attribute mezőnek jelen kell lennie, kivéve ha a(z) :other értéke :value.',
    'present_with' => 'A(z) :attribute mezőnek jelen kell lennie, amikor a(z) :values jelen van.',
    'present_with_all' => 'A(z) :attribute mezőnek jelen kell lennie, amikor a(z) :values mind jelen van.',
    'prohibited' => 'A(z) :attribute mező tilos.',
    'prohibited_if' => 'A(z) :attribute mező tilos, amikor a(z) :other értéke :value.',
    'prohibited_unless' => 'A(z) :attribute mező tilos, kivéve ha a(z) :other az alábbiak egyikében szerepel: :values.',
    'prohibits' => 'A(z) :attribute mező megtiltja, hogy a(z) :other jelen legyen.',
    'regex' => 'A(z) :attribute mező formátuma érvénytelen.',
    'required' => 'A(z) :attribute mező kitöltése kötelező.',
    'required_array_keys' => 'A(z) :attribute mezőnek tartalmaznia kell az alábbi kulcsokat: :values.',
    'required_if' => 'A(z) :attribute mező kitöltése kötelező, amikor a(z) :other értéke :value.',
    'required_if_accepted' => 'A(z) :attribute mező kitöltése kötelező, amikor a(z) :other elfogadott.',
    'required_if_declined' => 'A(z) :attribute mező kitöltése kötelező, amikor a(z) :other elutasított.',
    'required_unless' => 'A(z) :attribute mező kitöltése kötelező, kivéve ha a(z) :other az alábbiak egyikében szerepel: :values.',
    'required_with' => 'A(z) :attribute mező kitöltése kötelező, amikor a(z) :values jelen van.',
    'required_with_all' => 'A(z) :attribute mező kitöltése kötelező, amikor a(z) :values mind jelen van.',
    'required_without' => 'A(z) :attribute mező kitöltése kötelező, amikor a(z) :values nincs jelen.',
    'required_without_all' => 'A(z) :attribute mező kitöltése kötelező, amikor egyik :values sem jelen van.',
    'same' => 'A(z) :attribute mezőnek meg kell egyeznie a(z) :other mezővel.',
    'size' => [
        'array' => 'A(z) :attribute mezőnek :size elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek :size kilobájt-nak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek :size-nak kell lennie.',
        'string' => 'A(z) :attribute mezőnek :size karakter-t kell tartalmaznia.',
    ],
    'starts_with' => 'A(z) :attribute mezőnek az alábbiak egyikével kell kezdődnie: :values.',
    'string' => 'A(z) :attribute mezőnek sztringnek kell lennie.',
    'timezone' => 'A(z) :attribute mezőnek érvényes időzónának kell lennie.',
    'unique' => 'A(z) :attribute már el van foglalva.',
    'uploaded' => 'A(z) :attribute feltöltése nem sikerült.',
    'uppercase' => 'A(z) :attribute mezőnek nagybetűsnek kell lennie.',
    'url' => 'A(z) :attribute mezőnek érvényes URL-nek kell lennie.',
    'ulid' => 'A(z) :attribute mezőnek érvényes ULID-nek kell lennie.',
    'uuid' => 'A(z) :attribute mezőnek érvényes UUID-nek kell lennie.',

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

];
