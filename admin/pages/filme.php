<!DOCTYPE html>
<html>
	<?php
	$titlu = "Filme săptămânale";
	$css ="  <!-- fullCalendar -->
	<link href='plugins/fullcalendar/core/main.css' rel='stylesheet' />
	<link href='plugins/fullcalendar/daygrid/main.css' rel='stylesheet' />
	<link href='plugins/fullcalendar/timegrid/main.css' rel='stylesheet' />
	<link href='plugins/fullcalendar/list/main.css' rel='stylesheet' />";
	include('includes/head.php');
	
/*
$datetime_string = date('c',time());    

if(isset($_POST['action']) or isset($_GET['view']))
{
    if(isset($_GET['view']))
    {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($con,$_GET["start"]);
        $end = mysqli_real_escape_string($con,$_GET["end"]);
        
        $result = mysqli_query($con,"SELECT `id`, `start` ,`end` ,`title` FROM  `filme` where (date(start) >= '$start' AND date(start) <= '$end')");
        while($row = mysqli_fetch_assoc($result))
        {
            $events[] = $row; 
        }
        echo json_encode($events); 
        exit;
    }
    elseif($_POST['action'] == "add")
    {   
        mysqli_query($con,"INSERT INTO `filme` (
                    `title` ,
                    `start` ,
                    `end` 
                    )
                    VALUES (
                    '".mysqli_real_escape_string($con,$_POST["title"])."',
                    '".mysqli_real_escape_string($con,date('Y-m-d H:i:s',strtotime($_POST["start"])))."',
                    '".mysqli_real_escape_string($con,date('Y-m-d H:i:s',strtotime($_POST["end"])))."'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"'.mysqli_insert_id($con).'"}';
        exit;
    }
    elseif($_POST['action'] == "update")
    {
        mysqli_query($con,"UPDATE `filme` set 
            `start` = '".mysqli_real_escape_string($con,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
            `end` = '".mysqli_real_escape_string($con,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' 
            where uid = '".mysqli_real_escape_string($con,$uid)."' and id = '".mysqli_real_escape_string($con,$_POST["id"])."'");
        exit;
    }
    elseif($_POST['action'] == "delete") 
    {
        mysqli_query($con,"DELETE from `filme` where uid = '".mysqli_real_escape_string($con,$uid)."' and id = '".mysqli_real_escape_string($con,$_POST["id"])."'");
        if (mysqli_affected_rows($con) > 0) {
            echo "1";
        }
        exit;
    }
}
*/
	?>

	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<?php
			include('includes/navbar.php');
			include('includes/sidebar.php');
			?>
			
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<?php include('includes/content-header.php');?>

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="card card-primary">
									<div class="card-body p-0">
										<!-- THE CALENDAR -->
										<div id="calendar"></div>
									</div>
									<!-- /.card-body -->
								</div>
								<!-- /.card -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- /.content -->

				
				<!-- Modal vizualizare eveniment-->
				<div class="modal fade" id="info-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Informații eveniment</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input type="hidden" id="eventID"/>
								<div class="row">
									<p>Titlu: &nbsp</p>
									<b id="modalTitle"></b>
								</div>
								<div class="row">
									<p>Regia: &nbsp</p>
									<b id="regia"></b>
								</div>
								<div class="row">
									<p>URL trailer: &nbsp</p>
									<b id="trailer"></b>
								</div>
								<div class="row">
									<p>URL imagine: &nbsp</p>
									<b id="imagine"></b>
								</div>
								<div class="row">
									<p>Preț bilet: &nbsp</p>
									<b id="pret"></b>
								</div>
								<div class="row">
									<p>Descriere: &nbsp</p>
									<b id="descriere"></b>
								</div>
								<div class="row">
									<p>Durată: &nbsp</p>
									<b id="modalWhen"><b>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
								<button type="button" class="btn btn-danger" id="sterge">Șterge</button>
							</div>
						</div>
					</div>
				</div>
				<!--Modal-->
				
				<!-- Modal adaugare eveniment-->
				<div class="modal fade" id="adauga-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Adăugare film</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="control-group">
									<label class="control-label" for="inputPatient">Titlu:</label>
									<div class="field desc">
										<input class="form-control" id="titlu-adaugare" name="titlu-adaugare" placeholder="Adăugați titlul" type="text">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPatient">Regia:</label>
									<div class="field desc">
										<input class="form-control" id="regia-adaugare" name="regia-adaugare" placeholder="Adăugați regia" type="text">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPatient">Gen film:</label>
									<div class="field desc">
										<input class="form-control" id="gen-adaugare" name="gen-adaugare" placeholder="Adăugați genul" type="text">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPatient">Trailer:</label>
									<div class="field desc">
										<input class="form-control" id="trailer-adaugare" name="trailer-adaugare" placeholder="Adăugați un link catre trailer-ul filmului" type="text">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPatient">Imagine:</label>
									<div class="field desc">
										<input class="form-control" id="imagine-adaugare" name="imagine-adaugare" placeholder="Adăugați un link catre imaginea filmului" type="text">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPatient">Preț:</label>
									<div class="field desc">
										<input type="number" class="form-control" id="pret-adaugare" name="pret-adaugare" placeholder="Adăugați prețul biletului" type="text">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPatient">Descriere:</label>
									<div class="field desc">
										<textarea class="form-control" id="descriere-adaugare" name="descriere-adaugare" placeholder="Adăugați descrierea" type="text"></textarea>
									</div>
								</div>
								
								<input type="hidden" id="startTime"/>
								<input type="hidden" id="endTime"/>
								
								
						   
							<div class="control-group">
								<label class="control-label" for="when">Durată:</label>
								<div class="controls controls-row" id="when" style="margin-top:5px;">
								</div>
							</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" id="submitButton">Save</button>
							</div>
						</div>
					</div>
				</div>
				<!--Modal-->

			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- ./wrapper -->
	</body>
	<?php 
	include('includes/footer.php');
	$script = "<script src='plugins/fullcalendar/core/main.js'></script>
