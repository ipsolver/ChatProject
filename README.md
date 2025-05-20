# Chatter — Messaging Platform

Цей проєкт є повноцінною реалізацією платформи для обміну повідомленнями з підтримкою чатів, повідомлень, авторизації, REST API, подій, UI-інтерфейсу та масштабованої структури.

---
## Скріншоти

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/screenshot.jpg)

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/1.jpg)

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/2.jpg)

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/3.jpg)

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/4.jpg)

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/5.jpg)

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/6.jpg)

![](https://github.com/ipsolver/ChatProject/blob/main/screenshots/7.jpg)

## Що потрібно для запуску

### Встановлені інструменти:
- PHP >= 8.1
- Laravel >= 10.x
- Composer
- MySQL або PostgreSQL
- Node.js (для збірки фронту, якщо використовується UI)
- `php artisan serve` або Docker для запуску

### Команди для запуску:
```bash
git clone <repo>
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Використані шаблони проєктування

### Observer (Спостерігач)

**Суть**: об'єкти можуть реагувати на події (без прямої залежності один від одного)

**Реалізація:**
```php
// core/Providers/EventServiceProvider.php
protected $listen = [
    'App\Events\MessageSent' => [
        'App\Listeners\NotifyUser',
    ],
];
```

```php
// подія викликається:
event(new MessageSent($message));

// слухач:
public function handle(MessageSent $event)
{
    Notification::send($event->message->receiver, new NewMessageNotification($event->message));
}
```

---

### Factory (Фабрика)

**Суть**: централізоване створення об'єктів, часто з фейковими/тестовими даними

**Реалізація:**
```php
// database/factories/UserFactory.php
public function definition(): array
{
    return [
        'name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'password' => bcrypt('password'),
    ];
}
```

```php
// Seeder
User::factory()->count(10)->create();
```

---

### Dependency Injection (DI)

**Суть**: залежності підставляються автоматично через контейнер

**Реалізація:**
```php
class ChatController extends Controller
{
    protected ChatService $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }
}
```

Laravel сам створить `ChatService` і передасть його контролеру

---

### Facade (Фасад)

**Суть**: спрощений доступ до складних підсистем через статичний інтерфейс.

**Реалізація:**
```php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

// Простий виклик:
Cache::put('key', 'value', now()->addMinutes(10));

Notification::send($user, new WelcomeNotification());
```

### Техніки рефакторингу

- Винесення логіки у сервіси: обробка чатів, повідомлень — в окремих сервісах (Services/*)

- Інкапсуляція запитів: запити розбиті по сервісах, використовується DTO-підхід

- Події: замість прямого виклику логіки використані події (MessageSent)

- Слухачі: логіка сповіщення або логування винесена в окремі обробники

- Middleware: використовується для авторизації, throttle та інших цілей

###  Використані принципи програмування

- SOLID
- - S — Single Responsibility: класи розділені на контролери, сервіси, події, слухачі

- - O — Open/Closed: нову логіку додаємо без зміни існуючих класів (слухачі)

- - L — Liskov Substitution: всі сервіси можуть замінятися у DI без порушення роботи

- - I — Interface Segregation: сервісні інтерфейси не перевантажені

- - D — Dependency Inversion: залежності підставляє Laravel-контейнер
 
- DRY / KISS / YAGNI
- - DRY — повторюваний код винесений у сервіси

- - KISS — архітектура проєкту зрозуміла, контролери прості

- - YAGNI — немає зайвого коду, лише те, що дійсно потрібно

### UI частина
Проєкт має UI-інтерфейс, доступний через маршрути web.php, наприклад `/chat`

- Особливості:
- - Адаптивна верстка для месенджера

- - Список чатів + повідомлень

- - Інтеграція з Notification API Laravel

- - Можливе використання messenger-ui.php для кастомізації компонентів

- - У шаблонах використовуються Blade-компоненти
 
