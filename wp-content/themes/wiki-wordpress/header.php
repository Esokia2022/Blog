<?php
/**
 * The theme header.
 * 
 * @package bootstrap-basic4
 */

$container_class = apply_filters('bootstrap_basic4_container_class', 'container');
if (!is_scalar($container_class) || empty($container_class)) {
    $container_class = 'container';
}
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php if(is_search()){
            $search = get_search_query();
            echo "<title>Recherche : ".$search."</title>";
        } ?>
        <?php wp_head(); ?> 
        <!--end WordPress head-->
    </head>
    <body <?php body_class(); ?>>
        <?php
        if (function_exists('wp_body_open')) {
            wp_body_open();
        }
        ?> 

            <header class="header">
                <div class="container">
                    <!-- header logo -->
                    <div class="header-logo">
                    <?php if(function_exists('the_custom_logo')): ?> 
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php
                                    $custom_logo_id = get_theme_mod('custom_logo');
                                    
                                    $image = wp_get_attachment_image_src($custom_logo_id , 'full');
                                    if(!empty($image)): 
                                ?>

                                <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" width="122" height="72">

                                    <?php endif; ?>
                            </a>
                        <?php else: ?>
                            <div class="site-title">
                                <h1 class="site-title-heading">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                </h1>
                                <div class="site-description">
                                    <small>
                                        <?php bloginfo('description'); ?> 
                                    </small>
                                </div>
                            </div><!--.site-branding-->
                        <?php endif; ?>
                    </div>
                    <!--/ header logo -->

                    <!-- Burger Menu -->
                    <div class="menu-burger">
                        <div class="hamburger"> 
                            <span class="line"></span> 
                            <span class="line"></span> 
                            <span class="line"></span>
                        </div>
                    </div>

                    <!-- wrap menu -->
                    <div class="wrap-menu">
                        <!-- header menu -->
                        <div class="header-menu">
                            <?php if (has_nav_menu('primary')) { ?> 
                                <?php
                                    wp_nav_menu(
                                        // array(
                                        //     'depth' => '4',
                                        //     'theme_location' => 'primary',
                                        //     'container' => false,
                                        //     'walker' => new BootstrapBasic4WalkerNavMenu_custom()
                                        // )
                                        array(
                                            'theme_location' => 'primary', 
                                            'container' => false,
                                            'menu_class'=> 'menu menu-principal',
                                        )
                                    );
                                ?>
                            <?php } ?>
                        </div>
                        <!--/ header menu -->

                        <!-- header formsearch -->
                        <div class="header-search">
                            <?php echo get_form_search_global(); ?>
                        </div>
                        <!--/ header formsearch -->

                        <!-- header btn -->
                        <?php $user = wp_get_current_user(); ?>
                        <div class="header-auth">
                            <div class="header-auth-wrapper">
                                <?php if($user->ID == 0): ?> 
                                <div class="header-auth-item header-registration">
                                    <a class="auth-btn registration" href="<?php echo bloginfo('url') ?>/inscription">S'inscrire</a>
                                </div>
                                <?php endif; ?>
                                <div class="header-auth-item header-login">
                                    <?php if($user->ID == 0): ?> 
                                        <a class="auth-btn login"  href="<?php echo bloginfo('url') ?>/connexion">Se connecter</a>
                                    <?php else: ?>   
                                        <ul class="logged-in">
                                            <li>
                                                <a class="logged-in-btn"  href="#"><i class="bi bi-person"></i><?php echo $user->user_login ?></a>
                                                <ul class="logged-in-submenu">
                                                    <li>
                                                        <div class="user-infos">
                                                            <div class="user-infos-sigle">
                                                                <div class="sigle">
                                                                    <?php echo substr($user->first_name, 0, 1);  ?>
                                                                    <?php echo substr($user->last_name, 0, 1);  ?>
                                                                </div>
                                                            </div>
                                                            <div class="user-infos-txt">
                                                                <div class="user-infos-name">
                                                                    <span class="last-name"><?php echo $user->first_name ?></span>
                                                                    <span class="first-name"><?php echo $user->last_name ?></span> 
                                                                </div>
                                                                <div class="user-infos-mail"><?php echo $user->user_email; ?></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li><a  href="<?php echo site_url().'/profil' ?>">Mon profil</a></li>
                                                    <li><a  href="<?php echo site_url().'/mes-sujets' ?>">Mes sujets</a></li>
                                                    <li><a  href="<?php echo wp_logout_url( home_url() ); ?>">Se deconnecter</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    <?php endif; ?> 
                                </div>
                            </div>           
                        </div>
                        <!--/ header btn -->
                    </div>

                </div>
            </header>


