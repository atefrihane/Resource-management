@extends('layout.main')
@section('title', 'Visitor')
@section('content')
<div id="app">
    <show-visitor-resources/> 
</div>

</div>
<script src="{{ mix('js/showVisitorResources.js') }}"></script>
@endsection

