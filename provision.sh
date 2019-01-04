#!/bin/sh

echo ------------------------------
echo START!
echo ------------------------------

echo ------------------------------
echo Timezone
echo ------------------------------
date
sudo timedatectl set-timezone Asia/Tokyo
date
echo Timezone_changed.

echo ------------------------------
echo httpd/unzip install
echo ------------------------------
sudo yum install -y httpd
systemctl restart httpd.service
sudo yum install -y unzip

echo ------------------------------
echo epel/remi install
echo ------------------------------
sudo yum install -y epel-release
sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

echo ------------------------------
echo PHP install
echo ------------------------------
sudo yum install -y --disablerepo=* --enablerepo=epel,remi,remi-php73 php php-pdo php-mysql, php-mysqlnd php-mbstring php-xml

echo ------------------------------
echo Composer/Laravel install
echo ------------------------------
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer global require "laravel/installer=~1.1"

echo ------------------------------
echo MySQL install
echo ------------------------------
sudo yum -y localinstall http://dev.mysql.com/get/mysql57-community-release-el7-7.noarch.rpm
sudo yum -y install mysql mysql-devel mysql-server mysql-utilities
systemctl start mysqld.service
systemctl enable mysqld.service

echo ------------------------------
echo MySQL setting
echo ------------------------------
password=`cat /var/log/mysqld.log | grep "A temporary password" | tr ' ' '\n' | tail -n1`
mysql -u root -p${password} --connect-expired-password < /vagrant/provisioner.sql
sudo sh -c "echo 'binding-address=0.0.0.0' >> /etc/my.cnf"

echo ------------------------------
echo gitignore
echo ------------------------------
{
echo " "
echo /.vagrant
echo /.idea
echo *.iml
echo .env*
}  >> /vagrant/.gitignore

echo ------------------------------
echo END!
echo ------------------------------
