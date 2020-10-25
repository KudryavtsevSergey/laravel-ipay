# Laravel ipay erip package

## Installation

composer.json

```json
{
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/KudryavtsevSergey/laravel-ipay.git"
        }
    ],
    "require": {
      "sun/ipay": "dev-master"
    }
}
```

After updating composer, add the service provider to the ```providers``` array in ```config/app.php```

```php
[
    Sun\IPay\IPayServiceProvider::class,
];
```

And add alias:
```php
[
    'IPay' => Sun\IPay\Facade::class,
];
```
