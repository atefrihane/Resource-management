@extends('layout.main')
@section('title', 'Admin')
@section('content')
<div id="app">
    <show-admin-resources/> 
</div>

</div>
<script src="{{ mix('js/showAdminResources.js') }}"></script>
@endsection

