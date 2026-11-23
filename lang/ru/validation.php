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

    'accepted' => 'Поле «:attribute» должно быть принято.',
    'accepted_if' => 'Поле «:attribute» должно быть принято, если «:other» равно «:value».',
    'active_url' => 'Поле «:attribute» должно содержать действительный URL-адрес.',
    'after' => 'Поле «:attribute» должно содержать дату после :date.',
    'after_or_equal' => 'Поле «:attribute» должно содержать дату не раньше :date.',
    'alpha' => 'Поле «:attribute» должно содержать только буквы.',
    'alpha_dash' => 'Поле «:attribute» должно содержать только буквы, цифры, дефисы и символы подчёркивания.',
    'alpha_num' => 'Поле «:attribute» должно содержать только буквы и цифры.',
    'any_of' => 'Поле «:attribute» имеет недопустимое значение.',
    'array' => 'Поле «:attribute» должно быть массивом.',
    'ascii' => 'Поле «:attribute» должно содержать только однобайтовые буквенно-цифровые символы и знаки.',
    'before' => 'Поле «:attribute» должно содержать дату до :date.',
    'before_or_equal' => 'Поле «:attribute» должно содержать дату не позже :date.',
    'between' => [
        'array' => 'Количество элементов в поле «:attribute» должно быть от :min до :max.',
        'file' => 'Размер файла в поле «:attribute» должен быть от :min до :max КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть от :min до :max.',
        'string' => 'Длина поля «:attribute» должна быть от :min до :max символов.',
    ],
    'boolean' => 'Поле «:attribute» должно иметь значение true или false.',
    'can' => 'Поле «:attribute» содержит недопустимое значение.',
    'confirmed' => 'Подтверждение поля «:attribute» не совпадает.',
    'contains' => 'В поле «:attribute» отсутствует обязательное значение.',
    'current_password' => 'Неверный пароль.',
    'date' => 'Поле «:attribute» должно содержать действительную дату.',
    'date_equals' => 'Поле «:attribute» должно содержать дату :date.',
    'date_format' => 'Поле «:attribute» должно соответствовать формату :format.',
    'decimal' => 'Поле «:attribute» должно содержать :decimal знаков после запятой.',
    'declined' => 'Поле «:attribute» должно иметь отрицательное значение.',
    'declined_if' => 'Поле «:attribute» должно иметь отрицательное значение, если «:other» равно «:value».',
    'different' => 'Поля «:attribute» и «:other» должны различаться.',
    'digits' => 'Поле «:attribute» должно содержать :digits цифр.',
    'digits_between' => 'Поле «:attribute» должно содержать от :min до :max цифр.',
    'dimensions' => 'Поле «:attribute» имеет недопустимые размеры изображения.',
    'distinct' => 'Поле «:attribute» содержит повторяющееся значение.',
    'doesnt_end_with' => 'Поле «:attribute» не должно заканчиваться одним из следующих значений: :values.',
    'doesnt_start_with' => 'Поле «:attribute» не должно начинаться с одного из следующих значений: :values.',
    'email' => 'Поле «:attribute» должно содержать действительный адрес электронной почты.',
    'ends_with' => 'Поле «:attribute» должно заканчиваться одним из следующих значений: :values.',
    'enum' => 'Выбранное значение поля «:attribute» недопустимо.',
    'exists' => 'Выбранное значение поля «:attribute» недопустимо.',
    'extensions' => 'Файл в поле «:attribute» должен иметь одно из следующих расширений: :values.',
    'file' => 'Поле «:attribute» должно быть файлом.',
    'filled' => 'Поле «:attribute» должно быть заполнено.',
    'gt' => [
        'array' => 'Поле «:attribute» должно содержать более :value элементов.',
        'file' => 'Размер файла в поле «:attribute» должен быть больше :value КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть больше :value.',
        'string' => 'Длина поля «:attribute» должна быть больше :value символов.',
    ],
    'gte' => [
        'array' => 'Поле «:attribute» должно содержать не менее :value элементов.',
        'file' => 'Размер файла в поле «:attribute» должен быть не меньше :value КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть не меньше :value.',
        'string' => 'Длина поля «:attribute» должна быть не меньше :value символов.',
    ],
    'hex_color' => 'Поле «:attribute» должно содержать действительный шестнадцатеричный код цвета.',
    'image' => 'Поле «:attribute» должно быть изображением.',
    'in' => 'Выбранное значение поля «:attribute» недопустимо.',
    'in_array' => 'Значение поля «:attribute» должно присутствовать в «:other».',
    'in_array_keys' => 'Поле «:attribute» должно содержать хотя бы один из следующих ключей: :values.',
    'integer' => 'Поле «:attribute» должно быть целым числом.',
    'ip' => 'Поле «:attribute» должно содержать действительный IP-адрес.',
    'ipv4' => 'Поле «:attribute» должно содержать действительный IPv4-адрес.',
    'ipv6' => 'Поле «:attribute» должно содержать действительный IPv6-адрес.',
    'json' => 'Поле «:attribute» должно содержать действительную строку JSON.',
    'list' => 'Поле «:attribute» должно быть списком.',
    'lowercase' => 'Поле «:attribute» должно содержать только строчные буквы.',
    'lt' => [
        'array' => 'Поле «:attribute» должно содержать менее :value элементов.',
        'file' => 'Размер файла в поле «:attribute» должен быть меньше :value КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть меньше :value.',
        'string' => 'Длина поля «:attribute» должна быть меньше :value символов.',
    ],
    'lte' => [
        'array' => 'Поле «:attribute» не должно содержать более :value элементов.',
        'file' => 'Размер файла в поле «:attribute» должен быть не больше :value КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть не больше :value.',
        'string' => 'Длина поля «:attribute» должна быть не больше :value символов.',
    ],
    'mac_address' => 'Поле «:attribute» должно содержать действительный MAC-адрес.',
    'max' => [
        'array' => 'Поле «:attribute» не должно содержать более :max элементов.',
        'file' => 'Размер файла в поле «:attribute» не должен превышать :max КБ.',
        'numeric' => 'Значение поля «:attribute» не должно превышать :max.',
        'string' => 'Длина поля «:attribute» не должна превышать :max символов.',
    ],
    'max_digits' => 'Поле «:attribute» не должно содержать более :max цифр.',
    'mimes' => 'Файл в поле «:attribute» должен иметь один из следующих типов: :values.',
    'mimetypes' => 'Файл в поле «:attribute» должен иметь один из следующих MIME-типов: :values.',
    'min' => [
        'array' => 'Поле «:attribute» должно содержать не менее :min элементов.',
        'file' => 'Размер файла в поле «:attribute» должен быть не менее :min КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть не меньше :min.',
        'string' => 'Длина поля «:attribute» должна быть не менее :min символов.',
    ],
    'min_digits' => 'Поле «:attribute» должно содержать не менее :min цифр.',
    'missing' => 'Поле «:attribute» должно отсутствовать.',
    'missing_if' => 'Поле «:attribute» должно отсутствовать, если «:other» равно «:value».',
    'missing_unless' => 'Поле «:attribute» должно отсутствовать, если «:other» не равно «:value».',
    'missing_with' => 'Поле «:attribute» должно отсутствовать, если присутствует «:values».',
    'missing_with_all' => 'Поле «:attribute» должно отсутствовать, если присутствуют все поля «:values».',
    'multiple_of' => 'Значение поля «:attribute» должно быть кратно :value.',
    'not_in' => 'Выбранное значение поля «:attribute» недопустимо.',
    'not_regex' => 'Формат поля «:attribute» недопустим.',
    'numeric' => 'Поле «:attribute» должно быть числом.',
    'password' => [
        'letters' => 'Поле «:attribute» должно содержать хотя бы одну букву.',
        'mixed' => 'Поле «:attribute» должно содержать хотя бы одну заглавную и одну строчную букву.',
        'numbers' => 'Поле «:attribute» должно содержать хотя бы одну цифру.',
        'symbols' => 'Поле «:attribute» должно содержать хотя бы один специальный символ.',
        'uncompromised' => 'Значение поля «:attribute» обнаружено в утечке данных. Выберите другое значение для поля «:attribute».',
    ],
    'present' => 'Поле «:attribute» должно присутствовать.',
    'present_if' => 'Поле «:attribute» должно присутствовать, если «:other» равно «:value».',
    'present_unless' => 'Поле «:attribute» должно присутствовать, если «:other» не равно «:value».',
    'present_with' => 'Поле «:attribute» должно присутствовать, если присутствует «:values».',
    'present_with_all' => 'Поле «:attribute» должно присутствовать, если присутствуют все поля «:values».',
    'prohibited' => 'Поле «:attribute» запрещено для заполнения.',
    'prohibited_if' => 'Поле «:attribute» запрещено для заполнения, если «:other» равно «:value».',
    'prohibited_if_accepted' => 'Поле «:attribute» запрещено для заполнения, если «:other» принято.',
    'prohibited_if_declined' => 'Поле «:attribute» запрещено для заполнения, если «:other» отклонено.',
    'prohibited_unless' => 'Поле «:attribute» запрещено для заполнения, если «:other» не входит в список :values.',
    'prohibits' => 'Поле «:attribute» запрещает заполнение поля «:other».',
    'regex' => 'Формат поля «:attribute» недопустим.',
    'required' => 'Поле «:attribute» обязательно для заполнения.',
    'required_array_keys' => 'Поле «:attribute» должно содержать следующие ключи: :values.',
    'required_if' => 'Поле «:attribute» обязательно для заполнения, если «:other» равно «:value».',
    'required_if_accepted' => 'Поле «:attribute» обязательно для заполнения, если «:other» принято.',
    'required_if_declined' => 'Поле «:attribute» обязательно для заполнения, если «:other» отклонено.',
    'required_unless' => 'Поле «:attribute» обязательно для заполнения, если «:other» не входит в список :values.',
    'required_with' => 'Поле «:attribute» обязательно для заполнения, если присутствует «:values».',
    'required_with_all' => 'Поле «:attribute» обязательно для заполнения, если присутствуют все поля «:values».',
    'required_without' => 'Поле «:attribute» обязательно для заполнения, если «:values» отсутствует.',
    'required_without_all' => 'Поле «:attribute» обязательно для заполнения, если отсутствуют все поля «:values».',
    'same' => 'Поле «:attribute» должно совпадать с полем «:other».',
    'size' => [
        'array' => 'Поле «:attribute» должно содержать :size элементов.',
        'file' => 'Размер файла в поле «:attribute» должен составлять :size КБ.',
        'numeric' => 'Значение поля «:attribute» должно быть равно :size.',
        'string' => 'Длина поля «:attribute» должна составлять :size символов.',
    ],
    'starts_with' => 'Поле «:attribute» должно начинаться с одного из следующих значений: :values.',
    'string' => 'Поле «:attribute» должно быть строкой.',
    'timezone' => 'Поле «:attribute» должно содержать действительный часовой пояс.',
    'unique' => 'Значение поля «:attribute» уже используется.',
    'uploaded' => 'Не удалось загрузить файл «:attribute».',
    'uppercase' => 'Поле «:attribute» должно содержать только заглавные буквы.',
    'url' => 'Поле «:attribute» должно содержать действительный URL-адрес.',
    'ulid' => 'Поле «:attribute» должно содержать действительный ULID.',
    'uuid' => 'Поле «:attribute» должно содержать действительный UUID.',

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
            'rule-name' => 'Недопустимое значение поля.',
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