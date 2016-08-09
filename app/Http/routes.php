<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

$router->group(['as' => 'front::', 'middleware' => ['web']], function () use ($router){
	$router->auth();
	$router->get('terms', [
		'as'   => 'terms.get',
		'uses' => function (){
			return view('pages.blank');
		},
	]);
	$router->get('fqa', [
		'as'   => 'fqa.get',
		'uses' => function (){
			return view('pages.blank');
		},
	]);
	$router->get('payment-instructions', [
		'as'   => 'payin.get',
		'uses' => function (){
			return view('pages.blank');
		},
	]);
	$router->get('token', function (){
		return csrf_token();
	});

	$router->post('alipay', [
		'as'   => 'alipay.post',
		'uses' => 'Ecommerce\AlipayController@postAlipay',
	]);

	$router->get('language/{locale}', [
		'as'   => 'switch.lang',
		'uses' => 'PagesController@getLang',
	]);

	$router->get('home', function (){
		return redirect()->route('front::settings.account');
	});

	$router->get('/', [
		'as'   => 'home',
		'uses' => 'PagesController@getIndex',
	]);

	$router->get('auth/facebook', [
		'as'   => 'auth.facebook',
		'uses' => 'Auth\AuthController@redirectToProvider',
	]);

	$router->get('auth/facebook/callback', [
		'as'   => 'auth.social.confirm',
		'uses' => 'Auth\AuthController@handleProviderCallback',
	]);

	$router->controller('page', 'PagesController', [
		'getAbout'         => 'about',
		'getContact'       => 'contact',
		'putContact'       => 'put.contact',
		'getWinning'       => 'get.winning.numbers',
		'getSpecialOffers' => 'special.offers',
		'getTrustSecurity' => 'trust',
		'getPayment'       => 'payment',
	]);

	$router->controller('settings', 'User\SettingsController', [
		'getAccount'       => 'settings.account',
		'getPayment'       => 'settings.payment',
		'getWinning'       => 'settings.winning',
		'getNotifications' => 'settings.notifications',
	]);

	$router->controller('account', 'User\AccountController', [
		'putEditAccount'   => 'account.put.account',
		'postChangeAvatar' => 'account.avatar',
		'putChangePass'    => 'account.put.changepass',
		'getReSendEmail'   => 'register.resend.email',
		'getThank'         => 'register.thank',
		'getVerify'        => 'register.verify',
		'getAccount'       => 'get.account',
	]);

	$router->controller('payment', 'User\PaymentController', [
		'getPayments'   => 'get.payments',
		'putPayment'    => 'put.payment',
		'postPayment'   => 'post.payment',
		'deletePayment' => 'delete.payment',
		'postCharge'    => 'post.charge',
		'getHistory'    => 'payment.history',
		'getPayment'    => 'purchase.payment',
	]);

	$router->controller('winning', 'User\WinningController', [
		'postCharge' => 'post.charge',
		'postClaim'  => 'post.claim',
	]);

	$router->controller('transaction', 'User\TransactionController', [
		'getTransactions' => 'get.transaction',
		'putCancel'       => 'put.cancel.transaction',
	]);

	// FOR API
	$router->group(['as' => 'api::', 'prefix' => 'api'], function () use ($router){
		$router->get('orders', [
			'as'   => 'get.orders',
			'uses' => 'User\OrderController@getOrders',
		]);
		$router->get('orders/{order}', [
			'as'   => 'get.order',
			'uses' => 'User\OrderController@getOrder',
		]);

		$router->put('orders/{order}/cancel', [
			'as'   => 'put.order.cancel',
			'uses' => 'User\OrderController@cancleOrder',
		]);

		$router->get('results', [
			'as'   => 'get.results',
			'uses' => 'Games\PowerballController@getResults',
		]);

		$router->get('notifications', [
			'as'   => 'get.notifications',
			'uses' => 'User\NotificationController@getNotifications',
		]);
		$router->put('notifications/{notification}', [
			'as'   => 'put.isread.notification',
			'uses' => 'User\NotificationController@putIsRead',
		]);
		$router->delete('notifications/{notification}', [
			'as'   => 'delete.notification',
			'uses' => 'User\NotificationController@deleteNotify',
		]);

		$router->get('ecom-orders', [
			'as'   => 'get.ecommerce.orders',
			'uses' => 'Ecommerce\OrderController@getOrders',
		]);
		$router->get('ecom-show-orders/{order}', [
			'as'   => 'get.ecommerce.show.order',
			'uses' => 'Ecommerce\OrderController@getOrder',
		]);

		$router->post('discount/game/{game}/apply', [
			'as'   => 'discount.apply.game',
			'uses' => 'DiscountController@applyGameDiscount',
		]);

	});

	//FOR ORDER
	$router->resource('orders', 'User\OrderController', [
		'only' => [
			'index',
			'show',
		],
	]);

	$router->controller('game', 'GameController', [
		'getPowerball'    => 'game.powerball',
		'getMegamillions' => 'game.megamillions',
		'getPayment'      => 'game.get.payment',
		'getIndex'        => 'game.get.index',
	]);

	$router->controller('powerball', 'Games\PowerballController', [
		'postPowerball' => 'post.powerball',
		'putLuckys'     => 'put.luckys',
	]);

	$router->controller('megamillions', 'Games\MegamilionController', [
		'postMegamilion' => 'post.megamillions',
		'putLuckys'      => 'put.luckys.mega',
	]);

	$router->group([
		'as'        => 'ecommerce.',
		'prefix'    => 'ecommerce',
		'namespace' => 'Ecommerce',
	], function () use ($router){
		$router->get('cart', [
			'as'   => 'cart',
			'uses' => 'CartController@index',
		]);

		$router->get('category/{category}', [
			'as'   => 'category.show',
			'uses' => 'CategoryController@show',
		]);

		$router->get('product/{product}', [
			'as'   => 'product.show',
			'uses' => 'ProductController@show',
		]);

		$router->get('order', [
			'as'   => 'order',
			'uses' => 'OrderController@index',
		]);

		$router->post('order/store', [
			'as'   => 'order.store',
			'uses' => 'OrderController@store',
		]);

		$router->get('order/{order}', [
			'as'   => 'order.show',
			'uses' => 'OrderController@show',
		]);
	});

});

