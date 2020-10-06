<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de idioma contêm as mensagens de erro padrão usadas por
    | a classe validadora. Algumas dessas regras têm várias versões, como
    | como as regras de tamanho. Sinta-se à vontade para ajustar cada uma dessas mensagens aqui.
    |
    */

    'accepted' => 'O(a) :attribute deve ser aceito.',
    'active_url' => 'O(a) :attribute não é um URL válido.',
    'after' => 'O(a) :attribute deve ser uma data depois :date.',
    'after_or_equal' => 'O(a) :attribute deve ser uma data posterior ou igual a :date.',
    'alpha' => 'O(a) :attribute pode conter apenas letras.',
    'alpha_dash' => 'O(a) :attribute só pode conter letras, números, travessões e sublinhados.',
    'alpha_num' => 'O(a) :attribute só pode conter letras e números.',
    'array' => 'O(a) :attribute deve ser um array.',
    'before' => 'O(a) :attribute deve ser uma data antes :date.',
    'before_or_equal' => 'O(a) :attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => 'O(a) :attribute deve estar entre :min e :max kilobytes.',
        'string' => 'O(a) :attribute deve estar entre :min e :max caaracteres.',
        'array' => 'O(a) :attribute deve estar entre :min e :max itens.',
    ],
    'boolean' => 'O(a) :attribute campo deve ser verdadeiro ou falso.',
    'confirmed' => 'O(a) :attribute a confirmação não corresponde.',
    'date' => 'O(a) :attribute não é uma data válida.',
    'date_equals' => 'O(a) :attribute deve ser uma data igual a :date.',
    'date_format' => 'O(a) :attribute não corresponde ao formato :format.',
    'different' => 'O(a) :attribute e :other deve ser diferente.',
    'digits' => 'O(a) :attribute devem ser :digits digitos.',
    'digits_between' => 'O(a) :attribute deve estar entre :min e :max digitos.',
    'dimensions' => 'O(a) :attribute tem dimensões de imagem inválidas.',
    'distinct' => 'O(a) :attribute campo tem um valor duplicado.',
    'email' => 'O(a) :attribute Deve ser um endereço de e-mail válido.',
    'ends_with' => 'O(a) :attribute deve terminar com um dos seguintes: :values',
    'exists' => 'O(a) selecionado :attribute é invalido.',
    'file' => 'O(a) :attribute deve ser um arquivo.',
    'filled' => 'O(a) :attribute campo deve ter um valor.',
    'gt' => [
        'numeric' => 'O(a) :attribute deve ser maior que :value.',
        'file' => 'O(a) :attribute deve ser maior que :value kilobytes.',
        'string' => 'O(a) :attribute deve ser maior que :value caracteres.',
        'array' => 'O(a) :attribute deve ser maior que :value itens.',
    ],
    'gte' => [
        'numeric' => 'O(a) :attribute deve ser maior ou igual :value.',
        'file' => 'O(a) :attribute deve ser maior ou igual :value kilobytes.',
        'string' => 'O(a) :attribute deve ser maior ou igual :value caracteres.',
        'array' => 'O(a) :attribute deve ter :value items ou mais.',
    ],
    'image' => 'O(a) :attribute deve ser uma imagem.',
    'in' => 'O(a)  :attribute selecionado é invalido.',
    'in_array' => 'O(a) :attribute campo não existe em :other.',
    'integer' => 'O(a) :attribute deve ser um inteiro.',
    'ip' => 'O(a) :attribute deve ser um endereço IP válido.',
    'ipv4' => 'O(a) :attribute deve ser um endereço IPv4 válido.',
    'ipv6' => 'O(a) :attribute deve ser um endereço IPv6 válido.',
    'json' => 'O(a) :attribute deve ser uma string JSON válida.',
    'lt' => [
        'numeric' => 'O(a) :attribute deve ser menor que :value.',
        'file' => 'O(a) :attribute deve ser menor que :value kilobytes.',
        'string' => 'O(A) :attribute deve ser menor que :value caracteres.',
        'array' => 'O(a) :attribute deve ter menos que :value itens.',
    ],
    'lte' => [
        'numeric' => 'O(a) :attribute deve ser menor ou igual :value.',
        'file' => 'O(A) :attribute deve ser menor ou igual :value kilobytes.',
        'string' => 'O(a) :attribute deve ser menor ou igual :value caracteres.',
        'array' => 'O(a) :attribute não deve ter mais que :value itens.',
    ],
    'max' => [
        'numeric' => 'O(a) :attribute não pode ser maior que :max.',
        'file' => 'O(a) :attribute não pode ser maior que :max kilobytes.',
        'string' => 'O(a) :attribute não pode ser maior que :max caracteres.',
        'array' => 'O(a) :attribute não pode ter mais que :max itens.',
    ],
    'mimes' => 'O(a) :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O(a) :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O(a) :attribute deve ser pelo menos :min.',
        'file' => 'O(a) :attribute deve ser pelo menos :min kilobytes.',
        'string' => 'O(a) :attribute deve ser pelo menos :min caracteres.',
        'array' => 'O(a) :attribute deve ter pelo menos :min itens.',
    ],
    'not_in' => 'O(a) :attribute selecionado é invalido.',
    'not_regex' => 'O(a) :attribute formato é inavalido.',
    'numeric' => 'O(a) :attribute deve ser um número.',
    'present' => 'O(a) :attribute campo deve estar presente.',
    'regex' => 'O(a) :attribute formato é invalido.',
    'required' => 'O(a) :attribute campo é obrigatório.',
    'required_if' => 'O(a) :attribute campo é obrigatório quando :other é :value.',
    'required_unless' => 'O(a) :attribute campo é obrigatório a menos :other é em :values.',
    'required_with' => 'O(a) :attribute campo é obrigatório quando :values é presente.',
    'required_with_all' => 'O(a) :attribute campo é obrigatório quando :values estão presentes.',
    'required_without' => 'O(a) :attribute campo é obrigatório quando :values não está presente.',
    'required_without_all' => 'O(a) :attribute campo é obrigatório quando nenhum :values estão presentes.',
    'same' => 'O(a) :attribute e :other deve combinar.',
    'size' => [
        'numeric' => 'O(a) :attribute devem ser :size.',
        'file' => 'O(a) :attribute devem ser :size kilobytes.',
        'string' => 'O(a) :attribute devem ser :size caracteres.',
        'array' => 'O(a) :attribute deve conter :size itens.',
    ],
    'starts_with' => 'O(a) :attribute deve começar com um dos seguintes: :values',
    'string' => 'O(a) :attribute tem que ser um texto (string).',
    'timezone' => 'O(a) :attribute deve ser uma zona válida.',
    'unique' => 'O(a) :attribute já foi tomada.',
    'uploaded' => 'O(a) :attribute Falha ao carregar.',
    'url' => 'O(a) :attribute formato é invalido.',
    'uuid' => 'O(a) :attribute deve ser um UUID válido.',

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
        'hashtag' => 'O(a) :attribute deve haver mais 3 tags.',
        'old_password' => 'O(a) :attribute não corresponde ao nosso banco de dados'
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
