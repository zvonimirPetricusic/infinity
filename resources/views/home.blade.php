@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<!-- Bootstrap Font Icon CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link href="{{ asset('css/nav/aside.css') }}" rel="stylesheet">
<script type="application/javascript" src="{{ asset('js/similarity.min.js') }}"></script> 


<body>
    @include('structure.adminStructure')
    <div id="subHeaderContainer">
        <h3><img src="../../img/dashboardBlack.png" class="icon" alt="Dashboard icon"> &nbsp; Dashboard</h3>
    </div>

</body>

@endsection
