<?php
/**
 * Gravatar Proxy
 * The proxy itself
 *
 * PHP version 5.4
 *
 * @category Plugin
 * @package  Gravatar_Proxy
 * @author   Pierre Rudloff <contact@rudloff.pro>
 * @license  GPL http://www.gnu.org/licenses/gpl.html
 * @link     https://rudloff.pro/
 */

require_once __DIR__.'/vendor/autoload.php';

$cache = new Gilbitron\Util\SimpleCache();

$cache->cache_path = __DIR__.'/../../cache/wp-gravatar-proxy/';

header('Content-type: image/png');
echo $cache->get_data($_GET['query'], 'https://secure.gravatar.com/avatar/'.$_GET['query']);
?>
