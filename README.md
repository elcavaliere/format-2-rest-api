# Тестовое задание PHP

## Исходные данные

Некий сервис, в нем есть пользователи, у них есть баланс лицевого счета.
На вход сервис получает операция пополение или списания лицевого счета
(в сервисе принято называть их транзакциями).
Сервис обрабатывает около 100000 транзакции в день. 

В репозитарии имеются все нужные начальные данные
  - Миграции
  - Seed

### Разрешено
 - использовать любые инструменты в рамках php или БД 
 - добавлять, модифицировать таблицы 
 - добавлять, модифицировать поля в таблицах.

## Требуется
  - реализовать метод добавления транзакции.
  - реализовать метод отмены транзакции.
  - реализовать метод получения баланса пользователя.
  - формат взаимодейсвие с сервисом в JSON; 

### Плюсом будет:
  - объясните почему Вы сделали именно так;
  - использование docker-compose;
  - использованиен Swagger;
  - использование PHPDoc;
  - внимательность;
  - чистота кода;
  - наличие .env


