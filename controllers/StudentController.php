<?php

namespace app\controllers;

use Yii;
use app\models\Student;
use app\models\StudentSearch;
use app\models\Answer;
use yii\web\Session;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEntry()
    {
    	$model = new Student;
		if ($model->load(Yii::$app->request->post())
			&& $model->validate()) {
			//valid data recieved in $model
			// 1- Verify if the student already exists
			$row = (new \yii\db\Query())
				->select('*')
				->from('students')
				->where(['first_name' => $model->first_name,
					'id_class' => $model->id_class])
				->exists();
			if ($row === FALSE)
			// 2- If not, save the model (create it)
			$model->save();
			// 3- Open session
			$session = Yii::$app->session;
			$session->open();
			$session['first_name'] = $model->first_name;
			// 4- Redirect
					return $this->redirect(['answer']);
		} else {
			return $this->render('entry', ['model' => $model]);
		}
    }

	/*
	* List of series of problems
	*/
    public function actionProblems()
    {
    }

	/*
	* The student want to answer a give problem/serie of problems.
	*/
    public function actionAnswer()
    {
    	$model = new Answer;
		if ($model->load(Yii::$app->request->post())
			&& $model->validate()) {
			$model->save();
			return $this->redirect('index.php?r=answer/index');//, ['model' => $model]);
		} else {
			return $this->render('answer', ['model' => $model]);
		}
    }

}

