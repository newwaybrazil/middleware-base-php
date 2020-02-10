# middleware-base-php
A simple php class to implement middleware/pipeline concept (chain of responsibility)

To implement

1) Add Middleware.php to your project;

2) Create your middleware classes extending Middleware.php with the handle method. Where you need to pass to next step just do 
```return parent::handle($data);```, where you want to break the chain do ```return $data;```

FooMiddleware.php
```
<?php

namespace App;

use App\Middleware;

class FooMiddleware extends Middleware
{
    public function handle(
        array $data
    ): array {
        $data['foo'] = 'foo';
        return parent::handle($data);
    }
```

BarMiddleware.php
```
<?php

namespace App;

use App\Middleware;

class BarMiddleware extends Middleware
{
    public function handle(
        array $data
    ): array {
        $data['bar'] = 'bar';
        return parent::handle($data);
    }
```

3) On your main code create your pipeline and execute him:

MainCode.php
```
<?php

namespace App;

use App\FooMiddleware;
use App\BarMiddleware;

class MainCode
{
    public function proccess()
    {
        $foo = new FooMiddleware();
        $foo = new Bar();
        $foo->setNext($bar);

        $arrayTest = [];
        $result = $this->foo->handle($arrayTest);

        print_r($result);
     }
 }
```

The result will be:
```
Array
(
    [foo] => foo
    [bar] => bar
)
```
