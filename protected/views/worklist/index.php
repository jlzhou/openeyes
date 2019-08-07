<?php
/**
 * @var Worklist[] $worklists
 */
?>

<div class="oe-full-header flex-layout">
    <div class="title wordcaps">Worklists</div>
</div>

<div class="oe-full-content subgrid oe-worklists">

    <nav class="oe-full-side-panel">
        <p>Automatic Worklists</p>
        <div class="row">
            <?php $this->renderPartial('//site/change_site_and_firm', array('returnUrl' => Yii::app()->request->url, 'mode' => 'static')); ?>
        </div>
        <h3>Filter by Date</h3>
        <div class="flex-layout">
            <input id="worklist-date-from" class="cols-4" placeholder="from" type="text" value="<?= @$_GET['date_from'] ?>">
            <input id="worklist-date-to" class="cols-4" placeholder="to" type="text" value="<?= @$_GET['date_to'] ?>">
            <a href="#" class="selected js-clear-dates" id="sidebar-clear-date-ranges">All dates</a>
        </div>

        <h3>Select list</h3>
        <ul>
            <li><a class="js-worklist-filter" href="#" data-worklist="all">All</a></li>
            <?php foreach ($worklists as $worklist) : ?>
                <li><a href="#" class="js-worklist-filter"
                       data-worklist="js-worklist-<?= $worklist->id ?>"><?= $worklist->name ?>  : <?= $worklist->getDisplayShortDate() ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <main class="oe-full-main">
        <?php foreach ($worklists as $worklist) : ?>
            <?php echo $this->renderPartial('_worklist', array('worklist' => $worklist)); ?>
        <?php endforeach; ?>
    </main>
</div>
<script type="text/javascript">
    $(function () {

        pickmeup('#worklist-date-from', {
            format: 'd b Y',
            hide_on_select: true,
            date: $('#worklist-date-from').val(),
            default_date: false,
        });
        pickmeup('#worklist-date-to', {
            format: 'd b Y',
            hide_on_select: true,
            date: $('#worklist-date-to').val(),
            default_date: false,
        });

        $('#worklist-date-from, #worklist-date-to').on('pickmeup-change change', function () {
            window.location.href = jQuery.query
                .set('date_from', $('#worklist-date-from').val())
                .set('date_to', $('#worklist-date-to').val());
        });

        const worklist_selected = $.cookie("worklist_selected");
        if(worklist_selected){
            updateWorkLists(worklist_selected);
            $('.js-worklist-filter').filter('[data-worklist="'+worklist_selected+'"]').addClass('selected');
        }
    });

    $('.js-clear-dates').on('click', () => {
        $('#worklist-date-from').val(null);
        $('#worklist-date-to').val(null);

        window.location.href = '/worklist/cleardates';
    });

    $('.js-worklist-filter').click(function (e) {
        e.preventDefault();
        resetFilters();
        $(this).addClass('selected');
        updateWorkLists($(this).data('worklist'));
        $.cookie('worklist_selected', $(this).data('worklist'));
    });

    function resetFilters() {
        $('.js-worklist-filter').removeClass('selected');
    }

    function updateWorkLists(listID) {
        if (listID == 'all') {
            $('.worklist-group').show();
        } else {
            $('.worklist-group').hide();
            $('#' + listID + '-wrapper').show();
        }
    }
</script>
