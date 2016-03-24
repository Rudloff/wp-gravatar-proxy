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
header('Content-type: image/png');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://secure.gravatar.com/avatar/'.$_GET['query']);
curl_exec($ch);
curl_close($ch);
