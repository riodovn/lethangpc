@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Xem chi tiết chính sách bảo hành</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Tiêu đề:</strong>
                    <p>{{ $policy->title }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Nội dung:</strong>
                    <p>{!! $policy->content !!}</p>
                </div>
            </div>
            <a href="{{ route('admin.warranty_policies.edit', $policy->id) }}" class="btn btn-warning">Chỉnh sửa</a>
            <form action="{{ route('admin.warranty_policies.destroy', $policy->id) }}" method="post" style="display: inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
        </div>
    </div>
@endsection
