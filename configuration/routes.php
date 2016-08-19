<?php

/**
 * Application Routes
 * 
 * Application routes may be configured here. Each route needs at least a
 * method, controller and name. A guard may also be added to routes that
 * require the user to be authenticated.
 */
return [
    
    /**
     * Seeds the database.
     * 
     */
    '/seed-db' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Database\DatabaseController@seed',
        'name' => 'seed-db'
    ],
    
    /**
     * Login Page
     * 
     */
    '/login' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Login\LoginController@showLogin',
        'name' => 'login-page'
    ],
    
    /**
     * Do Login
     * 
     */
    '/do-login' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Login\LoginController@doLogin',
        'name' => 'do-login'
    ],
    
    /**
     * Do Logout
     * 
     */
    '/logout' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Logout\LogoutController@logout',
        'name' => 'logout-page'
    ],
    
    
    
    '/register' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Register\RegistrationController@showRegistration',
        'name' => 'registration-page'
    ],
    
    '/do-registration' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Register\RegistrationController@doRegistration',
        'name' => 'do-registration'
    ],
    
    
    
    '/forgot-password' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Password\PasswordController@showForgotPassword',
        'name' => 'forgot-password-page'
    ],
    
    '/reset-password' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Password\PasswordController@showResetPassword',
        'name' => 'reset-password-page'
    ],
    
    '/do-reset-password' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Password\PasswordController@doResetPassword',
        'name' => 'do-reset-password'
    ],
    
    '/send-forgot-password-email' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Password\PasswordController@sendForgotPasswordEmail',
        'name' => 'send-forgot-password-email'
    ],

    '/auth/dashboard' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Auth\Dashboard\DashboardController@showDashboard',
        'guard' => 'guard',
        'name' => 'auth-dashboard-page'
    ],

    '/auth/update-user-settings' => [
        'method' => 'post',
        'controller' => 'App\Controllers\User\UserController@updateSettings',
        'guard' => 'guard',
        'name' => 'update-user-settings'
    ],
    
    '/auth/fonts' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Auth\Font\FontController@showFonts',
        'guard' => 'guard',
        'name' => 'auth-font-page'
    ],
    
    '/get-batch-files' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Auth\System\SystemController@getBatchFiles',
        'guard' => 'guard',
        'name' => 'get-batch-files'
    ],
    
    '/get-batch-history' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Auth\System\SystemController@getBatchHistory',
        'guard' => 'guard',
        'name' => 'get-batch-history'
    ],
    
    '/update-system-settings' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Auth\System\SystemController@updateSystemSettings',
        'guard' => 'guard',
        'name' => 'update-system-settings'
    ],
    
    '/add-font' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Auth\Font\FontController@addFont',
        'guard' => 'guard',
        'name' => 'add-font'
    ],
    
    '/process-batch' => [
        'method' => 'post',
        'controller' => 'App\Controllers\Auth\System\SystemController@processBatch',
        'guard' => 'guard',
        'name' => 'process-batch'
    ],
    
    '/process-batch-testing' => [
        'method' => 'get',
        'controller' => 'App\Controllers\Auth\System\SystemController@processBatch',
        'guard' => 'guard',
        'name' => 'process-batch'
    ],
    
];
