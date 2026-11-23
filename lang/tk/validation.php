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

    'accepted' => ':attribute meýdany kabul edilmelidir.',
    'accepted_if' => ':other :value bolanda, :attribute meýdany kabul edilmelidir.',
    'active_url' => ':attribute meýdany dogry URL salgysyny öz içine almalydyr.',
    'after' => ':attribute meýdany :date senesinden soňky senäni öz içine almalydyr.',
    'after_or_equal' => ':attribute meýdany :date senesine deň ýa-da ondan soňky senäni öz içine almalydyr.',
    'alpha' => ':attribute meýdany diňe harplardan ybarat bolmalydyr.',
    'alpha_dash' => ':attribute meýdany diňe harplary, sanlary, defisleri we aşaky çyzyklary öz içine almalydyr.',
    'alpha_num' => ':attribute meýdany diňe harplary we sanlary öz içine almalydyr.',
    'any_of' => ':attribute meýdanynyň bahasy nädogry.',
    'array' => ':attribute meýdany sanaw görnüşinde bolmalydyr.',
    'ascii' => ':attribute meýdany diňe bir baýtly harp-san belgilerini we nyşanlaryny öz içine almalydyr.',
    'before' => ':attribute meýdany :date senesinden öňki senäni öz içine almalydyr.',
    'before_or_equal' => ':attribute meýdany :date senesine deň ýa-da ondan öňki senäni öz içine almalydyr.',
    'between' => [
        'array' => ':attribute meýdanynda :min bilen :max aralygynda element bolmalydyr.',
        'file' => ':attribute faýlynyň ölçegi :min bilen :max kilobaýt aralygynda bolmalydyr.',
        'numeric' => ':attribute meýdanynyň bahasy :min bilen :max aralygynda bolmalydyr.',
        'string' => ':attribute meýdany :min bilen :max nyşan aralygynda bolmalydyr.',
    ],
    'boolean' => ':attribute meýdany true ýa-da false bolmalydyr.',
    'can' => ':attribute meýdany rugsat berilmedik bahany öz içine alýar.',
    'confirmed' => ':attribute meýdanynyň tassyklamasy gabat gelenok.',
    'contains' => ':attribute meýdanynda zerur baha ýok.',
    'current_password' => 'Parol nädogry.',
    'date' => ':attribute meýdany dogry senäni öz içine almalydyr.',
    'date_equals' => ':attribute meýdany :date senesine deň bolmalydyr.',
    'date_format' => ':attribute meýdany :format görnüşine laýyk gelmelidir.',
    'decimal' => ':attribute meýdanynda onluk nokatdan soň :decimal san bolmalydyr.',
    'declined' => ':attribute meýdany ret edilen bahada bolmalydyr.',
    'declined_if' => ':other :value bolanda, :attribute meýdany ret edilen bahada bolmalydyr.',
    'different' => ':attribute we :other meýdanlary biri-birinden tapawutly bolmalydyr.',
    'digits' => ':attribute meýdany :digits sandan ybarat bolmalydyr.',
    'digits_between' => ':attribute meýdany :min bilen :max aralygynda san saklamalydyr.',
    'dimensions' => ':attribute meýdanyndaky suratyň ölçegleri nädogry.',
    'distinct' => ':attribute meýdanynda gaýtalanýan baha bar.',
    'doesnt_end_with' => ':attribute meýdany aşakdaky bahalaryň hiç biri bilen gutarmaly däldir: :values.',
    'doesnt_start_with' => ':attribute meýdany aşakdaky bahalaryň hiç biri bilen başlamaly däldir: :values.',
    'email' => ':attribute meýdany dogry e-poçta salgysyny öz içine almalydyr.',
    'ends_with' => ':attribute meýdany aşakdaky bahalaryň biri bilen gutarmalydyr: :values.',
    'enum' => ':attribute meýdany üçin saýlanan baha nädogry.',
    'exists' => ':attribute meýdany üçin saýlanan baha nädogry.',
    'extensions' => ':attribute faýly aşakdaky giňeltmeleriň birine eýe bolmalydyr: :values.',
    'file' => ':attribute meýdany faýl bolmalydyr.',
    'filled' => ':attribute meýdany boş bolmaly däldir.',
    'gt' => [
        'array' => ':attribute meýdanynda :value-den köp element bolmalydyr.',
        'file' => ':attribute faýlynyň ölçegi :value kilobaýtdan uly bolmalydyr.',
        'numeric' => ':attribute meýdanynyň bahasy :value-den uly bolmalydyr.',
        'string' => ':attribute meýdany :value nyşandan uzyn bolmalydyr.',
    ],
    'gte' => [
        'array' => ':attribute meýdanynda azyndan :value element bolmalydyr.',
        'file' => ':attribute faýlynyň ölçegi azyndan :value kilobaýt bolmalydyr.',
        'numeric' => ':attribute meýdanynyň bahasy :value-e deň ýa-da ondan uly bolmalydyr.',
        'string' => ':attribute meýdany azyndan :value nyşan bolmalydyr.',
    ],
    'hex_color' => ':attribute meýdany dogry on altylyk reňk koduny öz içine almalydyr.',
    'image' => ':attribute meýdany surat bolmalydyr.',
    'in' => ':attribute meýdany üçin saýlanan baha nädogry.',
    'in_array' => ':attribute meýdanynyň bahasy :other içinde bolmalydyr.',
    'in_array_keys' => ':attribute meýdany aşakdaky açarlaryň azyndan birini öz içine almalydyr: :values.',
    'integer' => ':attribute meýdany bitin san bolmalydyr.',
    'ip' => ':attribute meýdany dogry IP salgysyny öz içine almalydyr.',
    'ipv4' => ':attribute meýdany dogry IPv4 salgysyny öz içine almalydyr.',
    'ipv6' => ':attribute meýdany dogry IPv6 salgysyny öz içine almalydyr.',
    'json' => ':attribute meýdany dogry JSON setirini öz içine almalydyr.',
    'list' => ':attribute meýdany sanaw bolmalydyr.',
    'lowercase' => ':attribute meýdany diňe kiçi harplardan ybarat bolmalydyr.',
    'lt' => [
        'array' => ':attribute meýdanynda :value-den az element bolmalydyr.',
        'file' => ':attribute faýlynyň ölçegi :value kilobaýtdan kiçi bolmalydyr.',
        'numeric' => ':attribute meýdanynyň bahasy :value-den kiçi bolmalydyr.',
        'string' => ':attribute meýdany :value nyşandan gysga bolmalydyr.',
    ],
    'lte' => [
        'array' => ':attribute meýdanynda :value-den köp element bolmaly däldir.',
        'file' => ':attribute faýlynyň ölçegi :value kilobaýtdan köp bolmaly däldir.',
        'numeric' => ':attribute meýdanynyň bahasy :value-den uly bolmaly däldir.',
        'string' => ':attribute meýdany :value nyşandan uzyn bolmaly däldir.',
    ],
    'mac_address' => ':attribute meýdany dogry MAC salgysyny öz içine almalydyr.',
    'max' => [
        'array' => ':attribute meýdanynda :max-den köp element bolmaly däldir.',
        'file' => ':attribute faýlynyň ölçegi :max kilobaýtdan uly bolmaly däldir.',
        'numeric' => ':attribute meýdanynyň bahasy :max-den uly bolmaly däldir.',
        'string' => ':attribute meýdany :max nyşandan uzyn bolmaly däldir.',
    ],
    'max_digits' => ':attribute meýdanynda :max-den köp san bolmaly däldir.',
    'mimes' => ':attribute faýly şu görnüşleriň birinde bolmalydyr: :values.',
    'mimetypes' => ':attribute faýly şu MIME görnüşleriniň birinde bolmalydyr: :values.',
    'min' => [
        'array' => ':attribute meýdanynda azyndan :min element bolmalydyr.',
        'file' => ':attribute faýlynyň ölçegi azyndan :min kilobaýt bolmalydyr.',
        'numeric' => ':attribute meýdanynyň bahasy azyndan :min bolmalydyr.',
        'string' => ':attribute meýdany azyndan :min nyşan bolmalydyr.',
    ],
    'min_digits' => ':attribute meýdanynda azyndan :min san bolmalydyr.',
    'missing' => ':attribute meýdany bolmaly däldir.',
    'missing_if' => ':other :value bolanda, :attribute meýdany bolmaly däldir.',
    'missing_unless' => ':other :value bolmasa, :attribute meýdany bolmaly däldir.',
    'missing_with' => ':values bar bolsa, :attribute meýdany bolmaly däldir.',
    'missing_with_all' => ':values meýdanlarynyň hemmesi bar bolsa, :attribute meýdany bolmaly däldir.',
    'multiple_of' => ':attribute meýdanynyň bahasy :value sanyna kratny bolmalydyr.',
    'not_in' => ':attribute meýdany üçin saýlanan baha nädogry.',
    'not_regex' => ':attribute meýdanynyň görnüşi nädogry.',
    'numeric' => ':attribute meýdany san bolmalydyr.',
    'password' => [
        'letters' => ':attribute meýdany azyndan bir harp öz içine almalydyr.',
        'mixed' => ':attribute meýdany azyndan bir baş we bir setir harpy öz içine almalydyr.',
        'numbers' => ':attribute meýdany azyndan bir san öz içine almalydyr.',
        'symbols' => ':attribute meýdany azyndan bir ýörite nyşan öz içine almalydyr.',
        'uncompromised' => ':attribute bahasy maglumatlaryň syzmagynda ýüze çykaryldy. Başga :attribute saýlaň.',
    ],
    'present' => ':attribute meýdany hökman bolmalydyr.',
    'present_if' => ':other :value bolanda, :attribute meýdany hökman bolmalydyr.',
    'present_unless' => ':other :value bolmasa, :attribute meýdany hökman bolmalydyr.',
    'present_with' => ':values bar bolsa, :attribute meýdany hökman bolmalydyr.',
    'present_with_all' => ':values meýdanlarynyň hemmesi bar bolsa, :attribute meýdany hökman bolmalydyr.',
    'prohibited' => ':attribute meýdanyna rugsat berilmeýär.',
    'prohibited_if' => ':other :value bolanda, :attribute meýdanyna rugsat berilmeýär.',
    'prohibited_if_accepted' => ':other kabul edilen bolsa, :attribute meýdanyna rugsat berilmeýär.',
    'prohibited_if_declined' => ':other ret edilen bolsa, :attribute meýdanyna rugsat berilmeýär.',
    'prohibited_unless' => ':other :values sanawynda bolmasa, :attribute meýdanyna rugsat berilmeýär.',
    'prohibits' => ':attribute meýdany :other meýdanynyň bolmagyna rugsat bermeýär.',
    'regex' => ':attribute meýdanynyň görnüşi nädogry.',
    'required' => ':attribute meýdany hökmanydyr.',
    'required_array_keys' => ':attribute meýdany şu açarlary öz içine almalydyr: :values.',
    'required_if' => ':other :value bolanda, :attribute meýdany hökmanydyr.',
    'required_if_accepted' => ':other kabul edilen bolsa, :attribute meýdany hökmanydyr.',
    'required_if_declined' => ':other ret edilen bolsa, :attribute meýdany hökmanydyr.',
    'required_unless' => ':other :values sanawynda bolmasa, :attribute meýdany hökmanydyr.',
    'required_with' => ':values bar bolsa, :attribute meýdany hökmanydyr.',
    'required_with_all' => ':values meýdanlarynyň hemmesi bar bolsa, :attribute meýdany hökmanydyr.',
    'required_without' => ':values ýok bolsa, :attribute meýdany hökmanydyr.',
    'required_without_all' => ':values meýdanlarynyň hiç biri ýok bolsa, :attribute meýdany hökmanydyr.',
    'same' => ':attribute meýdany :other meýdany bilen gabat gelmelidir.',
    'size' => [
        'array' => ':attribute meýdanynda :size element bolmalydyr.',
        'file' => ':attribute faýlynyň ölçegi :size kilobaýt bolmalydyr.',
        'numeric' => ':attribute meýdanynyň bahasy :size bolmalydyr.',
        'string' => ':attribute meýdany :size nyşan bolmalydyr.',
    ],
    'starts_with' => ':attribute meýdany aşakdaky bahalaryň biri bilen başlamalydyr: :values.',
    'string' => ':attribute meýdany setir bolmalydyr.',
    'timezone' => ':attribute meýdany dogry wagt zolagyny öz içine almalydyr.',
    'unique' => ':attribute meýdanynyň bu bahasy eýýäm ulanylýar.',
    'uploaded' => ':attribute faýly ýüklenmedi.',
    'uppercase' => ':attribute meýdany diňe baş harplardan ybarat bolmalydyr.',
    'url' => ':attribute meýdany dogry URL salgysyny öz içine almalydyr.',
    'ulid' => ':attribute meýdany dogry ULID bolmalydyr.',
    'uuid' => ':attribute meýdany dogry UUID bolmalydyr.',

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
            'rule-name' => 'Meýdanyň bahasy nädogry.',
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