<?php

declare(strict_types=1);

namespace TaskForce\utils;

use Yii;
use app\models\User;

const ALL_STARS_COUNT = 5;

class CustomHelpers
{
    /**
     * Возвращает текст-верстку звездочек рейтинга
     * @param int $fullStarsCount рейтинг пользователя в числовом формате
     *
     * @return string верстка звездочек для отображения на странице
     */
    public static function getRatingStars(int $fullStarsCount): string
    {
        $allStars = '';
        $emptyStarsCount = ALL_STARS_COUNT - floor($fullStarsCount);

        while ($fullStarsCount > 0) {
            $fullStarsCount--;
            $allStars .= "<span class=\"fill-star\">&nbsp;</span>";
        }

        while ($emptyStarsCount > 0) {
            $emptyStarsCount--;
            $allStars .= "<span>&nbsp;</span>";
        }

        return $allStars;
    }

    /**
     * Возвращает разницу в годах
     * @param string $birthday дата в стоковом формате
     *
     * @return int разница в годах
     */
    public static function getTimeDifference(string $birthday): int
    {
        $birthdayDate = getdate(strtotime($birthday));
        $currentDate = getdate();

        return $currentDate['year'] - $birthdayDate['year'];
    }

    /**
     * Возвращает дату в формате: день / месяц / год / время
     * @param string $date дата в текстовом формате
     *
     * @return string дата в формате день, месяц (на русском языке), год и время
     */
    public static function getRuDate(string $date): string
    {
        $dateTime = new \DateTime($date);
        $index = $dateTime->format('n') - 1;
        $months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Майя', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];

        return $dateTime->format("d $months[$index] Y, H:i");
    }

    /**
     * Возвращает текстовый статус пользователя
     * @param array $tasks массив со списком задач, в которых пользователя является исполнителем
     *
     * @return string статус пользователя в текстовом формате
     */
    public static function getUserStatus(array $tasks): string
    {
        foreach ($tasks as $task) {
            if ($task->status === 'new' || 'in_progress') {
                return "Сейчас выполняет заказ";
            }
        }

        return "Открыт для новых заказов";
    }

    /**
     * Возвращает человекопонятное название статуса
     * @param string $taskStatus статус в текстовом формате
     *
     * @return string статус на русском языке в текстовом формате
     */
    public static function getTaskStatusName(string $taskStatus): string
    {
        $taskStatusesMap = [
            'new' => 'Новое',
            'in_progress' => 'В работе',
            'canceled' => 'Отменено',
            'failed' => 'Провалено',
            'finished' => 'Выполнено',
        ];

        return $taskStatusesMap[$taskStatus];
    }

    // Проверка на авторизацию, получение данных пользователя;
    public static function checkAuthorization(): ?object
    {
        if (Yii::$app->user->isGuest) {
            return null;
        }
        return User::findIdentity(Yii::$app->user->getId());
    }
}
