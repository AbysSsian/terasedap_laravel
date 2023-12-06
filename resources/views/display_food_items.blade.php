<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terasedap - Menu</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}" />
</head>

<body>
    @error('code')
    <div class="alert-warning">
        Please scan the qr code
    </div>
    @enderror
    <nav>
        <center>
            <div class="logo">
                <a href="{{ route('food-items') }}">
                    <img src="{{ asset('images/terasedap_logo.png') }}" alt="logo" />
                </a>
            </div>
        </center>
        <div class="cart-icon">
            <a href="{{ route('cart.view') }}">
                <img src="{{ asset('images/cart.png') }}" alt="cart" />
            </a>
        </div>
    </nav>
    
    <div class="motto">Experience Indonesian Culinary</div>
    <div class="centered-list">
        <ul class="horizontal-list">
            @foreach ($categories as $category)
            <li onclick="scrollToSection('{{$category->name}}')">{{ $category->name }}</li>
            @endforeach
        </ul>
    </div>

    @foreach ($categories as $category)
        
	<div class="scroll-target" id="{{$category->name}}">
        <center>
            <h1 class="list">{{$category->name}}</h1>
        </center>


        <div class="menu">
            <div class="menu-list">
                @foreach($foodItems->where('category_id', $category->id) as $item)
                    <livewire:components.menu-card :item="$item" />
                @endforeach
                </div>
        </div>

	</div>
    @endforeach

    <x-footer/>

    <script>
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);

        if (section) {
            section.scrollIntoView({
                behavior: "smooth"
            });
        }
    }
    </script>

</body>

</html>