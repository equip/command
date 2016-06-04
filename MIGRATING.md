Migrating
=========

Use this document to help you transition away from deprecated code.

## Switching from AbstractCommand to Command

Version 1.3.0 introduces a new `Command` class that replaces `AbstractCommand`.
It also introduces a new, immutable `Options` class that is used to hold options
for commands.

### Updating Commands

Commands that used to be defined as:

```php
use Equip\Command\AbstractCommand;

class LoginCommand extends AbstractCommand
{
    // ...
}
```

Should now be defined as:

```php
use Equip\Command\Command;

class LoginCommand extends Command
{
    // ...
}
```

This will also require modification in how commands use options internally.
Previously the `execute()` method would access options as an array:

```php
public function execute()
{
    $options = $this->options();

    $this->checkCredentials($options['email'], $options['password']);

    // ...
}
```

Instead, the options will now be a read-only object:

```
public function execute()
{
    $options = $this->options();

    $this->checkCredentials($options->email, $options->password);

    // ...
}
```

Any attempt to modify the options will throw an `ImmutableException`.

### Creating Options

Command options are now defined as separate classes. These classes must extend
the `Options` class:

```php
use Equip\Command\Options;

final class LoginOptions extends Options
{
    protected $email;
    protected $password;
    protected $remember = false;

    /**
     * @inheritdoc
     */
    public function required()
    {
        return [
            'email',
            'password',
        ];
    }
}
```

All valid options are defined as `protected` class properties. Optional properties
can have default values.

### Using Commands

Where calling code would previously be:

```php
$command = $command->withOptions([
    'email' => 'user@example.net',
    'password' => 'very-secret',
]);
```

The new options class must be used instead:

```php
$options = new LoginOptions([
    'email' => 'user@example.com',
    'password' => 'very-secret',
]);
$command = $command->withOptions($options);
