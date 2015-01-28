<?php
/* draws a calendar */
function draw_calendar_before($month,$tahun,$tanggal)
{
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	date_default_timezone_set("Asia/Jakarta"); 
	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$tahun));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$tahun));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
	
	$tgl_array = array(); 
	foreach ($tanggal as $date) 
	{
		$tgl_array[] = $date->tanggal;
	}
	

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if ($list_day > 20)
		{
			if (in_array($list_day, $tgl_array)) 
			{
				$calendar.= '<td class="calendar-day-done">Sudah di isi';
				/* add in the day number */
				$calendar.= '<div><a class="day-number">'.$list_day.'</a></div>';
	
				/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
				//$calendar.= str_repeat('<p> </p>',2);
				
			}
			else
			{
				$calendar.= '<td class="calendar-day">Belum di isi';
				/* add in the day number */
				$calendar.= '<div><a class="day-number" href="'.base_url().'admin/muhasabah/tambah/'.$list_day.'/'.$month.'">'.$list_day.'</a></div>';
	
				/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
				//$calendar.= str_repeat('<p> </p>',2);
			}
		}
		else
		{
			$calendar.= '<td class="calendar-day-false">Tidak bisa di isi';
			/* add in the day number */
			$calendar.= '<div><a class="day-number">'.$list_day.'</a></div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			//$calendar.= str_repeat('<p> </p>',2);
		}

		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

/* draws a calendar */
function draw_calendar_now($month,$tahun,$tanggal,$date_now)
{
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	date_default_timezone_set("Asia/Jakarta"); 
	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$tahun));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$tahun));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
	
	$tgl_array = array(); 
	foreach ($tanggal as $date) 
	{
		$tgl_array[] = $date->tanggal;
	}
	

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if ($date_now < 21) 
		{
			if ($list_day < 21)
			{
				if (in_array($list_day, $tgl_array)) 
				{
					$calendar.= '<td class="calendar-day-done">Sudah di isi';
					/* add in the day number */
					$calendar.= '<div><a class="day-number">'.$list_day.'</a></div>';
		
					/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
					//$calendar.= str_repeat('<p> </p>',2);
					
				}
				else
				{
					$calendar.= '<td class="calendar-day">Belum di isi';
					/* add in the day number */
					$calendar.= '<div><a class="day-number" href="'.base_url().'admin/muhasabah/tambah/'.$list_day.'/'.$month.'">'.$list_day.'</a></div>';
		
					/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
					//$calendar.= str_repeat('<p> </p>',2);
				}
			}
			else
			{
				$calendar.= '<td class="calendar-day-false">Belum bisa di isi';
				/* add in the day number */
				$calendar.= '<div><a class="day-number">'.$list_day.'</a></div>';
	
				/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
				//$calendar.= str_repeat('<p> </p>',2);
			}
		}
		else
		{
			if ($list_day > 20)
			{
				if (in_array($list_day, $tgl_array)) 
				{
					$calendar.= '<td class="calendar-day-done">Sudah di isi';
					/* add in the day number */
					$calendar.= '<div><a class="day-number">'.$list_day.'</a></div>';
	
					/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
					//$calendar.= str_repeat('<p> </p>',2);
					
				}
				else
				{
					$calendar.= '<td class="calendar-day">Belum di isi';
					/* add in the day number */
					$calendar.= '<div><a class="day-number" href="'.base_url().'admin/muhasabah/tambah/'.$list_day.'/'.$month.'">'.$list_day.'</a></div>';
		
					/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
					//$calendar.= str_repeat('<p> </p>',2);
				}
			}
			else
			{
				$calendar.= '<td class="calendar-day-false">Tidak bisa di isi';
				/* add in the day number */
				$calendar.= '<div><a class="day-number">'.$list_day.'</a></div>';

				/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
				//$calendar.= str_repeat('<p> </p>',2);
			}
		}

		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}
?>

		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Muhasabah</h1>
					</div>
				</div>
				<?php
					if ($date_now < 21) 
					{
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-calendar"></i><?php echo $nama_bulan_s; ?></h3>
							</div>
							<div class="box-content nopadding">
								<div>
									<?php
										echo draw_calendar_before($bulan-1,$tahun,$tanggal->tgl_before);
									?>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-calendar"></i><?php echo $nama_bulan; ?></h3>
							</div>
							<div class="box-content nopadding">
								<div>
									<?php
										echo draw_calendar_now((int)$bulan,$tahun,$tanggal->tgl,$date_now);
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <?php //akhir div container content ?>
	</body>

	</html>