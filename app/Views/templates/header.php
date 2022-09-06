<!DOCTYPE html>
<!-- 
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.5.1
Author: Sunnyat A.
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0?ref=myorange
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Easy Pie Chart - Statistics - SmartAdmin v4.5.1
        </title>
        <meta name="description" content="Easy Pie Chart">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" href="public/css/bootstrap.css">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="public/css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="public/css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="public/css/skins/skin-master.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="public/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="public/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="public/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <!-- my imports -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script src="https://kit.fontawesome.com/4d1ca3d67a.js" crossorigin="anonymous"></script>
        <link rel="mask-icon" href="public/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="public/css/statistics/chartjs/chartjs.css">
        <link rel="stylesheet" href="public/css/mystyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <!-- BEGIN Body -->
    <!-- Possible Classes

		* 'header-function-fixed'         - header is in a fixed at all times
		* 'nav-function-fixed'            - left panel is fixed
		* 'nav-function-minify'			  - skew nav to maximize space
		* 'nav-function-hidden'           - roll mouse on edge to reveal
		* 'nav-function-top'              - relocate left pane to top
		* 'mod-main-boxed'                - encapsulates to a container
		* 'nav-mobile-push'               - content pushed on menu reveal
		* 'nav-mobile-no-overlay'         - removes mesh on menu reveal
		* 'nav-mobile-slide-out'          - content overlaps menu
		* 'mod-bigger-font'               - content fonts are bigger for readability
		* 'mod-high-contrast'             - 4.5:1 text contrast ratio
		* 'mod-color-blind'               - color vision deficiency
		* 'mod-pace-custom'               - preloader will be inside content
		* 'mod-clean-page-bg'             - adds more whitespace
		* 'mod-hide-nav-icons'            - invisible navigation icons
		* 'mod-disable-animation'         - disables css based animations
		* 'mod-hide-info-card'            - hides info card from left panel
		* 'mod-lean-subheader'            - distinguished page header
		* 'mod-nav-link'                  - clear breakdown of nav links

		>>> more settings are described inside documentation page >>>
	-->
    <body class="mod-bg-1 mod-nav-link ">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);

            }
            else if (themeSettings.themeURL && document.getElementById('mytheme'))
            {
                document.getElementById('mytheme').href = themeSettings.themeURL;
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|footer|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- END Left Aside -->
                <div class="page-content-wrapper text-center">

                    <?php $currentPage = esc('currentPage'); if (isset($currentPage)): ?>

                    <?php //var_dump($_SESSION); ?>

                        <!-- BEGIN Page Header-->
                        
                        <header class="navbar navbar-expand-lg navbar-light px-6 pt-3">
                            <div class="d-flex fd-col mx-6" style="width: 6.25rem">
                                <div class="py-1">
                                    <img src="public/img/logo.png" width="100"/>
                                </div>
                                <div class="py-1 text-right">
                                    <h1><small class="m-0"><b>Monitoring</b></small></h1>
                                </div>
                            </div>
                            <div class="<?php if ($currentPage === 'login') { echo 'd-none';} else { echo 'd-flex'; } ?> justify-content-between mx-5 nav-xl nav-lg nav-md nav" id="navbarSupportedContent">
                                <div class="d-flex" id="js_nav_tabs">
                                    <a href="?monitoring" class="nav-link cursor-pointer <?php if ($currentPage === 'monitoring') { echo 'active'; } ?>" id="monitoring" role="tab" for="page-main-content">
                                        <i class="fal fa-disc-drive nav-icon d-block"></i>
                                        <text1x>Monitoring</text1x>
                                    </a>
                                    <a href="?taptab" class="nav-link cursor-pointer <?php if ($currentPage === 'taptab') { echo 'active'; } ?>" id="taptab" role="tab" for="page-main-content">
                                        <i class="fal fa-disc-drive nav-icon d-block"></i>
                                        <text1x>Taptab</text1x>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center fs3x nav-btn dropdown">
                                    <div class="fal fa-user dropdown-toggle cursor-pointer" style="height: 2rem" id="navbarDropdown">
                                        <!--     <span class="display-arrow cursor-pointer"></span> -->
                                    </div>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li class="nav-link dropdown-item" href="#!">Opcion 1</li>
                                        <li class="nav-link dropdown-item" href="#!">Opcion 2</li>
                                        <hr class="dropdown-divider"/>
                                        <a class="nav-link dropdown-item" href="?logout">Salir</a>
                                    </ul>
                                </div>
                            </div>
                        </header>

                    <?php else: ?>

                        <header class="navbar navbar-expand-lg navbar-light px-6 pt-3">
                            <div class="d-flex justify-content-between mx-5 nav-xl nav-lg nav-md nav">
                                <p>Las pestañas no han podido cargarse.</p>
                            </div>
                        </header>
                        <!-- END Page Header -->

                    <?php endif; ?>
                