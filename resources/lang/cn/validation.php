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

    'accepted'             => '填写的信息必须被接受The :attribute must be accepted.',
    'active_url'           => '填写的信息不是有效的URL.',
    'after'                => '填写的信息必须是时间.',
    'alpha'                => '填写的信息可以只包括字母.',
    'alpha_dash'           => '填写信息可以包括字母，数字和下划线.',
    'alpha_num'            => '填写信息可以包括字母和数字.',
    'array'                => '填写信息必须是箭头The :attribute must be an array.',
    'before'               => '填写的日期信息必须在该日期之前The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => '所填写的数字必须区间内.',
        'file'    => '所填信息必须在区间内.',
        'string'  => '所填信息必须在区间内.',
        'array'   => '所填信息必须在区间内.',
    ],
    'boolean'              => '所填信息必须是“是”或者“否”.',
    'confirmed'            => '不匹配.',
    'date'                 => '所填日期不是有效日期.',
    'date_format'          => '所填信息必须要是日期格式.',
    'different'            => '所填信息两者要不相同.',
    'digits'               => '所填信息必须是数字.',
    'digits_between'       => '所填写的数字必须在区间内间.',
    'email'                => '格式不对.',
    'exists'               => '选择无效.',
    'filled'               => '所填信息为必填项目.',
    'image'                => '所填信息必须是图片格式.',
    'in'                   => '选择无效.',
    'integer'              => '所填信息必须是整数.',
    'ip'                   => '所填信息必须是有效的IP地址.',
    'json'                 => '所填写信息必须是有效信息.',
    'max'                  => [
        'numeric' => '填写信息必须在最大和最小区间内.',
        'file'    => '填写信息必须在最大和最小区间内.',
        'string'  => '填写信息必须在最大和最小区间内.',
        'array'   => '填写信息必须在最大和最小区间内误.',
    ],
    'mimes'                => '填写信息必须数值.',
    'min'                  => [
        'numeric' => '所填信息必须高于最小值.',
        'file'    => '所填信息必须高于最小字符.',
        'string'  => '所填信息必须大于最小字符.',
        'array'   => '所填信息必须大于最小值.',
    ],
    'not_in'               => '选择无效.',
    'numeric'              => '所填信息必须是数字.',
    'regex'                => '所填信息格式错误.',
    'required'             => '所填信息为必填项目.',
    'required_if'          => '当选择了其他，以下所填信息为必填项目.',
    'required_unless'      => '所填信息为必填项目，除非选择的其他选项有内容.',
    'required_with'        => '当内容显示出来，所填信息为必填选项.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => '所填信息为必填选项，当没有任何内容显示.',
    'same'                 => '所填信息必须和其他内容一致.',
    'size'                 => [
        'numeric' => '所填数字必须符合大小.',
        'file'    => '所填信息必须符合字节长度.',
        'string'  => '所填信息必须符合字母长度.',
        'array'   => '所填信息必须包含项目大小.',
    ],
    'string'               => '所填信息必须是一个字符串.',
    'timezone'             => '所填信息必须是有效的时区.',
    'unique'               => '所填写信息已经被使用了.',
    'url'                  => '所填信息格式错误.',

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
