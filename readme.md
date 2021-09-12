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