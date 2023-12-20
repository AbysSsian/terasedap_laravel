<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/input.css')}}" />
    <title>Terasedap | Edit Menu</title>
</head>

<body>
    <div class="navbar">
        <div>
            <img src="{{ asset('images/terasedap_logo.png') }}" alt="logo" />
        </div>
        <ul>
            <li><a href="{{ route('admin.orders')}}">Orders</a></li>
            <li><a href="{{ route('admin.history')}}">Order History</a></li>
            <li><a href="{{route('admin.menu')}}">Menu Management</a></li>
            <li><a href="{{route('admin.category')}}">Category Management</a></li>
            <li><a href="{{ route('logout')}}">Logout</a></li>
        </ul>
    </div>
    <main>
        <div style="display: flex; align-items:center">    
            <a href="{{route('admin.menu')}}" style="margin-right: 10px"><x-iconsax-out-arrow-left style="width: 28px; color:#e9e9e9; font-weight:bold" />

            </a>
            <h2>Edit Menu</h2>
        </div>
        <div style="margin-top:32px; display:flex; justify-content: center;">
            <form action="{{route('save_menu', $menu->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('post')
                <div id="editing">
                    <div id="image-upload">
                        {{-- <div id="previous-image">
                            <img src="{{ $menu->getImageURL() }}" alt="{{$menu->name}}">
                        </div>    --}}
                        <div id="input-image">
                            <img src="{{ $menu->getImageURL() }}" alt="menu-image">
                            <span>Select an image</span>
                            <input type="file" class="file" accept="image/*" id="image" name="image">
                        </div>
                    </div>
                    <div id="input-section">
                        <div class="input-row">
                            <div class="input-group">
                                <label for="name" class="input-label">Menu Name</label>
                                <input type="text" name="name" id="name" class="input-field" value="{{$menu->name}}">
                            </div>
                            <div class="input-group">
                                <label for="price" class="input-label">Price</label>
                                <input type="number" name="price" id="price" class="input-field" value="{{$menu->price}}">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="description" class="input-label">Description</label>
                                <textarea class="input-area" name="description" id="description"><?php echo($menu->description) ?></textarea>
                            </div>
                            <div class="input-group">
                                <label for="category" class="input-label">Category</label>
                                <select name="category" id="category" class="input-field" style="height: 36px; width:310px">
                                    @foreach ($categories as $category)
                                    @if ($category->id == $menu->category_id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="save-button">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
        
    </main>
    <x-footer />
    <script>
        const input = document.querySelector('#input-image input');
        const preview = document.querySelector('#input-image img');

        input.addEventListener("change", () => {
            let file = input.files[0];

            preview.src = URL.createObjectURL(file);
        });
    </script>
    {{-- <script>
        let input = document.querySelector('#input-image input');
        let inputdiv = document.querySelector('#input-image');
        let source = '';
        input.addEventListener("change", () => {
            const file = input.files[0];

                URL.revokeObjectURL(source);

            source = URL.createObjectURL(file);
            displayImage(source);
        });

        inputdiv.addEventListener("drop", (e) => {
            e.preventDefault();
            input.files = e.dataTransfer.files;
            const file = input.files[0];

                URL.revokeObjectURL(source);

            source = URL.createObjectURL(file);
            displayImage(source);
        });

        function displayImage(source) {
            console.log(source);
            var image = `
                    <p style="z-index: 2;">Drag and drop image here or <span class="browse">Browse</span></p>
                    <input type="file" class="file" accept="image/*" style="z-index: 2;">
                    <img src="${source}" alt="uploaded-image">
                `;

            inputdiv.innerHTML = image;
        }
    </script> --}}
</body>

</html>