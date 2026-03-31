# Link QR — короткие ссылки с генерацией QR-кодов

Это базовый шаблон приложения [Yii 2](https://www.yiiframework.com/) с функционалом генерации QR-кодов (библиотека `bacon/bacon-qr-code`). Идеально подходит для быстрого создания небольших проектов.

## Особенности

- **Yii 2 Basic Project Template** — базовая структура приложения
- **Генерация QR-кодов** — интеграция с библиотекой BaconQrCode
- **Docker-контейнеризация** — PHP-FPM, Nginx, MySQL в Docker
- **phpMyAdmin** — встроенная панель управления базой данных

## Требования к системе

- **WSL or Linux**
- **Docker**

---

## Структура проекта

```
/var/www/link-qr/
├── docker/
│   ├── nginx/          # Конфигурация Nginx
│   │   └── default.conf
│   └── php/            # PHP Docker-контейнер
│       ├── Dockerfile
│       └── entrypoint.sh  # Скрипт инициализации контейнера
├── html/               # Веб-ресурсы приложения (YII2)
├── .env                # Переменные окружения (реальный файл)
├── .env.example        # Шаблон переменных окружения
└── docker-compose.yml  # Оркестрация контейнеров
```

---

## Быстрый старт с Docker

### 1. Копируем переменные окружения

Скопируйте `.env.example` в `.env`:

```bash
cp .env.example .env
```

### 2. Редактируем файл `.env`

Укажите свои данные для базы данных:

```ini
DB_ROOT_PASSWORD=root_password
DB_DATABASE=database
DB_USERNAME=db_user
DB_PASSWORD=db_password
```

> **Важно:** Все переменные окружения должны быть в формате `KEY=value` (без кавычек).

### 3. Запускаем Docker-контейнеры

```bash
docker compose up -d
```

### 4. Проверяем работу

- **Приложение:** http://localhost:8000
- **phpMyAdmin:** http://localhost:8080

---

## Как работает entrypoint.sh

Скрипт `./docker/php/entrypoint.sh` выполняет следующие действия при запуске контейнера:

1. Переходит в директорию `/var/www/html`
2. Изменяет права владения и доступ для директорий `models`, `controllers` и `views`. Это необходимо для корректной работы Gii (генератор компонентов Yii) во время разработки.:
   - Группа владельца: `www-data`
   - Права доступа: `775`
3. На всякий случай проверяет доступность mysql порта через nc
4. Выполняет установки зависимостей и выполняет миграции

---

## Конфигурация приложения

### База данных

Приложение использует переменные окружения из файла `.env`. В файле `config/db.php` указаны следующие настройки:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='. getenv('DB_HOST') .';dbname='. getenv('DB_DATABASE'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
];
```

> **Важно:** База данных создаётся автоматически при первом запуске контейнера MySQL.

---

## Запуск миграций базы данных (если есть)

Если у вас есть миграции, выполните:

```bash
docker compose exec php php yii migrate --interactive=0
```

## Доступные порты

| Сервис | Порт на хосте | Описание |
|--------|---------------|----------|
| Nginx + Yii 2 | `8000` | Основное приложение |
| phpMyAdmin | `8080` | Управление базой данных |

---

## Остановка контейнеров

```bash
docker compose down
```

Для удаления данных базы данных выполните:

```bash
docker compose down -v
```
---

## Лицензия

Yii Framework — [BSD License](https://www.yiiframework.com/license/)

Библиотека BaconQrCode — [MIT License](https://github.com/baconphp/bacon-qrcode)
