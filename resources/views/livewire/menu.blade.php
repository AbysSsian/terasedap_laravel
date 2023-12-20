@push('styles')
    <link rel="stylesheet" href="{{ asset('css/livewire.css') }}">
@endpush

<main>
    <div class="container admin">
        <p id="page-title">
            Menu Management
        </p>
        <div style="margin-top:20px">
            <a class="sign-button" href="{{ route('add-menu')}}">
                Add Menu
            </a>
        </div>
        <livewire:components.menu-management />
    </div>

</main>
