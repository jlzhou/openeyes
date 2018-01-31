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
?>

<section class="element">
  <div class="element-data element-eyes row">
    <div class="element-eye right-eye column">
      <div class="element-header right-side">
        <h4>Right side</h4>
      </div>
        <?php if ($element->hasRight()) {
            $this->renderPartial('form_Element_OphTrOperationnote_Biometry_Data_Fields',
                array('side' => 'right', 'element' => $element));
        } else { ?>
          <div class="data-value">Not recorded</div>
        <?php } ?>
    </div>
    <div class="element-eye left-eye column">
      <div class="element-header left-side">
        <h4>Left side</h4>
      </div>
        <?php if ($element->hasLeft()) {
            $this->renderPartial('form_Element_OphTrOperationnote_Biometry_Data_Fields',
                array('side' => 'left', 'element' => $element));
        } else { ?>
          <div class="data-value">Not recorded</div>
        <?php } ?>
    </div>
  </div>
</section>