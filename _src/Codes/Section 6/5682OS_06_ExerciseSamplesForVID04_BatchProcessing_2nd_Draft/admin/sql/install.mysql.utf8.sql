INSERT INTO `#__categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`, `version`) VALUES
(NULL, 106, 1, 35, 36, 1, 'desserts', 'com_goodcook', 'Desserts', 'desserts', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 43, '2013-01-27 16:44:05', 0, '0000-00-00 00:00:00', 0, '*', 1),
(NULL, 107, 1, 37, 38, 1, 'entrees', 'com_goodcook', 'Entrees', 'entrees', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 43, '2013-01-27 16:44:15', 0, '0000-00-00 00:00:00', 0, '*', 1);

CREATE TABLE IF NOT EXISTS `#__goodcook_recipes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `recipe` text NOT NULL,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `alias` varchar(255) DEFAULT NULL,
  `metadesc` varchar(1024) DEFAULT NULL,
  `metakey` varchar(1024) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL,
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

INSERT INTO `#__goodcook_recipes` (`id`, `title`, `alias`, `recipe`, `catid`, `created`, `created_by`, `metadesc`, `metakey`) VALUES
(NULL, 'Chocolate Sauce', 'chocolate-sauce', '<p>1/2 cup cocoa powder<br />1 1/2 cups sugar<br />1 cup water<br />1 teaspoon vanilla extract<br /><br />Combine cocoa, sugar and water in a pan and heat gently while stirring until it begins to boil. Cook for about a minute. Turn off heat and add vanilla. Stir until thoroughly mixed and sauce is smooth.</p>', (SELECT id FROM #__categories WHERE extension = 'com_goodcook' and title = 'Desserts' LIMIT 1), '2013-01-01 00:00:00', (SELECT id FROM #__users LIMIT 1), 'An easy recipe for chocolate sauce', 'chocolate,sauce,recipe,easy,dessert'),
(NULL, 'Easy Falafel', 'easy-falafel', '<p>1 box Falafel Mix<br />1 cup water<br />Cooking oil<br /><br />Stir together Falafel Mix and water until all of the powder has been moistened with water. Let sit for a minute until it is dry enough to handle. Shape into balls or patties. Heat cooking oil in a skillet. Fry the Falafel until golden brown. Serve on a sandwich, over a salad or as an entree.</p>', (SELECT id FROM #__categories WHERE extension = 'com_goodcook' and title = 'Entrees' LIMIT 1), '2013-01-01 00:00:00', (SELECT id FROM #__users LIMIT 1), 'An easy recipe for Falafel', 'falafel,recipe,dinner,entree');