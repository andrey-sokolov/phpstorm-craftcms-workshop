# phpstorm-craftcms-workshop
**PhpStorm Craft CMS workshop**

This is a container with php apache mysql server with craft installation.  

*Getting started*
To run docker container with perform these steps:
1. Run docker-compose up in root folder
2. go to http://localhost:8081/craft/web/index.php?p=admin and  start installation process

To work with Plugin files - install dependencies from composer.json to get code assistance from Craft libraries



*Language syntax*
```
<file> ::= statementList
<statementList> ::= <statement> | <statementList>
<statement> ::= <echoStatement> | <assignmentStatement>
<echoStatement> ::= "echo " <expression>
<assignmentStatement> ::= <variable> "=" <expression>
<expression> ::= <scalarExpression> | <binaryExpression>
<binaryExpression> ::= <scalarExpression> ("+" | "-" | "/" | "*") (<scalarExpression> | <binaryExpression>)
<scalarExpression> ::= <number> | <identifier>
<number> ::= ["-"]digit+
```
