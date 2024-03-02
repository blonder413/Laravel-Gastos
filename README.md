## Aplicación para llevar el control de los gastos del mes

Cada que se haga un gasto se registra en la aplicación, definimos unos montos de alerta y peligro y al entrar veremos 
el total gastado en el mes con el color correspondiente, esto nos permite saber de forma rápida si hemos gastado más 
de lo presupuestado o si estamos cerca de hacerlo.

Podemos mostrar las consultas ejecutadas usando los siguientes comandos al principio y al final respectivamente.
Para eso es importante llamar al namespace respectivo
```php
use Illuminate\Support\Facades\DB;
...
DB::enableQueryLog(); // Enable query log
// Consultas SQL
dd(DB::getQueryLog()); // Show results of log
```