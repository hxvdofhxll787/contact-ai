# Contact AI API
Backend-сервис для формы обратной связи на лендинге разработчика.

Проект предоставляет REST API для отправки обращений пользователей, автоматического анализа комментариев с помощью AI, отправки email-уведомлений, защиты от спама и просмотра метрик приложения.

## 1. Как запустить проект
### Локальный запуск
Клонировать репозиторий
### Настройка переменных окружения
Пример .env:
```bash
DB_CONNECTION=sqlite 
DB_DATABASE=/absolute/path/database/database.sqlite

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
Используется слоистая архитектура:
Controllers\
     |\
     v\
Services\
     |\
     v\
Repositories\
     |\
     v\
Models\
     |\
     v\
Database
### Controllers
Отвечают за:
- прием HTTP-запросов;
- валидацию входных данных;
- формирование HTTP-ответов.
