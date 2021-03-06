<?php
namespace app\controllers;
use Yii;
use app\models\Teacher;
use app\models\TeacherSearch;
use app\models\SerieClassLink;
use app\models\TeacherLoginForm;
use app\models\Student;
use app\models\Clas;
use app\models\Serie;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends Controller
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
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Teacher model.
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
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teacher();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Teacher model.
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
     * Deletes an existing Teacher model.
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
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSignup()
    {
		$model = new Teacher();
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				// form inputs are valid, do something here
				if ($this->actionInsert($model) === TRUE);
					return $this->redirect(['dashboard']);
			}
		}
		return $this->render('signup', ['model' => $model]);
    }

    protected function actionInsert($model)
    {
		// 1- Verify if the student already exists
		$row = (new \yii\db\Query())
			->select('*')
			->from('teachers')
			->where(['login' => $model->login])
			->exists();
		if ($row === FALSE)
		{
			// 2- If not, save the model (create it)
			$model->save();
			
			// 3- Open session
			$session = Yii::$app->session;
			$session->open();
			$session['login'] = $model->login;
			return TRUE;
		}
		else
			return FALSE;
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new TeacherLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
		return $this->redirect(['dashboard']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionDashboard()
    {
		$model = Yii::$app->user->identity;
		$query = Student::find();
		$pagination = new Pagination([
			'defaultPageSize' => 20,
			'totalCount' => $query->count(),
		]);
		$myStudents = $query
			->where(['id_class' => Yii::$app->user->identity->clas])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->orderBy('first_name')
			->all();
		return $this->render('dashboard', [
			'teacher' => $model,
			'students' => $myStudents,
			'pagination' => $pagination,
			'selectedStudent' => NULL,
		]);
    }

	public function actionChooseseries()
	{
		$series = Serie::find()
			->all();
		// Register modifications
		if (isset($_POST['id_class']))
		{
			foreach ($_POST as $key=>$val)
			{	// Plaster as series with spaces in the names wouldn't work
				// as the sp get replaced by '_' in $_POST.
				// But now series with '_' in the names won't work.
				$new_key = str_replace("_", " ", $key);
				$_POST[$new_key] = $val;
			}
			foreach ($series as $s)
			{
				$link = SerieClassLink::find()
					->where(['id_serie' => $s->id,
							 'id_class' => $_POST['id_class']])
					->one();
				if (isset($_POST[$s->name]) && $link === NULL)
				{	// The link doesn't exist while it should
					// (the teacher selected a serie for the given class)
					$model = new SerieClassLink;
					$model->id_serie = $s->id;
					$model->id_class = $_POST['id_class'];
					$model->save();
				}
				else if (!isset($_POST[$s->name]) && $link !== NULL)
				{	// The link exist while it shouldn't anymore
					// (the teacher unselected a serie for the given class)
					$link->delete();
				}
			}
		}
		// (re-)Display form
		$query = Clas::find();
		$pagination = new Pagination([
			'defaultPageSize' => 20,
			'totalCount' => $query->count(),
		]);
		$myClasses = $query
			->where(['id_teacher' => Yii::$app->user->identity->id])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->orderBy('name')
			->all();
		return $this->render('chooseseries', [
			'classes' => $myClasses,
			'series' => $series,
			'pagination' => $pagination,
			'selectedStudent' => NULL,
			'post' => $_POST,
		]);
	}
}
