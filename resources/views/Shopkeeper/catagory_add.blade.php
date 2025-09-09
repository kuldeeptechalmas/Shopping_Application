@extends('Shopkeeper.index')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div>
        Add : <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addcatagory"
            aria-current="page">Catagory</button>
    </div>
    <br>
    <div>
        Add : <button type="button" class="btn btn-success" onclick="cleansubcatagory()" data-bs-toggle="modal" data-bs-target="#addsubcatagory"
            aria-current="page">Sub Catagory</button>
    </div>

    <div id="catagorytabledata">

    </div>

    <!--Add Catagory Modal -->
    <div class="modal fade" id="addcatagory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Catagory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="margin-right: 10%;margin-left: 9%;">
                    <form enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name </label>
                            <input type="text" class="form-control" id="cname" name="name" aria-describedby="emailHelp">
                        </div>
                        <div style="color:red;" id="ecname" hidden></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary closemodel" onclick="addcatagory()">save</button>
                </div>
            </div>
        </div>
    </div>

    <!--Add Sub Catagory Modal -->
    <div class="modal fade" id="addsubcatagory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sub Catagory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="margin-right: 10%;margin-left: 9%;">
                    <form enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name </label>
                            <input type="text" class="form-control" id="scname" name="name" aria-describedby="emailHelp">
                        </div>
                        <div style="color:red;" id="escname" hidden></div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Catagory</label>
                                <select class="form-select" id="sccatagory" name="catagory">
                                    <option value="">Select</option>
                                    @if (isset($catagory))
                                        @foreach ($catagory as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div style="color:red;" hidden id="esccatagory"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary closemodel" onclick="addsubcatagory()">save</button>
                </div>
            </div>
        </div>
    </div>

    <!--View Catagory Modal -->
    <div class="modal fade" id="viewcatagory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Catagory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="margin-right: 10%;margin-left: 9%;">
                    <form enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name </label>
                            <input type="text" class="form-control" id="vcname" name="name" aria-describedby="emailHelp">
                            <input type="text" class="form-control" hidden id="vcid">
                        </div>
                        <div style="color:red;" id="evcname" hidden></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary closemodel" onclick="viewcatagorydata()">save</button>
                </div>
            </div>
        </div>
    </div>

    <!--Sub Catagory Delete Modal -->
    <div class="modal fade" id="deletesubcatagory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sub Catagory Delete Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You Sore This Record Delete
                    <label id="deletenamesubcatagory" style="font-weight: bold"></label>
                    <label id="deletesubcatagoryid" hidden></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger closemodel"
                        onclick="deleteReacordSubCatagory()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!--Catagory Delete Modal -->
    <div class="modal fade" id="deletecatagory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Catagory Delete Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You Sore This Record Delete
                    <label id="deletenamecatagory" style="font-weight: bold"></label>
                    <label id="deletecatagoryid" hidden></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger closemodel"
                        onclick="deleteReacordCatagory()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        function deletecatagory(id,name) {
            console.log(name);
            
            document.getElementById("deletecatagoryid").textContent = id;
            document.getElementById("deletenamecatagory").textContent = name;
        }

        function deleteReacordCatagory()
        {
            $.ajax({
                type: "delete",
                url: "/catagorydelete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    deleteid: document.getElementById("deletecatagoryid").textContent
                },
                success: function (res) {
                    console.log(res);
                    $(".closemodel").prev().trigger('click');
                    show_catagory();
                },
            });
        }

        // delete sub catagory
        function removesubcatagory(removeid, name) {
            document.getElementById("deletesubcatagoryid").textContent = removeid;
            document.getElementById("deletenamesubcatagory").textContent = name;
        }

        function deleteReacordSubCatagory() {
            $.ajax({
                type: "delete",
                url: "/subcatagorydelete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    deleteid: document.getElementById("deletesubcatagoryid").textContent
                },
                success: function (res) {
                    console.log(res);
                    $(".closemodel").prev().trigger('click');
                    show_catagory();
                },
            });

        }

        // view catagory
        function viewcatagory(name, id) {
            document.getElementById("vcname").value = name;
            document.getElementById("vcid").value = id;

        }

        function viewcatagorydata() {
            $.ajax({
                type: "get",
                url: "/catagoryupdate",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: document.getElementById("vcid").value,
                    name: document.getElementById("vcname").value,
                },
                success: function (res) {
                    console.log(res);
                    $(".closemodel").prev().trigger('click');
                    show_catagory();
                },
                error: function (e) {
                    const data = e["responseJSON"]["errors"];
                    console.log(e);

                    if (data["category_name"]) {
                        $("#evcname").text(data["category_name"]["0"]).removeAttr("hidden");
                    }

                }
            });
        }

        // add sub catagory
        function addsubcatagory() {
            $.ajax({
                type: "post",
                url: "/subcatagoryadd",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: document.getElementById("scname").value,
                    catagory: document.getElementById("sccatagory").value,
                },
                success: function (res) {
                    console.log(res);
                    $(".closemodel").prev().trigger('click');
                    show_catagory();
                },
                error: function (e) {
                    const data = e["responseJSON"]["errors"];
                    console.log(e);

                    if (data["name"]) {
                        $("#escname").text(data["name"]["0"]).removeAttr("hidden");
                    }
                    if (data["catagory"]) {
                        $("#esccatagory").text(data["catagory"]["0"]).removeAttr("hidden");
                    }
                }
            })
        }

        function cleansubcatagory() {
            console.log("show all");
            
            show_catagory();
            document.getElementById("scname").value = "";
            document.getElementById("sccatagory").value = "";
            $("#escname").attr("hidden", true);
            $("#esccatagory").attr("hidden", true);
        }

        // add catagory
        function addcatagory() {

            $.ajax({
                type: "post",
                url: "/catagoryadd",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: document.getElementById("cname").value
                },
                success: function (res) {
                    $(".closemodel").prev().trigger('click');
                    show_catagory();
                },
                error: function (e) {
                    if (e["responseJSON"]["errors"]["name"]["0"]) {
                        $("#ecname").text(e["responseJSON"]["errors"]["name"]["0"]).removeAttr("hidden");
                    }
                }
            })
        }

        $("#addcatagory").on("click", function () {
            document.getElementById("cname").value = "";
            $("#ecname").attr("hidden", true);
        })

        $(document).ready(function () {

            console.log("hello");
            show_catagory();
        })

        function show_catagory() {
            $.ajax({
                type: "get",
                url: "/catagoryget",
                success: function (res) {
                    $("#catagorytabledata").html(res);
                },
                error: function (e) {

                }
            })
        }
    </script>
@endsection