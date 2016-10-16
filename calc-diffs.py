#!/usr/bin/env python
import os
import re
import sys

os.system('dpkg --get-selections > tmp.txt');

ds = os.sep;

dir_path = os.path.dirname(os.path.realpath(__file__));
file_with_list_of_base_packages = \
    dir_path + ds + 'data' + ds + 'installed-packages-in-vanilla-mint-18-64bits.txt';

list_of_installed_packages = open('tmp.txt').readlines();
list_of_base_packages = open(file_with_list_of_base_packages).readlines();

num_non_base_packages = 0;

for installed_package in list_of_installed_packages:

    if installed_package not in list_of_base_packages:
        # clean up the line before printing it out
        output = re.sub('[\t]*(install|deinstall)', '', installed_package.strip(os.linesep));
        num_non_base_packages += 1;
        print output;

print os.linesep \
        + 'There were ' \
        + str(num_non_base_packages) \
        + ' non-base packages.' \
        + os.linesep;

os.system('rm tmp.txt');
