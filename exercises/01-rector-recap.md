# Rector recap

Aims of this exercise:

- Remind how to configure rector to run rules
- How to search for rules that might already exist; this saves us having to create our own rules.


## Demo

### Create config file

We'll create a rector config file and run a single rule for [property promotion](https://getrector.com/rule-detail/class-property-assign-to-constructor-promotion-rector)

First we'll run rector:

```shell
vendor/bin/rector
```

If there is no rector config file then you'll see something like this. Allow rector to create the config file.

```shell
 No "rector.php" config found. Should we generate it for you? [yes]:
 > yes
```

We are going to update the config file with the following:

1. Only look at `src/Exercise01`
2. Configure with rule `ClassPropertyAssignToConstructorPromotionRector`

Config will look something like this:

```php
return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src/Exercise01',
    ])
    ->withConfiguredRule(
        ClassPropertyAssignToConstructorPromotionRector::class,
        []
    );
```

### Run rule

Firstly, I'd recommend running command as a dry run:

```shell
vendor/bin/rector --dry-run
```

Check we are happy. Now run for real.

## Your turn

It is important to see if a rule already exists, before creating your own. 
This introduces us to the rector search function. 

### 1. Remove unreachable code

Use Rector's [rule search](https://getrector.com/find-rule) to find the rule that removes unreachable code in [Exercise01/UnreachableCode](../src/Exercise01/UnreachableCode.php).

Update the rector config file to run this rule. 

Run the rector in dry run mode first to make sure it does the correct thing. 

Finally run the rule for real. NOTE: We are only running the rule on the `src\Exercise01` folder.


### 2. Find a rule that adds void 

Use Rector's [rule search](https://getrector.com/find-rule) to find the rule that adds the missing `void` return type in [Exercise01/MissingVoid](../src/Exercise01/MissingVoid.php).

As before update the rector config file, use dry run before actually making the update.

