## Завдання

Є інтернет магазин, потрібно реалізувати логіку надсилання даних про посилку на кур'єрську службу (умовну Нову пошту).

Потрібно створити порожній laravel проект, створити контролер DeliveryController всередині повинен бути метод, який на вхід приймає дані про посилку та одержувача.

Дані про посилку включають ширину, висоту, довжину і вагу.
Дані про одержувача ПІБ, номер телефону, пошту та адресу.

Необхідно реалізувати логіку надсилання даних про посилку з урахуванням можливих майбутніх запитів клієнта. (*можна у коді прописати які можуть бути додаткові запити у майбутньому).

* Реалізувати завдання з урахуванням можливих доробок у майбутньому (передбачити, що клієнт може захотіти в майбутньому) та передбачивши архітектуру на майбутнє зростання
* Можна змінити код або дописати коментар над методом/класами як вони видозмінюватимуться якщо власник інтернет-магазину захоче додати відправку через Укрпошту, Джастін та інші кур'єрки
* Як зміниться код, якщо кур'єрок буде 15?
* Якщо клієнт має проблему з доставкою замовлень. Клієнт надсилає дані, але підтримка кур'єрської служби говорить, що не отримує даних від поточного сервісу.

## Опис рішення

* Створено API ендпоінт для приймання запиту та даних для створення доставки
* Передбачено версіонуання API
* Реалізована валідація вхідних даних
* Реалізовано інтерфайс для створення, за необхідністью, різних сервісів доставки з уніфікованим апі, для можливості швидкої заміни сервісу доставки у коді
* Реалізовано сервіс для роботи з Api нової пошти, на основі інтерфейсу
* Реалізовано додатковий ендпоінт, для можливого запиту клієнта
* Написані feature-тести для ендпоінтів
* Заміна сервісу доставки, наприклад, на Укрпошту, виконується створенням нового сервісу на основі інтерфейсу та переналаштуванням сервіс-контейнеру
* Для реалізації додаткових побажань клієнта створюються додаткові ендпоінти та методи до інтерфейсу і сервісу
* Якщо буде потрібно приймати не одну курьєрку, а наприклад 15, то додається додатковий ендпоінт до API і метод до інтерфейсу та сервісу
* Якщо клієнт має проблеми с доставкою, і не може зрозуміти у чому справа, то допоможе зберігання запитів від клієнта та відповідей від сервісу доставки у БД, зі створенням додаткового ендпоїнту для отримання цих записів (не було реалізовано так, як не передбачалося завданням)

## Що ще можна було б реалізувати

* Аутентифікацію та авторизацію на базі токену (наприклад JWT)
* Збереження у БД даних запитів від клієнта та до API служби доставки
* Роботу з різними службами доставки, на основі переданого ключа у запиті клієнта
* Логування
* Обробку подій (наприклад, сповіщення адміністратора про невдалі запити до API) 
