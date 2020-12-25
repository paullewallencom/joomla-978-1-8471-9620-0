CREATE TABLE IF NOT EXISTS `#__goodcook_recipes` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(250) NOT NULL DEFAULT '',
    `recipe` text NOT NULL,
    PRIMARY KEY (`id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT IGNORE INTO `#__goodcook_recipes` (`id`,`title`,`recipe`) VALUES
	(1, 'Chocolate Sauce', '1/2 cup cocoa powder<br />1 1/2 cups sugar<br />1 cup water<br />1 teaspoon vanilla extract<br /><br />Combine cocoa, sugar and water in a pan and heat gently while stirring until it begins to boil.  Cook for about a minute.  Turn off heat and add vanilla.  Stir until thoroughly mixed and sauce is smooth.'),
	(2, 'Easy Falafel', '1 box Falafel Mix<br />1 cup water<br />Cooking oil<br /><br />Stir together Falafel Mix and water until all of the powder has been moistened with water.  Let sit for a minute until it is dry enough to handle.  Shape into balls or patties.  Heat cooking oil in a skillet.  Fry the Falafel until golden brown.  Serve on a sandwich, over a salad or as an entree.');