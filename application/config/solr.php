<?php

//trong file nay co nhieu gia tri khong can thiet
/* Domain name of the Solr server */
//define('SOLR_SERVER_HOSTNAME', '10.8.36.48');
$config['solr']['SOLR_SERVER_HOSTNAME'] = '10.8.36.48';//omga.vn: 10.10.20.121 //local: 203.162.79.102
/* Whether or not to run in secure mode */
//define('SOLR_SECURE', true);

/* HTTP Port to connection */
$config['solr']['SOLR_SERVER_PORT'] = '8983';
//define('SOLR_SERVER_PORT', 8983);

/* HTTP Basic Authentication Username */
$config['solr']['SOLR_SERVER_USERNAME'] = '';
//define('SOLR_SERVER_USERNAME', '');

/* HTTP Basic Authentication password */
$config['solr']['SOLR_SERVER_PASSWORD'] = '';
//define('SOLR_SERVER_PASSWORD', '');

/* HTTP connection timeout */
/* This is maximum time in seconds allowed for the http data transfer operation. Default value is 30 seconds */
$config['solr']['SOLR_SERVER_TIMEOUT'] = 10;
//define('SOLR_SERVER_TIMEOUT', 10);

/* File name to a PEM-formatted private key + private certificate (concatenated in that order) */
$config['solr']['SOLR_SSL_CERT'] = 'certs/combo.pe';
//define('SOLR_SSL_CERT', 'certs/combo.pem');

/* File name to a PEM-formatted private certificate only */
$config['solr']['SOLR_SSL_CERT_ONLY'] = 'certs/solr.crt';
//define('SOLR_SSL_CERT_ONLY', 'certs/solr.crt');

/* File name to a PEM-formatted private key */
$config['solr']['SOLR_SSL_KEY'] = 'certs/solr.key';
//define('SOLR_SSL_KEY', 'certs/solr.key');

/* Password for PEM-formatted private key file */
$config['solr']['SOLR_SSL_KEYPASSWORD'] = 'StrongAndSecurePassword';
//define('SOLR_SSL_KEYPASSWORD', 'StrongAndSecurePassword');

/* Name of file holding one or more CA certificates to verify peer with */
$config['solr']['SOLR_SSL_CAINFO'] = 'certs/cacert.crt';
//define('SOLR_SSL_CAINFO', 'certs/cacert.crt');

/* Name of directory holding multiple CA certificates to verify peer with */
$config['solr']['SOLR_SSL_CAPATH'] = 'certs/';
$config['solr']['SOLR_SERVER_PATH'] = 'solr/news';
//define('SOLR_SSL_CAPATH', 'certs/');
//define('SOLR_SERVER_PATH', 'solr/news');
?>