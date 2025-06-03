@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3>Edit Profile</h3>
        <form>
            <div class="mb-3">
                <label class="form-label">Nama Laundry</label>
                <input type="text" class="form-control" value="Apple Laundry">
            </div>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </form>
    </div>
@endsection
