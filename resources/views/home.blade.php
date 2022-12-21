<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>MBIFL</title>
    <link href="{{ asset('assets/css/front.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th class="td_pad">Date</th>
                            <th class="td_pad">Time</th>
                            <th class="td_pad">Venue</th>
                            <th class="td_pad">Topic</th>
                            <th class="td_pad">Speaker</th>
                           
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <th>Topic</th>
                            <th>Speaker</th>
                           
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr>
                            <td class="td_pad">{{@$schedule->schedule_date}}</td>
                            <td class="td_pad">{{@$schedule->schedule_time}}</td>
                            <td class="td_pad">{{@$schedule->venue}}</td>
                            <td class="td_pad">{{@$schedule->topic}}</td>
                            <td class="td_pad">{{@$schedule->speakers}}</td>
                           
                        </tr>
                    @endforeach
                    </tbody>
                   
                </table>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12">
                <div class="content">
                    <div class="text mb-5 text-center text_white">
                        © 2022 Mbifl. All Rights Reserved. Digitally Empowered by <a href="https://www.netventure.in/"> NetVenture Digital Solutions Pvt. Ltd. </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src=" https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
       $(document).ready(function () {

        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input class="foot_pad" type="text" placeholder="Search ' + title + '" />');
        });
    
        // DataTable
        var table = $('#example').DataTable({
            initComplete: function () {
                // Apply the search
                this.api()
                    .columns()
                    .every(function () {
                        var that = this;
    
                        $('input', this.footer()).on('keyup change clear', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
            },
        
        });
    });
    </script>
</body>

</html>
