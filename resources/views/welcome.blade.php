<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Library Reservation System</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Ensure the header sits on top */
        .header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            padding: 20px 0;
        }
        .navbar-brand img {
            height: 40px; /* Adjust logo size */
        }
        .nav-link {
            color: #333;
            font-weight: 600;
            margin-left: 20px;
            text-decoration: none;
        }
        .nav-link:hover {
            color: #0d6efd; /* Blue hover */
        }
        .hero-section {
            padding-top: 180px; /* Push content below header */
            padding-bottom: 100px;
            background-color: #f8f9fa; /* Light gray background */
        }
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: #212529;
            margin-bottom: 20px;
        }
        .hero-content p {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 40px;
        }
        .btn-main {
            background-color: #0d6efd;
            color: white;
            padding: 12px 30px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-main:hover {
            background-color: #0b5ed7;
        }
        .btn-outline {
            border: 2px solid #0d6efd;
            color: #0d6efd;
            background: transparent;
        }
        .btn-outline:hover {
            background-color: #0d6efd;
            color: white;
        }
    </style>
  </head>
  <body>

    <header class="header">
      <div class="container mx-auto px-6">
        <div class="flex items-center justify-between">
            <a class="navbar-brand flex items-center" href="#">
              <svg class="h-10 w-auto text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
              <span class="ml-3 text-xl font-bold text-gray-800">Aklat-taan</span>
            </a>
            
            <nav class="flex items-center">
                @auth
                    {{-- NAVIGATION LOGIC --}}
                    @if(auth()->user()->usertype_id == 1)
                        {{-- STUDENT: Show "My Bookings" --}}
                        <a href="{{ route('reservations.index') }}" class="nav-link">My Bookings</a>
                    @else
                        {{-- TEACHER/LIBRARIAN: Show "Dashboard" --}}
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    @endif
                @endauth
            </nav>
        </div>
      </div>
    </header>

    <section id="home" class="hero-section">
      <div class="container mx-auto px-6">
        <div class="flex flex-col-reverse lg:flex-row items-center">
          
          <div class="lg:w-1/2 lg:pr-12">
            <div class="hero-content">
              @auth
                  <h1>Welcome, {{ Auth::user()->name }}!</h1>
                  
                  {{-- HERO SECTION LOGIC --}}
                  @if(auth()->user()->usertype_id == 1)
                      <p>Ready to find your perfect study spot or resource? Go to the sections page to get started.</p>
                      {{-- Student goes to Dashboard to pick a section to book --}}
                      <a href="{{ route('dashboard') }}" class="btn-main">Book a Resource</a>
                  @else
                      <p>Manage library reservations and view section availability.</p>
                      {{-- Teacher/Librarian goes to Dashboard to view/manage --}}
                      <a href="{{ route('dashboard') }}" class="btn-main">Go to Dashboard</a>
                  @endif

              @else
                  <h1>Library Reservation System</h1>
                  <p>Welcome to Aklat-taan. Please login to book a discussion room, computer, or library section.</p>
                  <div class="flex gap-4">
                      <a href="{{ route('login') }}" class="btn-main">Login</a>
                      @if (Route::has('register'))
                          <a href="{{ route('register') }}" class="btn-main btn-outline">Register</a>
                      @endif
                  </div>
              @endauth
            </div>
          </div>
          
          <div class="lg:w-1/2 mb-12 lg:mb-0">
             {{-- Optional Image --}}
          </div>

        </div>
      </div>
    </section>
    </body>
</html>