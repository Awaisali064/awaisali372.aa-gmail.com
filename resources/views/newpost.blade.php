    @if ($errors->any())
    <div class="col-sm-12">
        <div class="alert  alert-warning alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
            <span>
                <p>{{ $error }}</p>
            </span>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    @if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <!DOCTYPE html>
    <html>

        <head>


            <title>Admin Panel</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://fonts.google.com/specimen/Josefin+Sans?query=josefin">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" />
            <script>
            function manageCelebrity() {
                document.getElementById('head').innerHTML = "Manage Users";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this
                            .responseText;
                    }
                }
                xmlhttp.open("GET", "Listcelebrity?q=", true);
                xmlhttp.send();
            }

            function show(id, role) {
                //alert('welcome');
                document.getElementById('head').innerHTML = "Users";
                $.ajax({
                    type: "POST",
                    url: '/show',
                    data: {
                        user_id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data) {
                        console.log(data);
                        document.getElementById("txtHint")
                            .innerHTML = data;
                    },
                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                    },
                });
            }

            function edit(id) {
                //alert('edit');
                document.getElementById('head').innerHTML = "Edit User Details";
                $.ajax({
                    type: "POST",
                    url: '/editUser',
                    data: {
                        user_id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data) {
                        console.log(data);
                        document.getElementById("txtHint")
                            .innerHTML = data;
                    },
                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                    },
                });
            }

            function deleteCelebrity(id) {
                document.getElementById('head').innerHTML = "Delete User";
                $.ajax({
                    type: "POST",
                    url: '/DeleteUser',
                    data: {
                        user_id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data) {
                        console.log(data);
                        document.getElementById("txtHint")
                            .innerHTML = data;
                    },
                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                    },
                });

            }
            </script>


        </head>


        <body>

            <div class="w3-sidebar w3-bar-block w3-collapse w3-card " style="width:200px; background-color:#06242A"
                id="mySidebar">
                <button class="w3-bar-item w3-button w3-large w3-hide-large" style="color:#ffffff;"
                    onclick=" w3_close()">Close &times;</button>
                <section>
                    <nav class="navbar text-light " style=" font-size: 20px; height:60px; background-color:black;">
                        <h1>PANEL</h1>
                    </nav>
                    <div class="footer--nav-title" data-ce-key="414"
                        style="color: #89CBDF; font-size: 20px; margin-top:20px;"></div>
                    <nav class="navbar " style=" font-size: 20px ">
                    </nav>
                    <nav class="navbar " style=" font-size: 20px ">
                        <ul class="navbar-nav ">
                            @role('admin')
                            <li><a class=" text-light" title="List Celebrity" href="#" onclick="manageCelebrity()"
                                    data-ce-key="426">Manage Users</a> </li>
                            @endrole
                        </ul>
                    </nav>
                    <nav class="navbar " style=" font-size: 20px ">
                        <ul class="navbar-nav ">
                            @role('writer|admin')
                            <li><a class=" text-light" title="List Users" href="newpost" data-ce-key="426">Create
                                    Post</a> </li>
                            @endrole
                        </ul>
                    </nav>
                    <nav class="navbar " style=" font-size: 20px ">
                        <ul class="navbar-nav ">
                            @role('editor|admin')
                            <li><a class=" text-light" title="List Celebrity" href="edit" data-ce-key="426">Edit
                                    Post</a>
                            </li>
                            @endrole
                        </ul>
                    </nav>
                    <nav class="navbar " style=" font-size: 20px ">
                        <ul class="navbar-nav ">
                            @role('publisher|admin')
                            <li><a class=" text-light" title="List Celebrity" href="edit" data-ce-key="426">Publish
                                    Post</a>
                            </li>
                            @endrole
                        </ul>
                    </nav>
                </section>
            </div>
            <div class="w3-main mb-0" style="margin-left:200px; ">
                <section>
                    <hader>
                        <nav class="navbar navbar-expand-sm  sticky-top " style="background-color:black; ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" onclick="w3_open()"
                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"
                                    style="background-color: #06242A; color: #FF9C2B; "></span>
                            </button>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#robust"
                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"
                                    style="background-color: #06242A; color: #FF9C2B; icon-color:#FF9C2B;"></span>
                            </button>
                            <ul class="list-inline ml-auto mb-0">
                                <li class="list-inline-item ">
                                    <h3 class="text-light ml-center" id="head">Create Post</h3>
                                </li>
                            </ul>
                            <ul class="list-inline ml-auto mb-0">
                                <li class="list-inline-item ">
                                    <a class="nav-link  arrow-none waves-effect nav-user" data-toggle="dropdown"
                                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img src="images/IMG-20181119-WA0021.jpg" alt="user" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!--  <a class="dropdown-item" href="#"><i
                                                class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>-->
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <section>
                            <div class="container-fluaid p-5" style="min-height: 85vh;" id="txtHint">
                                <div>
                                </div>
                                <section>
                                    <div class="container">
                                        <div class="row mb-5">


                                            <div class="col-md-12" style="padding-top:30px;">
                                                <a class="btn btn-primary px-3" href="home"
                                                    style="float:right;">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="card-header text-center bg-primary"
                                                        style="font-size: 25px;">
                                                        {{ __('Create Post') }}
                                                    </div>

                                                    <div class="card-body">
                                                        @if (session('status'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session('status') }}
                                                        </div>
                                                        @endif

                                                        <form action="create" method="POST">
                                                            {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control" name="title"
                                                                    require>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Body</label>
                                                                <textarea type="text" class="form-control" name="body"
                                                                    require>
                                                                </textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary px-3">Create
                                                                Post</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            </div>

                        </section>
                        <footer style="background-color:black; margin-bottom:-14px;">
                            <p class="text-center text-light p-3">&copy;2020 Admin Panel</p>
                        </footer>
                    </hader>
                </section>
            </div>
        </body>

    </html>