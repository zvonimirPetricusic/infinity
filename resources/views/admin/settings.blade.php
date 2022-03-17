@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<!-- Bootstrap Font Icon CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link href="{{ asset('css/nav/aside.css') }}" rel="stylesheet">


<body>
    @include('structure.adminStructure')
    <div id="subHeaderContainer">
        <h3><img src="../../img/settingBlack.png" class="icon" alt="Settings icon"> &nbsp; Settings</h3>
    </div>
</body>
@endsection
