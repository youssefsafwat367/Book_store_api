<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="icon" href="{{asset('assets')}}/images/logo.png" type="image/x-icon"/>
  <link rel="stylesheet" href="{{asset('assets')}}/css/vendors/all.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/vendors/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/vendors/owl.carousel.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/vendors/owl.theme.default.min.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/main.min.css">
</head>
@yield('content')
