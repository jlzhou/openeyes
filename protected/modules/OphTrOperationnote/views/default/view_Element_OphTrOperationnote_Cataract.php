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
  <header class="element-header">
    <h3 class="element-title"><?php echo $element->elementType->name ?></h3>
  </header>
  <section class="element-fields full-width">
    <div class="row highlight-container">
      <div class="cols-6 column data-value highlight">
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('incision_site_id')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo $element->incision_site->name ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('length')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo $element->length ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('meridian')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo $element->meridian ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('incision_type_id')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo $element->incision_type->name ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('report2')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo CHtml::encode($element->report2) ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_type_id')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value">
                <?php echo $element->iol_type ? $element->iol_type->display_name : 'None'; ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_power')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo CHtml::encode($element->iol_power) ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('predicted_refraction')) ?>:
            </div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo CHtml::encode($element->predicted_refraction) ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_position_id')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo CHtml::encode($element->iol_position->name) ?></div>
          </div>
        </div>
        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('pcr_risk')) ?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo CHtml::encode($element->pcr_risk) ?></div>
          </div>
        </div>

        <div class="row">
          <div class="cols-4 column">
            <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('phaco_cde'))?>:</div>
          </div>
          <div class="cols-8 column">
            <div class="data-value"><?php echo $element->phaco_cde != '' ? CHtml::encode($element->phaco_cde) : 'not recorded'?></div>
          </div>
        </div>

          <?php if ($element->getSetting('fife')) { ?>
            <div class="row">
              <div class="cols-4 column">
                <div
                    class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('intraocular_solution_id')) ?>
                  :
                </div>
              </div>
              <div class="cols-8 column">
                <div
                    class="data-value"><?php echo $element->intraocular_solution ? $element->intraocular_solution->name : 'Not specified' ?></div>
              </div>
            </div>
            <div class="row">
              <div class="cols-4 column">
                <div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('skin_preparation_id')) ?>
                  :
                </div>
              </div>
              <div class="cols-8 column">
                <div
                    class="data-value"><?php echo $element->skin_preparation ? $element->skin_preparation->name : 'Not specified' ?></div>
              </div>
            </div>
          <?php } ?>
      </div>
      <div class="cols-6 column">
          <?php
          $this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
              'idSuffix' => 'Cataract',
              'side' => $element->eye->getShortName(),
              'mode' => 'view',
              'width' => 200,
              'height' => 200,
              'model' => $element,
              'attribute' => 'eyedraw',
          ));
          ?>
          <?php
          $this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
              'idSuffix' => 'Position',
              'side' => $element->eye->getShortName(),
              'mode' => 'view',
              'width' => 200,
              'height' => 200,
              'model' => $element,
              'attribute' => 'eyedraw2',
          ));
          ?>
      </div>
    </div>

    <div class="row">
      <div class="cols-4 column">
        <h3 class="data-label">Cataract report</h3>
        <div class="data-value highlight">
            <?= nl2br(CHtml::encode($element->report)); ?>
        </div>
      </div>
      <div class="cols-4 column">
        <h3 class="data-label">Agent(s)</h3>
        <div class="data-value highlight">
            <?php if (!$element->operative_devices) { ?>
              None
            <?php } else { ?>
                <?php foreach ($element->operative_devices as $device) { ?>
                    <?php echo $device->name ?><br/>
                <?php } ?>
            <?php } ?>
        </div>
      </div>
      <div class="cols-3 column left">
        <h3 class="data-label">Cataract complications</h3>
        <div class="data-value highlight">
            <?php if (!$element->complications && !$element->complication_notes) { ?>
              None
            <?php } else { ?>
                <?php foreach ($element->complications as $complication) { ?>
                    <?php echo $complication->name ?><br/>
                <?php } ?>
                <?php echo CHtml::encode($element->complication_notes) ?>
            <?php } ?>
        </div>
      </div>
    </div>
  </section>
</section>
