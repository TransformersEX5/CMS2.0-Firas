<?php

namespace app\modules\creditcontrol\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

use yii\web\View;
use app\models\Tblprogramregister;
use app\models\Tbldebtoraction;

use yii\bootstrap5\ActiveForm;
use yii\web\Response;
use yii\helpers\FileHelper;




/**
 * Default controller for the `creditcontrol` module
 */
class FollowupController extends Controller
{

    public $layout = '@app/views/layouts/lexapurple_layouts';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }



    public function actionFollowup()
    {
        $model = new Tbldebtoraction();

        $data = Yii::$app->request->post();


        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            
            

            Tbldebtoraction::updateAll(['CurrentStatusId' => 0], ['ProgramRegId'=>yii::$app->request->get('id')]);

            $model->ProgramRegId =  yii::$app->request->get('id');
            $model->OutsAmt =  yii::$app->request->get('studouts') ;  
            $model->CurrentStatusId = 1 ;  

            $model->UserId = Yii::$app->user->identity->UserId;
            Yii::$app->response->format = Response::FORMAT_JSON;
           
            
            if ($model->save()) {
                return ['success' => true];
            } else {
                return $model->getErrors();
            }
        }

        return $this->renderAjax('followup', ['model' => $model]);
    }


    
    public function actionFollowupview()
    {
        $followupid = yii::$app->request->get('followupid');

        $model = Tbldebtoraction::findOne($followupid) ; 
       
        return $this->renderAjax('followup', ['model' => $model]);
    }

    public function actionFollowupdelete()
    {
        $followupid = yii::$app->request->get('followupid');
        $programRegId = yii::$app->request->get('id');


     

        
        $model = Tbldebtoraction::findOne($followupid) ; 

        Yii::$app->response->format = Response::FORMAT_JSON;
       
        if ($model->delete()) {

            $maxFollowupId = TblDebtorAction::find()
            ->where(['ProgramRegId' => $programRegId])
            ->orderBy(['FollowupId' => SORT_DESC])
            ->limit(1)
            ->one();
          


        // Update TblDebtorAction if the maximum FollowupId exists
        if ($maxFollowupId !== null) {
            TblDebtorAction::updateAll(['CurrentStatusId' => 1], ['FollowupId' => $maxFollowupId]);
        }
            
            return ['success' => true];
        } else {
            return $model->getErrors();
        }
    }

      
    public function afterDelete()
    {
        parent::afterDelete();

        // Find the maximum ID among records with 'ProgramRegId' equal to the deleted record's ID
        $maxIdRecord = Tbldebtoraction::find()
            ->where(['ProgramRegId' => yii::$app->request->get('id')])
            ->orderBy(['FollowupId' => SORT_DESC])
            ->limit(1)
            ->one();

        // Update TblDebtorAction if the record with the maximum ID exists
        if ($maxIdRecord !== null) {
            TblDebtorAction::updateAll(['CurrentStatusId' => 1], ['FollowupId'=>$maxIdRecord['FollowupId']]);
        }
    
    }
    
    public function beforeAction($action)
    {
        if (!isset(Yii::$app->user->identity->UserId)) {
            //echo '<script>alert("login lah");</script>';
            return Yii::$app->response->redirect(['site/login'])->send();
        }

        return parent::beforeAction($action);
    }
}
