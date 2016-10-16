#!/usr/bin/env php
<?php
shell_exec('dpkg --get-selections > tmp.txt');

$ds = DIRECTORY_SEPARATOR;
$file_with_list_of_base_packages =
    __DIR__.$ds.'data'.$ds.'installed-packages-in-vanilla-mint-18-64bits.txt';

$list_of_installed_packages = file('tmp.txt');
$list_of_base_packages = file($file_with_list_of_base_packages);

$num_non_base_packages = 0;
foreach($list_of_installed_packages as $installed_package) {
    
    if( !in_array($installed_package, $list_of_base_packages) ) {
        
        //$output = trim($installed_package, PHP_EOL);
        $output = preg_replace('/[\t]*(install|deinstall)/i', '', trim($installed_package, PHP_EOL));
        echo($output.PHP_EOL);
        $num_non_base_packages++;
    }
}

echo 'There were '.$num_non_base_packages.' non-base packages'.PHP_EOL;

shell_exec('rm tmp.txt');

