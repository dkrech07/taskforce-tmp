<?php

namespace app\controllers;

use Yii;
use app\models\TasksSearchForm;
use app\services\TasksFilterService;
use yii\web\NotFoundHttpException;
use app\services\TasksService;
use app\services\RepliesService;
use app\services\CategoriesService;
use app\models\Tasks;
use app\models\Categories;
use app\models\AddTaskForm;
use app\models\Replies;
use app\models\RefuseForm;
use app\models\FinishedForm;
use app\services\OpinionsService;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;
use TaskForce\tasks\Task;
use app\models\Cities;

// Формы для задач
use app\models\ResponseForm;


class TasksController extends SecuredController
{
    public function behaviors()
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['add'],
            'matchCallback' => function ($rule, $action) {
                if (isset(\Yii::$app->user->identity->role)) {
                    return \Yii::$app->user->identity->role !== 0;
                }
            }
        ];

        array_unshift($rules['access']['rules'], $rule);
        return $rules;
    }

    public function actionIndex()
    {
        $model = new TasksSearchForm();

        if (Yii::$app->request->getIsPost()) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $tasks = (new TasksFilterService())->getFilteredTasks($model);
            }
        }

        !isset($tasks) && $tasks = Tasks::find()->all();
        $categories = Categories::find()->all();

        return $this->render('index', [
            'model' => $model,
            'tasks' => $tasks,
            'categories' => $categories,
            'period_values' => TasksSearchForm::PERIOD_VALUES
        ]);
    }

    public function actionView(int $id)
    {
        $userId = Yii::$app->user->getId();
        $tasksService = new TasksService;
        $task = $tasksService->getTask($id);

        if (!$task) {
            throw new NotFoundHttpException;
        }

        $customerId = $task->customer_id;
        $executorId = $task->executor_id;
        $currentStatus = $task->status;
        $Actions = new Task($customerId, $executorId, $userId, $currentStatus);
        $taskAction = $Actions->get_user_actions($currentStatus);
        $replies = $tasksService->getReplies($id);
        $task_files = $tasksService->getTaskFiles($id);

        $responseFormModel = new ResponseForm();
        $refuseFormModel = new RefuseForm();
        $finishedFormModel = new FinishedForm();

        if (Yii::$app->request->isPost) {
            // Исполнитель. Оставить отклик на задание;
            if (Yii::$app->request->post('response') === 'response') {
                $responseFormModel->load(Yii::$app->request->post());

                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($responseFormModel);
                }

                if ($responseFormModel->validate()) {
                    (new RepliesService())->createReply($userId, $id, $responseFormModel);
                    return $this->refresh();
                }
            }

            // Исполнитель. Отказаться от выполнения задания;
            if (Yii::$app->request->post('refuse') === 'refuse') {
                $refuseFormModel->load(Yii::$app->request->post());
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($refuseFormModel);
                }

                if ($refuseFormModel->validate()) {
                    (new RepliesService())->RefuseTask($userId, $id, $refuseFormModel);
                    return $this->refresh();
                }
            }

            // Заказчик. Завершить задание;
            if (Yii::$app->request->post('finished') === 'finished') {
                $finishedFormModel->load(Yii::$app->request->post());
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    return ActiveForm::validate($finishedFormModel);
                }

                if ($finishedFormModel->validate()) {
                    (new OpinionsService())->finishTask($id, $finishedFormModel);
                    return $this->refresh();
                }
            }
        }

        return $this->render('view', [
            'task' => $task,
            'replies' => $replies,
            'task_files' => $task_files,
            'responseFormModel' => $responseFormModel,
            'refuseFormModel' => $refuseFormModel,
            'finishedFormModel' => $finishedFormModel,
            'taskAction' => $taskAction,
        ]);
    }

    public function actionAdd()
    {
        $addTaskFormModel = new AddTaskForm();
        $tasksService = new TasksService;

        if (Yii::$app->request->isPost) {
            $addTaskFormModel->load(Yii::$app->request->post());
            $addTaskFormModel->files = UploadedFile::getInstances($addTaskFormModel, 'files');

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($addTaskFormModel);
            }

            if ($addTaskFormModel->validate()) {
                $taskId = $tasksService->createTask($addTaskFormModel);
                $this->redirect(['tasks/view', 'id' => $taskId]);
            }
        }

        $categoriesModel = new CategoriesService();
        $categories = $categoriesModel->findAll();

        $cities = Cities::find()
            ->select(['id', 'city'])
            ->indexBy('id')
            ->asArray()
            ->all();

        return $this->render('add', [
            'addTaskFormModel' => $addTaskFormModel,
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }

    // Заказчик. Принять отклик исполнителя;
    public function actionAccept(int $id)
    {
        $RepliesService = new RepliesService;
        $reply = $RepliesService->AcceptReply($id);

        return $this->redirect(['tasks/view/' . $reply->task_id]);
    }

    // Заказчик. Отменять отклик исполнителя;
    public function actionReject(int $id)
    {
        $reply = Replies::findOne(['id' => $id]);
        $reply->status = 0;
        $reply->save();
        return $this->redirect(['tasks/view/' . $reply->task_id]);
    }

    // Заказчик .Отменить задание;
    public function actionCancel(int $id)
    {
        $tasksModel = Tasks::findOne(['id' => $id]);
        if (Yii::$app->user->getId() !== $tasksModel->customer_id) {
            throw new ForbiddenHttpException('У Вас нет прав отменить это задание!');
        }

        $tasksModel->status = 'canceled';
        $tasksModel->update();
        return $this->redirect(['tasks/view/' . $id]);
    }
}
