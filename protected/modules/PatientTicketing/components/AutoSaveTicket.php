<?php
/**
 * (C) OpenEyes Foundation, 2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (C) 2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

namespace OEModule\PatientTicketing\components;

class AutoSaveTicket
{
    public static function saveFormData($patient_id, $queue_id, $data)
    {
        $key = static::
            getAutoSaveKey($patient_id, $queue_id);
        \AutoSave::add($key, $data);
    }

    public static function getFormData($patient_id, $queue_id)
    {
        $key = static::getAutoSaveKey($patient_id, $queue_id);

        return \AutoSave::get($key);
    }

    public static function getAutoSaveKey($patient_id, $queue_id)
    {
        return $key = 'pt_'.$patient_id.'_'.$queue_id;
    }

    public static function clear()
    {
        \AutoSave::RemoveAllByPrefix('pt_');
    }
}
