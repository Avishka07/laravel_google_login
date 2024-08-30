<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <br /><br /><br />
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login User Data</div>
                    <div class="card-body google-login-icons">
                        <h2>Hi {{ Auth::user()->name }}</h2>
                        <br />
                        <h3>You Are Logged in Now</h3>
                        <br />
                        <p>Welcome to laravel website!</p><br />
                        <div class="col-md-4 offset-md-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="btn btn-danger" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                        </div><br />
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>