CREATE TABLE IF NOT EXISTS `adm_login` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
`pass` varchar(64) NOT NULL,
 PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
