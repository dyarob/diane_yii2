<?php

namespace app\controllers;

use Yii;
use app\models\Student;
use app\models\StudentSearch;
use app\models\Answer;
use app\models\Serie;
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
				->select('id')
				->from('students')
				->where(['first_name' => $model->first_name,
					'id_class' => $model->id_class])
				->one();
			// 2- If not, save the model (create it)
			if ($row === FALSE)
			{
				$model->save();
				$row = (new \yii\db\Query())
					->select('id')
					->from('students')
					->where(['first_name' => $model->first_name,
						'id_class' => $model->id_class])
					->one();
			}
			$model->id = $row['id'];
			// 3- Open session
			$session = Yii::$app->session;
			$session->open();
			$session['student'] = $model;
			// 4- Redirect
					return $this->redirect(['chooseserie']);
		} else {
			return $this->render('entry', ['model' => $model]);
		}
    }

	public function actionChooseserie()
	{
		if (isset($_POST['serie1']))
			return $this->redirect(['answer', 'id_serie' => 1]);
		return $this->render('chooseserie');
	}

	/*
	* The student want to answer a give problem/serie of problems.
	*/
    public function actionAnswer($id_serie)
    {
		$_SESSION = Yii::$app->session;
/*
		if ($id_serie != 0)
		{
			$serie = Serie::find()
				->where(['id' => $id_serie])
				->one();
			$problems = (new \yii\db\Query())
				->select('*')
				->from('problems')
				->where(['id_serie' => $id_serie])
				->all();
			$prob_counter = $serie->nbr_of_problems;
			$id_serie = 0;
		}
		--$prob_counter;
*/
		$nbs_problem = array('15'=>'N1', '24'=>'N2', '1'=>'un');
		$model = new Answer;
		if ($model->load(Yii::$app->request->post()) && $model->validate())
		{
			$model->id_student = $_SESSION['student']->id;
			$model->save();
			$model->analyse($nbs_problem);
			$model->save();
//			if ($prob_counter <= 0)
//			{
				//Yii::$app->session->close();
				return $this->redirect('index.php?r=student/entry');
//			}
		}
		return $this->render('answer',
				['model' => $model,
/*				'problems' => $problems,
				'serie' => $serie,
				'prob_counter' => $prob_counter,
				'id_serie' => $id_serie
*/
				]);
    }

}