<script src='plugins/fullcalendar/interaction/main.js'></script>
<script src='plugins/fullcalendar/moment/main.js'></script>
<script src='plugins/fullcalendar/daygrid/main.js'></script>
<script src='plugins/fullcalendar/timegrid/main.js'></script>
<script src='plugins/fullcalendar/list/main.js'></script>
<script src='plugins/fullcalendar/core/locales/ro.js'></script>
<script src='plugins/fullcalendar/moment.min.js'></script>
<script src='https://momentjs.com/downloads/moment-with-locales.js'></script>

	";
	include('includes/scripts.php');
	?>
<script>
$("input").prop('required',true);
	
document.addEventListener('DOMContentLoaded', function() {
    moment.locale('ro');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'timeGrid', 'list', 'interaction'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        defaultView: 'timeGridWeek',
		hiddenDays: [1,2],
        editable: true,
        allDay: true,
        locale: 'ro',
        selectable: true,
        resizable: true,
        selectHelper: true,
        minTime: "07:00:00",
        maxTime: "22:00:00",
        // validRange: {
            // start: <?php echo "'".date('Y-m-d')."'"; ?>
        // },
        defaultDate: <?php echo "'".date('Y-m-d')."'"; ?> ,
        slotDuration : '00:15:00',
        navLinks: true, // can click day/week names to navigate views
        eventLimit: true, // allow "more" link when too many events
        events: {
            url: "calendar-afisare",
            failure: function(error) {
                console.log(error);
                alert("Error", "Unable to fetch events", "red");
            }
        },
		
        //Actiune pentru afisarea event-urilor
        eventClick: function(info) {
			// alert(JSON.stringify(info.event.extendedProps));
            var inceput = moment(info.event.start).format('dddd, Do MMMM YYYY, h:mm');
            var sfarsit = moment(info.event.end).format('h:mm');
            var interval = inceput + ' - ' + sfarsit;
            $('#modalTitle').html(info.event.title);
			$('#regia').html(info.event.extendedProps.regia);
			$('#gen').html(info.event.extendedProps.gen);
			$('#descriere').html(info.event.extendedProps.descriere);
			$('#trailer').html(info.event.extendedProps.trailer);
			$('#imagine').html(info.event.extendedProps.imagine);
			$('#pret').html(info.event.extendedProps.pret);
            $('#modalWhen').text(interval);
            $('#eventUrl').attr('href', info.event.url);
			$('#eventID').val(info.event.id);
            $('#info-event').modal();
        },
		
        //Actiune afisare event
        select: function(info) {
            var inceput = moment(info.startStr).format('dddd, Do MMMM YYYY, h:mm');
            var sfarsit = moment(info.endStr).format('dddd, Do MMMM YYYY, h:mm');
            var interval2 = inceput + ' - ' + sfarsit;

            $('#adauga-event #startTime').val(info.startStr);
            $('#adauga-event #endTime').val(info.endStr);
            $('#adauga-event #when').text(interval2);
            $('#adauga-event').modal('toggle');
        },

        //Actiunea pentru dragging
        eventDrop: function(info) {
            $.ajax({
                url: 'calendar-actiune',
                data: 'actiune=actualizare&title=' + info.event.title + '&start=' + info.event.start.toISOString() + '&end=' + info.event.end.toISOString() + '&id=' + info.event.id,
                type: "POST",
                error: function(xhr, status, error) {
                    alert(status);
                    alert(xhr.responseText);
                },
                success: function(json) {
                    // alert(json);
                }
            });
            // alert(info.event.title + " was dropped on " + info.event.start.toISOString());
        }

    });
	
    $('#submitButton').on('click', function(e) {
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doSubmit();
    });

    $('#sterge').on('click', function(e) {
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doDelete();
		calendar.render();
    });
	
    function doDelete() {
        var eventID = $('#eventID').val();
		
        $.ajax({
            url: 'calendar-actiune',
            data: 'actiune=sterge&id=' + eventID,
            type: "POST",
            success: function(json) {
                if (json == 1){
					//Reimprospatam calendarul
					calendar.refetchEvents();
					//Inchidem modalul
					$('#info-event').modal('hide');
				} else
                    return false;
            }
        });
    }

    function doSubmit() {
        var title       = $('#titlu-adaugare').val();
        var regia       = $('#regia-adaugare').val();
        var gen         = $('#gen-adaugare').val();
        var descriere   = $('#descriere-adaugare').val();
        var url_trailer = $('#trailer-adaugare').val();
        var url_imagine = $('#imagine-adaugare').val();
        var pret        = $('#pret-adaugare').val();
        var startTime   = $('#startTime').val();
        var endTime     = $('#endTime').val();

        $.ajax({
            url: 'calendar-actiune',
            data: 'actiune=adaugare&title=' + title + '&regia=' + regia +'&gen=' + gen +'&descriere=' + descriere +'&url_trailer=' + url_trailer +'&url_imagine=' + url_imagine +'&pret=' + pret + '&start=' + startTime + '&end=' + endTime,
            type: "POST",
            error: function(xhr, status, error) {
                alert(status);
                alert(xhr.responseText);
            },
            success: function(json) {
                //Reimprospatam calendarul
				$('#adauga-event').modal('toggle');
				$('input[type="text"], textarea').val('');
                calendar.refetchEvents();
            }
        });
        calendar.render();
    }

    calendar.render();
});
</script>

</html>