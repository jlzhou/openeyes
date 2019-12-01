<?php
/**
 * OpenEyes.
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.openeyes.org.uk
 *
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */

return array(
    'eo1' => array(
        'event_id' => 1,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 5,
        'anaesthetist_required' => 0,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo2' => array(
        'event_id' => 2,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 1,
        'anaesthetist_required' => 0,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo3' => array(
        'event_id' => 3,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 1,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo4' => array(
        'event_id' => 4,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 1,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo5' => array(
        'event_id' => 5,
        'eye_id' => 1,
        'consultant_required' => 0,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 1,
        'anaesthetist_required' => 0,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo6' => array(
        'event_id' => 6,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 6,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo7' => array(
        'event_id' => 7,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 1,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo8' => array(
        'event_id' => 8,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 2,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00', time() + 10),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo9' => array(
        'event_id' => 9,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 3,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00', time() + 20),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo10' => array(
        'event_id' => 10,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 4,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00', time() + 30),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo11' => array(
        'event_id' => 11,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 5,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00', time() + 40),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo12' => array(
        'event_id' => 12,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 6,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'booking_cancellation_date' => '2013-05-05 12:30:00',
        'created_date' => date('Y-m-d 00:00:00', time() + 50),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo13' => array(
        'event_id' => 1,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 1,
        'anaesthetist_required' => 0,
        'operation_cancellation_date' => null,
        'created_date' => date('Y-m-d 00:00:00'),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
    'eo14' => array(
        'event_id' => 12,
        'eye_id' => 1,
        'consultant_required' => 1,
        'overnight_stay' => 0,
        'site_id' => 1,
        'priority_id' => 1,
        'decision_date' => date('Y-m-d'),
        'comments' => 'Test comments',
        'total_duration' => 100,
        'status_id' => 2,
        'anaesthetist_required' => 1,
        'operation_cancellation_date' => null,
        'booking_cancellation_date' => '2013-05-05 12:30:00',
        'created_date' => date('Y-m-d 00:00:00', time() + 50),
        'last_modified_date' => date('Y-m-d 00:00:00'),
    ),
);
