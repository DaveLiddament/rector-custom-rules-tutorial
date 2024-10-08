# AST

Aims of this exercise is to learn how to identify the type of AST node that we might want to manipulate. 

## Demo

There are a number of tools that can be used:

- CLI: Using `php-parse`
- Online tools
  - [Rector AST analyser](https://getrector.com/ast)
  - [PHP AST Analyser](https://phpast.com/)
  - [PHP AST Viewer](https://php-ast-viewer.com/)

## What type of node is use for function calls?

Run `vendor/bin/php-parse -d src/Exercise02/function-call.php`

Look at the output. What is the type of the AST node that represents a function call?

Now find that class that represents this node in the [PHP Parser library](https://github.com/nikic/PHP-Parser/tree/master/lib/PhpParser/Node)


# Your turn

## 1. What is the AST node that represents a method call?

Use the file [Exercise02/method-call.php](../src/Exercise02/method-call.php)

Find the class that represents the node.

## 2. What is the AST node that represents the increment operator (`++`)?

If you want to use `php-parse` create snippets of code in the [scratch](../scratch) directory. 
Code in here is ignored by git.

Find the class that represents the node.

## 3. Experiment with other snippets of code

Try snippets of code. Work out the nodes. Look at corresponding class in the PHP Parser library.