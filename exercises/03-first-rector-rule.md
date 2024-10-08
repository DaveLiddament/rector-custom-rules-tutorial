# First rector rule

## Demo

We are going to write our first rector rule. It is going to rename the function calls from `sayHello` to `greet`.

Let's use rector to create a new custom rule:

```shell
vendor/bin/rector custom-rule 
```

We will give it the name: `UpdateSayHelloToGreetRector`

Rector has done a few things:

- Created an empty rule
- Created tests for the new rule

If it is the first time this has been run:

- Updated `composer.json`
- Updated `phpunit.xml`

Don't forget to run:

```shell
composer du
```

## Create the rule

Rector rule has 2 methods to populate.

#### getNodeTypes

Return the nodes we are interested in modifying. Use the AST tools to help us find this.

`Node\Expr\FuncCall::class`

#### refactor

```php
        $node->name = new Name('welcome');
        return $node;
```

Update the `rector.php` config to run in `Exercise03`

Run:

```shell
vendor/bin/rector --dry-run
```

### Any thoughts?

- What about other function calls?
- Update `welcome.php` to include another function call.
- Add this to the start of the `refactor` method.

```php
        if (! $this->isName($node, 'sayHello')) {
            return null;
        }
```

# Your turn

## Update echo message

We want to update:
```php
echo 'I hate rector';
```
To: 
```php
echo 'I love rector';
```

NOTE: All other echo statements should remain unaltered.

Hints:

1. Create a code snippet in the `Exercise03` folder
2. Create the rule using `vendor/bin/rector custom-rule`
3. Use the AST visualisation tool of your choice to:
    - Identify the node type for `echo`
    - Find the corresponding class in PHP Parser library
    - Update the `return` statement in `getNodeTypes` 
4. First see if you can alter all the echo statements. The `--dry-run` flag is your friend.
5. Now only update the echo statements that would print `I hate rector`


## Update post increment to pre increment

Go from:
```php
$count++;
```

To:
```php
++$count;
```

Follow the steps we've done in previous examples. 

## Make sure in_array uses strict comparison 

To make sure `in_array` does a strict comparison (both type and value must be equal), the third parameter must be true. 
See the [PHP docs](https://www.php.net/manual/en/function.in-array.php).

Update any of the following:
```php
in_array($a, $b);
in_array($a, $b, false);
```

To:
```php
in_array($a, $b, true);
```

TIP: When creating a new node try using the relevant method on `$this->nodeFactory`.

