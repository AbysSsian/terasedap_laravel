<style>
    #menu-manager {
        margin-top: 1.5rem;
    }

    #category-list {
        display: flex;
        justify-content: space-between;
        overflow:scroll;
    }

    li {
        list-style-type: none;
    }
    .category-list-item {
        display: grid;
        align-items: center;
        min-width: max-content;
        padding: 6px 1rem;
        border-radius: 20px;
        margin: 8px;
        overflow:hidden;
        background-color: #5F5A55;
        text-align: center;
        a {
            color: #dddddd;
            text-decoration: none;
        }
    }

    .category-list-item:hover {
        cursor: pointer;
    }

</style>
<div id="menu-manager">
    <ul id="category-list">
        @foreach ($categories as $category)
        <li class="category-list-item" onclick="scrollToSection('{{$category->name}}')">
            <a>{{$category->name}}</a>
        </li>
        @endforeach
    </ul>
    <div id="admin-menu">
        @foreach ($categories as $category)
            <div class="scroll-target category-section" id="{{$category->name}}">
                <h2>{{ $category->name}}</h2>
                <div class="menu-section">
                    @foreach ($category->items as $food)
                        <livewire:Components.AdminMenu :detail="$food" wire:key="{{$food->id}}" />
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    @foreach ($categories as $category)
        @foreach ($category->items as $menu)
        <livewire:Components.DeleteMenuModal :menu="$menu" wire:key="{{$menu->id}}" />
        @endforeach
    @endforeach
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
</div>

