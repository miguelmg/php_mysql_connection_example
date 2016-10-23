CREATE TABLE `Product` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `quantity` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO Product (name, quantity) VALUES ('Book', 10);
INSERT INTO Product (name, quantity) VALUES ('Pencil', 30);
INSERT INTO Product (name, quantity) VALUES ('Computer', 5);