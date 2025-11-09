@extends('layouts.app')
@section ("content")
<style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.41), #e6ffaaff);
        }
        .hero {
            background: linear-gradient(to right, rgba(255, 255, 255, 0.41), #e5ffbaff);
            color: #333;
            padding: 100px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
            margin: 20px 0;
        }
        .feature-card img {
            height: 150px;
            object-fit: cover;
        }
        
        .card{
            background: linear-gradient(to right, rgba(166, 238, 178, 0.41), #eaf3e0ff);
        }
    </style>
    <section class="hero">
        <div class="container">
            <h1>Welcome to Test Site</h1>
            <p>Manage your employees efficiently, track details, and keep your team organized.</p>
            @if(Auth::user())
                <a href="{{ route('view') }}" class="btn btn-success btn-lg mt-3">View Employees</a>
                <a href="{{ route('add') }}" class="btn btn-outline-secondary btn-lg mt-3">Add Employee</a>
            @else
                <a href="{{ route('signup') }}" class="btn btn-success btn-lg mt-3">Get Started</a>
            @endif
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 shadow-sm">
                        <img src="https://res.cloudinary.com/dxenqv1hp/image/upload/v1762657251/main-sample.png" class="card-img-top" alt="All Employees">
                        <div class="card-body">
                            <h5 class="card-title">All Employees</h5>
                            <p class="card-text">View and manage all employees in one place with detailed information.</p>
                            <a href="{{route('view')}}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 shadow-sm">
                        <img src="https://res.cloudinary.com/dxenqv1hp/image/upload/v1762657247/samples/coffee.jpg" class="card-img-top" alt="Add Employee">
                        <div class="card-body">
                            <h5 class="card-title">Add Employee</h5>
                            <p class="card-text">Quickly add new employees with all necessary details and assign IDs.</p>
                            <a href={{route("add")}} class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card h-100 shadow-sm">
                        <img src="https://res.cloudinary.com/dxenqv1hp/image/upload/v1762657244/samples/balloons.jpg" class="card-img-top" alt="Add Employee">
                        <div class="card-body">
                            <h5 class="card-title">Edit Employee</h5>
                            <p class="card-text">Edit employees with all necessary details and photos can be reuploaded.</p>
                            <a href="#" class="btn btn-danger disabled">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection