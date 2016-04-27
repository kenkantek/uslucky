<?php

return [
    'award'              => "You are WINNER! Congratulation from " . env('TITLE'),
    'updated_order'      => "Your order # :order_id at :created_at  was purchased. Please check by Your order menu.",
    'order_cancle'       => "Because your order # :order_id at :created_at was canceled. We refund to you. Total amount: $ :price",
    'claim'              => "Your claim request # :transaction at :created_at was paid. Total amount: $ :amount",
    'winner'             => "You are WINNER with ticket number: <strong> :tickets  <span style='color: red'> :ball </span></strong>. Prize: :label with $ :reward",
    'title_update_order' => env('TITLE') . " - Your order was purchased",
    'title_new_order'    => "Your new order from " . env('TITLE'),
    'title_claim'        => env('TITLE') . " Preview Payment transaction # :transaction",
    'title_paid'         => env('TITLE') . " Preview Payment transaction # :transaction",
    'register'           => "Verify Your Email Address From " . env('TITLE'),
];
