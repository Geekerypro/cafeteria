/*Consultar productos con mayor stock*/
select * from productos where stock = (select max(stock) from productos);

/*Consultar el producto mas vendido*/
/*Esta consulta Falto*/