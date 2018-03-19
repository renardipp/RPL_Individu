<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property int $branch_id
 * @property int $company_id
 * @property string $branch_name
 * @property string $branch_address
 *
 * @property Companies $company
 * @property Departments[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'company_id'], 'required'],
            [['branch_id', 'company_id'], 'integer'],
            [['branch_name', 'branch_address'], 'string', 'max' => 50],
            [['branch_id'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'company_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'company_id' => 'Company ID',
            'branch_name' => 'Branch Name',
            'branch_address' => 'Branch Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['branch_id' => 'branch_id']);
    }
}
