<!DOCTYPE html>
<html lang="en">

@extends('admin.layouts.header')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<body>
    <input type="hidden" id="base_url" value="{{url('/')}}/" />
    <div class="container">
        @yield('content')
    </div>
    @extends('admin.layouts.footer')

</body>

</html>