#!/bin/bash

mkdir -p config/kissorm;
cp -rp ./vendor/levitarmouse/kiss_orm/scripts/post_install.sh ./kissorm_post_install.sh;
chmod 0775 ./config/kissorm/kissorm_post_install.sh;
./kissorm_post_install.sh;