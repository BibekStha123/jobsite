<x-admin-layout>
    <div class="container">
        <div class="card card-primary mt-5">
            <div class="card-header">
                <h3 class="card-title">Edit {{$user->name}}</h3>
            </div>
            <form method="POST" action="/user/{{$user->id}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter name"
                            name="name" value="{{ $user->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                            name="email" value="{{ $user->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
