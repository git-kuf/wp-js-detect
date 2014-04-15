#!/usr/bin/expect

# Installing PHP Pear without user prompt
spawn wget -O /tmp/go-pear.phar http://pear.php.net/go-pear.phar
expect eof

spawn php /tmp/go-pear.phar

expect "1-11, 'all' or Enter to continue:"
send "\r"
expect eof

spawn rm /tmp/go-pear.phar

#!/usr/bin/env bash

if [ $# -lt 3 ]; then
	echo "usage: $0 <db-name> <db-user> <db-pass> [db-host] [wp-version]"
	exit 1
fi

DB_NAME=$1
DB_USER=$2
DB_PASS=$3
DB_HOST=${4-localhost}
WP_VERSION=${5-master}

WP_TESTS_DIR=${WP_TESTS_DIR-/tmp/wordpress-tests-lib}
WP_CORE_DIR=/tmp/wordpress/

set -ex

install_wp() {
	mkdir -p $WP_CORE_DIR

	if [ $WP_VERSION == 'latest' ]; then 
		local ARCHIVE_NAME='latest'
	else
		local ARCHIVE_NAME="wordpress-$WP_VERSION"
	fi

	wget -nv -O /tmp/wordpress.tar.gz http://wordpress.org/${ARCHIVE_NAME}.tar.gz
	tar --strip-components=1 -zxmf /tmp/wordpress.tar.gz -C $WP_CORE_DIR

	wget -nv -O $WP_CORE_DIR/wp-content/db.php https://raw.github.com/markoheijnen/wp-mysqli/master/db.php
}

install_test_suite() {
	# portable in-place argument for both GNU sed and Mac OSX sed
	if [[ $(uname -s) == 'Darwin' ]]; then
		local ioption='-i ""'
	else
		local ioption='-i'
	fi

	# set up testing suite
	mkdir -p $WP_TESTS_DIR
	cd $WP_TESTS_DIR
	svn co --quiet http://develop.svn.wordpress.org/trunk/tests/phpunit/includes/

	wget -nv -O wp-tests-config.php http://develop.svn.wordpress.org/trunk/wp-tests-config-sample.php
	sed $ioption "s:dirname( __FILE__ ) . '/src/':'$WP_CORE_DIR':" wp-tests-config.php
	sed $ioption "s/youremptytestdbnamehere/$DB_NAME/" wp-tests-config.php
	sed $ioption "s/yourusernamehere/$DB_USER/" wp-tests-config.php
	sed $ioption "s/yourpasswordhere/$DB_PASS/" wp-tests-config.php
	sed $ioption "s|localhost|${DB_HOST}|" wp-tests-config.php
}

install_db() {
	# parse DB_HOST for port or socket references
	local PARTS=(${DB_HOST//\:/ })
	local DB_HOSTNAME=${PARTS[0]};
	local DB_SOCK_OR_PORT=${PARTS[1]};
	local EXTRA=""

	if ! [ -z $DB_HOSTNAME ] ; then
		if [[ "$DB_SOCK_OR_PORT" =~ ^[0-9]+$ ]] ; then
			EXTRA=" --host=$DB_HOSTNAME --port=$DB_SOCK_OR_PORT --protocol=tcp"
		elif ! [ -z $DB_SOCK_OR_PORT ] ; then
			EXTRA=" --socket=$DB_SOCK_OR_PORT"
		elif ! [ -z $DB_HOSTNAME ] ; then
			EXTRA=" --host=$DB_HOSTNAME --protocol=tcp"
		fi
	fi

	# create database
	mysqladmin create $DB_NAME --user="$DB_USER" --password="$DB_PASS"$EXTRA
}

php_tools() {


	## PHP_CodeSniffer
		sudo pear install PHP_CodeSniffer
		phpenv rehash
		git clone git://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards.git

	## PHP Copy/Paste Detector
		curl -o phpcpd.phar https://phar.phpunit.de/phpcpd.phar
        
	## PHP Mess Detector
        #Installing as a PEAR package
		pear config-set preferred_state beta
		printf "\n" | pecl install imagick
		pear channel-discover pear.phpmd.org
		pear channel-discover pear.pdepend.org
		pear install --alldeps phpmd/PHP_PMD
		phpenv rehash
        
        # From the github repository
        #git clone git://github.com/phpmd/phpmd.git
        #cd phpmd
        #git submodule update --init
        #ant initialize
        #cd ..
        
	## PHPLOC
		curl -o phploc.phar https://phar.phpunit.de/phploc.phar

    ## PHP_CodeSniffer
    	#phpcs --standard=PSR1 .
    	#phpcs --standard=PSR2 .
		phpcs --standard=WordPress-Coding-Standards .

    ## PHP Copy/Paste Detector
    	php phpcpd.phar --verbose .
    ## PHP Mess Detector
    	phpmd . text cleancode --exclude lightopenid
        phpmd . text codesize --exclude lightopenid
    	phpmd . text controversial --exclude lightopenid
    	phpmd . text design --exclude lightopenid
    	phpmd . text naming --exclude lightopenid
    	phpmd . text unusedcode --exclude lightopenid
    ## PHPLOC
    	php phploc.phar .
}

install_wp
install_test_suite
install_db
#php_tools