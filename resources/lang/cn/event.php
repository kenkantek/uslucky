<?php

return [
    'award'              => "你中奖了! 恭喜发财 " . env('TITLE'),
    'updated_order'      => "你的订单已经购买成功了。请查询你的订单记录.",
    'order_cancle'       => "你的订单已经取消。我们会全额退款给你。退款金额为: $ :price",
    'claim'              => "你的兑现要求 # :交易为 :created_at 已经付款. 总计为: $ :amount",
    'winner'             => "你选中的号码中奖了： <strong> :tickets  <span style='color: red'> :ball </span></strong>. 奖金: :label with $ :reward",
    'title_update_order' => env('TITLE') . " - 你选的号码已经购买成功了Your order was purchased",
    'title_new_order'    => "你的新订单 " . env('TITLE'),
    'title_claim'        => env('TITLE') . " 预览支付交易# :transaction",
    'title_paid'         => env('TITLE') . " 预览支付交易 # :transaction",
    'register'           => "验证你的电子邮件地址 " . env('TITLE'),
];
