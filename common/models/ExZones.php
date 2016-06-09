<?php
namespace common\models;

use common\models\AdminCompanies;
use common\models\Zones;
use Yii;

/**
 * @property AdminCompanies[] $admins
 */
class ExZones extends Zones
{
    private $_linkedAdmins;

    public function addAdmin(AdminCompanies $admin)
    {
        $this->_linkedAdmins[$admin->companies_id] = $admin;
    }

    public function getAdmins()
    {
        return $this->_linkedAdmins;
    }

    public function fields()
    {
        return array_merge(parent::fields(), [
            'admins' => function () {
                return array_map(function (AdminCompanies $admin) {
                    return $admin->toArray(['companies_id', 'name', 'default_provider']);
                }, $this->admins);
            }
        ]);
    }
}