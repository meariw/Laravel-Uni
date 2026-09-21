@extends('layouts.app')

@section('title', 'Контакты — Aesthetic Café & Bakery')

@section('content')
    <h1>Контакты</h1>
    <ul style="list-style: none; padding: 0; font-size: 17px; line-height: 1.8;">
        <li><strong>Адрес:</strong> {{ $contacts['address'] }}</li>
        <li><strong>Телефон:</strong> {{ $contacts['phone'] }}</li>
        <li><strong>Email:</strong> {{ $contacts['email'] }}</li>
        <li><strong>Часы работы:</strong> {{ $contacts['worktime'] }}</li>
        <li><strong>Instagram:</strong> {{ $contacts['instagram'] }}</li>
    </ul>
@endsection