# Клиент Anti-captcha API 2 для Yii2

- Site: https://anti-captcha.com/mainpage
- API: https://anticaptcha.atlassian.net/wiki/spaces/API/pages/196633

## Настройка

```php
$config = [
    'modules' => [
        'anticaptcha' => [
            'class' => dicr\anticaptcha\AntiCaptchaModule::class,
            'clientKey' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
        ]
    ]
];
```

## Использование

Запрос на решение простой текстовой капчи:

```php
use dicr\anticaptcha\AntiCaptchaModule;
use dicr\anticaptcha\method\CreateTaskRequest;
use dicr\anticaptcha\method\GetTaskRequest;
use dicr\anticaptcha\task\ImageToTextTask;

/** @var AntiCaptchaModule $module модуль */
$module = Yii::$app->getModule('anticaptcha');

/** @var CreateTaskRequest $req запрос создания задачи */
$req = $module->request([
    'class' => CreateTaskRequest::class,
    'task' => new ImageToTextTask([
        'body' => base64_encode(file_get_contents(__DIR__ . '/captcha.gif')),
    ])
]);

// отправляем запрос создания задачи решения капчи
$res = $req->send();
echo 'Задача: ' . $res->taskId . "\n";

// ждем 20 секунд
sleep(20);

/** @var CreateTaskRequest $req запрос решения капчи */
$req =$module->request([
    'class' => GetTaskRequest::class,
    'taskId' => $res->taskId
]);

// отправляем запрос
$res = $req->send();
echo 'Ответ: ' . $res->solution['text'] . "\n";
```
