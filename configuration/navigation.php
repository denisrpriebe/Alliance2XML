<?php

/**
 * Navigation Configuration
 *
 * Navigation can be configured here. Each link/tab needs to have a text, icon
 * and route-name.
 */
return array(

    'nav' => array(

        'dashboard' => array(
            'text' => 'Dashboard',
            'icon' => '<span class="glyphicon glyphicon-dashboard"></span>',
            'route-name' => 'auth-dashboard-page'
        ),

        'fonts' => array(
            'text' => 'Fonts',
            'icon' => '<span class="glyphicon glyphicon-font"></span>',
            'route-name' => 'auth-font-page'
        )

    )
);
