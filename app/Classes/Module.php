<?php

namespace App\Classes;

use Nwidart\Modules\Facades\Module as ModuleBase;

class Module extends ModuleBase
{
    /**
     * Checks if given module is enabled
     *
     * @param $moduleName
     * @return bool
     */
    function isEnabled()
    {
        $enabledModules = self::allEnabled();

        foreach ($enabledModules as $module) {
            if (strtolower($module->getName()) === strtolower($this->getName())) {
                return true;
            }
        }

        return false;
    }

    public static function enabledCount()
    {
        return count(self::allEnabled());
    }

    public static function disabledCount()
    {
        return count(self::allDisabled());
    }


    public static function addToModulesStatuses($fileName)
    {
        $modulesStatuses = json_decode(file_get_contents(base_path() . '/modules_statuses.json'));
        $modulesStatuses->$fileName = true;
        $modulesStatuses = json_encode($modulesStatuses, JSON_PRETTY_PRINT);
        file_put_contents(base_path() . '/modules_statuses.json', $modulesStatuses);
    }
}
