<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Key Performance Indicator</h1>
						<?php
							$link = null;

							if (!$chart_pgw)
							{
								$link = $kpi->divisi;
							}
							else
							{
								$link = '0/'.$id_pgw;
							}
						?>
						<a href="<?php echo base_url("admin/kpi/cetak/".$link);?>" style="margin-left:2px" class="btn btn-primary">CETAK</a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-table"></i>
										Muhasabah
									</h3>
								</div>
							<div id="muhasabah" class='flot'></div>
						</div>
					</div>
					<div class="span6">
						<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-table"></i>
										Presensi
									</h3>
								</div>
							<div id="presensi" class='flot'></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	<script type="text/javascript">
	(function ($) {
		var i = 0
		var series = [{
			data: [
			<?php
			if (count($kpi->muhasabah) > 0)
			{
				$i = 1;
				foreach ($kpi->muhasabah as $mhb)
				{
			?>
			[<?php echo $i++; ?>, <?php echo number_format($mhb['kpi'],2); ?>],
			<?php
				}
			}
			?>
			],
			label: 'Tahun Ini (%)'
		}];

		var options = {
			xaxis: {
				ticks: [
				['1', 'Jan'],
				['2', 'Feb'],
				['3', 'Mar'],
				['4', 'Apr'],
				['5', 'Mei'],
				['6', 'Jun'],
				['7', 'Jul'],
				['8', 'Agus'],
				['9', 'Sept'],
				['10', 'Okt'],
				['11', 'Nov'],
				['12', 'Des']
				]
			},
			series: {
				bars: {
					show: true,
					barWidth: .9,
					align: "center"
				},
				stack: 0
			}
		};

		$.plot("#muhasabah", series, options);
	})(jQuery);

	(function ($) {
		var i = 0
		var series = [{
			data: [
			<?php
			if (count($kpi->presensi) > 0)
			{
				$i = 1;
				foreach ($kpi->presensi as $prs)
				{
			?>
			[<?php echo $i++; ?>, <?php echo number_format($prs['kpi'],2); ?>],
			<?php
				}
			}
			?>
			],
			label: 'Tahun Ini (%)'
		}];

		var options = {
			xaxis: {
				ticks: [
				['1', 'Jan'],
				['2', 'Feb'],
				['3', 'Mar'],
				['4', 'Apr'],
				['5', 'Mei'],
				['6', 'Jun'],
				['7', 'Jul'],
				['8', 'Agus'],
				['9', 'Sept'],
				['10', 'Okt'],
				['11', 'Nov'],
				['12', 'Des']
				]
			},
			series: {
				bars: {
					show: true,
					barWidth: .9,
					align: "center"
				},
				stack: 0
			}
		};

		$.plot("#presensi", series, options);
	})(jQuery);
	
</script>
	</body>

	</html>