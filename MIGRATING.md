Migrating
=========

Use this document to help you transition away from deprecated code.

## Switching from AbstractCommand to CommandInterface

Version 2.0.0 simplifies the `CommandInterface` and adds an `OptionsInterface`.
Combined, these two interfaces represent the fundamental requirements of a
command system that is flexible and can be used in modern and legacy environments.

### Creating an Options Value Object

All options must implement `OptionsInterface`, which includes the ability to
serialize the value object to JSON. The `OptionsSerializerTrait` can provide
this functionality.

Options must validate the values passed during construction. If you are using an
array to hydrate the options, the `OptionsRequiredTrait` will help you validate
requirements. Type checking should also be done when suitable.

```php
use Equip\Command\OptionsInterface;
use Equip\Command\OptionsRequiredTrait;
use Equip\Command\OptionsSerializerTrait;

class LoginOptions implements OptionsInterface
{
    use OptionsRequiredTrait;
    use OptionsSerializerTrait;

    private $email;
    private $password;

    public function __construct(array $options)
    {
        $this->checkRequired($options, [
            'email',
            'password',
        ]);

        $this->email = $options['email'];
        $this->password = $options['password'];
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }
}
```

### Creating a Command

All commands must implement the `CommandInterface` instead of `AbstractCommand`.

Commands should be immutable and return a copy when `withOptions()` is called.
The `CommandImmutableOptionsTrait` can provide this functionality.

```php
use Equip\Command\CommandInterface;
use Equip\Command\CommandImmutableOptionsTrait;

class LoginCommand implements CommandInterface
{
    use CommandImmutableOptionsTrait;

    /**
     * @var LoginOptions
     */
    private $options;

    public function withOptions(LoginOptions $options)
    {
        return $this->copyWithOptions($options);
    }

    /**
     * @return object
     */
    public function execute()
    {
        $user = $this->getUser($this->options->email());

        $this->checkCredentials($user, $this->options->password());

        return $user;
    }
}
```

### Executing a Command

```php
$options = new LoginOptions([
    'email' => 'user@example.com',
    'password' => 'very secret',
]);

$command = new LoginCommand();
$command = $command->withOptions($options);

$user = $command->execute();
```
