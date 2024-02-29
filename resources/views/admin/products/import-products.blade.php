@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Import products</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.upload.products') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="fileinput">File input(Datasheet)</label>
                    <input type="file" class="form-control" id="fileinput" name="file">
                </div>
                <div style="float: right">
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-success">Upload Products</button>
                </div>
            </form>
        </div>
    </div>
@endsection
