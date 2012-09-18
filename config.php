<?php
error_reporting(1);
ini_set('display_errors','On');
$config['atk']['base_path']='./atk4/';
$config['dsn']='mysql://root:@localhost/fbwallmessage';

$config['url_postfix']='';
$config['url_prefix']='?page=';

# Facebook Wall Message Sender Application Configuration
$config['appId']	='325002274262209';
$config['secret']	='464fd58d412a67711a202a2324c790b9';



# Agile Toolkit attempts to use as many default values for config file,
# and you only need to add them here if you wish to re-define default
# values. For more options look at:
#
#  http://www.atk4.com/doc/config

?>