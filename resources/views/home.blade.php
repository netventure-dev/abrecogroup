<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>MBIFL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />


    <link href="{{ asset('assets/css/front.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>

<body data-spy="scroll" data-target="#navbarSupportedContent">
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light fixed-">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="https://www.mbifl.com/wp-content/uploads/2022/11/Group-4.svg" alt="logo"
                            width="60" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.mbifl.com/">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.mbifl.com/about-mbifl/">ABOUT MBIFL</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="https://mathrubhumimediaschool.com/mbifl/">BOOK
                                    TICKETS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.mbifl.com/activities/">ACTIVITIES</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    EDITION
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="https://www.mbifl.com/edition-2020/">EDITION
                                            2020</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.mathrubhumi.com/">MATHRUBHUMI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.mbifl.com/speakers-2023/">SPEAKERS 2023</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main style="padding: 50px 0; text-align: center; margin-top: 0;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <button id="search-data">Search</button>
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
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td class="td_pad">{{ @$schedule->schedule_date }}</td>
                                    <td class="td_pad">{{ @$schedule->schedule_time }}</td>
                                    <td class="td_pad">{{ @$schedule->venue }}</td>
                                    <td class="td_pad">{{ @$schedule->topic }}</td>
                                    <td class="td_pad">{{ @$schedule->speakers }}</td>
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
    </main>

    <footer class="page-footer font-small pt-4 bg-light">
        <div class="container text-md-left">
            <div class="row">
                <div class="col-md-2">
                    <a class="navbar-brand" href="#">
                        <img src="https://www.mbifl.com/wp-content/uploads/2022/11/Group-4.svg" alt="logo"
                            width="80" />
                    </a>
                </div>
                <div class="col-md-10">
                    <ul class="list-unstyled">
                        <li><a href="https://www.mbifl.com/">HOME</a></li>
                        <li><a href="https://www.mbifl.com/about-mbifl/">ABOUT MBIFL</a></li>
                        <li><a href="https://mathrubhumimediaschool.com/mbifl/">BOOK TICKETS</a></li>
                        <li><a href="https://www.mbifl.com/activities/">ACTIVITIES</a></li>
                        <li><a href="https://www.mbifl.com/edition-2020/">EDITION 2020</a></li>
                        <li><a href="https://www.mathrubhumi.com/">MATHRUBHUMI</a></li>
                        <li><a href="https://www.mbifl.com/speakers-2023/">SPEAKERS 2023</a></li>
                    </ul>
                    <p class="float-left">Copyright © The Mathrubhumi Printing and Publishing Company Limited 2022.</p>
                    <ul class="list-inline social float-right">
                        <li class="list-inline-item"><a target="_blank" href="https://fb.com/mbifl"><i
                                    class="fab fa-facebook-f"> </i></a></li>
                        <li class="list-inline-item"><a target="_blank" href="https://twitter.com/mbifl2021"><i
                                    class="fab fa-twitter"> </i></a></li>
                        <li class="list-inline-item"><a target="_blank" href="https://www.instagram.com/mbifl/"><i
                                    class="fab fa-instagram"> </i></a></li>
                        <li class="list-inline-item"><a target="_blank" href="https://www.youtube.com/mbifl"><i
                                    class="fab fa-youtube"> </i></a></li>
                    </ul>
                    <ul class="list-inline policy float-left w-100">
                        <li class="list-inline-item m-0"><a href="https://www.mbifl.com/privacy-policy/">Privacy
                                Policy</a></li>
                        <li class="list-inline-item m-0"><a href="https://www.mbifl.com/terms-and-conditions/">T&C</a>
                        </li>
                        <li class="list-inline-item m-0"><a href="https://www.mbifl.com/contact-us">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src=" https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input class="foot_pad" type="text" placeholder="Search '+title+'" />');
            });

            // DataTable
            var table = $('#example').DataTable({
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },

            });
        });
        $(document).ready(function(){
            $('#search-data').click(function(){
                $('#example tfoot').toggle();
                if ($(this).text() == "Search")
                    $(this).text("Close")
                else
                    $(this).text("Search");
            })
        });
    </script>
</body>
</html>