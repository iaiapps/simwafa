<header class="position-fixed header w-100 bg-body-tertiary shadow">

    <nav class="d-flex align-items-center">
        <div class="icon text-center align-middle bg-secondary">
            {{-- <i class="bi bi-list-check d-sm-none fs-2 text-white"></i> --}}
            <p class="d-sm-none fs-2 text-white m-0">SW</p>
            <a class="navbar-brand d-none d-sm-block fs-4 text-white" href="#"> SimWafa</a>
        </div>
        <div class="flex-grow-1 px-3">
            <div class="float-start">
                <button id="buttonSidebar" class="btn btn-primary"><i class="bi bi-columns-gap"></i></button>
            </div>
            <div class="float-end d-flex">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">logout</button>
                </form>
            </div>
        </div>
    </nav>

</header>
