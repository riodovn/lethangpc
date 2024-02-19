@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách chính sách bảo hành</h3>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.warranty_policies.create') }}" class="btn btn-primary mb-4">Tạo mới</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($policies as $policy)
                    <tr>
                        <td>{{ $policy->title }}</td>
                        <td>{{ Str::limit($policy->content, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.warranty_policies.show', $policy->id) }}" class="btn btn-info">Xem</a>
                            <a href="{{ route('admin.warranty_policies.edit', $policy->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('admin.warranty_policies.destroy', $policy->id) }}" method="post" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection