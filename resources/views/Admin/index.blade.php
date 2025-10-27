<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet">
    <title>Admin</title>
    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/js/coreui.bundle.min.js"></script>
    <title>Welcome</title>
    <style>
        .btn-tertiary {
            color: #555;
            padding: 0;
            line-height: 40px;
            width: 300px;
            margin: auto;
            display: block;
            border: 2px solid #555;

            &:hover,
            &:focus {
                color: lighten(#555, 20%);
                border-color: lighten(#555, 20%);
            }
        }

        /* input file style */

        .input-file {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;

            +.js-labelFile {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                padding: 0 10px;
                cursor: pointer;
            }
        }

        /* profile */
        .hover-trigger {
            position: relative;
        }

        .show-on-hover {
            display: none;
            position: absolute;
            top: 100%;
        }

        .hover-trigger:hover .show-on-hover {
            display: block;
            z-index: 9;
        }

    </style>

    @yield('css_content')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <div style="margin-right: 62px;">
                    <form class="d-flex" method="post">
                        @csrf
                        <input type="text" name="action" hidden value="searchDataAdmin" id="">
                        <input class="form-control me-2" name="searchData" value="{{ isset($searchData)?$searchData:'' }}" id="searchproductid" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <form class="d-flex">

                    <div>
                        <div class="hover-trigger position-relative" style="margin-right: 20px;">
                            <h1><i class="fa-solid fa-circle-user"></i></h1>
                            {{session('adminname')}}
                            <div class="show-on-hover position-absolute" style="right: 0px; width: 222px; background: white;border-radius: 15px;">
                                <div class="shadow p-3 bg-body rounded">


                                    <div style="padding: 10px; border-bottom: 1px solid #555;">
                                        <a style="text-decoration: none;  color: #000;" href="/AdminProfile">
                                            Profile
                                        </a>
                                    </div>


                                    <a style="text-decoration: none;  color: #000;" href="{{ route('admin.Logout') }}">
                                        <div style="padding: 10px;color:red;">
                                            Logout
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </nav>

    <div class="c-app">
        <div class="sidebar sidebar-white sidebar-fixed" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <a href="/AdminInUser">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                    </a>

                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="/AdminInUser" id="usersnavbarid" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Users
                    </a>
                    <a href="/AdminInProduct" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Products
                    </a>
                    <a href="/AdminProductRating" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Product Rating
                    </a>
                    <a href="/AdminInOrder" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Order
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/catagorypage">
                        <i class="nav-icon cil-speedometer"></i> Category Add
                    </a>
                </li>

            </ul>
            <div class="sidebar-footer">
                <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
            </div>
        </div>

        <div class="wrapper d-flex flex-column min-vh-100 bg-light">

            <div class="body flex-grow-1 px-3" style="margin-left: 21%;">

                @yield('content')

            </div>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    @stack("script_content")

    <script>
        // status change
        // done
        function statuscheck_viewproduct() {
            if (document.getElementById('vpstock').value == "0") {
                document.getElementById('vpstatus').value = "out of stock";
            } else {
                if (document.getElementById('vpstock').value > 0) {
                    document.getElementById('vpstatus').value = "in stock";
                } else {
                    if (document.getElementById('vpstock').value < 0) {
                        document.getElementById('vpstatus').value = "out of stock";
                    } else {
                        document.getElementById('vpstatus').value = "";
                    }
                }
            }
        }
        $("#pstatus").on("change", function() {
            if (document.getElementById('pstatus').value == "out of stock") {
                document.getElementById('pstock').value = 0;
            }
        });

    </script>
</body>

</html>
