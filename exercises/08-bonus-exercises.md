# Bonus exercises

## Update the 2 rules created in exercise 5

- Update the first rule (`UpdateDogMakeNoiseToBarkRector`) we created together to also update the method name on the class
- Update the second rule (`LookkupServiceAddDefaultRector`) to modify the method signature to add the parameter `mixed $default`

TIP: Remember `getNodeTypes` can return multiple nodes.


## Update the rule in exercise 6 so that it also updates the method name

Often we want rules to do multiple things. The rule we have created updates does half the job.
Update it, so it updates the method name, as well as the calls to that method.

E.g. Before
```php
class Car {
    public function getEngine(): int 
    {
        // implementation
    }
}
```

After:
```php
class Car {
    public function getEngineSize(): int 
    {
        // implementation
    }
}
```