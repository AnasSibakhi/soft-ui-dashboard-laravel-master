@extends('layouts.app')

@section('content')
<div class="container">
    <h2>إضافة طلب جديد</h2>
    <form method="POST" action="{{ route('user.orders.store') }}">
        @csrf
        <div class="mb-3">
            <label for="product" class="form-label">اسم المنتج</label>
            <input type="text" name="product" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">الكمية</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">إرسال</button>
    </form>
</div>
@endsection
