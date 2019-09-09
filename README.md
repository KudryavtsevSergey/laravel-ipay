# Laravel ipay erip package

## Installation

cd to project.

```shell script
mkdir -p packages/sun

cd packages/sun

git clone https://github.com/KudryavtsevSergey/laravel-ipay.git ipay
```

in your composer.json

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "packages/sun/ipay",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
      "sun/ipay": "dev-master"
    }
}
```

After updating composer, add the service provider to the ```providers``` array in ```config/app.php```

```php
Sun\IPay\IPayServiceProvider::class,
```
