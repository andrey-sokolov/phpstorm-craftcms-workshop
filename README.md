# phpstorm-craftcms-workshop
**PhpStorm Craft CMS workshop**

This is a container with php apache mysql server with craft installation.  

*Getting started*
To run docker container with perform these steps:
1. Run docker-compose up in root folder
2. go to http://localhost:8081/craft/web/index.php?p=admin and  start installation process

To work with Plugin files - install dependencies from composer.json to get code assistance from Craft libraries

*Debug*
Update `XDEBUG_CONFIG` variable in `docker-compose.yml` with your IP address. That is necessary for Web Debugging.
To get the right IP address that is available from Docker please use one of the following command:
    
* Windows:  execute `ipconfig` and copy ip from `DockerNAT` interface from `IPv4 Address` field
* macOS: execute `ifconfig en0` and copy IP from `inet` field
* Linux: execute `ifconfig docker0` and copy ip from `inet addr` field



*Language syntax*
```
<file> ::= <statementList>
<statementList> ::= <statement> | <statement><statementList>
<statement> ::= <echoStatement> | <assignmentStatement>
<echoStatement> ::= "echo" <expression>
<assignmentStatement> ::= <variable> "=" <expression>
<expression> ::= <scalarExpression> | <binaryExpression>
<binaryExpression> ::= <scalarExpression> ("+" | "-" | "/" | "*") (<scalarExpression> | <binaryExpression>)
<scalarExpression> ::= <number> | <identifier>
<number> ::= ["-"]digit+
```
