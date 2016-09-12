#yumパッケージを全てアップデート
sudo yum -y update

# Apacheをインストール
sudo yum -y install httpd —noplugins

# httpdの自動起動設定
sudo chkconfig httpd on

###PHP5.5をインストール############################################################
sudo yum -y remove php*
sudo yum -y install http://pkgs.repoforge.org/rpmforge-release/rpmforge-release-0.5.3-1.el6.rf.x86_64.rpm
sudo sed -i -e "s/enabled = 1/enabled = 0/g" /etc/yum.repos.d/rpmforge.repo
sudo rpm -Uvh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm
sudo sed -i -e "s/enabled = 1/enabled = 0/g" /etc/yum.repos.d/epel.repo
sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
sudo sed -i -e "s/enabled = 1/enabled = 0/g" /etc/yum.repos.d/remi.repo
sudo yum -y update --enablerepo=rpmforge,epel,remi,remi-php55
sudo yum -y install --enablerepo=remi,remi-php55 php php-opcache php-devel php-mbstring php-mcrypt php-mysql php-sudo phpunit-PHPUnit php-pecl-xdebug php-cli php-common

#####php.ini設定
sudo cp /etc/php.ini /etc/php.ini.bk
sudo sed -i "s|^;date.timezone =|date.timezone = Asia/Tokyo|" /etc/php.ini

###MySQL5.6をインストール########################################################################
sudo yum -y remove mysql*
sudo yum -y install http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm
sudo yum -y install mysql mysql-devel mysql-server mysql-utilities
sudo rpm -qa | grep mysql
sudo service mysqld start
sudo chkconfig mysqld on

#初期パスワードセット root に
/usr/bin/mysqladmin -u root password "root"

#確認。下記でpasswordにrootと入力してログインできたら成功
# mysql -u root -p

# apacheの再起動
sudo /etc/rc.d/init.d/httpd restart
