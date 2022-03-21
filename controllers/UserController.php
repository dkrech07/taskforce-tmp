<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\services\UserService;

class UserController extends SecuredController
{
    public function actionView(int $id)
    {
        $userService = new UserService;
        $user = $userService->getExecutor($id);
        $tasksFinishedCount = $userService->getExecutorTasksCount($id, 'finished');
        $tasksFailedCount = $userService->getExecutorTasksCount($id, 'failed');
        $tasksInProgressCount = $userService->getExecutorTasksCount($id, 'in_progress');
        $specializations = $userService->getExecutorSpecializations($id);
        $opinions = $userService->getExecutorOpinions($id);
        $userRatingPosition = $userService->getExecutorRatingPosition($id);

        if (!$user) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'user' => $user,
            'specializations' => $specializations,
            'tasksFinishedCount' => $tasksFinishedCount,
            'tasksFailedCount' => $tasksFailedCount,
            'tasksInProgressCount' => $tasksInProgressCount,
            'userRatingPosition' => $userRatingPosition,
            'opinions' => $opinions,
        ]);
    }

    public function actionEdit()
    {
        return $this->render('edit', [
            // 'user' => $user,
            // 'specializations' => $specializations,
            // 'tasksFinishedCount' => $tasksFinishedCount,
            // 'tasksFailedCount' => $tasksFailedCount,
            // 'tasksInProgressCount' => $tasksInProgressCount,
            // 'userRatingPosition' => $userRatingPosition,
            // 'opinions' => $opinions,
        ]);
    }
}
