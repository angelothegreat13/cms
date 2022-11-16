@include('layouts._top')
<div id="wrapper">
    @include('layouts._sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('layouts._header')
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
                @yield('content')
            </div>
        </div>
        @include('layouts._footer')
    </div>
</div>
@include('layouts._bottom')
