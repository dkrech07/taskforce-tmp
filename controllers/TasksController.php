<?php

namespace app\controllers;

use Yii;
use app\models\TasksSearchForm;
use app\services\TasksFilterService;
use yii\web\NotFoundHttpException;
use app\services\TasksService;
use app\models\Tasks;
use app\models\Categories;
use app\models\AddTaskForm;

class TasksController extends SecuredController
{
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
        $tasksService = new TasksService;
        $task = $tasksService->getTask($id);
        $replies = $tasksService->getReplies($id);

        if (!$task) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'task' => $task,
            'replies' => $replies,
        ]);
    }

    public function actionAdd()
    {
        $addTaskForm = new AddTaskForm();

        // if (Yii::$app->request->isPost) {
        //     $addTaskForm->load(Yii::$app->request->post());
        //     $addTaskForm->files = UploadedFile::getInstances($addTaskForm, 'files');

        //     if (Yii::$app->request->isAjax) {
        //         Yii::$app->response->format = Response::FORMAT_JSON;

        //         return ActiveForm::validate($addTaskForm);
        //     }

        //     if ($addTaskForm->validate()) {
        //         $taskId = (new TaskService())->create($addTaskForm);
        //         $this->redirect(['tasks/view', 'id' => $taskId]);
        //     }
        // }

        // $categories = (new CategoryService())->findAll();

        return $this->render('add', [
            'model' => $addTaskForm,
            // 'categories' => $categories
        ]);
    }
}
