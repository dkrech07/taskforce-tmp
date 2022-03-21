<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\services\UserService;
use TaskForce\utils\CustomHelpers;
use app\models\EditProfileForm;
use Yii;

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
        $EditProfileFormModel = new EditProfileForm();

        $userId = Yii::$app->user->getId();
        $userProfile = (new UserService())->getExecutor($userId);
        print_r($userProfile->profile->avatar_link);

        return $this->render('edit', [
            'userProfile' => $userProfile,
            'EditProfileFormModel' => $EditProfileFormModel,
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
