@extends('index')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col"></div>
    <div class="col-6"></div>
    <div class="col">
        <button type="submit" class="btn btn-primary" onclick="getprofileuser('{{$customer_profile->email}}')" data-bs-toggle="modal" data-bs-target="#profilemodel">Edit
            Profile</button>
    </div>
</div>
<form class="mx-1 mx-md-4" method="post">
    @csrf
    <div class="row justify-content-evenly">
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example1c">Your Name</label>
                    <input type="text" disabled value="{{$customer_profile->name}}" class="form-control" />
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example1c">Phone No</label>
                    <input type="text" disabled value="{{$customer_profile->phone}}" class="form-control" />
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-evenly">
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example1c">Gender :</label><br> <input disabled type="radio" value="male" {{$customer_profile->gender == 'male' ? 'checked' : '' }} />Male<input type="radio" value="female" disabled {{$customer_profile->gender == 'female' ? 'checked' : '' }} />Female
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example1c">Address : </label>
                    <input type="text" disabled value="{{$customer_profile->address}}" class="form-control" />
                </div>
            </div>
        </div>
    </div>

    <input type="text" name="rols" id="roles" hidden>

    <div class="row justify-content-evenly">
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example1c">Country</label>
                    <select class="form-select" disabled id="upcountry" value="{{old('country')}}">
                        <option>Select</option>
                        @if (isset($contrylist))
                        @foreach ($contrylist as $item)
                        <option value={{$item['id']}} {{$customer_profile->country == $item['id'] ? 'selected' : ''}}>
                            {{$item['name']}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="state">State</label>
                    <select class="form-select" disabled id="upstate" value="{{$customer_profile->state}}">
                        <option>Select</option>
                    </select>
                    @error('state')
                    <div style="color:red;">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-evenly">
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example1c">City</label>
                    <select placeholder="Select" disabled id="upcity" class="form-select" value="{{$customer_profile->city}}">
                        <option>Select</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" for="form3Example1c">Pincode</label>
                    <input type="text" disabled value="{{$customer_profile->pincode}}" class="form-control" />
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-evenly">
        <div class="col-4">
            <div class="d-flex flex-row align-items-center mb-4">
                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <label class="form-label" disabled for="form3Example3c">Your Email</label>
                    <input type="text" disabled value="{{$customer_profile->email}}" class="form-control" />

                </div>
            </div>
        </div>
    </div>
</form>

<!--Customer Profile Modal -->
<div class="modal fade" id="profilemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Customer Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userprofilebody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="update()">Save Chang</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('js/customer/customerprofile.js') }}"></script>
@endsection
