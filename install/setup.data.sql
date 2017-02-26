
--
-- Структура таблицы `{PREFIX}desire`
--

CREATE TABLE IF NOT EXISTS `{PREFIX}desire` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL DEFAULT '0',
  `items` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;