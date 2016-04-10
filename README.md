# ParseSQL
This library parse multiple query of MySQLDump output file. mysqli can not execute all query when it containing:

* procedure
* functions
* trigger

ParseSQL designed to parse multiple query and ready to be executed using mysql_query. This library is usefull to create database structure or restore database from sql file.