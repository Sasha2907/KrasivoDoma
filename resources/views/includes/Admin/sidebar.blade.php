<div class="sidebar-wrapper">
    <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="menu"
            data-accordion="false"
        >
            <li class="nav-header">ADMIN PANEL</li>
            <li class="nav-item">
                <a href="{{route('admin.review.index')}}" class="nav-link">
                    <p style="color:white;">Отзывы</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.products.index')}}" class="nav-link">
                    <p style="color:white;">Товары</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.suppliers.index')}}" class="nav-link">
                    <p style="color:white;">Поставщики</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('fabrics.index')}}" class="nav-link">
                    <p style="color:white;">Ткани</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.preorders.index')}}" class="nav-link">
                    <p style="color:white;">Пред-заказы</p>
                </a>
            </li>
        </ul>
        
        <!--end::Sidebar Menu-->
    </nav>
</div>
