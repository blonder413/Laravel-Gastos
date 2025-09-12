## Aplicación para llevar el control de los gastos del mes

Cada que se haga un gasto se registra en la aplicación, definimos unos montos de alerta y peligro y al entrar veremos
el total gastado en el mes con el color correspondiente, esto nos permite saber de forma rápida si hemos gastado más
de lo presupuestado o si estamos cerca de hacerlo.

## Instalación

```bash
git clone https://github.com/blonder413/Laravel-Gastos.git
cd Laravel-Gastos
composer install
```

La creación de la base de datos es manual por ahora.

# SonarQube

```sh
php artisan test --coverage-clover=storage/coverage/coverage.xml
sonar-scanner
```