//FOR ADMIN
$router->group([
	'prefix'     => 'admin',
	'namespace'  => 'Admin',
	'middleware' => ['web'],
], function () use ($router){

	$router->get('login', [
		'as'   => 'admin.auth.login',
		'uses' => 'Auth\AuthController@getLogin',
	]);

	$router->group(['middleware' => ['auth', 'active', 'admin']], function () use ($router){

		//API
		$router->group(['as' => 'admin.', 'prefix' => 'api'], function () use ($router){
			$router->get('contacts', [
				'as'   => 'get.contacts',
				'uses' => 'ContactController@getContacts',
			]);

			$router->get('orders', [
				'as'   => 'get.orders',
				'uses' => 'OrdersController@getOrders',
			]);
			$router->get('order/{order}', [
				'as'   => 'get.order',
				'uses' => 'OrdersController@getOrder',
			]);
			$router->post('orders/{order}/uploads', [
				'as'   => 'post.files.order',
				'uses' => 'OrdersController@postFiles',
			]);
			$router->delete('orders/{order}/{id}', [
				'as'   => 'delete.file.order',
				'uses' => 'OrdersController@deleteFile',
			]);

			$router->get('users', [
				'as'   => 'get.users',
				'uses' => 'UserController@getUsers',
			]);
			$router->get('user/{user}', [
				'as'   => 'get.user',
				'uses' => 'UserController@getUser',
			]);
			$router->post('user/{user}', [
				'as'   => 'post.user.deposit',
				'uses' => 'UserController@postDeposit',
			]);
			$router->post('user/{user}/avatar', [
				'as'   => 'post.avatar',
				'uses' => 'UserController@postChangeAvatar',
			]);
			$router->put('user/{user}/password', [
				'as'   => 'put.password',
				'uses' => 'UserController@putChangePass',
			]);
			$router->get('user/{user}/transaction', [
				'as'   => 'get.user.transaction',
				'uses' => 'UserController@getTransactions',
			]);
			$router->get('user/{user}/orders', [
				'as'   => 'get.user.orders',
				'uses' => 'UserController@getOrders',
			]);

			$router->get('manages/{id}', [
				'as'   => 'get.managegame',
				'uses' => 'ManageGameController@getKeys',
			]);

			$router->post('results/{game_id}/assign', [
				'as'   => 'post.assign.result',
				'uses' => 'Results\ResultController@assignToResult',
			]);
			$router->get('results/{game_id}/nj', [
				'as'   => 'get.result.nj',
				'uses' => 'Results\ResultController@getResultsNj',
			]);
			$router->get('results/results', [ // for Search
				'as'   => 'get.results',
				'uses' => 'Results\ResultController@getResults',
			]);
			$router->post('results/award/{result}/finish', [
				'as'   => 'post.award.result.finish',
				'uses' => 'Results\ResultController@onFinish',
			]);
			$router->get('results/award/{result}/detail', [
				'as'   => 'get.award.result.detail',
				'uses' => 'Results\ResultController@getTicketAward',
			]);
			$router->put('results/award/{award}', [
				'as'   => 'put.award.changestatus',
				'uses' => 'Results\ResultController@putStatusTicket',
			]);

			$router->post('results/validate/{result}', [
				'as'   => 'post.award.result.validate',
				'uses' => 'Results\ResultController@validateCal',
			]);

			$router->post('results/calculate/{result}', [
				'as'   => 'post.award.result.calculate',
				'uses' => 'Results\ResultController@onCalculate',
			]);

			$router->get('users/winners', [
				'as'   => 'get.winners',
				'uses' => 'WinnerController@getWinners',
			]);

			$router->get('users/winners/tickets', [
				'as'   => 'get.winners.tickets',
				'uses' => 'WinnerController@getTicketWin',
			]);

			$router->get('claim-winning', [
				'as'   => 'get.transactions',
				'uses' => 'RequestList\WithDrawController@getTransacsions',
			]);

			$router->get('discounts', [
				'as'   => 'api.discounts',
				'uses' => 'DiscountController@apiIndex',
			]);
			$router->get('discounts/autocomplete', [
				'as'   => 'api.discounts.autocomplete',
				'uses' => 'DiscountController@autocomplete',
			]);

			$router->delete('game/{game}/discount/{discount}', [
				'as'   => 'api.game.discount.delete',
				'uses' => 'ManageGameController@removeDiscount',
			]);
			$router->post('game/{game}/discount/{discount}', [
				'as'   => 'api.game.discount.add',
				'uses' => 'ManageGameController@addDiscount',
			]);
			
			$router->get('api-promotion',[
				'as' => 'api.promotion',
				'uses' => 'PromotionController@apiPromotion'
			]);

		}); //END API

		$router->resource('contact', 'ContactController', [
			'only' => ['index', 'show', 'update'],
		]);

		$router->resource('promotion', 'PromotionController', [
			'only' => ['index', 'update'],
		]);

		$router->resource('users/winners', 'WinnerController', [
			'only' => 'index',
		]);
		$router->put('users/{users}/active', [
			'as'   => 'user.post.active',
			'uses' => 'UserController@putActive',
		]);
		$router->resource('users', 'UserController', [
			'only' => ['index', 'destroy', 'show', 'update'],
		]);

		$router->get('orders/prints', [
			'as'   => 'get.prints',
			'uses' => 'OrdersController@getPrints',
		]);
		$router->resource('orders', 'OrdersController', [
			'only' => ['index', 'show', 'update', 'destroy'],
		]);

		$router->resource('tickets', 'TicketsController', [
			'only' => 'index',
		]);

		$router->resource('results', 'Results\ResultController', [
			'only' => 'index',
		]);
		$router->get('results/awards', [
			'as'   => 'get.results.awards',
			'uses' => 'Results\ResultController@awards',
		]);
		$router->get('results/award/{result}', [
			'as'   => 'get.award.result.detailt',
			'uses' => 'Results\ResultController@awardDetail',
		]);

		$router->resource('claim-winning', 'RequestList\WithDrawController', [
			'only' => ['index', 'update'],
		]);

		$router->resource('games', 'ManageGameController', [
			'only' => ['show', 'update'],
		]);

		$router->resource('discount', 'DiscountController', [
			'only' => ['index', 'edit', 'update', 'create', 'store', 'destroy'],
		]);

		$router->get('games/{game}/discount', [
			'as'   => 'game.assign.discount',
			'uses' => 'ManageGameController@discount',
		]);

		//FOR e-commerce
		$router->group(
			['as' => 'ecommerce.', 'prefix' => 'ecommerce', 'namespace' => 'Ecommerce'],
			function () use ($router){
				$router->get('api/products', [
					'as'   => 'api.list',
					'uses' => 'ProductController@apiGetProducts',
				]);
				$router->resource('product', 'ProductController', [
					'except' => ['update'],
				]);
				$router->post('product/{product}', [
					'as'   => 'admin.ecommerce.product.update',
					'uses' => 'ProductController@update',
				]);

				$router->get('orders', [
					'as'   => 'order.index',
					'uses' => 'OrderController@index',
				]);
				$router->get('order/{order}', [
					'as'   => 'order.show',
					'uses' => 'OrderController@show',
				]);

				$router->get('api/orders', [
					'as'   => 'api.orders',
					'uses' => 'OrderController@apiIndex',
				]);
				$router->get('api/order/{order}', [
					'as'   => 'api.order.show',
					'uses' => 'OrderController@apiShow',
				]);
				$router->put('api/updatestatus/{order}', [
					'as'   => 'api.order.update.status',
					'uses' => 'OrderController@apiUpdateStatus',
				]);

				$router->resource('category', 'CategoryController', [

				]);

				$router->get('api/categories', [
					'as'   => 'category.api.index',
					'uses' => 'CategoryController@apiIndex',
				]);
				$router->get('api/categories/autocomplete', [
					'as'   => 'category.api.autocomplete',
					'uses' => 'CategoryController@autocompleteCategories',
				]);
			}
		);

		//NOTICE: Only bottom
		$router->controller('/', 'AdminController', [
			'getDashboard' => 'admin.dashboard',
		]);

	});
});

$router->group(['as' => 'api::', 'prefix' => 'api'], function () use ($router){
	$router->controller('game', 'Api\GameController', [
		'getResults' => 'get.game.results',
	]);
});
