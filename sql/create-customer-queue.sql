CREATE TABLE {prefix}sws_customer_queue (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  firstname varchar(32) NOT NULL DEFAULT '',
  lastname varchar(32) NOT NULL DEFAULT '',
  email varchar(96) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  phone varchar(24) NOT NULL DEFAULT '',
  company varchar(100) NOT NULL DEFAULT '',
  marketing enum('yes','no') NOT NULL DEFAULT 'no',
  sameshipaddress enum('yes','no') NOT NULL DEFAULT 'no',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  role varchar(64),
  type varchar(64),
  PRIMARY KEY (id)
) 