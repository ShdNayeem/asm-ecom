@extends('layouts.app')
@section('title', 'ASM Ecom')
@section('content')

<livewire:frontend.index :mobileProducts="$mobileProducts" :mobileCategory="$mobileCategory"/>

@endsection