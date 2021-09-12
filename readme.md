# SQL 101

## PDO

Stands for PHP Data Object and is used to build a connection with databases.

Three of the most important classes are:
    - PDO, to build a connection to a database, to send SQL commandos and stop the connection.
    - PDOStatement to access results of an object
    - PDOException - for errors caused from PDO

### Create a connection to a database

PDO needs to be instantiated. The constructor needs specific parameters to create a connection.

1. Data source
2. Username
3. Password (we'll use root as username and leave password empty)
4. more optional parameters

The syntax looks like this:

public PDO::__constructor(string $dsn[,string $username[, string $password[,array $options]]]);

View file createconnection.php

When a connection is created you should make sure if the connection was successful. If something wend wrong there will be an 'exeption', if the exeption is not catched there will be an error when running the program.
To avoid a long fatal error message you can first 'try' to build a connection and in case of an exception 'catch' it.
die() is used to output the message and then end the program exit() can be used as well.

Especially during the development phase it might be useful to get more information about the error. By using a method of the object $e you can get a bit more information about the error.
With print_r you can output the whole $e object

view file pdoexception.php

### Send query

Sending a query is possible after the PDO object was successfully instantiated.
SQL statements can be sent ti ab rdbms with the method query()

formal syntax looks like this:
    public PDOStatement PDO::query(string $statement);
If it was unsuccessful it will return false. If it was successful it will return an object from type PDOStatement.

View file sendquery.php

