<?php

return [

    'accepted'             => 'Вы должны принять :attribute.',
    'accepted_if'          => 'Вы должны принять :attribute, когда :other соответствует :value.',
    'active_url'           => 'Поле :attribute недействительный URL.',
    'after'                => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal'       => 'Поле :attribute должно быть датой после или равной :date.',
    'alpha'                => 'Поле :attribute может содержать только буквы.',
    'alpha_dash'           => 'Поле :attribute может содержать только буквы, цифры, дефисы и подчёркивания.',
    'alpha_num'            => 'Поле :attribute может содержать только буквы и цифры.',
    'array'                => 'Поле :attribute должно быть массивом.',
    'ascii'                => 'Поле :attribute должно содержать только однобайтовые буквенно-цифровые символы и символы.',
    'before'               => 'Поле :attribute должно быть датой до :date.',
    'before_or_equal'      => 'Поле :attribute должно быть датой до или равной :date.',
    'between'              => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'file'    => 'Размер файла в поле :attribute должен быть между :min и :max килобайт.',
        'string'  => 'Длина текста в поле :attribute должна быть между :min и :max символов.',
        'array'   => 'Поле :attribute должно содержать от :min до :max элементов.',
    ],
    'boolean'              => 'Поле :attribute должно быть логического типа.',
    'confirmed'            => 'Поле :attribute не совпадает с подтверждением.',
    'current_password'     => 'Неверный пароль.',
    'date'                 => 'Поле :attribute не является датой.',
    'date_equals'          => 'Поле :attribute должно быть датой, равной :date.',
    'date_format'          => 'Поле :attribute не соответствует формату :format.',
    'decimal'              => 'Поле :attribute должно содержать :decimal знаков после запятой.',
    'declined'             => 'Поле :attribute должно быть отклонено.',
    'declined_if'          => 'Поле :attribute должно быть отклонено, когда :other равно :value.',
    'different'            => 'Поля :attribute и :other должны различаться.',
    'digits'               => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between'       => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions'           => 'Поле :attribute содержит недопустимые размеры изображения.',
    'distinct'             => 'Поле :attribute содержит повторяющееся значение.',
    'email'                => 'Поле :attribute должно быть действительным email-адресом.',
    'ends_with'            => 'Поле :attribute должно заканчиваться одним из следующих значений: :values.',
    'enum'                 => 'Выбранное значение для :attribute некорректно.',
    'exists'               => 'Выбранное значение для :attribute некорректно.',
    'file'                 => 'Поле :attribute должно быть файлом.',
    'filled'               => 'Поле :attribute обязательно для заполнения.',
    'gt'                   => [
        'numeric' => 'Поле :attribute должно быть больше :value.',
        'file'    => 'Поле :attribute должно быть больше :value килобайт.',
        'string'  => 'Поле :attribute должно быть больше :value символов.',
        'array'   => 'Поле :attribute должно содержать больше :value элементов.',
    ],
    'gte'                  => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file'    => 'Поле :attribute должно быть больше или равно :value килобайт.',
        'string'  => 'Поле :attribute должно быть больше или равно :value символов.',
        'array'   => 'Поле :attribute должно содержать :value элементов или больше.',
    ],
    'image'                => 'Поле :attribute должно быть изображением.',
    'in'                   => 'Выбранное значение для :attribute некорректно.',
    'in_array'             => 'Поле :attribute не существует в :other.',
    'integer'              => 'Поле :attribute должно быть целым числом.',
    'ip'                   => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4'                 => 'Поле :attribute должно быть действительным IPv4-адресом.',
    'ipv6'                 => 'Поле :attribute должно быть действительным IPv6-адресом.',
    'json'                 => 'Поле :attribute должно быть JSON строкой.',
    'lt'                   => [
        'numeric' => 'Поле :attribute должно быть меньше :value.',
        'file'    => 'Поле :attribute должно быть меньше :value килобайт.',
        'string'  => 'Поле :attribute должно быть меньше :value символов.',
        'array'   => 'Поле :attribute должно содержать меньше :value элементов.',
    ],
    'lte'                  => [
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'file'    => 'Поле :attribute должно быть меньше или равно :value килобайт.',
        'string'  => 'Поле :attribute должно быть меньше или равно :value символов.',
        'array'   => 'Поле :attribute не должно содержать больше :value элементов.',
    ],
    'mac_address'          => 'Поле :attribute должно быть MAC-адресом.',
    'max'                  => [
        'numeric' => 'Поле :attribute не может быть больше :max.',
        'file'    => 'Поле :attribute не может быть больше :max килобайт.',
        'string'  => 'Поле :attribute не может быть длиннее :max символов.',
        'array'   => 'Поле :attribute не может содержать больше :max элементов.',
    ],
    'mimes'                => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'mimetypes'            => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'min'                  => [
        'numeric' => 'Поле :attribute должно быть не меньше :min.',
        'file'    => 'Поле :attribute должно быть не меньше :min килобайт.',
        'string'  => 'Поле :attribute должно содержать не менее :min символов.',
        'array'   => 'Поле :attribute должно содержать как минимум :min элементов.',
    ],
    'multiple_of'          => 'Поле :attribute должно быть кратным :value.',
    'not_in'               => 'Выбранное значение для :attribute некорректно.',
    'not_regex'            => 'Формат поля :attribute некорректен.',
    'numeric'              => 'Поле :attribute должно быть числом.',
    'password'             => [
        'letters'       => 'Поле :attribute должно содержать хотя бы одну букву.',
        'mixed'         => 'Поле :attribute должно содержать как минимум одну заглавную и одну строчную букву.',
        'numbers'       => 'Поле :attribute должно содержать хотя бы одну цифру.',
        'symbols'       => 'Поле :attribute должно содержать хотя бы один символ.',
        'uncompromised' => 'Указанный :attribute появился в утечке данных. Пожалуйста, выберите другой.',
    ],
    'present'              => 'Поле :attribute должно быть присутствующим.',
    'prohibited'           => 'Поле :attribute запрещено.',
    'prohibited_if'        => 'Поле :attribute запрещено, когда :other равно :value.',
    'prohibited_unless'    => 'Поле :attribute запрещено, если :other не входит в :values.',
    'prohibits'            => 'Поле :attribute запрещает наличие :other.',
    'regex'                => 'Поле :attribute имеет некорректный формат.',
    'required'             => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys'  => 'Поле :attribute должно содержать записи для: :values.',
    'required_if'          => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_unless'      => 'Поле :attribute обязательно для заполнения, если :other не входит в :values.',
    'required_with'        => 'Поле :attribute обязательно при наличии :values.',
    'required_with_all'    => 'Поле :attribute обязательно при наличии всех :values.',
    'required_without'     => 'Поле :attribute обязательно при отсутствии :values.',
    'required_without_all' => 'Поле :attribute обязательно, если ни одно из :values не присутствует.',
    'same'                 => 'Значения полей :attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => 'Поле :attribute должно быть :size.',
        'file'    => 'Поле :attribute должно быть :size килобайт.',
        'string'  => 'Поле :attribute должно содержать :size символов.',
        'array'   => 'Поле :attribute должно содержать :size элементов.',
    ],
    'starts_with'          => 'Поле :attribute должно начинаться с одного из следующих значений: :values.',
    'string'               => 'Поле :attribute должно быть строкой.',
    'timezone'             => 'Поле :attribute должно быть действительным часовым поясом.',
    'unique'               => 'Такое значение поля :attribute уже существует.',
    'uploaded'             => 'Не удалось загрузить файл :attribute.',
    'url'                  => 'Поле :attribute имеет некорректный формат URL.',
    'uuid'                 => 'Поле :attribute должно быть корректным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Настройка кастомных сообщений
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'email' => [
            'required' => 'Пожалуйста, введите адрес электронной почты.',
        ],
        'password' => [
            'required' => 'Пожалуйста, введите пароль.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Атрибуты
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name' => 'имя',
        'email' => 'адрес электронной почты',
        'password' => 'пароль',
        'password_confirmation' => 'подтверждение пароля',
    ],

];
