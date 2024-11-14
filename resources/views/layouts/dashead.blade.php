<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{asset('fav-icon.png')}}">
  <title>dashboard</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('back/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('back/dist/css/adminlte.min.css')}}">
  <!-- bootstrap -->
  <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">

  <!-- chart -->
  <link rel="stylesheet" href="front/css/charts.min.css">
  <!-- own style -->
  <link rel="stylesheet" href="{{asset('front/css/my-style.css')}}">
</head>