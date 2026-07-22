# Contact AI API
Backend-сервис для формы обратной связи.

Проект предоставляет REST API для отправки обращений пользователей, автоматического анализа комментариев с помощью AI, отправки email-уведомлений, защиты от спама и просмотра метрик приложения.

## 1. Как запустить проект
### Локальный запуск
### Вариант 1. Локальный запуск без Docker
#### 1. Клонировать репозиторий
```bash
git clone https://github.com/hxvdofhxll787/contact-ai.git

cd contact-ai
```
#### 2. Установка зависимостей
```bash
composer install
```
#### 3. Создать .env
```bash
cp .env.example .env
```
#### 4. Сгенерировать ключ приложения
```bash
php artisan key:generate
```
#### 5. Настройка базы данных
Создать SQLite файл:
```bash
touch database.database.sqlite
```
В .env указать:
```text
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```
#### 6. Выполнение миграций
```bash
php artisan migrate
```
#### 7. Запуск приложения
```bash
php artisan serve
```
После запуска API будет доступно:
```link
http://localhost:8000/api
```
### Вариант 2. Запуск через Docker
#### 1. Клонировать репозиторий
```bash
git clone https://github.com/hxvdofhxll787/contact-ai.git

cd contact-ai
```
#### 2. Создать .env
```bash
cp .env.example .env
```
#### 3. Настройка базы данных
Создать SQLite файл:
```bash
touch database.database.sqlite
```
В .env указать:
```text
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```
#### 4. Сборка и запуск контейнера
```bash
docker compose up -d --build
```
Приложение будет доступно:
```link
http://localhost:8000/api
```
#### 5. Выполнение миграций
```bash
docker compose exec app php artisan migrate
```
### Настройка переменных окружения
Пример .env:
```bash
MAIL_MAILER=smtp 
MAIL_HOST=smtp.example.com 
MAIL_PORT=587 
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

MAIL_FROM_NAME="Contact API"
MAIL_OWNER_ADDRESS=owner@example.com

GEMINI_API_KEY=your_api_key
```
## 2. Стек технологий
### Backend
- PHP 8.3
- Laravel 13
- SQLite
- Eloquent ORM
- Laravel Mail
- Laravel Validation
- Laravel Middleware
- Laravel Rate Limiting
### AI
Используется: Google Gemini API
### Документация
- L5-Swagger
### Infrastructure
- Docker
- Docker Compose
## 3. Архитектура проекта
Проект построен с использованием слоистой архитектуры.
### Структура проекта
app/\
├── Http/\
│ ├── Controllers/\
│ │ └── Api/\
│ │&nbsp;&nbsp;&nbsp;├── ContactController.php\
│ │&nbsp;&nbsp;&nbsp;├── HealthController.php\
│ │&nbsp;&nbsp;&nbsp;└── MetricsController.php\
│ │\
│ ├── Middleware/\
│ │ └── RequestLogger.php\
│ │\
│ └── Requests/\
│&nbsp;&nbsp;&nbsp;└── ContactRequest.php\
│\
├── Services/\
│ ├── ContactService.php\
│ ├── AIService.php\
│ ├── MailService.php\
│ ├── MetricsService.php\
│ └── RequestLogService.php\
│\
├── Repositories/\
│ ├── ContactRepository.php\
│ └── RequestLogRepository.php\
│\
├── Models/\
│ ├── Contact.php\
│ └── RequestLog.php\
│\
└── Mail/\
&nbsp;&nbsp;&nbsp;├── ContactNotification.php\
&nbsp;&nbsp;&nbsp;└── ContactConfirmation.php
### Паттерны проектирования
В проекте есть несколько паттернов:
#### 1. Service Layer
Controller -> Service -> Repository
#### 2. Repository Pattern
Бизнес-логика не знает, откуда берутся данные.
#### 3.Middleware Pattern
Request -> Middleware -> Controller\
Middleware перехватывает запрос до и после выполнения.
### Обоснование выбора технологий
#### Laravel
Laravel выбран в качестве backend-фреймворка благодаря:
- встроенной поддержке REST API;
- удобной системе маршрутизации;
- встроенной валидации;
- работе с почтой;
- ORM Eloquent.
#### SQLite
SQLite выбран как база данных, так как:
- легко запускается локально;
- подходит для небольшого backend-сервиса;
- поддерживается Laravel из коробки.
#### Google Gemini API
Google Gemini API был выбран из-за:
- доступности;
- удобного использования;
- быстрых ответов.
#### Docker
Docker используется для:
- стандартизации окружения;
- упрощения запуска проекта.
## 4. Реализация API
### POST /api/contact
Создание обращения через форму.
#### Request
```json
{
    "name": "Иван",
    "email": "ivan@example.com",
    "phone": "+79999999999",
    "comment": "Хочу заказать разработку сайта."
}
```
#### Response 201
```json
{
    "success": true,
    "message": "Contact successfully created.",
    "data": {
        "id": 36,
        "sentiment": "Neutral",
        "category": "Partnership"
    }
}
```
### Ошибки
#### 422 Validation Error
Пустой комментарий:
```json
{
    "success": false,
    "message": "Comment is required."
}
```
Неверный формат номера телефона:
```json
{
    "success": false,
    "message": "Invalid Phone number."
}
```
Неверный формат электронной почты:
```json
{
    "success": false,
    "message": "Invalid email."
}
```
#### 429 Too Many Requests
Возвращается при превышении лимита запросов:
```json
{
    "success": false,
    "message": "Too Many Attempts."
}
```
### GET /api/health
Проверка состояния сервиса.\
Пример ответа:
```json
{
    "status": "ok",
    "timestamp": "2026-07-18T09:12:19.528625Z",
    "app": "Contact AI",
    "version": "1.0.0"
}
```
### GET /api/metrics
Получение статистики приложения.\
Пример ответа:
```json
{ 
    "contacts": { 
        "total": 25, 
        "today": 3 
    }, 
        
    "requests": { 
        "total": 100, 
        "failed": 5 
    }, 
    
    "sentiments": { 
        "positive": 10, 
        "neutral": 12, 
        "negative": 3 
    } 
}
```
### Swagger документация
После запуска приложения:
```bash
http://localhost:8000/api/documentation
```
Доступна документация API.
## 5. AI-интеграции
Для анализа пользовательских обращений используется Google Gemini API.
### Функциональность
AI выполняет:
1. Анализ тональности:
- positive
- neutral
- negative
2. Классификацию обращения:
- question 
- feedback 
- complaint 
- partnership 
- other
### Graceful fallback
Если AI-сервис недоступен:
- ошибка записывается в лог;
- обращение сохраняется;
- пользователь получает успешный ответ.
Fallback:
```json
{ 
    "sentiment": "unknown", 
    "category": "unknown" 
}
```
Это позволяет сервису продолжать работу при временной недоступности AI-провайдера.
### Промпт
```prompt
Проанализируй комментарий пользователя.
Верни только валидный JSON.

Доступные значения sentiment:
- Positive
- Neutral
- Negative

Доступные значения category:
- Question
- Feedback
- Complaint
- Partnership
- Other

JSON формат ответа:
{
    "sentiment": "",
    "category": ""
}

Комментарий пользователя:
{$comment}
```
## 6. Было сделано с AI
AI-инструменты использовались для:
- проверки архитектурных решений;
- подготовки документации;
- работа с Google Gemini API;
- поиска возможных улучшений кода.
Все сгенерированные части были проверены и адаптированы вручную.\
## 7. Хранение данных
Используется SQLite.
### Логи
Хранятся в базе данных:
- HTTP метод;
- URL;
- входные данные;
- HTTP статус ответа;
- время выполнения;
- IP адрес.
Логирование выполняется через middleware.\
Логи с ошибками также записываются в текстовой файл laravel.log. Дополнительно:
- ошибки AI интеграции;
- ошибки отправки email;
- HTTP ошибки.
### Rate limiting
Защита от спама реализована через Laravel Rate Limiter.\
Ограничение применяется к:
```bash
POST /api/contact
```
Данные ограничения хранятся через файловый cache driver.
## Пример curl запроса
```bash
curl -X POST http://localhost:8000/api/contact \
-H "Content-Type: application/json" \
-d '{
"name":"Иван",
"email":"ivan@example.com",
"phone":"+79999999999",
"comment":"Хочу заказать разработку сайта."
}'
```
