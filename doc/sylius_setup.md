Manual sylius install:

# cd /home/vagrant/
# composer create-project --no-interaction -s beta sylius/sylius-standard sylius
# sudo chown -R www-data:vagrant sylius
# sudo chmod -R 775 sylius
# mysql -u root --port=3306 -proot -t <<EOF
# SHOW DATABASES;
# CREATE DATABASE sylius;
# SHOW DATABASES;
# EOF
# mysqladmin -u root --port=3306 -proot reload
# echo "<VirtualHost *:80>
#      ServerAdmin eligijus.stugys@gmail.com
#      ServerName sylius.vagrant.test1.dev
#      ServerAlias www.sylius.vagrant.test1.dev
# 
#      DocumentRoot /home/vagrant/sylius/web
#      <Directory /home/vagrant/sylius/web>
#           AllowOverride All
#           Require all granted
#      </Directory>
# 
#      ErrorLog /home/vagrant/sylius/logs/error.log
#      CustomLog /home/vagrant/sylius/logs/access.log combined
# </VirtualHost>
# " | sudo tee /etc/apache2/sites-available/sylius.vagrant.test1.dev.conf
# sudo a2ensite sylius.vagrant.test1.dev.conf
# echo "date.timezone = Europe/Vilnius" | sudo tee -a /etc/php/7.1/cli/php.ini
# echo "date.timezone = Europe/Vilnius" | sudo tee -a /etc/php/7.1/apache2/php.ini
# sudo service apache2 stop
# sudo service apache2 start
# echo "parameters:
#     database_driver: pdo_mysql
#     database_host: 127.0.0.1
#     database_port: 3306
#     database_name: sylius
#     database_user: root
#     database_password: root
#     mailer_transport: smtp
#     mailer_host: 127.0.0.1
#     mailer_user: null
#     mailer_password: null
#     secret: EDITME
#     locale: en_US
# " | tee /home/vagrant/sylius/app/config/parameters.yml
# cd /home/vagrant/sylius/
# npm install
# npm run gulp
# php bin/console sylius:install:check-requirements
# cd /home/vagrant/sylius/
# php bin/console sylius:install -n
# cd /home/vagrant/
# sudo chown -R www-data:vagrant sylius
# sudo chmod -R 775 sylius
# http://sylius.vagrant.test1.dev/app_dev.php
# echo "------------------------------ END Sylius install --------------"

