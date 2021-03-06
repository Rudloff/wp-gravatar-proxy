<?php
/**
 * Gravatar Proxy
 * Base plugin file
 *
 * PHP version 5.4
 *
 * @category Plugin
 * @package  Gravatar_Proxy
 * @author   Pierre Rudloff <contact@rudloff.pro>
 * @license  GPL http://www.gnu.org/licenses/gpl.html
 * @link     https://rudloff.pro/
 */
/*
Plugin Name: Gravatar Proxy
Plugin URI: https://github.com/Rudloff/wp-gravatar-proxy
Description: This plugin replaces Gravatar URLs with a local proxy.
It helps mitigating Gravatar privacy risks
by hiding your users IP addresses to Gravatar.
Author: Pierre Rudloff
Version: 0.1
Author URI: https://rudloff.pro/
*/

/**
 * Replace Gravatar URL with proxy URL
 *
 * @param string $avatar Avatar img tag
 *
 * @return string Avatar img tag
 * */
function replaceAvatar($avatar)
{
    preg_match(
        '#(https?:\/\/secure|https?:\/\/www|https?:\/\/0|https?:\/\/1|https?:\/\/2)\.gravatar\.com\/avatar\/'.
        '([\w+]?[\?[\w|=]+]?)#',
        $avatar,
        $matches
    );
    return str_replace(
        $matches[0],
        plugin_dir_url(__FILE__).
            'proxy.php?query='.urlencode($matches[2]),
        $avatar
    );
}

/**
 * Don't run on the admin options-discussion page
 */
preg_match('/[\w\-]+.php/', $_SERVER["SCRIPT_FILENAME"], $match);
$curpage = array_shift($match);
if ($curpage !== 'options-discussion.php') {
    add_filter('get_avatar', 'replaceAvatar', 10, 5);
}
