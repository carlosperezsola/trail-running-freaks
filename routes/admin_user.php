<?php

use App\Http\Controllers\Backend\AdminThirdPartyUserProfileController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileUserController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\TrademarkController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductOptionController;
use App\Http\Controllers\Backend\ProductOptionItemController;
use App\Http\Controllers\Backend\CountDownController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\FooterGridController;
use App\Http\Controllers\Backend\SubscribersController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\WhoWeAreController;
use App\Http\Controllers\Backend\TermsAndConditionController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminUserController::class, 'dashboard'])->name('dashboard');

/** Profile routes */
Route::get('profile', [ProfileUserController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileUserController::class, 'updateUserProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileUserController::class, 'updatePassword'])->name('password.update');

/** Slider routes */
Route::resource('slider', SliderController::class);

/** Category routes */
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/** Sub category routes */
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

/** Child category routes */
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

/** Trademark routes */
Route::put('trademark/change-status', [TrademarkController::class, 'changeStatus'])->name('trademark.change-status');
Route::resource('trademark', TrademarkController::class);

/** Third party profile routes */
Route::resource('third-party-profile', AdminThirdPartyUserProfileController::class);

/** Products routes */
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);

/** Products image gallery route */
Route::resource('products-image-gallery', ProductImageGalleryController::class);

/** Products option route */
Route::put('products-option/change-status', [ProductOptionController::class, 'changeStatus'])->name('products-option.change-status');
Route::resource('products-option', ProductOptionController::class);

/** Products option item route */
Route::get('products-option-item/{productId}/{optionId}', [ProductOptionItemController::class, 'index'])->name('products-option-item.index');
Route::get('products-option-item/create/{productId}/{optionId}', [ProductOptionItemController::class, 'create'])->name('products-option-item.create');
Route::post('products-option-item', [ProductOptionItemController::class, 'store'])->name('products-option-item.store');
Route::get('products-option-item-edit/{optionItemId}', [ProductOptionItemController::class, 'edit'])->name('products-option-item.edit');
Route::put('products-option-item-update/{optionItemId}', [ProductOptionItemController::class, 'update'])->name('products-option-item.update');
Route::delete('products-option-item/{optionItemId}', [ProductOptionItemController::class, 'destroy'])->name('products-option-item.destroy');
Route::put('products-option-item-status', [ProductOptionItemController::class, 'changeStatus'])->name('products-option-item.changes-status');

/** Seller product routes */
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');

/** Count Down routes */
Route::get('count-down', [CountDownController::class, 'index'])->name('count-down.index');
Route::put('count-down', [CountDownController::class, 'update'])->name('count-down.update');
Route::post('count-down/add-product', [CountDownController::class, 'addProduct'])->name('count-down.add-product');
Route::put('count-down/show-at-home/status-change', [CountDownController::class, 'changeShowAtHomeStatus'])->name('count-down.show-at-home.change-status');
Route::put('count-down-status', [CountDownController::class, 'changeStatus'])->name('count-down-status');
Route::delete('count-down/{id}', [CountDownController::class, 'destroy'])->name('count-down.destroy');

/** Settings routes */
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');
Route::put('email-setting-update', [SettingController::class, 'emailConfigSettingUpdate'])->name('email-setting-update');
Route::put('logo-setting-update', [SettingController::class, 'logoSettingUpdate'])->name('logo-setting-update');

/** home page setting route */
Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting.index');
Route::put('popular-category-section', [HomePageSettingController::class, 'updatePopularCategorySection'])->name('popular-category-section');

/** Shipping rules routes */
Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);

/** Order routes */
Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::resource('order', OrderController::class);

/** Subscribers routes */
Route::get('subscribers', [SubscribersController::class, 'index'])->name('subscribers.index');
Route::delete('subscribers/{id}', [SubscribersController::class, 'destroy'])->name('subscribers.destroy');
Route::post('subscribers-send-mail', [SubscribersController::class, 'sendMail'])->name('subscribers-send-mail');

/** Banner routes */
Route::get('banner', [BannerController::class, 'index'])->name('banner.index');
Route::put('banner/homepage-banner-section', [BannerController::class, 'homepageBannersection'])->name('homepage-banner-section');
Route::put('banner/homepage-banner-section-four', [BannerController::class, 'homepageBannersectionFour'])->name('homepage-banner-section-four');
Route::put('banner/productpage-banner', [BannerController::class, 'productPageBanner'])->name('productpage-banner');
Route::put('banner/cartpage-banner', [BannerController::class, 'cartPageBanner'])->name('cartpage-banner');

/** Who we are routes */
Route::get('who-we-are', [WhoWeAreController::class, 'index'])->name('who-we-are.index');
Route::put('who-we-are/update', [WhoWeAreController::class, 'update'])->name('who-we-are.update');

/** Terms & conditons routes */
Route::get('terms-and-conditions', [TermsAndConditionController::class, 'index'])->name('terms-and-conditions.index');
Route::put('terms-and-conditions/update', [TermsAndConditionController::class, 'update'])->name('terms-and-conditions.update');

/** Footer routes */
Route::resource('footer-info', FooterInfoController::class);
Route::put('footer-socials/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-socials.change-status');
Route::resource('footer-socials', FooterSocialController::class);
Route::put('footer-grid/change-status', [FooterGridController::class, 'changeStatus'])->name('footer-grid.change-status');
Route::resource('footer-grid', FooterGridController::class);

/** Payment settings routes */
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');