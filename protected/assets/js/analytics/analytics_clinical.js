var analytics_clinical = (function () {
	var init = function (flag, custom_data) {
		// get clinical data
		var clinical_data = analytics_dataCenter.clinical.getClinicalData();

		// force csv update the data inside
		analytics_csv_download()

		// get clinical plot layout settings
		var clinical_layout = JSON.parse(JSON.stringify(analytics_layout));
		// to be used to get margin left value
		var max_name_length = Math.max(...clinical_data['text'].map(function (item) {
			return item.length;
		}));

        // set up plot data
		var data = [{
			name: clinical_data['title'],
			x: clinical_data['x'],
			y: clinical_data['y'],
			customdata: clinical_data['customdata'],
			type: 'bar',
			hoverinfo: 'x+y',
			orientation: 'h'
		}];
		clinical_layout['margin']['l'] = max_name_length * 7;
		clinical_layout['xaxis']['showticksuffix'] = 'none';
		clinical_layout['xaxis']['title'] = 'Number of Patient';
		clinical_layout['xaxis']['tick0'] = 0;
		clinical_layout['yaxis']['showgrid'] = false;
		clinical_layout['yaxis']['tickvals'] = clinical_data['y'];
		clinical_layout['yaxis']['ticktext'] = clinical_data['text'];
		clinical_layout['clickmode'] = 'event';
		if (flag === 'update') {
            // if the drill down has further plot
			if ('text' in custom_data && 'customdata' in custom_data) {
				clinical_data['y'] = $('#js-hs-chart-analytics-clinical')[0].layout['yaxis']['tickvals'];
				clinical_data['text'] = $('#js-hs-chart-analytics-clinical')[0].layout['yaxis']['ticktext'];
				$('#js-back-to-common-disorder').show();
				//click on "other" bar, redraw the chart show details of other disorders.
				custom_data['type'] = 'bar';
				custom_data['orientation'] = 'h';
				custom_data['hoverinfo'] = 'x+y';
				clinical_layout['yaxis']['tickvals'] = custom_data['y'];
				clinical_layout['yaxis']['ticktext'] = custom_data['text'];

				Plotly.react(
					'js-hs-chart-analytics-clinical', [custom_data], clinical_layout, analytics_options
				);
			}
		} else {
			Plotly.newPlot(
				'js-hs-chart-analytics-clinical', data, clinical_layout, analytics_options
			);
		}
		$('#js-back-to-common-disorder').off('click').on('click', function () {
			$(this).hide();
			clinical_layout['yaxis']['tickvals'] = clinical_data['y'];
			clinical_layout['yaxis']['ticktext'] = clinical_data['text'];
			Plotly.react(
				'js-hs-chart-analytics-clinical', data, clinical_layout, analytics_options
			);
		});
	}

	return init
})()