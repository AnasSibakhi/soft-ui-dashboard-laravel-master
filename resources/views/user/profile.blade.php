@extends('layouts.app')

@section('content')
<div class="container">
    <h2>الملف الشخصي</h2>
    <p>الاسم: {{ Auth::user()->name }}</p>
    <p>البريد الإلكتروني: {{ Auth::user()->email }}</p>
</div>
@endsection
