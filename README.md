# Userstamps #

Create created_by and updated_by for your migrations.

```php
$table->userstamps();
```

will add

`created_by` and `updated_by` column

Comes with handy trait to use in your model

```php
use Munettt\Userstamps\Userstamps;

class Book extends Model
{
    use Userstamps;

    //
}
```

which register events upon creating/updating model with appropriate created_by / updated_by user id.
