<?php

namespace app\controllers;

use Yii;
use app\models\TasksSearchForm;
use app\services\TasksFilterService;
use yii\web\NotFoundHttpException;
use app\services\TasksService;
use app\services\CategoriesService;
use app\models\Tasks;
use app\models\Categories;
use app\models\AddTaskForm;
use app\models\Replies;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

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
        $tasksService = new TasksService;
        $task = $tasksService->getTask($id);
        $replies = $tasksService->getReplies($id);
        $task_files = $tasksService->getTaskFiles($id);

        if (!$task) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'task' => $task,
            'replies' => $replies,
            'task_files' => $task_files,
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

        return $this->render('add', [
            'addTaskFormModel' => $addTaskFormModel,
            'categories' => $categories
        ]);
    }

    public function acceptReply($reply)
    {
        //меняем статус отклика на принято
        // $modelReplies = Replies::findOne(['id' => $reply->id]);
        // $modelTasks = Tasks::findOne(['id' => $reply->id]);

        // Найти отзыв
        // Найти задачу
        // Записать в задачу отзыв (id отзыва)
        // Поменять статус задачи на в работе

        // $model->status = Reply::STATUS_ACCEPTED;
        // $model->update();
        // //стартуем задание
        // $task = Task::findOne(['id' => $reply->task_id]);
        // if (Action::doAction(Action::ACTION_START, $task, $this->user->id)) {
        //     $task->contr_id = $model->contr_id;
        //     if ($task->update() === false) {
        //         throw new \Exception('Не удалось изменить данные задачи id ' . $task->id);
        //     }
        // }
    }

    /**
     * Принять отклик исполнителя
     * @param int $id id отклика исполнителя
     */
    public function actionAccept(int $id)
    {
        $reply = Replies::findOne(['id' => $id]);

        $task = Tasks::findOne(['id' => $reply->task_id]);
        $task->executor_id = $reply->executor_id;
        $task->status = 'in_progress';
        // Добавить статус отклика
        $task->save();
    }

    /**
     * Отклонить отклик исполнителя
     * @param int $id id отклика исполнителя
     */
    public function actionReject(int $id)
    {
        $reply = Replies::findOne(['id' => $id]);
        $this->rejectReply($reply);
        return $this->actionView($reply->task_id);
    }
}
