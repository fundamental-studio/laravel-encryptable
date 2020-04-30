# Laravel Encryptable by Fundamental Studio Ltd.
Laravel Encryptable addon for easy encrypt/decrypt database values with as many as 4 lines of code.
- Single trait to use within all your models.
- Specify all attributes you want or you do not want to encrypt.
- Automatically encrypts the data on create/update.
- Automatically decrypts the values on retrieve and attribute access.
- Can be used with all available databases. Please, be aware of the length of your data.
- Respects both: the casts and the dates fields.
- Under the hood, it uses the Crypt trait from Laravel.
- It respects the casts and mutations of your attributes.

Made with love and code by [Fundamental Studio Ltd.](https://www.fundamental.bg)

## Installation

The package is compatible with Laravel 7+ version.

Via composer:
``` bash
$ composer require fmtl-studio/laravel-encryptable
```

After installing, the package should be auto-discovered by Laravel.
That's it. You are up & running and ready to go.

## Documentation and Usage instructions

The usage of our package is pretty seamless and easy.
First of all, you need to use the proper namespace for our package:
```
use Fundamental\Encryptable\Encryptable;
```

After that, use the trait inside your Eloquent Model, like this:

```php
class User extends Model
{
    use Encryptable;

    // The rest of your model.
}
```

Then, you can specify the attributes you want to encrypt or just those that you do not want to:
```php
protected $encryption = [
    'attribute_1', 'attribute_2', 'attribute_3'
];
```

You can also specify:
```php
protected $encryptAll = true;
```

And the use the skipEncryption rule for those which should be ommitted.
```php
protected $skipEncryption = [
    'attribute_4', 'attribute_5'
];
```

By default, the id and the timestamp fields are ommitted.

## Methods
The package is as simple as possible. It contains a trait, which is overriding the default setAttribute and getAttributeValue methods.
You can find more about them at [Laravel API Documentation](https://laravel.com/api/7.x/Illuminate/Database/Eloquent/Model.html).

There aren't any public exposed methods you should use.

## Changelog
All changes are available in our Changelog file.

## Support
For any further questions, feature requests, problems, ideas, etc. you can create an issue tracker or drop us a line at support@fundamental.bg

## Contributing
Read the Contribution file for further information.

## Credits

- Konstantin Rachev
- Vanya Ananieva

The package is bundled and contributed to the community by Fundamental Studio Ltd.'s team.

## Issues
If you discover any issues, please use the issue tracker.

## Security
If your discover any security-related issues, please email konstantin@fundamental.bg or support@fundamental.bg instead of using the issue tracker.

## License
The MIT License(MIT). See License file for further information and reading.