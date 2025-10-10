@extends('Admin.index')
@section('css_content')
<style>
    .pagination {
        margin-bottom: 0px;
        margin-right: 120px;
    }

</style>
@endsection
@section('content')
@if ($data->isNotEmpty())
<div id="dataOutput" class="mt-3">
    <h1>Show Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>


            @foreach ($data as $item)
            <tr>
                <th scope="col">{{$item->name}}</th>
                <th scope="col">{{$item->address}}</th>
                <th scope="col">{{$item->phone}}</th>
                <th scope="col">{{$item->email}}</th>
                <th scope="col">{{$item->rols}}</th>
                <th scope="col">
                    <div class="row">
                        <div class="col-4">
                            <a href="/AdminInUserUpdate/{{ $item->id }}">
                                <button type="button" class="btn btn-primary">
                                    Edit
                                </button>
                            </a>
                        </div>
                        <div class="col-8">
                            <button type="button" class="btn btn-danger" onclick="deleteuserdata('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal" data-bs-target="#AdminUserDeleteModal">
                                Delete
                            </button>
                        </div>
                    </div>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">

        <div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">
            <div class="card row" style="margin-left: 0px;width: 96%;height: 58px;justify-content:center;">
                <div class="col-2">
                    Page {{ $data->currentPage() }} of {{ $data->lastPage() }} in {{ $data->count() }} Records
                </div>
                <div class="col-10" style="display: flex;justify-content: center;">
                    {{ $data->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @else
    <div style="display: flex;justify-content: center;margin-top: 116px;">
        <div>
            <div style="width: 100px; height: auto; display: flex;justify-content: center;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
            </div>
        </div>
    </div>
    <div style="display: flex;justify-content: center;text-align: center;">
        <div>

            <h5>Sorry, no results found <br /></h5>
            Edit search or go back to Users Page <br /><br />
            <a href="/AdminInUser">
                <button class="btn btn-primary" style="width: 192px;">Go To Users</button>
            </a>
        </div>
    </div>
    @endif

    <!--User Delete Modal -->
    <div class="modal fade" id="AdminUserDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">User Delete Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admindashboard')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        Are You Sore This Record Delete
                        <label id="deletenameuser" style="font-weight: bold"></label>
                        <input id="deleteuserid" name="id" name="id" hidden>
                        <input type="text" name="action" hidden value="remove">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @endsection

    @push("script_content")


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function deleteuserdata(id, name) {
            document.getElementById("deletenameuser").textContent = name;
            document.getElementById("deleteuserid").value = id;
        }

        // Search data-bs-target
        function searchproduct() {
            console.log($("#searchproductid").val());
            $.ajax({
                type: "get"
                , url: "/SearchData/" + $("#searchproductid").val() + "/User"
                , success: function(res) {
                    console.log(res);

                }
                , error: function(e) {
                    console.log(e);
                }
            });
        }

    </script>
    @endpush
