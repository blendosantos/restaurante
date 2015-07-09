use plusv789_easy_dev;
ALTER TABLE empresas ADD formaPagamento varchar(2);
ALTER TABLE `empresas` CHANGE `diaPagamento` `diaPagamento` DATE NULL DEFAULT NULL;
